<?php
if(isset($_POST['edit'])) {
    $value = $_POST['edit'];
    $sthEdit = DB::selectRow($dbh, 'news', $_POST['edit']);
} else {
    // Если в массиве $_POST отсутствуют данные о нажатии кнопки "редактирования", не производим никаких действий
}

if(isset($_POST['text'])) {
    DB::updateRow($dbh, 'news', $_POST['text'], $_POST['editID']);
    header('Location: /homepage');
    exit;
} else {
    // Если в массиве $_POST отсутствуют данные о редактировании, не производим никаких действий
}
