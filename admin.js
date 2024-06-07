let valueDisplays = document.querySelectorAll(".num");
let interval = 4000;

valueDisplays.forEach((valueDisplay) => {
    let startValue = 0;
    let endValue = parseInt(valueDisplay.getAttribute("dat-val"));
    let duration = Math.floor(interval / endValue);
    let counter = setInterval(function () {
        startValue += 1;
        valueDisplay.textContent = startValue;
        if (startValue == endValue) {
            clearInterval(counter);
        }
    }, duration);
});

$(".menu > ul > li").click(function (e) {
    // Remove 'active' from already active items
    $(this).siblings().removeClass("active");
    // Toggle 'active' for clicked item
    $(this).toggleClass("active");
    // If it has a sub-menu, open it
    $(this).find("ul").slideToggle();
    // Close other submenus if any are open
    $(this).siblings().find("ul").slideUp();

    // Remove active class from submenu items
    $(this).siblings().find("ul").find("li").removeClass("active");

});
$(".menu-btn").click(function () {
    $(".sidebar").toggleClass("active");
});
let slides = document.querySelectorAll('.slide-container');
let index = 0;

function next() {
    slides[index].classList.remove('active');
    index = (index + 1) % slides.length;
    slides[index].classList.add('active');
}
function prev() {
    slides[index].classList.remove('active');
    index = (index - 1 + slides.length) % slides.length;
    slides[index].classList.add('active');
}



document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('modal');
    const closeButton = document.querySelector('.close-button');
    const modalImage = document.getElementById('modal-image');
    const modalName = document.getElementById('modal-name');
    const modalContact = document.getElementById('modal-contact');
    const modalRickshawModel = document.getElementById('modal-rickshaw-model');
    const modalLicencePlate = document.getElementById('modal-licence-plate');
    const modalExperience = document.getElementById('modal-experience');

    document.querySelectorAll('.fa-eye').forEach(button => {
        button.addEventListener('click', function () {
            const row = this.closest('tr');
            const imageSrc = row.querySelector('img').src;
            const name = row.children[2].textContent;
            const contact = row.children[3].textContent;
            const rickshawModel = row.children[4].textContent;
            const licencePlate = row.children[5].textContent;
            const experience = row.children[6].textContent;

            modalImage.src = imageSrc;
            modalName.textContent = `Name: ${name}`;
            modalContact.textContent = `Contact: ${contact}`;
            modalRickshawModel.textContent = `Rickshaw Model: ${rickshawModel}`;
            modalLicencePlate.textContent = `Licence Plate: ${licencePlate}`;
            modalExperience.textContent = `Experience: ${experience}`;

            modal.style.display = 'flex';
        });
    });

    closeButton.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function () {
            const driverID = this.getAttribute('data-id');

            if (confirm('Are you sure you want to delete this driver?')) {
                fetch('delete_driver.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `DriverID=${driverID}`
                })
                    .then(response => response.text())
                    .then(data => {
                        if (data === 'Success') {
                            alert('Driver deleted successfully');
                            location.reload();  // Reload the page to reflect the deletion
                        } else {
                            alert('Failed to delete driver');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        });
    });
});


function filterTable() {
    // Get the search input value
    let input = document.getElementById('search');
    let filter = input.value.toLowerCase();
    
    // Get the table and rows
    let table = document.getElementById('driverTable');
    let rows = table.getElementsByTagName('tr');

    // Loop through all table rows (excluding the first row which contains table headers)
    for (let i = 1; i < rows.length; i++) {
        let cells = rows[i].getElementsByTagName('td');
        let found = false;
        
        // Loop through each cell in the row
        for (let j = 0; j < cells.length; j++) {
            if (cells[j]) {
                let cellText = cells[j].innerText || cells[j].textContent;
                if (cellText.toLowerCase().indexOf(filter) > -1) {
                    found = true;
                    break;
                }
            }
        }

        // Show or hide the row based on the search text
        rows[i].style.display = found ? '' : 'none';
    }
}
