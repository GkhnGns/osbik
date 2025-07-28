<?php
session_start();
require_once 'UserManager.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: giris.php');
    exit;
}

$um = new UserManager();
$user = $um->findById($_SESSION['user_id']);
include 'header.php';
?>
<h1 class="mb-4">Profil</h1>
<p>Hoşgeldiniz, <?php echo htmlspecialchars($user['email'] ?? ''); ?>!</p>
<ul class="list-unstyled mb-4">
    <li><a href="profil_duzenle.php" class="btn btn-secondary me-2">Hesap Bilgilerini Değiştir</a></li>
    <li><a href="logout.php" class="btn btn-link">Çıkış Yap</a></li>
</ul>
<?php include 'footer.php'; ?>
