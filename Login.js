function validateForm() {
    // Get form values
    var fname = document.getElementById("fname").value.trim();
    var lname = document.getElementById("lname").value.trim();
    var email = document.getElementById("email").value.trim();
    var username = document.getElementById("username").value.trim();
    var password = document.getElementById("psswrd").value.trim();
    var dob = document.getElementById("dob").value;
    
    // Validate fields
    if (fname === "" || lname === "" || email === "" || username === "" || password === "") {
        alert("All fields are required.");
        return false;
    }

    // Email format check
    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!emailPattern.test(email)) {
        alert("Please enter a valid email address.");
        return false;
    }

    // Password length check
    if (password.length < 6) {
        alert("Password must be at least 6 characters long.");
        return false;
    }

    // Date of birth validation
    var today = new Date();
    var birthDate = new Date(dob);
    if (birthDate >= today) {
        alert("Please enter a valid date of birth.");
        return false;
    }

    return true; // If all validations pass
}
