<?php
session_start();
require_once __DIR__ . '/includes/config.php';

$title = 'Bucketlist';
$currentPage = 'bucketlist';

$database = new Database();
$bucketList = new BucketList($database->getConnection());

$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);
$formData = $_SESSION['formData'] ?? [];
unset($_SESSION['formData']);
$fieldErrors = $_SESSION['fieldErrors'] ?? [];
unset($_SESSION['fieldErrors']);

// Hanterar POST-förfrågningar för att lägga till ett nytt bucketlist-objekt
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';
    $priority = $_POST['priority'] ?? '';

    if (!$bucketList->setName($name)) {
        $errors[] = "Namnet måste innehålla mellan 1 och 64 tecken.";
        $fieldErrors['name'] = true;
    }

    if (!$bucketList->setDescription($description)) {
        $errors[] = "Beskrivningen måste innehålla mellan 1 och 255 tecken.";
        $fieldErrors['description'] = true;
    }

    if (!$bucketList->setPriority($priority)) {
        $errors[] = "Du måste välja en giltig prioritet.";
        $fieldErrors['priority'] = true;
    }

    if (empty($errors)) {
        if ($bucketList->addBucket($name, $description, $priority)) {
            header("Location: bucketlist.php");
            exit;
        } else {
            $errors[] = "Ett fel uppstod när målet skulle läggas till. Vänligen försök igen.";
        }
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['formData'] = $_POST;
        $_SESSION['fieldErrors'] = $fieldErrors;
        header("Location: bucketlist.php");
        exit;
    }
}

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
            Jag gjorde det! 🥳
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

<?php include __DIR__ . '/includes/bucket-form.php'; ?>

<?php include __DIR__ . '/includes/footer.php'; ?>