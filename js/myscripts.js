//My global javascript functions for extra functionality... pun totally intended...

function toggleElement(elementti) { //hides or shows elements

   // alert("Hello\nHow are you?"); 

var div = document.getElementById(elementti);
    if (div.style.display !== 'none') {
        div.style.display = 'none'; //toggle element
    }
    else {
        div.style.display = 'block';
    }
}

function validateRegister() { //javascript validation for inputs, additional validation in register.php
    var x = document.forms["registerForm"]["usr"].value;
    if (x == "") { //oh no! user has no username, better tell them!
        alert("Username must be filled out");
        return false; //false so it doesn't allow posting
    }
	    var x = document.forms["registerForm"]["pwd"].value;
    if (x == "") { //oh no! user has no password, better tell them!
        alert("You must have password!");
        return false;
    }
	else
	if (x.length < 8) { //too short password, tell about that too
        alert("Your password must be at least 8 characters long!");
        return false;
    }
} 