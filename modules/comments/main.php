<?php
// todo: реализовать проверку корректности комментария
$error = 0;
if(isset($_POST['comment'], $_SESSION['login'])) {

    if(iconv_strlen(trim(utf8_decode($_POST['comment']))) < 10) {
        $error = 1;
    } elseif (substr_count((trim($_POST['comment'])), ' ') < 1) {
        $error = 1;
    }

    if(!$error) {
        $date = date("Y-m-d H:i:s");
        DB::addComment($dbh, $date, $_SESSION['login'], $_POST['comment']);
        header('Location: /comments');
        exit;
    }
}

$sth = DB::selectSomeRows($dbh, 'comments', Core::DISPLAY_PROJECTS);
$pages = ceil(DB::countRows($dbh, 'comments') / Core::DISPLAY_PROJECTS);
