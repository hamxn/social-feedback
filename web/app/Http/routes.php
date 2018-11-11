<?php
/**
 * Route
 *
 * PHP version 7
 *
 * @category Route
 * @package  Route
 * @author   XuanDD <xuandd@lifull-tech.vn>
 * @link     https://bitbucket.org/dinhdiemxuan/reportchain
 */
use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group(
    [
        'prefix'        => config('admin.route.prefix'),
        'namespace'     => config('admin.route.namespace'),
        'middleware'    => config('admin.route.middleware'),
    ],
    function (Router $router) {
        $router->get('/', 'HomeController@index');
        $router->resource('auth/users', 'UserController');
        $router->get('auth/setting', 'AuthController@getSetting');
        $router->put('auth/setting', 'AuthController@putSetting');
        
        $router->get('reports/completed', 'ReportController@completed');
        $router->get('reports/completed/{id}', 'ReportController@completedDetail');
        $router->resource('reports', 'ReportController')
            ->except('destroy');
        $router->post('reports/update_status/{id}', 'ReportController@updateStatus');
    }
);

Route::group(
    [
        'prefix'        => config('admin.route.prefix'),
        'namespace'     => config('admin.route.namespace'),
        'middleware'    => ['web'],
    ],
    function (Router $router) {
        $router->get('reports/completed', 'ReportController@completed');
        $router->get('register', 'Auth\RegisterController@showRegistrationForm')
            ->name('register');
        $router->post('register', 'Auth\RegisterController@register');
        $router->get('reports/completed/{id}', 'ReportController@completedDetail')
            ->where(['id' => '\d+']);
    }
);
