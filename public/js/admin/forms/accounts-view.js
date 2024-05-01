$(document).ready(function () {
    refreshAccountTable();

    $.ajax({
        url: "/api/users",
        method: "GET",
        dataType: "json",
        success: function (response) {
            let select = $("#user");
            response.data.forEach((user) => {
                select.append(
                    new Option(`${user.id} - ${user.username}`, `${user.id}`)
                );
            });
        },
        error: function (xhr, status, error) {
            console.error(error);
        },
    });

    $("#addAccountForm").submit(function (e) {
        e.preventDefault();
        var form = $(this)[0];
        var isValid = true;

        // validation

        if (!isValid) {
            e.preventDefault();
            e.stopPropagation();
        } else {
            accountData = {
                user: $("#user").val(),
                nickname: $("#nickname").val(),
                balance: $("#balance").val(),
            };

            $.ajax({
                url: "/api/accounts",
                type: "POST",
                contentType: "application/json",
                data: JSON.stringify(accountData),
                dataType: "json",
                success: function (response) {
                    alert("New account registered");
                    refreshAccountTable();
                },
                error: function (xhr, status, error) {
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
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

function refreshAccountTable() {
    $.ajax({
        url: "/api/accounts",
        method: "GET",
        dataType: "json",
        success: function (response) {
            $("#accountsTable tbody").html(
                $.map(response.data, function (account) {
                    return `
                        <tr id="account-${account.id}">
                            <td>${account.id}</td>
                            <td>
                                <span class="editable" data-field="user">${
                                    account.user
                                }</span>
                                <select class="form-select user-select" id="edit-user-${
                                    account.id
                                }" style="display: none;">
                                </select>
                            </td>
                            <td>
                                <span class="editable" data-field="nickname">${
                                    account.nickname
                                }</span>
                                <input type="text" class="form-control" id="edit-nickname-${
                                    account.id
                                }"  style="display: none;" value="${account.nickname}">
                            </td>
                            <td>
                                <span class="editable" data-field="balance">
                                    \$${parseFloat(
                                        account.balance
                                    ).toLocaleString()}
                                </span>
                                <input type="number" min="0" step="0.01" class="form-control" id="edit-balance-${
                                    account.id
                                }"  style="display: none;" value="${account.balance}"}>
                            </td>
                            <td>${account.created_at}</td>
                            <td>${account.updated_at}</td>
                            <td>
                                <button class="btn btn-secondary edit-btn" onclick="toggleEdit(${
                                    account.id
                                }, ${account.user})">
                                    <i class="fa-solid fa-pencil"></i>
                                </button>
                                <button class="btn btn-secondary save-btn" style="display: none;" onclick="saveAccount(${
                                    account.id
                                }, ${account.user})">
                                    <i class="fa-solid fa-check"></i>
                                </button>
                                <button class="btn btn-danger delete-btn" onclick="deleteAccount(${
                                    account.id
                                })">
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

function deleteAccount(accountId) {
    if (confirm("Are you sure you want to delete this account?")) {
        $.ajax({
            url: "/api/accounts?account-id=" + accountId,
            method: "DELETE",
            success: function (response) {
                refreshAccountTable();
            },
            error: function (xhr, status, error) {
                console.error(error);
            },
        });
    }
}

function toggleEdit(accountId, userId) {
    var row = $("#account-" + accountId);
    populateUsers(accountId, userId);
    row.find(".editable").toggle();
    row.find("select").toggle();
    row.find("input").toggle();
    row.find(".delete-btn").toggle();
    row.find(".save-btn").toggle();
}

function saveAccount(accountId, userId) {
    var accountData = {
        id: accountId,
        user: $("#edit-user-" + accountId).val(),
        nickname: $("#edit-nickname-" + accountId).val(),
        balance: $("#edit-balance-" + accountId).val(),
    };

    $.ajax({
        url: "/api/accounts",
        method: "PUT",
        contentType: "application/json",
        data: JSON.stringify(accountData),
        success: function (response) {
            refreshAccountTable();
            toggleEdit(accountId, userId);
        },
        error: function (xhr, status, error) {
            console.error(error);
        },
    });
}

function populateUsers(accountId, userId) {
    var row = $("#account-" + accountId);
    var selectField = row.find(".user-select");

    $.ajax({
        url: "/api/users",
        method: "GET",
        dataType: "json",
        success: function (response) {
            var options = "";
            response.data.forEach(function (user) {
                let sel = user.id == userId ? "selected" : "";
                options += `<option value="${user.id}" ${sel}>${user.username}</option>`;
            });
            selectField.html(options);
        },
        error: function (xhr, status, error) {
            console.error(error);
        },
    });
}
