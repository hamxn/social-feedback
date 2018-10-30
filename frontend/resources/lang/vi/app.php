<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Dashboard Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'login'             => 'Đăng nhập',
    'register'          => 'Đăng kí',

    'menu'  => [
        'overview'                      => 'Tổng quan',
        'resolved_list'                 => 'Danh sách đã xử lý',
        'add_new'                       => 'Gửi phản ánh',

    ],

    'board'  => [
        'title'                     => 'BẢNG THỐNG KÊ',
        'pref'                      => 'Tỉnh, thành phố',
        'open'                      => 'SL chờ xử lý',
        'in_progress'               => 'SL đang xử lý',
        'reject'                    => 'SL từ chối',
        'resolved'                  => 'SL đã xử lý',
        'total'                     => 'SL tổng',
    ],


    'home'  => [
        'header'                    => 'Tổng quan',
        'description'               => '',
    ],

    'detail_page' => [
        'header'                    => 'Chi tiết phản ánh',
        'description'               => '',
    ],

    'post_page' => [
        'header'                    => 'Gửi phản ánh',
        'description'               => '',
    ],

    'list_page' => [
        'header'                    => 'Danh sách phản ánh',
        'description'               => '',
    ],

    'resolved_page'  => [
        'header'                    => 'Danh sách đã xử lý',
        'description'               => '',
        'grid' => [
            'id' => 'ID',
            'title' => 'Tiêu đề',
            'content'   => 'Nội dung phản ánh',
            'pref'  => 'Tỉnh, thành phố',
            'address' => 'Địa chỉ',
            'status' => 'Trạng thái',
            'action' => 'Chức năng',
            'image' => 'Hình ảnh',
            'create_at' => 'Ngày gửi',
            'update_at' => 'Ngày cập nhật',
        ],
    ],

];
