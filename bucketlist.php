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

// Hanterar POST-förfrågningar för att radera ett bucketlist-objekt
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $id = filter_var($_POST['delete_id'], FILTER_VALIDATE_INT);

    if ($id !== false && $id > 0) {
        $bucketList->deleteBucket($id);
    }

    header("Location: bucketlist.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['completed_id'])) {
    $id = filter_var($_POST['completed_id'], FILTER_VALIDATE_INT);
    $completed = isset($_POST['completed']);

    if ($id !== false && $id > 0) {
        $bucketList->updateBucketCompleted($id, $completed);
    }

    header("Location: bucketlist.php");
    exit;
}

// Hanterar POST-förfrågningar för att lägga till ett nytt bucketlist-objekt
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';
    $priority = $_POST['priority'] ?? '';
    $id = $_POST['id'] ?? '';

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
        if (!empty($id)) {
            $success = $bucketList->updateBucket((int)$id, $name, $description, $priority);
        } else {
            $success = $bucketList->addBucket($name, $description, $priority);
        }

        if ($success) {
            $fromCompleted = ($_POST['from_completed'] ?? '0') === '1';

            header("Location: bucketlist.php" . ($fromCompleted ? "?completed=1" : ""));
            exit;
        } else {
            $errors[] = "Ett fel uppstod när målet skulle sparas. Vänligen försök igen.";
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


<section class="bucketlist-container">
    <h1>Bucketlist</h1>
    <p>Här kan du lägga till, redigera och radera mål i din bucketlist. Du kan också markera mål som genomförda.</p>
    <div class="bucket-actions">
        <button type="button" id="add-bucket-button">Lägg till nytt mål 🎯</button>
        <button type="button" id="show-completed-button">Visa färdiga mål 🥳</button>
    </div>

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

        <form method='post' action='bucketlist.php'>
        <input type='hidden' name='completed_id' value='{$id}'>
            <fieldset>
                <legend>Markera målet som genomfört</legend>
                <label>
                    <input type='checkbox' name='completed' value='1'
                        onchange='this.form.submit()'>
                    Jag gjorde det! 🥳
                </label>
            </fieldset>
            <button type='submit' class='visually-hidden-submit'>
                Spara status
            </button>
        </form>

        <button type='button' class='settings-button'
                aria-label='Inställningar för {$name}'>
            ⋯
        </button>

        <div class='card-settings' hidden>
            <button type='button' class='close-settings'>×</button>
            <button type='button' class='edit-button'>✏️ Redigera</button>
            <button type='button' class='delete-button'>🗑️ Radera</button>
        </div>
        <p class='created-at'>Skapad: {$createdAt}</p>
    </details>";
        }
    }
    ?>

</section>
<?php include __DIR__ . '/includes/completed-dialog.php'; ?>
<?php include __DIR__ . '/includes/delet-dialog.php'; ?>
<?php include __DIR__ . '/includes/bucket-form.php'; ?>
<?php include __DIR__ . '/includes/footer.php'; ?>