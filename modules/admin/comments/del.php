<?php
if(isset($_POST['delete'])) {
    DB::deleteRow($dbh, 'comments', $_POST['delete']);
    header('Location: /comments');
    exit;
} else {
    // Если в массиве $_POST отсутствуют данные об удалении комментария, не производим никаких действий
}
