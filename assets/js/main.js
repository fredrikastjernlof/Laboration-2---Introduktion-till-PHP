"use strict"

// HTML-element
const addBucketButton = document.getElementById('add-bucket-button');
const showCompletedButton = document.getElementById('show-completed-button');
const closeCompletedButton = document.getElementById('close-completed-button');
const bucketDialog = document.getElementById('bucket-dialog');
const cancelButton = document.getElementById('cancel-button');
const formErrors = document.getElementById('form-errors');

const settingsButtons = document.querySelectorAll('.settings-button');
const editButtons = document.querySelectorAll('.edit-button');
const deleteButtons = document.querySelectorAll('.delete-button');


// Event-lyssnare för bucketlist-sidan

// Visa dialogrutan om det finns valideringsfel
if (!formErrors.hidden) {
    bucketDialog.showModal();
}

// Stäng dialogrutan när användaren klickar på avbryt
cancelButton.addEventListener('click', () => {
    formErrors.hidden = true;
    bucketDialog.close();
});

// Visa dialogrutan för att lägga till ett nytt bucketlist-objekt
addBucketButton.addEventListener('click', () => {
    document.getElementById('name').value = '';
    document.getElementById('description').value = '';
    document.getElementById('priority').value = '';

    formErrors.hidden = true;

    document.querySelectorAll('.is-invalid').forEach(field => {
        field.classList.remove('is-invalid');
    });

    document.getElementById('bucket-dialog-title').textContent = 'Lägg till ett nytt mål i din bucketlist';
    document.getElementById('bucket-id').value = '';
    document.getElementById('submit-button').textContent = '➕ Lägg till';
    bucketDialog.showModal();
});

// Visa dialogrutan med färdiga mål
showCompletedButton.addEventListener('click', () => {
    document.querySelectorAll('#completed-dialog .bucket-card').forEach(card => {
        card.open = false;
    });
    document.getElementById('completed-dialog').showModal();
});

// Stäng dialogrutan med färdiga mål
closeCompletedButton.addEventListener('click', () => {
    document.getElementById('completed-dialog').close();
});

// Visa dialogrutan med färdiga mål om användaren har markerat ett mål som genomfört
const params = new URLSearchParams(window.location.search);
if (params.get('completed') === '1') {
    document.getElementById('completed-dialog').showModal();
    window.history.replaceState({}, '', window.location.pathname);
}

// Visa och dölj inställningsmenyn för varje bucketlist-objekt
settingsButtons.forEach(button => {
    button.addEventListener('click', () => {
        const cardSettings = button.nextElementSibling;
        cardSettings.toggleAttribute('hidden');
        button.hidden = !cardSettings.hidden;
    });
});

// Stäng inställningsmenyn när användaren klickar på stäng
document.querySelectorAll('.close-settings').forEach(button => {
    button.addEventListener('click', () => {
        const menu = button.closest('.card-settings');
        menu.hidden = true;
        menu.previousElementSibling.hidden = false;
    });
});

// Visa dialogrutan för att redigera ett bucketlist-objekt
editButtons.forEach(button => {
    button.addEventListener('click', () => {
        const card = button.closest('.bucket-card');
        document.getElementById('from-completed').value =
            card.closest('#completed-dialog') ? '1' : '0';

        const id = card.dataset.id;
        const hiddenIdInput = document.getElementById('bucket-id');

        hiddenIdInput.value = id;

        const name = card.querySelector('h2').textContent;
        const description = card.querySelector('p').textContent;
        const priority = card.querySelector('.priority').textContent;

        document.getElementById('name').value = name;
        document.getElementById('description').value = description;
        document.getElementById('priority').value = priority;

        document.getElementById('bucket-dialog-title').textContent = 'Redigera mål i din bucketlist';
        document.getElementById('submit-button').textContent = '💾 Spara ändringar';

        if (card.closest('#completed-dialog')) {
            document.getElementById('completed-dialog').close();
        }
        const menu = button.closest('.card-settings');
        menu.hidden = true;
        menu.previousElementSibling.hidden = false;
        
        bucketDialog.showModal();
    });
});

// Visa dialogrutan för att ta bort ett bucketlist-objekt
deleteButtons.forEach(button => {
    button.addEventListener('click', () => {
        const card = button.closest('.bucket-card');
        const id = card.dataset.id;
        const hiddenIdInput = document.getElementById('delete-id');

        hiddenIdInput.value = id;

        const menu = button.closest('.card-settings');
        menu.hidden = true;
        menu.previousElementSibling.hidden = false;

        if (card.closest('#completed-dialog')) {
            document.getElementById('completed-dialog').close();
        }

        document.getElementById('delete-dialog').showModal();
    });
});

// Stäng radera-dialogen när användaren klickar på Avbryt
document.getElementById('cancel-delete-button').addEventListener('click', () => {
    document.getElementById('delete-dialog').close();
});