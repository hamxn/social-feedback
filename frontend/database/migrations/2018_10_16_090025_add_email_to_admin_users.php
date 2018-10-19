<?php
/**
 * AddEmailToAdminUsers
 *
 * PHP version 7
 *
 * @category Migrations
 * @package  AddEmailToAdminUsers
 * @author   XuanDD <xuandd@lifull-tech.vn>
 * @link     https://bitbucket.org/dinhdiemxuan/reportchain
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class AddEmailToAdminUsers
 *
 * PHP version 7
 *
 * @category Migrations
 * @package  AddEmailToAdminUsers
 * @author   XuanDD <xuandd@lifull-tech.vn>
 * @link     https://bitbucket.org/dinhdiemxuan/reportchain
 */
class AddEmailToAdminUsers extends Migration
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
                $table->string('email');
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
                $table->dropColumn('email');
            }
        );
    }
}
