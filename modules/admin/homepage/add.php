<?php
if(isset($_POST['add'])) {
    $date = date("Y-m-d H:i:s");
    DB::addNews($dbh, $date, $_POST['add']);
    header('Location: /homepage');
    exit;
} else {
    // Если в массиве $_POST отсутствуют данные о добавлении новости, не производим никаких действий
}