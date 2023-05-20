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

    $('#hashtag-input').on('input', function() {
        var inputText = $(this).val();
        
        if (inputText.startsWith('#')) {
            $.ajax({
                url: '/get_hashtags.php',
                method: 'POST',
                data: { search: inputText.substring(1) },
                success: function(response) {
                    displayAutocompleteOptions(response);
                },
                error: function(xhr, status, error) {
                    console.error('An error occurred:', error);
                }
            });
        } else {
            $('#autocomplete-results').empty();
        }
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

function displayAutocompleteOptions(options) {
    var resultsDiv = $('#autocomplete-results');
    resultsDiv.empty();

    options.forEach(function(option) {
        var optionDiv = $('<div class="autocomplete-option">' + option + '</div>');

        optionDiv.click(function() {
            var selectedHashtag = '#' + option;
            displaySelectedHashtag(selectedHashtag);
            updateHashtagsInput();
            $('#hashtag-input').val('').focus();
            resultsDiv.empty();
        });

        resultsDiv.append(optionDiv);
    });
}

function displaySelectedHashtag(hashtag) {
    var selectedHashtagsContainer = $('#selected-hashtags');
    var hashtagDiv = $('<div class="selected-hashtag">' + hashtag + '</div>');

    hashtagDiv.click(function() {
        $(this).remove();
    });

    selectedHashtagsContainer.append(hashtagDiv);
}

function updateHashtagsInput() {
    var selectedHashtags = $('.selected-hashtag').map(function() {
        return $(this).text();
    }).get().join(',');

    $('#hashtag-input').val(selectedHashtags);
}

$('#selected-hashtags').on('click', '.selected-hashtag', function() {
    $(this).remove();
    updateHashtagsInput();
});



