"use strict"

const addBucketButton = document.getElementById('add-bucket-button');
const bucketDialog = document.getElementById('bucket-dialog');
addBucketButton.addEventListener('click', () => {
    const bucketForm = document.getElementById('bucket-form');
    bucketForm.reset();
    document.getElementById('bucket-dialog-title').textContent = 'Lägg till ett nytt mål i din bucketlist';
    document.getElementById('bucket-id').value = '';
    bucketDialog.showModal();
});


const cancelButton = document.getElementById('cancel-button');
cancelButton.addEventListener('click', () => {
    bucketDialog.close();
});

const settingsButtons = document.querySelectorAll('.settings-button');

settingsButtons.forEach(button => {
    button.addEventListener('click', () => {
        const cardSettings = button.nextElementSibling;
        cardSettings.toggleAttribute('hidden');
        button.hidden = !cardSettings.hidden;
    });
});

document.querySelectorAll('.close-settings').forEach(button => {
    button.addEventListener('click', () => {
        const menu = button.closest('.card-settings');
        menu.hidden = true;
        menu.previousElementSibling.hidden = false;
    });
});

const editButtons = document.querySelectorAll('.edit-button');

editButtons.forEach(button => {
    button.addEventListener('click', () => {
        const card = button.closest('.bucket-card');
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
        document.getElementById('submit-button').textContent = 'Spara ändringar';
        bucketDialog.showModal();
    });
});