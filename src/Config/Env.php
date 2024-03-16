<?php

namespace App\Config;

class Env
{
    public const DATABASE_INFO = [
        'db_type' => 'mysql',//資料庫類型
        'db_host' => 'localhost',//資料庫主機名
        'db_name' => 'message_board',//資料庫名稱
        'db_user' => 'root',//用戶名
        'db_password' => ''//密碼
    ];
}
