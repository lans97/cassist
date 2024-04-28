$('#registerForm').submit(function(event) {
    event.preventDefault();

    var username = $("#username").val();
    var mail = $("#mail").val();
    var password = $("#password").val();
    var confirmPassword = $("#confirmPassword").val();
    var super_user = $("#super_user").val();

    var userData = {
        username: username,
        mail: mail,
        password: password,
        super_user: super_user
    };
    
    let isValid = true;

    if (username.trim() === "") {
        $("#usernameError").html("Username is required");
        isValid = false;
    }

    if (mail.trim() === "") {
        $("#emailError").html("Email is required");
        isValid = false;
    } else if (!isValidEmail(mail)) {
        $("#emailError").html("Invalid email format");
        isValid = false;
    }

    if (password.trim() === "") {
        $("#passwordError").html("Password is required");
        isValid = false;
    }

    if (confirmPassword.trim() === "") {
        $("#confirmPasswordError").html("Please confirm your password");
        isValid = false;
    } else if (confirmPassword !== password) {
        $("#confirmPasswordError").html("Passwords do not match");
        isValid = false;
    }

    if (isValid) {
        this.submit();
    } else {
        return;
    }
    
    $.ajax({
        url: '/api/users',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(userData),
        success: function(response) {
            if (response.success){
                alert(`New user creatred with ID: ${response.data.id}`);
            } else {
                alert(`Error: ${response.error}`);
            }
            console.log(response);
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
        }
    });
});

function isValidEmail(email) {
    // Regular expression for email validation
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}