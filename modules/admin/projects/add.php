<?php
if(isset($_POST['addCode'])) {
    $uploaddir = './files/projects/';
    $path_info = pathinfo($_FILES['userfile']['name']);
    $filename = md5($_FILES['userfile']['tmp_name']) .'.'. $path_info['extension'];
    $uploadfile = $uploaddir.$filename;

    DB::addProject($dbh, $_POST['addCode'], $_POST['addName'], $_POST['addAddress'], $_POST['addCustomer'], $filename);
    move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
    header('Location: /projects');
    exit;
} else {
    // Если в массиве $_POST отсутствуют данные о добавлении комментария, не производим никаких действий
}