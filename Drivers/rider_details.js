let subMenu = document.getElementById("subMenu");
let toastbox = document.getElementById("toastbox");
let acceptMsg = '<i class="fa-solid fa-circle-check"></i> Call Accepted';
let declineMsg = '<i class="fa-solid fa-circle-xmark"></i> Call Declined';

function toggleMenu() {
    subMenu.classList.toggle("open-menu");
}

function handleRequest(action, button) {
    var requestId = button.getAttribute('data-id');

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'handle_request.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log(xhr.responseText);
            try {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    if (action === 'accept') {
                        // Remove the request from all drivers' pages
                        document.querySelectorAll('.ride-request[data-id="' + requestId + '"]').forEach(function (request) {
                            request.remove();
                        });
                    } else if (action === 'decline') {
                        // Remove the request only from the current driver's page
                        button.closest('.ride-request').remove();
                    }
                    showToast(response.message);
                    console.log(xhr.responseText);
                } else {
                    showToast(response.message);
                }
            } catch (e) {
                console.error('Failed to parse response as JSON:', xhr.responseText);
                showToast('An error occurred while processing your request.');
            }
        }
    };
    xhr.send('action=' + action + '&request_id=' + requestId);
}

function showToast(msg) {
    let toast = document.createElement("div");
    toast.classList.add("toast");
    toast.innerHTML = msg;
    toastbox.appendChild(toast);

    setTimeout(() => {
        toast.remove();
    }, 5000);
}
