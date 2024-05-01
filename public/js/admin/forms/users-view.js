$(document).ready(function () {
    refreshUserTable();

    $("#addUserForm").submit(function (e) {
        e.preventDefault();
        var form = $(this)[0];
        var isValid = true;

        if (form.username.value.trim() === "") {
            setErrorFor($("#username"), "Username can't be NULL");
            isValid = false;
        } else {
            setSuccessFor($("#username"));
        }

        if (form.email.value.trim() === "") {
            setErrorFor($("#email"), "Email can't be NULL");
            isValid = false;
        } else if (!isValidEmail(form.email.value.trim())) {
            setErrorFor($("#email"), "Invalid email format");
            isValid = false;
        } else {
            setSuccessFor($("#email"));
        }

        if (form.password.value.trim() === "") {
            setErrorFor($("#password"), "Password can't be NULL");
            isValid = false;
        } else {
            setSuccessFor($("#password"));
        }

        if (form.confirmPassword.value.trim() === "") {
            setErrorFor(
                $("#confirmPassword"),
                "Password confirmation necesary"
            );
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
            e.preventDefault();
            e.stopPropagation();
        } else {
            userData = {
                username: $("#username").val(),
                email: $("#email").val(),
                password: $("#password").val(),
                confirmPassword: $("#confirmPassword").val(),
                super_user: $("#super_user").is(":checked") ? true : false,
            };

            $.ajax({
                url: "/api/users",
                type: "POST",
                contentType: "application/json",
                data: JSON.stringify(userData),
                dataType: "json",
                success: function (response) {
                    alert("New user registered");
                    refreshUserTable();
                },
                error: function (xhr, status, error) {
                    alert("An error occured. Please try again later.");
                },
            });
        }
        form.classList.add("was-validated");
    });
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

function refreshUserTable() {
    $.ajax({
        url: "/api/users",
        method: "GET",
        dataType: "json",
        success: function (response) {
            $("#usersTable tbody").html(
                $.map(response.data, function (user) {
                    return `
                        <tr id="user-${user.id}">
                            <td>${user.id}</td>
                            <td>
                                <span class="editable" data-field="username">${user.username}</span>
                                <input type="text" class="form-control" id="edit-username-${user.id}" style="display: none;" value="${user.username}">
                            </td>
                            <td>
                                <span class="editable" data-field="email">${user.email}</span>
                                <input type="text" class="form-control" id="edit-email-${user.id}"  style="display: none;" value="${user.email}">
                            </td>
                            <td>
                                <span class="editable" data-field="super_user">${user.super_user}</span>
                                <input type="checkbox" class="form-check-input" id="edit-super_user-${user.id}"  style="display: none;" ${user.super_user ? "checked" : ""}>
                            </td>
                            <td>${user.created_at}</td>
                            <td>${user.updated_at}</td>
                            <td>
                                <button class="btn btn-secondary edit-btn" onclick="toggleEdit(${user.id})">
                                    <i class="fa-solid fa-pencil"></i>
                                </button>
                                <button class="btn btn-secondary save-btn" style="display: none;" onclick="saveUser(${user.id})">
                                    <i class="fa-solid fa-check"></i>
                                </button>
                                <button class="btn btn-danger delete-btn" onclick="deleteUser(${user.id})">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    `;
                }).join("")
            );
        },
        error: function (xhr, status, error) {
            console.error(error);
        },
    });
}

function deleteUser(userId) {
    if (confirm("Are you sure you want to delete this user?")) {
        $.ajax({
            url: "/api/users?user-id=" + userId,
            method: "DELETE",
            success: function (response) {
                refreshUserTable();
            },
            error: function (xhr, status, error) {
                console.error(error);
            },
        });
    }
}

function toggleEdit(userId) {
    var row = $("#user-" + userId);
    row.find(".editable").toggle();
    row.find("input").toggle();
    row.find(".delete-btn").toggle();
    row.find(".save-btn").toggle();
}

function saveUser(userId) {
    var userData = {
        id: userId,
        username: $("#edit-username-"+userId).val(),
        email: $("#edit-email-"+userId).val(),
        super_user: $("#edit-super_user-"+userId).prop("checked"),
    };
    
    $.ajax({
        url: "/api/users",
        method: "PUT",
        contentType: "application/json",
        data: JSON.stringify(userData),
        success: function (response) {
            refreshUserTable();
            toggleEdit(userId);
        },
        error: function (xhr, status, error) {
            console.error(error);
        },
    });
}
