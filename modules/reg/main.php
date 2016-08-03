<?php
if(isset($_SESSION['entry'])) {
    header ('Location: /account');
}

$errors = array();
$errors[0] = 'Не указано имя учетной записи.';
$errors[1] = 'Имя учетной записи не может быть меньше 2 символов.';
$errors[2] = 'Имя учетной записи не должно быть больше 30 символов.';
$errors[3] = 'Не указан адрес электронной почты.';
$errors[4] = 'Адрес электронной почты не должен быть больше 30 символов.';
$errors[5] = 'Адрес электронной почты указан некорректно.';
$errors[6] = 'Не указан пароль.';
$errors[7] = 'Минимальная длина пароля должна быть не менее 6 символов.';
$errors[8] = 'Максимальная длина пароля должна быть не более 30 символов.';
$errors[9] = 'Необходимо подтвердить пароль.';
$errors[10] = 'Пароли не совпадают.';

$errors[11] = 'Данный логин уже занят.';
$errors[12] = 'Данный почтовый ящик уже занят.';
$err = array();

if(isset($_POST['login'], $_POST['email'], $_POST['pass'], $_POST['passrep'])) {

    if(DB::countRowsWhere($dbh, 'users', 'login', $_POST['login'])) {
        array_push($err, 11);
    }
    if(DB::countRowsWhere($dbh, 'users', 'email', $_POST['email'])) {
        array_push($err, 12);
    }

    if(empty($_POST['login'])) {
        array_push($err, 0);
    }
    elseif(iconv_strlen($_POST['login']) < 2) {
        array_push($err, 1);
    }
    elseif(iconv_strlen($_POST['login']) > 30) {
        array_push($err, 2);
    }

    if(empty($_POST['email'])) {
        array_push($err, 3);
    }
    elseif(iconv_strlen($_POST['email']) > 30) {
        array_push($err, 4);
    }
    elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        array_push($err, 5);
    }

    if(empty($_POST['pass'])) {
        array_push($err, 6);
    }
    elseif(iconv_strlen($_POST['pass']) < 6) {
        array_push($err, 7);
    }
    elseif(iconv_strlen($_POST['pass']) > 30) {
        array_push($err, 8);
    }
    elseif(empty($_POST['passrep'])) {
        array_push($err, 9);
    }
    elseif(strcmp($_POST['passrep'], $_POST['pass'])) {
        array_push($err, 10);
    }

    if(!count($err)) {
        $sql = 'INSERT INTO users(login, email, pass, hash, status) VALUES(:login, :email, :pass, :hash, 1)';

        $tmp1 = myHash($_POST['pass']);
        $tmp2 = myHash($_POST['login'] . '&' . $_POST['email']);

        $sth = $dbh->prepare($sql);

        $sth->bindParam(':login', $_POST['login'], PDO::PARAM_STR);
        $sth->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
        $sth->bindParam(':pass', $tmp1, PDO::PARAM_STR);
        $sth->bindParam(':hash', $tmp2, PDO::PARAM_STR);

        $sth->execute();

        Mail::Send($_POST['email']);
        $_SESSION['reginfo'] = 'success';
        header ('Location: /reg');
        exit;
    }
}
