<?php
if(isset($_SESSION['login'])) {
    $sth = DB::selectCommentsFromUser($dbh, $_SESSION['login'], Core::DISPLAY_COMMENTS);
    $pages = ceil(DB::countRowsWhere($dbh, 'comments', 'user', $_SESSION['login']) / Core::DISPLAY_COMMENTS);
} else {
    // Если пользователь не авторизован, то ничего ничего не делаем
}
