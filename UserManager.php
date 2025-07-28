<?php
require_once 'db.php';

class UserManager
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = DB::getConnection();
    }

    public function findByTC($tc)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE tc = ?');
        $stmt->execute([$tc]);
        return $stmt->fetch();
    }

    public function createUser($tc, $email, $password)
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare('INSERT INTO users (tc, email, password) VALUES (?,?,?)');
        $stmt->execute([$tc, $email, $hash]);
        return $this->pdo->lastInsertId();
    }

    public function verifyLogin($tc, $password)
    {
        $user = $this->findByTC($tc);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public function findById($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function updateProfile($id, $fields)
    {
        $sets = [];
        $values = [];
        foreach ($fields as $k => $v) {
            $sets[] = "$k = ?";
            $values[] = $v;
        }
        if (!$sets) return;
        $values[] = $id;
        $sql = 'UPDATE users SET '.implode(', ', $sets).' WHERE id = ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($values);
    }
}
?>
