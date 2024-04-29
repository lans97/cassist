$(document).ready(function () {
    $("#registerForm").submit(function (event) {
        event.preventDefault();
        var form = $(this)[0];
        var isValid = true;

        if (form.username.value.trim() === "") {
            setErrorFor($("#username"), "Username is required");
            isValid = false;
        } else {
            setSuccessFor($("#username"));
        }

        if (form.email.value.trim() === "") {
            setErrorFor($("#email"), "Email is required");
            isValid = false;
        } else if (!isValidEmail(form.email.value.trim())) {
            setErrorFor($("#email"), "Invalid email format");
            isValid = false;
        } else {
            setSuccessFor($("#email"));
        }

        if (form.password.value.trim() === "") {
            setErrorFor($("#password"), "Password is required");
            isValid = false;
        } else {
            setSuccessFor($("#password"));
        }

        if (form.confirmPassword.value.trim() === "") {
            setErrorFor($("#confirmPassword"), "Please confirm your password");
            isValid = false;
        } else if (
            form.confirmPassword.value.trim() !== form.password.value.trim()
        ) {
            setErrorFor($("#confirmPassword"), "Passwords do not match");
            isValid = false;
        } else {
            setSuccessFor($("#confirmPassword"));
        }

        if (!isValid) {
            event.preventDefault();
            event.stopPropagation();
        } else {
            userData = {
                username: $("#username").val(),
                email: $("#email").val(),
                password: $("#password").val(),
                confirmPassword: $("#confirmPassword").val(),
                super_user: false
            };
            $.ajax({
                url: "/api/users",
                type: "POST",
                contentType: "application/json",
                data: JSON.stringify(userData),
                dataType: "json",
                success: function (response) {
                    alert(response.message);
                    window.location.href = "/login"
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                    alert("An error occured. Please try again later.");
                },
            });
        }
        form.classList.add("was-validated");
    });

    function setErrorFor(input, message) {
        var feedbackElement = input.next(".invalid-feedback");
        feedbackElement.html(message);
        input.addClass("is-invalid").removeClass("is-valid");
    }

    function setSuccessFor(input) {
        input.addClass("is-valid").removeClass("is-invalid");
    }

    function isValidEmail(email) {
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
});
