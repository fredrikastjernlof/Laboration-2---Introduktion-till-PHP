<dialog id="completed-dialog">
    <h2>Färdiga mål! 🥳</h2>
    <?php
    $completedBuckets = $bucketList->getCompletedBuckets();
    if (empty($completedBuckets)) {
        echo "<p>Du har inga färdiga mål ännu.</p>";
    } else {
        foreach ($completedBuckets as $bucket) {
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
                        " . ($completed ? 'checked' : '') . "
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

    <button type="button" id="close-completed-button">❌ Stäng</button>
</dialog>