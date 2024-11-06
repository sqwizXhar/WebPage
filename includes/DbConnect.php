<?php
    $host = 'localhost';
    $username = 'postgres';
    $password = 'sqweezey17))';
    $dbname = 'users_test';

    try {
        $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo 'Connection failed ' . $e->getMessage();
    }

?>
