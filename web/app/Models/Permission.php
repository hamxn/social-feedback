<?php
/**
 * Permission
 *
 * PHP version 7
 *
 * @category Models
 * @package  Permission
 * @author   XuanDD <xuandd@lifull-tech.vn>
 * @link     https://bitbucket.org/dinhdiemxuan/reportchain
 */
namespace App\Models;

use Illuminate\Http\Request;
use Encore\Admin\Auth\Database\Permission as BasePermission;

/**
 * Class Permission
 *
 * @category Models
 * @package  Permission
 * @author   XuanDD <xuandd@lifull-tech.vn>
 * @link     https://bitbucket.org/dinhdiemxuan/reportchain
 */
class Permission extends BasePermission
{
    /**
     * Overwrite matchRequest method in Permission base class
     * because / path cannot be handled with permission function of laravel admin.
     *
     * @param array   $match   to check match
     * @param Request $request to check
     *
     * @return bool
     */
    protected function matchRequest(array $match, Request $request) : bool
    {
        if (!$request->is(trim($match['path'], '/'))) {
            if (!$request->is($match['path'])) {
                return false;
            }
        }

        $method = collect($match['method'])->filter()->map(
            function ($method) {
                return strtoupper($method);
            }
        );

        return $method->isEmpty() || $method->contains($request->method());
    }
}
