function validateRegister() { //javascript validation for inputs, additional validation in register.php
    var x = document.forms["registerForm"]["usr"].value;
    if (x == "") {
        alert("Username must be filled out");
        return false;
    }
    var x = document.forms["registerForm"]["pwd"].value;
    if (x == "") {
        alert("You must have password!");
        return false;
    }
    else
        if (x.length < 8) {
            alert("Your password must be at least 8 characters long!");
            return false;
        }
} 