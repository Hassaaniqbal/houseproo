// Function to update availability
function updateAvailability() {
    var switchCheckbox = document.getElementById("flexSwitchCheckDefault");
    var availabilityValue = switchCheckbox.checked ? 1 : 0; // 1 if checked, 0 if unchecked

    // Store the availability state in local storage
    localStorage.setItem('availabilityState', availabilityValue);

    // Send an AJAX request to update the database
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "update_availability.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Set up the data to send
    var data = "availability=" + availabilityValue;

    // Send the availability value to the server
    xhr.send(data);
}

// Function to initialize checkbox state based on local storage
function initializeAvailability() {
    var availabilityState = localStorage.getItem('availabilityState');
    if (availabilityState === '1') {
        document.getElementById("flexSwitchCheckDefault").checked = true;
    } else {
        document.getElementById("flexSwitchCheckDefault").checked = false;
    }
}

// Call initializeAvailability function when the page loads
window.onload = initializeAvailability;
