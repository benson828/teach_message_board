<?php

namespace App\Service;

use App\Config\Database;

require '../../vendor/autoload.php';
class MessageBoard
{
    //新增留言
    public function addMessage($title, $content)
    {
        $db = new Database();
        $db = $db->dbConnect();
        $statement = $db->prepare("INSERT INTO `message` (`title`, `content`) VALUES (?,?)");
        $statement->execute([$title, $content]);
    }

    //取得留言
    public function getMessage()
    {
        $db = new Database();
        $db = $db->dbConnect();
        $statement = $db->prepare("SELECT * FROM `message`");
        $statement->execute();
        return $statement->fetchAll();
    }

    //刪除留言
    public function deleteMessage($id)
    {
        $db = new Database();
        $db = $db->dbConnect();
        $statement = $db->prepare("DELETE FROM `message` WHERE `id` = ?");
        $statement->execute([$id]);
    }

    //修改留言
    public function updateMessage($id, $title, $content)
    {
        $db = new Database;
        $db = $db->dbConnect();
        $statement = $db->prepare("UPDATE `message` SET `title` = ? ,`content` = ? WHERE `id` = ?");
        $statement->execute([$title, $content, $id]);
    }
}
