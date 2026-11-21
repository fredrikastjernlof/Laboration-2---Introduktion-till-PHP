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

<section class="bucketlist-container">
    <button type="button" id="add-bucket-button">Lägg till nytt mål</button>
    <?php
    $buckets = $bucketList->getBucketList();

    if (empty($buckets)) {
        echo "<p>Du har inte lagt till några bucketlist-objekt ännu.</p>";
    } else {
        foreach ($buckets as $bucket) {
            $id = (int) $bucket['id'];
            $name = htmlspecialchars($bucket['name']);
            $description = htmlspecialchars($bucket['description']);
            $priority = htmlspecialchars($bucket['priority']);
            $completed = (bool) $bucket['completed'];
            $createdAt = date('Y-m-d', strtotime($bucket['created_at']));


            echo "
    <details class='bucket-card' data-id='{$id}'>
        <summary>
            <h2>{$name}</h2>
        </summary>

        <p>{$description}</p>
        <p><strong>Prioritet:</strong> <span class='priority'>{$priority}</span></p>

        <label>
            <input
                type='checkbox'
                name='completed'
                value='1'
                " . ($completed ? 'checked' : '') . "
            >
            Jag gjorde det!
        </label>

        <button type='button' class='settings-button'
                aria-label='Inställningar för {$name}'>
            ⋯
        </button>

        <div class='card-settings' hidden>
            <button type='button' class='close-settings'>×</button>
            <button type='button' class='edit-button'>Redigera</button>
            <button type='button' class='delete-button'>Radera</button>
        </div>
        <p class='created-at'>Skapad: {$createdAt}</p>
    </details>";
        }
    }
    ?>

</section>

<dialog id="bucket-dialog">
    <form id="bucket-form" method="post">
        <h2 id="bucket-dialog-title">Lägg till ett nytt mål i din bucketlist</h2>
        <input type="hidden" id="bucket-id" name="id">
        <div class="form-group">
            <label for="name">Ange ditt mål:</label>
            <input type="text" id="name" name="name" maxlength="64" required>
        </div>
        <div class="form-group">
            <label for="description">Beskriv ditt mål:</label>
            <textarea id="description" name="description" maxlength="255" required></textarea>
        </div>
        <div class="form-group">
            <label for="priority">Välj prioritet:</label>
            <select id="priority" name="priority" required>
                <option value="low">Låg</option>
                <option value="medium">Medium</option>
                <option value="high">Hög</option>
            </select>
        </div>
        <div id="form-errors" role="alert" hidden>
            <ul></ul>
        </div>
        <div class="form-buttons">
            <button type="submit" id="submit-button">Lägg till</button>
            <button type="button" id="cancel-button">Avbryt</button>
        </div>
    </form>

</dialog>

<?php include __DIR__ . '/includes/footer.php'; ?>