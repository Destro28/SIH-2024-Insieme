function validateForm(event) {
    var username = document.forms["loginForm"]["name1"].value;
    var password = document.forms["loginForm"]["password"].value;

    // Validate Username
    if (username.trim() === "") {
        alert("Username must be filled out.");
        event.preventDefault(); // Prevent form submission
        return false;
    }

    // Validate Password
    var passwordRegex = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-zA-Z]).{8,}$/;
    if (!passwordRegex.test(password)) {
        alert("Your Password is too weak. It must contain at least one number, one letter, one special character, and be at least 8 characters long.");
        event.preventDefault(); // Prevent form submission
        return false;
    }

    // Optionally, you can add more validation rules here

    // If all validations pass
    return true;
}