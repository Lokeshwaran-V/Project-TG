// Function to handle adding a room
function addRoom() {
    // Get room number and room name input values
    var roomNo = document.getElementById("room-input-number").value;
    var roomName = document.getElementById("room-input-name").value;
    var department = document.getElementById("room-dropdown-department").value;

    // Perform validation if needed

    // Submit form data to Rooms.php
    // You can use AJAX to submit the form data asynchronously
    // Here's a basic example of submitting the form using fetch API
    fetch('rooms.php', {
        method: 'POST',
        body: JSON.stringify({
            roomNo: roomNo,
            roomName: roomName,
            department: department
        }),
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => {
        // Handle response
        if (response.ok) {
            // Room added successfully, perform further actions if needed
            console.log('Room added successfully');
        } else {
            // Error occurred, handle it appropriately
            console.error('Failed to add room');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
