<?php
if(isset($_POST['add'])) {
    $date = date("Y-m-d H:i:s");
    DB::addComment($dbh, $date, $_SESSION['login'], $_POST['add']);
    header('Location: /comments');
    exit;
} else {
    // Если в массиве $_POST отсутствуют данные о добавлении комментария, не производим никаких действий
}