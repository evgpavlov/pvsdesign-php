<?php
$sth = DB::selectSomeRows($dbh, 'news', Core::DISPLAY_NEWS);
$pages = ceil(DB::countRows($dbh, 'news') / Core::DISPLAY_NEWS);
