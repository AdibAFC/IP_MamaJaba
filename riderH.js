let subMenu = document.getElementById("subMenu");

function toggleMenu() {
    subMenu.classList.toggle("open-menu");
}
$(document).ready(function() {
    $('#requestRide').on('click', function() {
        var pickUpLocation = $('#pickUpLocation').val();
        var dropOffLocation = $('#dropOffLocation').val();

        $.ajax({
            url: 'submit_ride_request.php',
            method: 'POST',
            data: {
                pick_up_location: pickUpLocation,
                drop_off_location: dropOffLocation
            },
            success: function(response) {
                alert('Ride request submitted successfully.');
            },
            error: function() {
                alert('Error submitting ride request.');
            }
        });
    });
});