<?php
$sth = DB::selectSomeRows($dbh, 'projects', Core::DISPLAY_PROJECTS);
$pages = ceil(DB::countRows($dbh, 'projects') / Core::DISPLAY_PROJECTS);
