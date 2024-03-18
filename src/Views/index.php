<?php

use App\Service\MessageBoard;

require '../../vendor/autoload.php';

$messageBoard = new MessageBoard();
// 獲取留言
$getMsg = $messageBoard->getMessage();
// 新增留言
if (isset($_POST['add_msg'])) {
    $messageBoard->addMessage($_POST['new_title'], $_POST['new_msg']);
    $getMsg = $messageBoard->getMessage(); //重新獲取留言
}

if (isset($_POST['delete_msg'])) {
    $messageBoard->deleteMessage($_POST['id']);
    $getMsg = $messageBoard->getMessage();
}
if (isset($_POST['update_msg'])) {
    $messageBoard->updateMessage($_POST['id'], $_POST['editTitle'], $_POST['editContent']);
    $getMsg = $messageBoard->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>留言板</title>
</head>
<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <div class="navbar-brand fs-3 text-center">留言板</div>
        </div>
    </nav>
</header>

<body>
    <div class="container">
        <div class="list">
            <h1 class="list_title text-center mt-5 mb-3">留言列表</h1>
            <?php foreach ($getMsg as $key => $row) { ?>
                <div class="card mb-2">
                    <div class="card-body">
                        <h5 class="card-title" id="title<?= $row['id'] ?>">
                            <!-- //改成使用物件屬性的方式來存取資料 -->
                            <?= $row['title'] ?>
                        </h5>

                        <p class="card-text" id="content<?= $row['id'] ?>">
                            <?= $row['content'] ?>
                        </p>

                        <form id="msg<?= $row['id'] ?>" class="d-inline" method="post">
                            <input type="hidden" name="editTitle" id="editTitle<?= $row['id'] ?>">
                            <input type="hidden" name="editContent" id="editContent<?= $row['id'] ?>">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <input type="submit" name="delete_msg" id="delete<?= $row['id'] ?>" class="btn btn-danger" value="刪除"></input>
                            <input type="button" class="btn btn-warning" value="編輯" id="edit<?= $row['id'] ?>" onclick="edit_(<?= $row['id'] ?>)"></input>
                            <input type="hidden" name="update_msg" class="btn btn-warning" value="送出" id="send<?= $row['id'] ?>"></input>
                        </form>
                        <span class="date_text ">
                            <?= $row['date'] ?>
                        </span>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="add_line text-center mt-5">
            <a class="btn btn-success px-5 mb-3" id="add_expend" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" onclick="disAppearance()">新增留言</a>

            <div class="collapse" id="collapseExample">
                <div class="card card-body">
                    <form method="post">
                        <input class="d-block form-control mb-2" type="text" name="new_title" placeholder="標題" required>
                        <textarea class="d-block form-control" name="new_msg" rows="10" placeholder="請輸入內容" required></textarea>
                        <input class="btn btn-success px-5 mt-3" type="submit" value="確認新增" name="add_msg">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function disAppearance() {
            document.querySelector('#add_expend').style.display = "none";
            //classList.remove()方法移除collapseExample區塊的class = "collapse"屬性，這樣就可以讓表單區塊顯示在畫面上了。
            document.querySelector('#collapseExample').classList.remove('collapse');
        }

        function edit_(id) {
            document.querySelector('#editTitle' + id).type = "";
            document.querySelector('#editContent' + id).type = "";
            document.querySelector('#edit' + id).type = "hidden";
            document.querySelector('#send' + id).type = "submit";
            oldName = document.querySelector('#title' + id).innerText;
            oldContent = document.querySelector('#content' + id).innerText;
            document.querySelector('#editTitle' + id).value = oldName;
            document.querySelector('#editContent' + id).value = oldContent;
            document.querySelector('#title' + id).style.display = "none";
            document.querySelector('#content' + id).style.display = "none";
        }
    </script>
</body>

</html>