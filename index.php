<?php
require_once 'EmployeeManager.php';

$manager = new EmployeeManager();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['name']) && isset($_POST['position'])) {
        $manager->add([
            'name' => $_POST['name'],
            'position' => $_POST['position']
        ]);
    }
    if (isset($_POST['delete_id'])) {
        $manager->remove($_POST['delete_id']);
    }
}

$employees = $manager->getAll();
?>
<!doctype html>
<html>
<head>
    <title>Insan Kaynaklari Yazilimi</title>
</head>
<body>
<h1>Calisanlar</h1>
<table border="1" cellpadding="5" cellspacing="0">
    <tr><th>Isim</th><th>Pozisyon</th><th>Islem</th></tr>
    <?php foreach ($employees as $emp): ?>
    <tr>
        <td><?php echo htmlspecialchars($emp['name']); ?></td>
        <td><?php echo htmlspecialchars($emp['position']); ?></td>
        <td>
            <form method="post" style="display:inline;">
                <input type="hidden" name="delete_id" value="<?php echo $emp['id']; ?>">
                <button type="submit">Sil</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<h2>Yeni Calisan Ekle</h2>
<form method="post">
    <label>Isim: <input type="text" name="name" required></label><br>
    <label>Pozisyon: <input type="text" name="position" required></label><br>
    <button type="submit">Ekle</button>
</form>
</body>
</html>
