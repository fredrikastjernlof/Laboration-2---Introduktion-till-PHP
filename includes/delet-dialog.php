<dialog id="delete-dialog">

    <form id="delete-form" method="post" action="bucketlist.php">

        <h2 id="delete-dialog-title">Bekräfta radering</h2>

        <p>Är du säker på att du vill radera detta mål?</p>

        <input type="hidden" id="delete-id" name="delete_id">

        <div class="form-buttons">
            <button type="submit" id="confirm-delete-button">Ja, radera</button>
            <button type="button" id="cancel-delete-button">Avbryt</button>
        </div>

    </form>

</dialog>