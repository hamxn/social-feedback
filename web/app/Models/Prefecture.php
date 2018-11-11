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
        return [
                1  => [
                    'name' => 'Thành phố Hà Nội',
                ],
                2  => [
                    'name' => 'Tỉnh Hà Giang',
                ],
                4  => [
                    'name' => 'Tỉnh Cao Bằng',
                ],
                6  => [
                    'name' => 'Tỉnh Bắc Kạn',
                ],
                8  => [
                    'name' => 'Tỉnh Tuyên Quang',
                ],
                10  => [
                    'name' => 'Tỉnh Lào Cai',
                ],
                11  => [
                    'name' => 'Tỉnh Điện Biên',
                ],
                12  => [
                    'name' => 'Tỉnh Lai Châu',
                ],
                14  => [
                    'name' => 'Tỉnh Sơn La',
                ],
                15  => [
                    'name' => 'Tỉnh Yên Bái',
                ],
                17  => [
                    'name' => 'Tỉnh Hoà Bình',
                ],
                19  => [
                    'name' => 'Tỉnh Thái Nguyên',
                ],
                20  => [
                    'name' => 'Tỉnh Lạng Sơn',
                ],
                22  => [
                    'name' => 'Tỉnh Quảng Ninh',
                ],
                24  => [
                    'name' => 'Tỉnh Bắc Giang',
                ],
                25  => [
                    'name' => 'Tỉnh Phú Thọ',
                ],
                26  => [
                    'name' => 'Tỉnh Vĩnh Phúc',
                ],
                27  => [
                    'name' => 'Tỉnh Bắc Ninh',
                ],
                30  => [
                    'name' => 'Tỉnh Hải Dương',
                ],
                31  => [
                    'name' => 'Thành phố Hải Phòng',
                ],
                33  => [
                    'name' => 'Tỉnh Hưng Yên',
                ],
                34  => [
                    'name' => 'Tỉnh Thái Bình',
                ],
                35  => [
                    'name' => 'Tỉnh Hà Nam',
                ],
                36  => [
                    'name' => 'Tỉnh Nam Định',
                ],
                37  => [
                    'name' => 'Tỉnh Ninh Bình',
                ],
                38  => [
                    'name' => 'Tỉnh Thanh Hoá',
                ],
                40  => [
                    'name' => 'Tỉnh Nghệ An',
                ],
                42  => [
                    'name' => 'Tỉnh Hà Tĩnh',
                ],
                44  => [
                    'name' => 'Tỉnh Quảng Bình',
                ],
                45  => [
                    'name' => 'Tỉnh Quảng Trị',
                ],
                46  => [
                    'name' => 'Tỉnh Thừa Thiên Huế',
                ],
                48  => [
                    'name' => 'Thành phố Đà Nẵng',
                ],
                49  => [
                    'name' => 'Tỉnh Quảng Nam',
                ],
                51  => [
                    'name' => 'Tỉnh Quảng Ngãi',
                ],
                52  => [
                    'name' => 'Tỉnh Bình Định',
                ],
                54  => [
                    'name' => 'Tỉnh Phú Yên',
                ],
                56  => [
                    'name' => 'Tỉnh Khánh Hoà',
                ],
                58  => [
                    'name' => 'Tỉnh Ninh Thuận',
                ],
                60  => [
                    'name' => 'Tỉnh Bình Thuận',
                ],
                62  => [
                    'name' => 'Tỉnh Kon Tum',
                ],
                64  => [
                    'name' => 'Tỉnh Gia Lai',
                ],
                66  => [
                    'name' => 'Tỉnh Đắk Lắk',
                ],
                67  => [
                    'name' => 'Tỉnh Đắk Nông',
                ],
                68  => [
                    'name' => 'Tỉnh Lâm Đồng',
                ],
                70  => [
                    'name' => 'Tỉnh Bình Phước',
                ],
                72  => [
                    'name' => 'Tỉnh Tây Ninh',
                ],
                74  => [
                    'name' => 'Tỉnh Bình Dương',
                ],
                75  => [
                    'name' => 'Tỉnh Đồng Nai',
                ],
                77  => [
                    'name' => 'Tỉnh Bà Rịa - Vũng Tàu',
                ],
                79  => [
                    'name' => 'Thành phố Hồ Chí Minh',
                ],
                80  => [
                    'name' => 'Tỉnh Long An',
                ],
                82  => [
                    'name' => 'Tỉnh Tiền Giang',
                ],
                83  => [
                    'name' => 'Tỉnh Bến Tre',
                ],
                84  => [
                    'name' => 'Tỉnh Trà Vinh',
                ],
                86  => [
                    'name' => 'Tỉnh Vĩnh Long',
                ],
                87  => [
                    'name' => 'Tỉnh Đồng Tháp',
                ],
                89  => [
                    'name' => 'Tỉnh An Giang',
                ],
                91  => [
                    'name' => 'Tỉnh Kiên Giang',
                ],
                92  => [
                    'name' => 'Thành phố Cần Thơ',
                ],
                93  => [
                    'name' => 'Tỉnh Hậu Giang',
                ],
                94  => [
                    'name' => 'Tỉnh Sóc Trăng',
                ],
                95  => [
                    'name' => 'Tỉnh Bạc Liêu',
                ],
                96  => [
                    'name' => 'Tỉnh Cà Mau',
                ],
        ];
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
