<?php
class DB {
    private static $pdo;

    public static function getConnection() {
        if (!self::$pdo) {
            $dsn = 'mysql:host=localhost;dbname=gokh3319_osbik;charset=utf8mb4';
            $user = 'gokh3319_osbikuser';
            $pass = '3[6.QujZcN&!vAIK3[6.QujZcN&!vAIK&!vAIK3[6.Quj';
            self::$pdo = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        }
        return self::$pdo;
    }
}
?>
