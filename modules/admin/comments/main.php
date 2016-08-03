<?php
include_once 'add.php';
include_once 'edit.php';
include_once 'del.php';

$sth = DB::selectSomeRows($dbh, 'comments', Core::DISPLAY_PROJECTS);
$pages = ceil(DB::countRows($dbh, 'comments') / Core::DISPLAY_PROJECTS);
