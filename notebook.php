<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notebook Section</title>
    <link rel="stylesheet" href="notebook.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
</head>

<body>
    <section class="header">
        <div class="logo">
            <i class="ri-menu-line menu"></i>
            <h2><span>Devotion</span>Diaries</h2>
        </div>
        <div class="noteName">
            <h3 class="note">Notebook 1</h3>

            <button type="button" class="addEntryButton">
                <span class="button__text">Add Entry</span>
                <span class="button__icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" stroke-width="2" stroke-linejoin="round" stroke-linecap="round" stroke="currentColor" height="24" fill="none" class="svg">
                        <line y2="19" y1="5" x2="12" x1="12"></line>
                        <line y2="12" y1="12" x2="19" x1="5"></line>
                    </svg></span>
            </button>

        </div>
    </section>

    <section class="main">
        <div id="entry" class="tab">
            <div class="main--container">
                <div class="section--title">
                    <h3 class="title">Make an Entry</h3>
                </div>
                <div class="section--container">
                    <form id="entryForm">
                        <div class="form-group">
                            <label for="entryTitle">Title:</label>
                            <input type="text" id="entryTitle" name="entryTitle" required>
                        </div>
                        <br>
                        <div class="form--group">
                            <label for="date">Date:</label>
                            <input type="date" id="dateUploaded" name="dateUploaded" required>
                        </div>
                        <br>
                        <hr>
                        <div class="form-group1">
                            <label for="entryBody"></label>
                            <textarea id="entryBody" name="entryBody" rows="6" required></textarea>
                        </div>
                        <div class="button-group">
                            <button type="submit" class="save-button">Save</button>
                            <button type="button" class="update-button">Update</button>
                            <button type="button" class="delete-button">Delete</button>
                        </div>
                    </form>
                    <div class="new-container">
                        <div class="section--title2">
                            <h3 class="title">Your Entries:</h3>
                        </div>
                        <div class="card" id="defaultCard">
                            <h4 class="entry-number">Entry 1</h4>
                            <p class="entry-title">Title 1</p>
                            <button class="view-btn">View</button>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>

    <SCript>
        document.addEventListener('DOMContentLoaded', function() {
            const addEntryButton = document.querySelector('.addEntryButton');
            const container = document.querySelector('.new-container');
            let entryNumber = 1;

            addEntryButton.addEventListener('click', function() {
                // Create a new card
                const newCard = document.createElement('div');
                newCard.classList.add('card');

                // Increment entry number and set it as the text content of the new card
                entryNumber++;
                newCard.innerHTML = `
            <h4 class="entry-number">Entry ${entryNumber}</h4>
            <p class="entry-title">Title ${entryNumber}</p>
            <button class="view-btn">View</button>
        `;

                // Append the new card to the container
                container.appendChild(newCard);
            });
        });
    </SCript>

</body>

</html>