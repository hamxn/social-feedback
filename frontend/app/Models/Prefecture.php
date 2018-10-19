<?php
/**
 * Model Prefecture
 *
 * PHP version 7
 *
 * @category Models
 * @package  Prefecture
 * @author   XuanDD <xuandd@lifull-tech.vn>
 * @link     https://bitbucket.org/dinhdiemxuan/reportchain
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Prefecture
 *
 * @category Models
 * @package  Prefecture
 * @author   XuanDD <xuandd@lifull-tech.vn>
 * @link     https://bitbucket.org/dinhdiemxuan/reportchain
 */
class Prefecture extends Model
{
    /**
     * Get Prefectures
     *
     * @return array prefectures
     */
    public static function getPrefectures()
    {
        $prefs = [];
        for ($i = 1; $i <= 64; $i++) {
            $prefs[$i] = ['name' => 'pref_' . $i];
        }
        return $prefs;
    }

    /**
     * Get Prefecture name by prefecture_id
     *
     * @param unsign int $pref_id prefecture_id
     *
     * @return string prefecture name
     */
    public static function getPrefNameByPrefId($pref_id)
    {
        $prefs = Prefecture::getPrefectures();
        return $prefs[$pref_id]['name'] ?? '';
    }

    /**
     * Get Prefecture options
     *
     * @return array prefecture options
     */
    public static function getPrefectureOptions()
    {
        $prefs = Prefecture::getPrefectures();
        foreach ($prefs as $pref_id => $pref) {
            $res[$pref_id] = $pref['name'];
        }
        return $res;
    }
}
