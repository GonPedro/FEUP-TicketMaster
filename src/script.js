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

    $('#hashtag-ticket-input').on('input', function() {
    var inputText = $(this).val();
    

    // Click-to-remove functionality
    $(document).on('click', '.hashtag-label', function() {
        var label = $(this);
        var ticketId = label.data('ticket-id');
        var hashtag = label.data('hashtag-id');
        
        // Remove the label from the screen
        label.remove();
        
        removeHashtagFromDatabase(ticketId, hashtag);
    });
});
});


function removeHashtagFromDatabase(ticketId, hashtag){
    $.ajax({
        url: '/action_remove_hashtag.php',
        method: 'POST',
        data: {
            ticketID: ticketId,
            hashtag: hashtag
        },
        success: function(response) {
            console.log("Successfully removed hashtag from ticket");
        },
        error: function(xhr, status, error) {
            // Handle the error here
            console.error('An error occurred:', error);
        }
    });
}

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

function changeStatus(select) {
    var selectedValue = select.value;
    // Perform an AJAX request to trigger the action
    $.ajax({
        url: '/action_change_status.php',
        method: 'POST',
        data: $('#statusChange').serialize(),
        success: function(response) {
            document.getElementById("ticketmenu").innerHTML = response;
        },
        error: function(xhr, status, error) {
            // Handle the error here
            console.error('An error occurred:', error);
        }
    });
}

function changeDepartment(select) {
    var selectedValue = select.value;
    // Perform an AJAX request to trigger the action
    $.ajax({
        url: '/action_change_department.php',
        method: 'POST',
        data: $('#departmentChange').serialize(),
        success: function(response) {
            document.getElementById("ticketmenu").innerHTML = response;
        },
        error: function(xhr, status, error) {
            // Handle the error here
            console.error('An error occurred:', error);
        }
    });
}

function changePriority(select) {
    var selectedValue = select.value;
    // Perform an AJAX request to trigger the action
    $.ajax({
        url: '/action_change_priority.php',
        method: 'POST',
        data: $('#priorityChange').serialize(),
        success: function(response) {
            document.getElementById("ticketmenu").innerHTML = response;
        },
        error: function(xhr, status, error) {
            // Handle the error here
            console.error('An error occurred:', error);
        }
    });
}


  



