<?php
if(isset($_POST['edit'])) {
    $value = $_POST['edit'];
    $sthEdit = DB::selectRow($dbh, 'projects', $_POST['edit']);
} else {
    // Если в массиве $_POST отсутствуют данные о нажатии кнопки "редактирования", не производим никаких действий
}

if(isset($_POST['updateCode'])) {
    DB::updateProject($dbh, $_POST['updateCode'], $_POST['addName'], $_POST['addAddress'], $_POST['addCustomer'], $_POST['editID']);

    $uploaddir = './files/projects/';
    $path_info = pathinfo($_FILES['userfile']['name']);
    $filename = $_POST['filename'];
    $uploadfile = $uploaddir.$filename;
    move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);

    header('Location: /projects');
    exit;
} else {
    // Если в массиве $_POST отсутствуют данные о редактировании, не производим никаких действий
}
