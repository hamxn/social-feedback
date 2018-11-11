<?php
/**
 * Administrator
 *
 * PHP version 7
 *
 * @category Models
 * @package  Administrator
 * @author   XuanDD <xuandd@lifull-tech.vn>
 * @link     https://bitbucket.org/dinhdiemxuan/reportchain
 */
namespace App\Models;

use Encore\Admin\Auth\Database\Administrator as Model;

/**
 * Class Administrator.
 *
 * @category Models
 * @package  Administrator
 * @author   XuanDD <xuandd@lifull-tech.vn>
 * @link     https://bitbucket.org/dinhdiemxuan/reportchain
 * @property Role[] $roles
 */
class Administrator extends Model
{
    protected $fillable = ['username', 'password', 'name', 'email', 'prefecture_id'];
}
