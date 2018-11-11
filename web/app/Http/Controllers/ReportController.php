<?php
/**
 * ReportController
 *
 * PHP version 7
 *
 * @category Controller
 * @package  ReportController
 * @author   XuanDD <xuandd@lifull-tech.vn>
 * @link     https://bitbucket.org/dinhdiemxuan/reportchain
 */
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use App\Models\Issue;
use App\Models\Prefecture;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Encore\Admin\Auth\Permission;

/**
 * Class ReportController
 *
 * PHP version 7
 *
 * @category Controller
 * @package  ReportController
 * @author   XuanDD <xuandd@lifull-tech.vn>
 * @link     https://bitbucket.org/dinhdiemxuan/reportchain
 */
class ReportController extends Controller
{
    use HasResourceActions;

    /**
     * Completed Reports
     *
     * @param Content $content to display
     *
     * @return Content
     */
    public function completed(Content $content)
    {
        return $content
            ->header(trans('app.resolved_page.header'))
            ->description(trans('app.resolved_page.description'))
            ->body($this->grid(true));
    }

    /**
     * Index interface.
     *
     * @param Content $content to display
     *
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header(trans('app.list_page.header'))
            ->description(trans('app.list_page.description'))
            ->body($this->grid());
    }

    /**
     * Create interface.
     *
     * @param Content $content to display
     *
     * @return Content
     */
    public function create(Content $content)
    {
        Permission::check('create-issue');
        return $content
            ->header(trans('app.post_page.header'))
            ->description(trans('app.post_page.description'))
            ->body($this->form());
    }

    /**
     * Show interface.
     *
     * @param int     $id      issue id
     * @param Content $content to display
     *
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header(trans('app.detail_page.header'))
            ->description(trans('app.detail_page.description'))
            ->body($this->detail($id));
    }

    /**
     * Completed Reports
     *
     * @param int     $id      issue id
     * @param Content $content to display
     *
     * @return Content
     */
    public function completedDetail($id, Content $content)
    {
        return $content
            ->header(trans('app.detail_page.header'))
            ->description(trans('app.detail_page.description'))
            ->body($this->detail($id, true));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function updateStatus($id)
    {
        Permission::check('update-issue');
        $report = (new Issue)->agent()->findOrFail($id);
        $report->status = request()->status;
        $report->save();
        return redirect(admin_base_path('reports'));
    }

    /**
     * Make a grid builder.
     *
     * @param boolean $completed to filter list
     *
     * @return Grid
     */
    protected function grid($completed = false)
    {
        $grid = new Grid(new Issue);

        $is_logIn = Auth::user() ? true : false;

        // $grid->model()->latest('updated_at');

        if ($is_logIn && Auth::user()->can('view-my-issue')) {
            $grid->model()->my();
            if (!isset(request()->status) && $completed == false) {
                $grid->model()->uncompleted();
            }
        }

        if ($is_logIn && Auth::user()->can('view-agent-issue')) {
            $grid->model()->agent();
        }

        if ($completed) {
            $grid->model()->completed();
        }

        if ($is_logIn && !Auth::user()->can('create-issue')) {
            $grid->disableCreateButton();
        }

        // Define for display grid view
        $this->gridDisplay($grid);

        // Define for filter form
        // $this->gridFilter($grid, $completed);
        $grid->disableFilter();

        // Pagination
        // $grid->paginate(config('myconfig.perPage'));
        $grid->disablePagination();

        $grid->actions(
            function ($actions) {
                $actions->disableDelete();
                $actions->disableEdit();
            }
        );

        $grid->disableRowSelector();
        $grid->disableExport();
        $grid->disableCreateButton();

        return $grid;
    }

    /**
     * Grid display
     * Select column and define how to display
     *
     * @param Grid $grid to define display
     *
     * @return void
     */
    protected function gridDisplay(Grid $grid)
    {
        $grid->id(trans('app.issue.id'))->sortable();
        $grid->title(trans('app.issue.title'));
        $grid->content(trans('app.issue.content'))->display(function ($content) {
            return str_limit($content, 30, '...');
        });

        $grid->prefecture(trans('app.issue.pref'))
            ->display(
                function () {
                    return Prefecture::getPrefNameByPrefId(
                        $this->prefecture_id
                    );
                }
            );
        $grid->address(trans('app.issue.address'))->display(function ($address) {
            return str_limit($address, 30, '...');
        });
        $grid->status(trans('app.issue.status'))
            ->display(
                function () {
                    return $this->status_text;
                }
            );
        $grid->created_at(trans('app.issue.create_at'));
        $grid->updated_at(trans('app.issue.update_at'));
    }

    /**
     * Grid filter
     * Define how to filter by column
     *
     * @param Grid    $grid      to define filter
     * @param boolean $completed to filter options
     *
     * @return void
     */
    protected function gridFilter(Grid $grid, $completed = false)
    {
        $grid->filter(
            function ($filter) use ($completed) {
                $filter->disableIdFilter();

                // $filter
                // ->like('title', trans('app.issue.title'))
                // ->placeholder('');

                // $filter
                // ->like('content', trans('app.issue.content'))
                // ->placeholder('');

                if ((Auth::user() && !Auth::user()->can('view-agent-issue'))|| $completed) {
                    $filter
                        ->equal('prefecture_id', trans('app.issue.pref'))
                        ->select(Prefecture::getPrefectureOptions());
                }

                // $filter
                // ->like('address', trans('app.issue.address'))
                // ->placeholder('');

                $statusOptions = Issue::statusOptions();

                if ($completed) {
                    $statusOptions = Issue::statusCompletedOptions();
                }

                $filter->equal('status', trans('app.issue.status'))
                    ->select($statusOptions);

                // $filter->between('created_at', 'Created at')->datetime();
            }
        );
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Issue);

        $form->display('id', trans('app.issue.id'));

        $form->text('title', trans('app.issue.title'))
            ->rules('required|max:100')->placeholder(' ');
        $form->textarea('content', trans('app.issue.content'))
            ->rules('required')->placeholder(' ');
        $form->select('prefecture_id', trans('app.issue.pref'))
            ->options(Prefecture::getPrefectureOptions());
        $form->text('address', trans('app.issue.address'))
            ->rules('required|max:100')->placeholder(' ');
        $form->image('image_path', trans('app.issue.image'))
            ->uniqueName()
            ->removable();

        $form->tools(
            function (Form\Tools $tools) {
                $tools->disableView();
                $tools->disableDelete();
            }
        );
        $form->footer(function ($footer) {

            // disable `View` checkbox
            $footer->disableViewCheck();

            // disable `Continue editing` checkbox
            $footer->disableEditingCheck();

            // disable `Continue Creating` checkbox
            $footer->disableCreatingCheck();
        });

        $form->saving(
            function (Form $form) {
                $form->model()->issuer_id = Auth::id();
                $form->model()->status = Issue::STATUS_OPEN;
                $image = Input::all()['image_path'] ?? null;
                if ($image) {
                    $form->model()->image_hash = md5($image->get());
                }
            }
        );
        return $form;
    }

