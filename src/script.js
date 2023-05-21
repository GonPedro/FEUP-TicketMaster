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

    $('#hashtag-ticket-input').on('input', function() {
    var inputText = $(this).val();
    
    if (inputText.startsWith('#')) {
        $.ajax({
        url: '/get_ticket_hashtags.php',
        method: 'POST',
        data: {
            search: inputText.substring(1),
            ticket: $('#hashtag-ticket-input').data('ticket-id')
        },
        success: function(response) {
            var option = Object.values(response);
            displayAutocompleteTicketOptions(option);
        },
        error: function(xhr, status, error) {
            console.error('An error occurred:', error);
        }
        });
    } else {
        $('#autocomplete-results').empty();
    }
    });

    // Click-to-remove functionality
    $(document).on('click', '.hashtag-label', function() {
        var label = $(this);
        var ticketId = label.data('ticket-id');
        var hashtag = label.data('hashtag-id');
        
        // Remove the label from the screen
        label.remove();
        
        // Call a function to remove the hashtag from the database, passing the hashtag ID as an argument
        removeHashtagFromDatabase(ticketId, hashtag);
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

function displayAutocompleteTicketOptions(options) {
    var resultsDiv = $('#autocomplete-results');
    resultsDiv.empty();
  
    options.forEach(function(option) {
        console.log("type");
      var optionDiv = $('<div class="autocomplete-option">' + option + '</div>');
  
      optionDiv.click(function() {
        console.log("click");
        var selectedHashtag = '#' + option;
        displaySelectedTicketHashtag(selectedHashtag);
        $('#hashtag-input').val('').focus();
        resultsDiv.empty();
      });
  
      resultsDiv.append(optionDiv);
    });
  }


  function displaySelectedTicketHashtag(hashtag) {
    var listDiv = $('#list');
    var hashtagLabel = $('<label class="hashtag-label">' + hashtag + '</label>');
  
    listDiv.append(hashtagLabel);
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
      updateHashtagsInput();
    });
  
    selectedHashtagsContainer.append(hashtagDiv);
  }
  
  function updateHashtagsInput() {
    var selectedHashtags = [];
  
    $('.selected-hashtag').each(function(index) {
      var hashtag = $(this).text().trim();
      if (hashtag && selectedHashtags.indexOf(hashtag) === -1) {
        if (index !== 0) { // Skip the first concatenated word
          selectedHashtags.push(hashtag);
        }
      }
    });
  
    var selectedHashtagsString = selectedHashtags.map(function(hashtag) {
      return '#' + hashtag.replace(/#/g, '').trim();
    }).join(',');
  
    console.log(selectedHashtagsString);
  
    $('.hashtag-input').val(selectedHashtagsString);
  }
  


