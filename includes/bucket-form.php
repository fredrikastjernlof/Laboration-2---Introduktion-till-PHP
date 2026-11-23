<dialog id="bucket-dialog">

    <form id="bucket-form" method="post" action="bucketlist.php" novalidate>

        <h2 id="bucket-dialog-title">Lägg till ett nytt mål i din bucketlist</h2>

        <input type="hidden" id="bucket-id" name="id">
        <input type="hidden" name="from_completed" id="from-completed" value="0">

        <div class="form-group">
            <label for="name">Ange ditt mål:</label>
            <input type="text" id="name" name="name" maxlength="64" required
                class="<?= isset($fieldErrors['name']) ? 'is-invalid' : '' ?>"
                value="<?= htmlspecialchars($formData['name'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
        </div>

        <div class="form-group">
            <label for="description">Beskriv ditt mål:</label>
            <textarea id="description" name="description" maxlength="255" required
                class="<?= isset($fieldErrors['description']) ? 'is-invalid' : '' ?>"><?= htmlspecialchars($formData['description'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
        </div>

        <div class="form-group">
            <label for="priority">Välj prioritet:</label>
            <select id="priority" name="priority" required
                class="<?= isset($fieldErrors['priority']) ? 'is-invalid' : '' ?>">
                <option value="">Välj prioritet</option>
                <option value="low" <?= ($formData['priority'] ?? '') === 'low' ? 'selected' : '' ?>>Låg</option>
                <option value="medium" <?= ($formData['priority'] ?? '') === 'medium' ? 'selected' : '' ?>>Medium</option>
                <option value="high" <?= ($formData['priority'] ?? '') === 'high' ? 'selected' : '' ?>>Hög</option>
            </select>
        </div>

        <div id="form-errors" role="alert" <?php if (empty($errors)) echo 'hidden'; ?>>
            <ul>
                <?php if (!empty($errors)) {
                    foreach ($errors as $error) {
                        echo "<li>" . htmlspecialchars($error) . "</li>";
                    }
                } ?>
            </ul>
        </div>

        <div class="form-buttons">
            <button type="submit" id="submit-button">
                <?= !empty($formData['id']) ? '💾 Spara ändringar' : '➕ Lägg till' ?>
            </button>
            <button type="button" id="cancel-button">↩️ Avbryt</button>
        </div>

    </form>

</dialog>