    /**
     * Make a show builder.
     *
     * @param int     $id        issue id
     * @param boolean $completed to get model
     *
     * @return Show
     */
    protected function detail($id, $completed = false)
    {
        $query = (new Issue)->my();
        $is_logIn = Auth::user() ? true : false;
        if ($is_logIn && Auth::user()->can('view-agent-issue')) {
            $query = (new Issue)->agent();
        }

        if ($completed) {
            $query = (new Issue)->completed();
        }

        Form::registerBuiltinFields();
        $form = new Form((new Issue)->findOrFail($id));
        if (!$is_logIn || !Auth::user()->can('view-all-issue')) {
            $form = new Form($query->findOrFail($id));
        }
        $form->setTitle('Detail');

        $form->display(trans('app.issue.id'))
            ->value($form->model()->id);
        $form->display(trans('app.issue.title'))
            ->value($form->model()->title);
        $form->display(trans('app.issue.content'))
            ->value($form->model()->content);
        $form->display(trans('app.issue.pref'))
            ->value(
                Prefecture::getPrefNameByPrefId(
                    $form->model()->prefecture_id
                )
            );
        $form->display(trans('app.issue.address'))
            ->value($form->model()->address);

        $issue = $form->model();

        if ($issue->image_path) {
            $disk = config('admin.upload.disk');
            $image_hash = md5(Storage::disk($disk)->get($issue->image_path));
            if ($image_hash === $issue->image_hash) {
                $disk = config('admin.upload.disk');
                $src = Storage::disk($disk)->url($issue->image_path);
                $form->html(
                    "<img src='$src' "
                    . " style='max-width:160px;max-height:160px'"
                    . " class='img' />"
                );
            }
        }

        $form->display(trans('app.issue.create_at'))
            ->value($form->model()->created_at);
        $form->display(trans('app.issue.update_at'))
            ->value($form->model()->updated_at);

        if ($is_logIn && Auth::user()->can('update-issue')) {
            $form->radio('status', 'Status')
                ->options(Issue::statusOptionsForAgent($form->model()->status))
                ->default($form->model()->status)
                ->rules(
                    'in:' . Issue::STATUS_INPROGRESS . ','
                    . Issue::STATUS_RESOLVED . ',' . Issue::STATUS_REJECT
                );
            $form->setAction('/reports/update_status/' . $form->model()->id);
        }

        $form->tools(
            function ($tools) {
                $tools->disableView();
                $tools->disableDelete();
            }
        );

        if (!$is_logIn || !Auth::user()->can('update-issue')) {
            $form->disableSubmit();
        }

        $form->disableReset();
        $form->footer(function ($footer) {

            // disable `View` checkbox
            $footer->disableViewCheck();

            // disable `Continue editing` checkbox
            $footer->disableEditingCheck();

            // disable `Continue Creating` checkbox
            $footer->disableCreatingCheck();
        });

        return $form;
    }

    /**
     * Check if user in $roles.
     *
     * @param array $roles to check
     *
     * @return boolean
     */
    protected function inRoles($roles)
    {
        return Auth::guard('admin')->user()->inRoles($roles);
    }
}
