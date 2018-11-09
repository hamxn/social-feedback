<?php
/**
 * HomeController
 *
 * PHP version 7
 *
 * @category Controller
 * @package  HomeController
 * @author   XuanDD <xuandd@lifull-tech.vn>
 * @link     https://bitbucket.org/dinhdiemxuan/reportchain
 */
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use App\Models\Issue;

/**
 * Class HomeController
 *
 * PHP version 7
 *
 * @category Controller
 * @package  HomeController
 * @author   XuanDD <xuandd@lifull-tech.vn>
 * @link     https://bitbucket.org/dinhdiemxuan/reportchain
 */
class HomeController extends Controller
{
    /**
     * Dashboard
     *
     * @param Content $content to display dashboard
     *
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header(trans('app.home.header'))
            ->description(trans('app.home.description'))
            ->row(view('dashboard.title'))
            ->row(
                function (Row $row) {
                    $row->column(3, '');
                    $row->column(
                        6,
                        function (Column $column) {
                            $issues = (new Issue)->getLandingPageInfo();
                            $column->append(view('dashboard', compact('issues')));
                        }
                    );
                    $row->column(3, '');
                }
            );
    }
}
