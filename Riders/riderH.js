let subMenu = document.getElementById("subMenu");

function toggleMenu() {
    subMenu.classList.toggle("open-menu");
}
$(document).ready(function () {
    $('#requestRide').on('click', function () {
        var pickUpLocation = $('#pickUpLocation').val();
        var dropOffLocation = $('#dropOffLocation').val();

        $.ajax({
            url: 'submit_ride_request.php',
            method: 'POST',
            data: {
                pick_up_location: pickUpLocation,
                drop_off_location: dropOffLocation
            },
            success: function (response) {
                // alert('Ride request submitted successfully.');
            },
            error: function () {
                // alert('Error submitting ride request.');
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

document.addEventListener("DOMContentLoaded", function () {
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





//message
document.getElementById('requestRide').addEventListener('click', function (event) {
    event.preventDefault();
    message();
});
function message() {
    var loc = document.getElementById('pickUpLocation');
    var des = document.getElementById('dropOffLocation');
    const success = document.getElementById('success');
    const danger = document.getElementById('danger');

    if (loc.value === '' || des.value === '') {
        danger.style.display = 'block';
    }
    else {
        setTimeout(() => {
            loc.value = '';
            des.value = '';
        }, 2000);

        success.style.display = 'block';
    }

    setTimeout(() => {
        danger.style.display = 'none';
        success.style.display = 'none';
    }, 4000);
}


// JavaScript to handle rating selection
const stars = document.querySelectorAll('.star-widget input[type="radio"]');
let ratingValue;

stars.forEach((star) => {
    star.addEventListener('click', function () {
        ratingValue = this.value;
        document.getElementById('rating').value = ratingValue;
        console.log('Rating selected:', ratingValue);
    });
});

// Example function to validate form before submission
document.getElementById('reviewForm').addEventListener('submit', function (event) {
    // Validate if a rating is selected
    if (!ratingValue) {
        alert('Please select a rating before submitting.');
        event.preventDefault(); // Prevent form submission
    }
});



document.addEventListener('DOMContentLoaded', function() {
    const rider_id = document.getElementById('rid');
    fetchNotifications(rider_id);

    // Add debounce function to handle rapid clicks
    const debounce = (func, delay) => {
        let debounceTimer;
        return function() {
            const context = this;
            const args = arguments;
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => func.apply(context, args), delay);
        }
    };

    document.getElementById('notification-btn').addEventListener('click', debounce(function() {
        toggleNotifications(rider_id);
    }, 300));
});
function toggleNotifications(rider_id) {
    console.log('Toggle Notifications called'); // Debugging line
    const notificationsDiv = document.getElementById('notifications');
    const isHidden = notificationsDiv.classList.contains('hidden');
    console.log('Initial display property:', isHidden); // Debugging line

    if (isHidden) {
        fetchNotifications(rider_id);
        notificationsDiv.classList.remove('hidden');
    } else {
        notificationsDiv.classList.add('hidden');
    }

    console.log('Updated display property:', notificationsDiv.classList.contains('hidden')); // Debugging line
}

function fetchNotifications(rider_id) {
    fetch(`fetch_notifications.php?rider_id=${rider_id}`)
        .then(response => response.json())
        .then(data => {
            const notificationsDiv = document.getElementById('notifications');
            notificationsDiv.innerHTML = '';
            data.forEach(notification => {
                const notificationDiv = document.createElement('div');
                notificationDiv.classList.add('notification');
                notificationDiv.innerHTML = `
                    <i class="fa-solid fa-bell" style="color: #00bfff;"></i>
                    <span>Mr.${notification.msg} at ${notification.time}</span>
                    <button class="close-btn" onclick="closeNotification(this, ${notification.id})">x</button>
                `;
                notificationsDiv.appendChild(notificationDiv);
            });
            updateNotificationCount();
        })
        .catch(error => console.error('Error fetching notifications:', error));
}

function closeNotification(button, notificationId) {
    const notification = button.parentElement;
    notification.remove();
    markNotificationAsRead(notificationId);
    updateNotificationCount();
}

function markNotificationAsRead(notificationId) {
    fetch(`mark_as_read.php?notification_id=${notificationId}`, { method: 'POST' })
        .then(response => response.json())
        .then(data => {
            console.log('Notification marked as read');
        });
}

function updateNotificationCount() {
    const notifications = document.querySelectorAll('.notification');
    const count = notifications.length;
    const notificationCountSpan = document.getElementById('notification-count');
    notificationCountSpan.textContent = count;
    if (count === 0) {
        notificationCountSpan.style.display = 'none';
    } else {
        notificationCountSpan.style.display = 'inline';
    }
}

function fetchHistory() {
    let historyDiv = document.getElementById('ride-history');
    
    if (historyDiv.style.display === 'none' || historyDiv.innerHTML === '') {
        // Fetch and display history if it's currently hidden or empty
        fetch('fetch_history.php')
            .then(response => response.json())
            .then(data => {
                historyDiv.innerHTML = ''; // Clear any existing content
                
                if (data.length === 0) {
                    historyDiv.innerHTML = '<p>No accepted rides found.</p>';
                } else {
                    data.forEach((ride, index) => {
                        let rideDetails = document.createElement('div');
                        rideDetails.classList.add('ride');
                        rideDetails.innerHTML = `
                            <p><strong>Pick-Up Location:</strong> ${ride.pick_up_location}</p>
                            <p><strong>Drop-Off Location:</strong> ${ride.drop_off_location}</p>
                            <p><strong>Request Time:</strong> ${ride.request_time}</p>
                        `;
                        historyDiv.appendChild(rideDetails);
                    });
                }

                // Show the history
                historyDiv.style.display = 'block';
            })
            .catch(error => console.error('Error fetching ride history:', error));
    } else {
        // Hide the history if it's currently visible
        historyDiv.style.display = 'none';
    }
}
