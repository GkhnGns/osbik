<?php
require_once 'ReportManager.php';

$start = $_GET['start'] ?? null;
$end = $_GET['end'] ?? null;

$manager = new ReportManager();
$report = $manager->generalReport($start, $end);
?>
<!doctype html>
<html>
<head>
    <title>Genel Basvuru Raporu</title>
</head>
<body>
<h1>Genel Basvuru Raporu</h1>
<form method="get">
    Baslangic Tarihi: <input type="date" name="start" value="<?php echo htmlspecialchars($start); ?>">
    Bitis Tarihi: <input type="date" name="end" value="<?php echo htmlspecialchars($end); ?>">
    <button type="submit">Getir</button>
</form>
<p>Toplam Basvuru: <?php echo $report['applications']; ?></p>
<p>Islenen / Ise Alinan: <?php echo $report['hired']; ?></p>
<h2>Firma Bazli Yönlendirme</h2>
<ul>
<?php foreach ($report['companyCounts'] as $company => $count): ?>
    <li><?php echo htmlspecialchars($company); ?>: <?php echo $count; ?></li>
<?php endforeach; ?>
</ul>
</body>
</html>
