<?php
/**
 * UserController
 *
 * PHP version 7
 *
 * @category Controller
 * @package  UserController
 * @author   XuanDD <xuandd@lifull-tech.vn>
 * @link     https://bitbucket.org/dinhdiemxuan/reportchain
 */
namespace App\Http\Controllers;

use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Auth\Database\Permission;
use Encore\Admin\Auth\Database\Role;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Encore\Admin\Controllers\UserController as Controller;
use Encore\Admin\Form\Builder;
use App\Models\Prefecture;

/**
 * Class UserController
 *
 * PHP version 7
 *
 * @category Controller
 * @package  UserController
 * @author   XuanDD <xuandd@lifull-tech.vn>
 * @link     https://bitbucket.org/dinhdiemxuan/reportchain
 */
class UserController extends Controller
{
    /**
     * Make a form builder.
     *
     * @return Form
     */
    public function form()
    {
        $form = Administrator::form(
            function (Form $form) {
            }
        );

        $form->display('id', 'ID');

        $form->text('username', trans('admin.username'))
            ->rules('required');
        $form->text('name', trans('admin.name'))
            ->rules('required');
        $form->password('password', trans('admin.password'))
            ->rules('required|confirmed');
        $form->password(
            'password_confirmation',
            trans('admin.password_confirmation')
        )->rules('required')
            ->default(
                function ($form) {
                    return $form->model()->password;
                }
            );

        $form->ignore(['password_confirmation']);

        $form->select('roles', trans('admin.roles'))
            ->options(Role::all()->pluck('name', 'id'));
        $form->multipleSelect('permissions', trans('admin.permissions'))
            ->options(Permission::all()->pluck('name', 'id'));
        $form->select('prefecture_id', 'Prefecture')
            ->options(Prefecture::getPrefectureOptions())
            ->rules(
                'required_if:roles,' . config('myconfig.roles.text.AGENT'),
                [
                    'required_if' =>
                        'The Prefecture field is required when roles is Agent.'
                ]
            );

        $form->display('created_at', trans('admin.created_at'));
        $form->display('updated_at', trans('admin.updated_at'));

        $form->saving(
            function (Form $form) {
                $form->roles = [$form->roles, null];
                if ($form->password
                    && $form->model()->password != bcrypt($form->password)
                ) {
                    $form->password = bcrypt($form->password);
                }
            }
        );

        return $form;
    }
}
