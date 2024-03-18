const links = document.querySelectorAll('a');  // Select all anchor tags

links.forEach(link => {
    link.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default link behavior

        // Show the loading page
        document.body.innerHTML = '<iframe src="/ims/html/load.html" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; border: none;"></iframe>';

        // Delay navigation to the target page for at least 2 seconds
        setTimeout(function() {
            window.location.href = link.href; // Redirect to the target page
        }, 2000); // Delay for 2 seconds (2000 milliseconds)
    });
});

    function deleteRow(id) {
        // Get the reference of the row by ID
        var row = document.querySelector('tr[data-id="' + id + '"]');

        // Remove the row from the table
        row.parentNode.removeChild(row);

        // Send an AJAX request to the server to delete the record with the given ID
        sendDeleteRequestToServer(id);
    }

    function sendDeleteRequestToServer(id) {
        // Use AJAX to send a request to your server to delete the record with the given ID
        // Example using fetch API:
        fetch('delete-item.php?id=' + id, {
            method: 'DELETE'
        })
        .then(response => response.json())
        .then(data => console.log(data))
        .catch(error => console.error('Error:', error));
    }

