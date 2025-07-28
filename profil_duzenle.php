<?php
session_start();
require_once 'UserManager.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: giris.php');
    exit;
}

$um = new UserManager();
$user = $um->findById($_SESSION['user_id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fields = [];
    if (!empty($_POST['email'])) {
        $fields['email'] = $_POST['email'];
    }
    if (!empty($_POST['password'])) {
        $fields['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
    }
    if ($fields) {
        $um->updateProfile($user['id'], $fields);
        $user = $um->findById($user['id']);
    }
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Profil Duzenle</title>
</head>
<body>
<h1>Profil Duzenle</h1>
<form method="post">
    <label>Email: <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>"></label><br>
    <label>Yeni Sifre: <input type="password" name="password"></label><br>
    <button type="submit">Kaydet</button>
</form>
<p><a href="profil.php">Geri</a></p>
</body>
</html>
