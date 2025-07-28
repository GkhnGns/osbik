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
        if ($user) {
            $step = 'login';
        } else {
            $step = 'register';
        }
    } elseif ($step === 'login') {
        $user = $um->verifyLogin($tc, $_POST['password']);
        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            header('Location: profil.php');
            exit;
        } else {
            $error = 'Bilgiler hatali';
        }
    } elseif ($step === 'register') {
        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            $id = $um->createUser($tc, $_POST['email'], $_POST['password']);
            $_SESSION['user_id'] = $id;
            header('Location: profil.php');
            exit;
        } else {
            $error = 'Email ve sifre gerekli';
        }
    } elseif ($step === 'reset') {
        if (!empty($_POST['email'])) {
            $error = 'Sifre sifirlama baglantisi gonderildi.';
        }
    }
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Giris</title>
</head>
<body>
<h1>Is Arayan Giris</h1>
<?php if ($error): ?>
<p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>
<form method="post">
    <input type="hidden" name="step" value="<?php echo $step; ?>">
<?php if ($step === 'tc'): ?>
    <label>TC Kimlik No: <input type="text" name="tc" required></label>
    <button type="submit">Devam</button>
<?php elseif ($step === 'login'): ?>
    <input type="hidden" name="tc" value="<?php echo htmlspecialchars($tc); ?>">
    <label>Sifre: <input type="password" name="password" required></label>
    <button type="submit">Giris</button>
    <button type="submit" name="step" value="reset">Şifremi Unuttum</button>
<?php elseif ($step === 'register'): ?>
    <input type="hidden" name="tc" value="<?php echo htmlspecialchars($tc); ?>">
    <label>Email: <input type="email" name="email" required></label><br>
    <label>Sifre: <input type="password" name="password" required></label><br>
    <button type="submit">Kaydol</button>
<?php elseif ($step === 'reset'): ?>
    <label>Email: <input type="email" name="email" required></label>
    <button type="submit">Gonder</button>
<?php endif; ?>
</form>
</body>
</html>
