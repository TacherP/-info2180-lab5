$(document).ready(function() {
    // Listen for clicks on the "Lookup" button
    $("#lookup").click(function() {
        // Fetch data by opening an AJAX connection
        var country = $("#countryInput").val();

        // Use jQuery for AJAX request
        $.ajax({
            url: 'world.php?country=' + encodeURIComponent(country),
            type: 'GET',
            success: function(response) {
                // Success! Print the data into the div with id "result"
                $("#result").html(response);
            },
            error: function(xhr, status, error) {
                // Error handling if the request was unsuccessful
                console.error('Request failed with status:', status, 'Error:', error);
            }
        });
    });

    // Listen for clicks on the "LookupBtn" button
    $("#lookupBtn").click(function() {
        // Fetch data by opening an AJAX connection for city lookup
        var country = $("#countryInput").val();

        // Use jQuery for AJAX request for city lookup
        $.ajax({
            url: 'world.php?country=' + encodeURIComponent(country) + '&lookup=cities',
            type: 'GET',
            success: function(response) {
                // Success! Print the data into the div with id "result"
                $("#result").html(response);
            },
            error: function(xhr, status, error) {
                // Error handling if the request was unsuccessful
                console.error('Request failed with status:', status, 'Error:', error);
            }
        });
    });
});
