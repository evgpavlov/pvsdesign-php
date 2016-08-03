<?php
include_once 'add.php';
include_once 'edit.php';
include_once 'del.php';

$sth = DB::selectSomeRows($dbh, 'news', Core::DISPLAY_NEWS);
$pages = ceil(DB::countRows($dbh, 'news') / Core::DISPLAY_NEWS);
