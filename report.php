<?php
require_once 'ReportManager.php';

$start = $_GET['start'] ?? null;
$end = $_GET['end'] ?? null;
$manager = new ReportManager();
$report = $manager->generalReport($start, $end);
include 'header.php';
?>
<h1 class="mb-4">Genel Başvuru Raporu</h1>
<form method="get" class="row g-3 mb-4">
    <div class="col-auto">
        <label class="form-label">Başlangıç</label>
        <input type="date" name="start" class="form-control" value="<?php echo htmlspecialchars($start); ?>">
    </div>
    <div class="col-auto">
        <label class="form-label">Bitiş</label>
        <input type="date" name="end" class="form-control" value="<?php echo htmlspecialchars($end); ?>">
    </div>
    <div class="col-auto align-self-end">
        <button type="submit" class="btn btn-primary">Getir</button>
    </div>
</form>
<p>Toplam Başvuru: <?php echo $report['applications']; ?></p>
<p>İşlenen / İşe Alınan: <?php echo $report['hired']; ?></p>
<h2>Firma Bazlı Yönlendirme</h2>
<ul>
<?php foreach ($report['companyCounts'] as $company => $count): ?>
    <li><?php echo htmlspecialchars($company); ?>: <?php echo $count; ?></li>
<?php endforeach; ?>
</ul>
<?php include 'footer.php'; ?>
