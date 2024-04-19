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
        <div class="sidebar">
            <ul class="sidebar--items">
                <li>
                    <a href="#" class="sidebar-link active" data-target="entry">
                        <span class="icon"><i class="ri-file-text-line"></i>
                            </i></span>
                        <div class="sidebar--item">Entry</div>
                    </a>
                </li>
        </div>

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
                </div>
            </div>
        </div>



    </section>



    <!-- // FOR THE SIDEBAR -->
    <script>
        let body = document.querySelector(".body")


        let menu = document.querySelector(".menu")
        let sidebar = document.querySelector(".sidebar")
        let mainContainer = document.querySelector(".main--container")

        menu.onclick = function() {
            sidebar.classList.toggle("activemenu")
        }
        mainContainer.onclick = function() {
            sidebar.classList.remove("activemenu")
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tabs = document.querySelectorAll('.tab');
            const sidebarLinks = document.querySelectorAll('.sidebar-link');

            sidebarLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = this.getAttribute('data-target');

                    tabs.forEach(tab => {
                        if (tab.id === target) {
                            tab.style.display = 'block';
                        } else {
                            tab.style.display = 'none';
                        }
                    });

                    sidebarLinks.forEach(sidebarLink => {
                        sidebarLink.classList.remove('active');
                    });
                    this.classList.add('active');
                });
            });
        });
    </script>

    <!-- ADD SCRIPT/NEW ENTRY -->
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const addEntryButton = document.querySelector(".addEntryButton");
        const sidebarItems = document.querySelector(".sidebar--items");
        const entryTab = document.getElementById("entry");

        let entryCount = 0;

        addEntryButton.addEventListener("click", function() {
            entryCount++;
            const targetId = `entry${entryCount}`;
            const newEntry = document.createElement("li");
            newEntry.innerHTML = `
                <a href="#" class="sidebar-link" data-target="${targetId}">
                    <span class="icon"><i class="ri-file-text-line"></i></span>
                    <div class="sidebar--item">Entry ${entryCount}</div>
                </a>
            `;
            sidebarItems.appendChild(newEntry);

            const newEntryContent = document.createElement("div");
            newEntryContent.id = targetId;
            newEntryContent.classList.add("tab");

            newEntryContent.innerHTML = `
                <div class="main--container">
                    <div class="section--title">
                        <h3 class="title">Make an Entry</h3>
                    </div>
                    <div class="section--container">
                        <form id="entryForm${entryCount}">
                            <div class="form-group">
                                <label for="entryTitle">Title:</label>
                                <input type="text" id="entryTitle${entryCount}" name="entryTitle" required>
                            </div>
                            <br>
                            <div class="form--group">
                                <label for="date">Date:</label>
                                <input type="date" id="dateUploaded${entryCount}" name="dateUploaded" required>
                            </div>
                            <br>
                            <hr>
                            <div class="form-group1">
                                <label for="entryBody"></label>
                                <textarea id="entryBody${entryCount}" name="entryBody" rows="6" required></textarea>
                            </div>
                            <div class="button-group">
                                <button type="submit" class="save-button">Save</button>
                                <button type="button" class="update-button">Update</button>
                                <button type="button" class="delete-button">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            `;
            entryTab.appendChild(newEntryContent);
            // Show the first tab and mark the corresponding sidebar item as active
            if (entryCount === 1) {
                newEntryContent.style.display = "block";
                newEntry.querySelector(".sidebar-link").classList.add("active");
            }
        });

        // Add event listener to sidebar items
        sidebarItems.addEventListener("click", function(event) {
            if (event.target.classList.contains("sidebar-link")) {
                event.preventDefault();
                const target = event.target.getAttribute("data-target");
                // Hide all tabs
                const tabs = document.querySelectorAll(".tab");
                tabs.forEach(tab => {
                    tab.style.display = "none";
                });
                // Remove "active" class from all sidebar items
                const sidebarLinks = document.querySelectorAll(".sidebar-link");
                sidebarLinks.forEach(link => {
                    link.classList.remove("active");
                });
                // Show the clicked tab and mark the clicked sidebar item as active
                const clickedTab = document.getElementById(target);
                clickedTab.style.display = "block";
                event.target.classList.add("active");
            }
        });
    });
</script>



</body>

</html>