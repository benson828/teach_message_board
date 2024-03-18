<?php

namespace App\Config;

use PDO;
use PDOException;
use App\Config\Env;

class Database
{
    /**
     * 進行與資料庫的初始連線
     * 回傳連線
     *
     * @return  PDO         $db     資料庫的連線
     * @throws  PDOException   $e      回應錯誤訊息
     */
    public function dbConnect()
    {
        $db_type = Env::DATABASE_INFO['db_type'];
        $db_host = Env::DATABASE_INFO['db_host'];
        $db_name = Env::DATABASE_INFO['db_name'];
        $db_user = Env::DATABASE_INFO['db_user'];
        $db_password = Env::DATABASE_INFO['db_password'];
        $connect = $db_type . ':host=' . $db_host . ';dbname=' . $db_name;
        try {
            $db = new PDO($connect, $db_user, $db_password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $db->query("SET NAMES 'utf8mb4'");
        } catch (PDOException $e) {
            die("Error!:" . $e->getMessage() . '<br>');
        }
        return $db;
    }
}
