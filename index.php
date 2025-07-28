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
include 'header.php';
?>
<h1 class="mb-4">Çalışanlar</h1>
<table class="table table-bordered">
    <tr><th>İsim</th><th>Pozisyon</th><th>İşlem</th></tr>
    <?php foreach ($employees as $emp): ?>
    <tr>
        <td><?php echo htmlspecialchars($emp['name']); ?></td>
        <td><?php echo htmlspecialchars($emp['position']); ?></td>
        <td>
            <form method="post" class="d-inline">
                <input type="hidden" name="delete_id" value="<?php echo $emp['id']; ?>">
                <button type="submit" class="btn btn-danger btn-sm">Sil</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<h2>Yeni Çalışan Ekle</h2>
<form method="post" class="w-50">
    <div class="mb-3">
        <label class="form-label">İsim</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Pozisyon</label>
        <input type="text" name="position" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Ekle</button>
</form>
<?php include 'footer.php'; ?>
