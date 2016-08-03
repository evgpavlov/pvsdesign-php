<?php
include_once 'add.php';
include_once 'edit.php';
include_once 'del.php';
include_once 'upload.php';

$sth = DB::selectSomeRows($dbh, 'projects', Core::DISPLAY_PROJECTS);
$pages = ceil(DB::countRows($dbh, 'projects') / Core::DISPLAY_PROJECTS);
