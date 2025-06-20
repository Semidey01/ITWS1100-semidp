function validate(formObj) {
  
  if (formObj.firstNames.value == "") {
    alert("Please enter a first name");
    formObj.firstNames.focus();
    return false;
  }
  
  if (formObj.lastName.value == "") {
    alert("Please enter a last name");
    formObj.lastName.focus();
    return false;
  }
  
  if (formObj.dob.value == "") {
    alert("Please enter a date of birth");
    formObj.dob.focus();
    return false;
  }
    
  return true;
}

function validateMovie(formObj) {
  if (formObj.title.value == "") {
    alert("Please enter a title");
    formObj.title.focus();
    return false;
  }
  
  if (formObj.year.value == "") {
    alert("Please enter a year");
    formObj.year.focus();
    return false;
  }
  
  if (isNaN(formObj.year.value)) {
    alert("Year must be a number");
    formObj.year.focus();
    return false;
  }
    
  return true;
}


$(document).ready(function() {
  
  // focus the name field on first load of the page
  $("#firstNames").focus();

  $(".deleteMovie").click(function() {
    if(confirm("Remove movie? (This action cannot be undone.)")) {
        var curId = $(this).closest("tr").attr("id");
        var movieId = curId.substr(curId.indexOf("-")+1);
        var postData = "id=" + movieId;
        
        $.ajax({
            type: "post",
            url: "movie-delete.php",
            dataType: "json",
            data: postData,
            success: function(responseData, status){
                if (responseData.errors) {
                    alert(responseData.errno + " " + responseData.error);
                } else {
                    $("#" + curId).closest("tr").remove();
                    $(".messages").hide();
                    $("#jsMessages").html("<h4>Movie deleted</h4>").show();
                    
                    $("#movieTable tr").each(function(i){
                        if (i % 2 == 0) {
                            $(this).addClass("odd"); 
                        } else {
                            $(this).removeClass("odd");
                        }
                    });
                }
            },
            error: function(msg) {
                alert(msg.status + " " + msg.statusText);
            }
        });
    }
});
     
  $(".deleteActor").click(function() {
    if(confirm("Remove actor? (This action cannot be undone.)")) {
      
      // get the id of the clicked element's row
      var curId = $(this).closest("tr").attr("id");
      // Extract the db id of the actor from the dom id of the clicked element
      var actorId = curId.substr(curId.indexOf("-")+1);
      // Build the data to send. 
      var postData = "id=" + actorId;
      // we could also format this as json ... jQuery will (by default) 
      // convert it into a query string anyway, e.g. 
      // var postData = { "id" : actorId };
      
      $.ajax({
        type: "post",
        url: "actor-delete.php",
        dataType: "json",
        data: postData,
        success: function(responseData, status){
          if (responseData.errors) {
            alert(responseData.errno + " " + responseData.error);
          } else {
            // Uncomment the following line to see the repsonse message from the server
            // alert(responseData.message);
            
            // remove the table row in which the image was clicked
            $("#" + curId).closest("tr").remove();
            
            // if a php generated message box is up, hide it:
            $(".messages").hide();
            
            // populate the js message box and show it:
            $("#jsMessages").html("<h4>Actor deleted</h4>").show();
            
            // re-zebra the table
            $("#actorTable tr").each(function(i){
              if (i % 2 == 0) {
                // we must compensate for the header row...
                $(this).addClass("odd"); 
              } else {
                $(this).removeClass("odd");
              }
            });
          }
        },
        error: function(msg) {
          // there was a problem
          alert(msg.status + " " + msg.statusText);
        }
      });
      
    }
  });
  
});