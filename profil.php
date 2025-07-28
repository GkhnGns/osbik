<?php
session_start();
require_once 'UserManager.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: giris.php');
    exit;
}

$um = new UserManager();
$user = $um->findById($_SESSION['user_id']);
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Profil</title>
</head>
<body>
<h1>Profil</h1>
<p>Hosgeldiniz, <?php echo htmlspecialchars($user['email'] ?? ''); ?>!</p>
<ul>
    <li><a href="profil_duzenle.php">Hesap Bilgilerini Degistir</a></li>
    <li><a href="logout.php">Cikis Yap</a></li>
</ul>
</body>
</html>
