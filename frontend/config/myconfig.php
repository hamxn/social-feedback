<?php
/**
 * Myconfig
 *
 * PHP version 7
 *
 * @category Config
 * @package  Myconfig
 * @author   XuanDD <xuandd@lifull-tech.vn>
 * @link     https://bitbucket.org/dinhdiemxuan/reportchain
 */

return [
    'perPage' => 50,

    'roles' => [
        'text' => [
            'USER'  => 2,
            'AGENT' => 3
        ]
    ],

    'issue' => [
        'status' => [
            0 => 'Open',
            1 => 'In progress',
            2 => 'Resolved',
            3 => 'Reject'
        ],
    ],
];
