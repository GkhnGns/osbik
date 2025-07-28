<?php
session_start();
require_once 'SettingsManager.php';
$sm = new SettingsManager();

if (isset($_GET['logout'])) {
    unset($_SESSION['admin']);
    header('Location: admin.php');
    exit;
}

if (!isset($_SESSION['admin'])) {
    $error = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {
        if ($_POST['password'] === 'admin123') {
            $_SESSION['admin'] = true;
            header('Location: admin.php');
            exit;
        } else {
            $error = 'Yanlış parola';
        }
    }
    include 'header.php';
    ?>
    <h1>Admin Girişi</h1>
    <?php if ($error): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <form method="post" class="w-25">
        <div class="mb-3">
            <label class="form-label">Parola</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Giriş</button>
    </form>
    <?php
    include 'footer.php';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['site_title'])) {
        $sm->set('site_title', $_POST['site_title']);
        $sm->set('primary_color', $_POST['primary_color']);
    }
}
$settings = $sm->getAll();
include 'header.php';
?>
<h1>Site Ayarları</h1>
<form method="post" class="w-50">
    <div class="mb-3">
        <label class="form-label">Site Başlığı</label>
        <input type="text" name="site_title" class="form-control" value="<?php echo htmlspecialchars($settings['site_title']); ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Ana Renk</label>
        <input type="color" name="primary_color" class="form-control form-control-color" value="<?php echo htmlspecialchars($settings['primary_color']); ?>">
    </div>
    <button type="submit" class="btn btn-primary">Kaydet</button>
    <a href="admin.php?logout=1" class="btn btn-link">Çıkış</a>
</form>
<?php include 'footer.php'; ?>
