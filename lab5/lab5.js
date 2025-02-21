/* Lab 5 JavaScript File 
   Place variables and functions in this file */

function clearForm(anId) {
   var text = document.getElementById("comments");
   if (text.value == "Please enter your comments") {
      text.value = "";
   }
}

function restoreForm(anId) {
   var text = document.getElementById("comments");
   if (text.value == "") {
      text.value = "Please enter your comments";
   }
}


function validate(formObj) {
   var alert_text = "";

   if (formObj.firstName.value == "") {
       alert_text += "You must enter a first name\n";
       formObj.firstName.focus();
   }

   if (formObj.lastName.value == "") {
       alert_text += "You must enter a last name\n";
       formObj.lastName.focus();
   }

   if (formObj.title.value == "") {
       alert_text += "You must enter a title\n";
       formObj.title.focus();
   }

   if (formObj.org.value == "") {
       alert_text += "You must enter an organization\n";
       formObj.org.focus();
   }

   if (formObj.pseudonym.value == "") {
       alert_text += "You must enter a pseudonym\n";
       formObj.pseudonym.focus();
   }

   if (formObj.comments.value == "") {
       alert_text += "You must enter comments\n";
       formObj.comments.focus();
   }

   if (alert_text != "") {
       alert(alert_text);
       return false; // Prevent form submission if there are errors
   } else {
       alert("Submission Successful");
       return true; // Allow form submission if all fields are valid
   }
}

function showName() {
   var name = document.getElementById("firstName").value;
   var lastName = document.getElementById("lastName").value;
   var nickname = document.getElementById("pseudonym").value;
   if (name == "" || lastName == "" || nickname == "") {
       alert("Please fill out the name, last name and nickname fields");
       return;
   }
   else{
         alert(name + " " + lastName + " is " + nickname);
   }
}

