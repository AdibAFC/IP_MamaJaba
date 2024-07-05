let subMenu = document.getElementById("subMenu");

function toggleMenu() {
    subMenu.classList.toggle("open-menu");
}
function fetchRideRequests() {
    $.ajax({
        url: 'fetch_ride_requests.php',
        method: 'GET',
        success: function(response) {
            $('#ridereq').html(response);
        }
    });
}

$(document).ready(function() {
    fetchRideRequests();
    setInterval(fetchRideRequests, 5000); // Poll every 5 seconds
});


function openmap() {
    document.querySelector(".overlay").classList.add("active");
    document.getElementById("popup").classList.add("open-popup");
}

function closemap() {
    document.querySelector(".overlay").classList.remove("active");
    document.getElementById("popup").classList.remove("open-popup");
}