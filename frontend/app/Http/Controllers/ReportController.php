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
            ->header('Completed Reports Page')
            ->description('Description')
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
            ->header('Reports Page')
            ->description('Description')
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
        return $content
            ->header('Report')
            ->description('Create')
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
            ->header('Report')
            ->description('Detail')
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
            ->header('Report')
            ->description('Detail')
            ->body($this->detail($id, true));
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

        if ($completed) {
            $grid->model()->completed();
        }

        // Define for display grid view
        $this->gridDisplay($grid);

        // Define for filter form
        $this->gridFilter($grid, $completed);

        // Pagination
        $grid->paginate(config('myconfig.perPage'));

        $grid->actions(
            function ($actions) {
                $actions->disableDelete();
                $actions->disableEdit();
            }
        );

        $grid->disableRowSelector();
        $grid->disableExport();
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
        $grid->id('ID')->sortable();
        $grid->title();
        $grid->content();
        $grid->prefecture()
            ->display(
                function () {
                    return Prefecture::getPrefNameByPrefId(
                        $this->prefecture_id
                    );
                }
            );
        $grid->address();
        $grid->status()
            ->display(
                function () {
                    return $this->status_text;
                }
            );
        $grid->created_at();
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

                $filter->like('title');

                $filter->like('content');

                $filter->equal('prefecture_id', 'Prefecture')
                    ->select(Prefecture::getPrefectureOptions());

                $filter->like('address');

                $statusOptions = Issue::statusOptions();

                if ($completed) {
                    $statusOptions = Issue::statusCompletedOptions();
                }

                $filter->equal('status')
                    ->select($statusOptions);

                $filter->between('created_at', 'Created at')->datetime();
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

        $form->display('id', 'ID');

        $form->text('title', 'Title')
            ->rules('required|max:100');
        $form->text('content', 'Content')
            ->rules('required|max:100');
        $form->select('prefecture_id', 'Prefecture')
            ->options(Prefecture::getPrefectureOptions());
        $form->text('address', 'Address')
            ->rules('required|max:100');
        $form->image('image_path', 'Image')
            ->uniqueName()
            ->removable();

        $form->saving(
            function (Form $form) {
                $form->model()->issuer_id = Auth::id();
                $form->model()->status = Issue::STATUS_OPEN;
                $image = Input::all()['image_path'];
                $form->model()->image_hash = md5($image->get());
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
        $query = Issue::my();
        if ($completed) {
            $query = Issue::completed();
        }
        $show = new Show($query->findOrFail($id));

        $show->id('ID');
        $show->title();
        $show->content();
        $show->prefecture()->as(
            function () {
                return Prefecture::getPrefNameByPrefId(
                    $this->prefecture_id
                );
            }
        );
        $show->address();

        $issue = $show->getModel();
        
        if ($issue->image_path) {
            $disk = config('admin.upload.disk');
            $image_hash = md5(Storage::disk($disk)->get($issue->image_path));
            if ($image_hash === $issue->image_hash) {
                $show->image_path('Image')->image();
            }
        }

        $show->created_at(trans('admin.created_at'));
        $show->updated_at(trans('admin.updated_at'));

        $show->panel()
            ->tools(
                function ($tools) {
                    $tools->disableEdit();
                    $tools->disableDelete();
                }
            );

        return $show;
    }
}
