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

    $("#ticketFilter").submit(function(event) {
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
                document.getElementById("list").innerHTML = response;
                console.log(response);
            },
            error: function(xhr, status, error) {
                // Handle the error response
                // For example, you can display an error message
                console.log("AJAX request failed: " + error);
            }
        });
    });

    $("#searchUser").submit(function(event) {
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
                document.getElementById("userlist").innerHTML = response;
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

 function changeRole(select) {
    var selectedValue = select.value;
    // Perform an AJAX request to trigger the action
    $.ajax({
        url: '/action_promote_user.php',
        method: 'POST',
        data: $('#roleChange').serialize(),
        success: function(response) {
            document.getElementById("userlist").innerHTML = response;
        },
        error: function(xhr, status, error) {
            // Handle the error here
            console.error('An error occurred:', error);
        }
    });
}




