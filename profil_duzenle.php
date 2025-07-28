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
include 'header.php';
?>
<h1 class="mb-4">Profil Düzenle</h1>
<form method="post" class="w-50">
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Yeni Şifre</label>
        <input type="password" name="password" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Kaydet</button>
    <a href="profil.php" class="btn btn-link">Geri</a>
</form>
<?php include 'footer.php'; ?>
