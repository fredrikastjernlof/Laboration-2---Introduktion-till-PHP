<?php
require_once __DIR__ . '/includes/config.php';

$title = 'Bucketlist';
$currentPage = 'bucketlist';

$database = new Database();
$bucketList = new BucketList($database->getConnection());

require_once __DIR__ . '/includes/header.php';
?>
<h1>Bucketlist</h1>
<p>Intro-text till bucketlist-sidan skrivs här..</p>

<?php
$buckets = $bucketList->getBucketList();

if (empty($buckets)) {
    echo "<p>Inga bucketlist-objekt hittades.</p>";
} else {
    echo "<ul>";
    foreach ($buckets as $bucket) {
        echo "<li>";
        echo "ID: " . $bucket['id'] . "<br>";
        echo "Namn: " . htmlspecialchars($bucket['name']) . "<br>";
        echo "Beskrivning: " . htmlspecialchars($bucket['description']) . "<br>";
        echo "Prioritet: " . htmlspecialchars($bucket['priority']) . "<br>";
        echo "Genomförd: " . ($bucket['completed'] ? 'Ja' : 'Nej') . "<br>";
        echo "Skapad: " . $bucket['created_at'];
        echo "</li>";
    }
    echo "</ul>";
}
?>

<?php include __DIR__ . '/includes/footer.php'; ?>