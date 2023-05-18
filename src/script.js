$(document).ready(function() {
    // Handle form submission
    $("#messageForm").submit(function(event) {
        // Prevent the default form submission
        event.preventDefault();

        // Get the form data
        var formData = $(this).serialize();

        // Send AJAX request
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: formData,
            success: function(response) {
                document.getElementById("msglist").innerHTML = response;
                console.log(response);
            },
            error: function(xhr, status, error) {
                // Handle the error response
                // For example, you can display an error message
                console.log("AJAX request failed: " + error);
            }
        });
    });
});
