// world.js
// Get the button element with id of lookup
var button = document.getElementById("lookup");

document.addEventListener('DOMContentLoaded', function () {
    // Listen for clicks on the "Lookup" button
    document.getElementById('lookup').addEventListener('click', function () {
        // Fetch data by opening an AJAX connection
        var country = document.getElementById('countryInput').value;
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'world.php?country=' + encodeURIComponent(country), true);

        // Set up the callback function to handle the response
        xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 400) {
                // Success! Print the data into the div with id "result"
                document.getElementById('result').innerHTML = xhr.responseText;
            } else {
                // Error handling if the request was unsuccessful
                console.error('Request failed with status:', xhr.status);
            }
        };

        // Send the AJAX request
        xhr.open("GET",url,true);
        xhr.send();
    });
});