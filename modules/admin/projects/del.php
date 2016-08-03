<?php
if(isset($_POST['delete'])) {
    DB::deleteRow($dbh, 'projects', $_POST['delete']);
    header('Location: /projects');
    exit;
} else {
    // Если в массиве $_POST отсутствуют данные об удалении комментария, не производим никаких действий
}
