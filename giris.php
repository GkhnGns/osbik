<?php
session_start();
require_once 'UserManager.php';

$um = new UserManager();
$tc = $_POST['tc'] ?? '';
$step = $_POST['step'] ?? 'tc';
$error = '';

if (isset($_SESSION['user_id'])) {
    header('Location: profil.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($step === 'tc') {
        $user = $um->findByTC($tc);
        $step = $user ? 'login' : 'register';
    } elseif ($step === 'login') {
        $user = $um->verifyLogin($tc, $_POST['password']);
        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            header('Location: profil.php');
            exit;
        } else {
            $error = 'Bilgiler hatalı';
        }
    } elseif ($step === 'register') {
        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            $id = $um->createUser($tc, $_POST['email'], $_POST['password']);
            $_SESSION['user_id'] = $id;
            header('Location: profil.php');
            exit;
        } else {
            $error = 'Email ve şifre gerekli';
        }
    } elseif ($step === 'reset') {
        if (!empty($_POST['email'])) {
            $error = 'Şifre sıfırlama bağlantısı gönderildi.';
        }
    }
}
include 'header.php';
?>
<h1 class="mb-4">İş Arayan Giriş</h1>
<?php if ($error): ?>
<div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>
<form method="post" class="w-50">
    <input type="hidden" name="step" value="<?php echo $step; ?>">
    <?php if ($step === 'tc'): ?>
        <div class="mb-3">
            <label class="form-label">TC Kimlik No</label>
            <input type="text" name="tc" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Devam</button>
    <?php elseif ($step === 'login'): ?>
        <input type="hidden" name="tc" value="<?php echo htmlspecialchars($tc); ?>">
        <div class="mb-3">
            <label class="form-label">Şifre</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Giriş</button>
        <button type="submit" name="step" value="reset" class="btn btn-link">Şifremi Unuttum</button>
    <?php elseif ($step === 'register'): ?>
        <input type="hidden" name="tc" value="<?php echo htmlspecialchars($tc); ?>">
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Şifre</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Kaydol</button>
    <?php elseif ($step === 'reset'): ?>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Gönder</button>
    <?php endif; ?>
</form>
<?php include 'footer.php'; ?>
