<?php
if(isset($_POST['delete'])) {
    DB::deleteRow($dbh, 'news', $_POST['delete']);
    header('Location: /homepage');
    exit;
} else {
    // Если в массиве $_POST отсутствуют данные об удалении новости, не производим никаких действий
}
