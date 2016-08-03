<?php
class DB {
    // Осуществляем выборку строк из таблицы $table
    static public function selectSomeRows($dbh, $table, $countDisplayRows) {
        // Определяем значение первого аргумента LIMIT, с которого будет начинаться вывод следующих $countDisplayRows записей
        if($_GET['page'] != 0) {
            $limit = ($_GET['page'] * $countDisplayRows) - $countDisplayRows;
        } else {
            $limit = 1;
        }
        $sth = $dbh->prepare('SELECT * FROM '.$table.' ORDER BY id DESC LIMIT '.$limit.', '.$countDisplayRows);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }


    // Подсчитываем количество строк в таблице $table
    static public function countRows($dbh, $table) {
        $sth = $dbh->prepare('SELECT COUNT(*) FROM '.$table);
        $sth->execute();
        return $sth->fetchColumn(); // Для возвращения одного столбца
    }


    static public function addComment($dbh, $date, $login, $text) {
        $sth = $dbh->prepare('INSERT INTO comments(date, user, text) VALUES(:date, :user, :text)');
        $sth->bindParam(':date', $date, PDO::PARAM_STR);
        $sth->bindParam(':user', $login, PDO::PARAM_STR);
        $sth->bindParam(':text', $text, PDO::PARAM_STR);
        $sth->execute();
    }


    static public function selectCommentsFromUser($dbh, $user, $countDisplayRows) {
        // Определяем значение первого аргумента LIMIT, с которого будет начинаться вывод следующих $countDisplayRows записей
        if($_GET['page'] != 0) {
            $limit = ($_GET['page'] * $countDisplayRows) - $countDisplayRows;
        } else {
            $limit = 1;
        }
        $sth = $dbh->prepare('SELECT * FROM comments WHERE user = :user ORDER BY id DESC LIMIT '.$limit.', '.$countDisplayRows);
        $sth->bindParam(':user', $user, PDO::PARAM_STR);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }


    static public function countRowsWhere($dbh, $table, $nameRow, $value) {
        $sth = $dbh->prepare('SELECT COUNT(*) FROM '.$table.' WHERE '.$nameRow.' = :value');
        $sth->bindParam(':value', $value, PDO::PARAM_STR);
        $sth->execute();
        return $sth->fetchColumn();
    }


    static public function addNews($dbh, $date, $text) {
        $sth = $dbh->prepare('INSERT INTO news(date, text) VALUES(:date, :text)');
        $sth->bindParam(':date', $date, PDO::PARAM_STR);
        $sth->bindParam(':text', $text, PDO::PARAM_STR);
        $sth->execute();
    }


    static public function addProject($dbh, $code, $name, $address, $customer, $filename) {
        $sth = $dbh->prepare('INSERT INTO projects(code, name, address, customer, filename) VALUES(:code, :name, :address, :customer, :filename)');
        $sth->bindParam(':code', $code, PDO::PARAM_STR);
        $sth->bindParam(':name', $name, PDO::PARAM_STR);
        $sth->bindParam(':address', $address, PDO::PARAM_STR);
        $sth->bindParam(':customer', $customer, PDO::PARAM_STR);
        $sth->bindParam(':filename', $filename, PDO::PARAM_STR);
        $sth->execute();
    }


    static public function updateProject($dbh, $code, $name, $address, $customer, $id) {
        $sth = $dbh->prepare('UPDATE projects SET code = :code, name = :name, address = :address, customer = :customer WHERE id = '.$id);
        $sth->bindParam(':code', $code, PDO::PARAM_STR);
        $sth->bindParam(':name', $name, PDO::PARAM_STR);
        $sth->bindParam(':address', $address, PDO::PARAM_STR);
        $sth->bindParam(':customer', $customer, PDO::PARAM_STR);
        $sth->execute();
    }


    static public function selectRow($dbh, $table, $id) {
        $sth = $dbh->prepare('SELECT * FROM '.$table.' WHERE id = '.$id);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }


    static public function updateRow($dbh, $table, $text, $id) {
        $sth = $dbh->prepare('UPDATE '.$table.' SET text = :text WHERE id = '.$id);
        $sth->bindParam(':text', $text, PDO::PARAM_STR);
        $sth->execute();
    }


    static public function deleteRow($dbh, $table, $id) {
        $sth = $dbh->prepare('DELETE FROM '.$table.' WHERE id = '.$id);
        $sth->execute();
    }
}
