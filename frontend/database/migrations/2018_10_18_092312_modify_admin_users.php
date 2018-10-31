<?php
/**
 * ModifyAdminUsers
 *
 * PHP version 7
 *
 * @category Migrations
 * @package  ModifyAdminUsers
 * @author   XuanDD <xuandd@lifull-tech.vn>
 * @link     https://bitbucket.org/dinhdiemxuan/reportchain
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class ModifyAdminUsers
 *
 * @category Migrations
 * @package  ModifyAdminUsers
 * @author   XuanDD <xuandd@lifull-tech.vn>
 * @link     https://bitbucket.org/dinhdiemxuan/reportchain
 */
class ModifyAdminUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'admin_users',
            function (Blueprint $table) {
                $table->tinyInteger('prefecture_id')->nullable();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(
            'admin_users',
            function (Blueprint $table) {
                $table->dropColumn('prefecture_id');
            }
        );
    }
}
