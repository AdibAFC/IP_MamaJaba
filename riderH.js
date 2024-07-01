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







function openPopup() {
    document.querySelector(".overlay").classList.add("active");
    document.getElementById("popup").classList.add("open-popup");
}

function closePopup() {
    document.querySelector(".overlay").classList.remove("active");
    document.getElementById("popup").classList.remove("open-popup");
}

document.addEventListener("DOMContentLoaded", function() {
    const btn = document.querySelector(".star-widget button");
    const post = document.querySelector(".post");
    const widget = document.querySelector(".star-widget");
    const editbtn = document.querySelector(".edit");

    btn.onclick = (e) => {
        e.preventDefault();  // Prevent the form from submitting
        const form = e.target.closest('form');
        submitReviewForm(form);
    };

    editbtn.onclick = () => {
        widget.style.display = "block";
        post.style.display = "none";
        return false;
    };
});

function submitReviewForm(form) {
    const formData = new FormData(form);

    fetch('submit_review.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        console.log(data);
        if (data.includes('Review submitted successfully')) {
            document.querySelector('.star-widget').style.display = 'none';
            document.querySelector('.post').style.display = 'block';
        } else {
            alert('Failed to submit review.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}



document.getElementById('notification-btn').addEventListener('click', function() {
    const notificationsDiv = document.getElementById('notifications');
    if (notificationsDiv.style.display === 'block') {
        notificationsDiv.style.display = 'none';
    } else {
        notificationsDiv.style.display = 'block';
    }
});

function closeNotification(button) {
    const notification = button.parentElement;
    notification.remove();
    updateNotificationCount();
}

function updateNotificationCount() {
    const notifications = document.querySelectorAll('.notification');
    const count = notifications.length;
    const notificationCountSpan = document.getElementById('notification-count');
    notificationCountSpan.textContent = count;
    if (count === 0) {
        notificationCountSpan.style.display = 'none';
    }
}


//message
document.getElementById('requestRide').addEventListener('click', function(event) {
    event.preventDefault(); 
    message();
});
function message(){
    var loc = document.getElementById('pickUpLocation');
    var des = document.getElementById('dropOffLocation');
    const success = document.getElementById('success');
    const danger = document.getElementById('danger');

    if(loc.value === '' || des.value === '')
    {
        danger.style.display = 'block';
    }
    else{
        setTimeout(()=>{
            loc.value='';
            des.value='';
        },2000);

        success.style.display = 'block';
    }

    setTimeout(()=>{
        danger.style.display='none';
        success.style.display='none';
    },4000);
}
