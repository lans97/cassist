$(document).ready(function () {
    refreshMovementTable();

    $.ajax({
        url: "/api/accounts",
        method: "GET",
        dataType: "json",
        success: function (response) {
            let select = $("#account");
            response.data.forEach((account) => {
                select.append(
                    new Option(
                        `${account.user} - ${account.nickname}`,
                        `${account.id}`
                    )
                );
            });
        },
        error: function (xhr, status, error) {
            console.error(error);
        },
    });

    $.ajax({
        url: "/api/categories",
        method: "GET",
        dataType: "json",
        success: function (response) {
            let select = $("#category");
            response.data.forEach((category) => {
                select.append(
                    new Option(
                        `${category.user} - ${category.name}`,
                        `${category.id}`
                    )
                );
            });
        },
        error: function (xhr, status, error) {
            console.error(error);
        },
    });

    $("#addMovementForm").submit(function (e) {
        e.preventDefault();
        var form = $(this)[0];
        var isValid = true;

        // validation

        if (!isValid) {
            e.preventDefault();
            e.stopPropagation();
        } else {
            movementData = {
                account: $("#account").val(),
                category: $("#category").val(),
                info: $("#information").val(),
                ammount: $("#ammount").val(),
            };
            
            console.log(movementData);

            $.ajax({
                url: "/api/movements",
                type: "POST",
                contentType: "application/json",
                data: JSON.stringify(movementData),
                dataType: "json",
                success: function (response) {
                    alert("New movement registered");
                    refreshMovementTable();
                },
                error: function (xhr, status, error) {
                    console.error(xhr);
                    console.error(status);
                    console.error(error);
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

function refreshMovementTable() {
    $.ajax({
        url: "/api/movements",
        method: "GET",
        dataType: "json",
        success: function (response) {
            $("#movementsTable tbody").html(
                $.map(response.data, function (movement) {
                    return `
                        <tr id="movement-${movement.id}">
                            <td>${movement.id}</td>
                            <td>
                                <span class="editable" data-field="account">${
                                    movement.account
                                }</span>
                                <select class="form-select account-select" id="edit-account-${
                                    movement.id
                                }" style="display: none;">
                                </select>
                            </td>
                            <td>
                                <span class="editable" data-field="category">${
                                    movement.category
                                }</span>
                                <select class="form-select category-select" id="edit-category-${
                                    movement.id
                                }" style="display: none;">
                                </select>
                            </td>
                            <td>
                                <span class="editable" data-field="info">${
                                    movement.info
                                }</span>
                                <textarea class="form-control" cols="30" rows="10" id="edit-info-${
                                    movement.id
                                }"  style="display: none;">${movement.info}</textarea>
                            </td>
                            <td>
                                <span class="editable" data-field="ammount">
                                    \$${parseFloat(
                                        movement.ammount
                                    ).toLocaleString()}
                                </span>
                                <input type="number" min="0" step="0.01" class="form-control" id="edit-ammount-${
                                    movement.id
                                }"  style="display: none;" value="${movement.ammount}"}>
                            </td>
                            <td>${movement.created_at}</td>
                            <td>${movement.updated_at}</td>
                            <td>
                                <button class="btn btn-secondary edit-btn" onclick="toggleEdit(${
                                    movement.id
                                }, ${movement.account}, ${movement.category})">
                                    <i class="fa-solid fa-pencil"></i>
                                </button>
                                <button class="btn btn-secondary save-btn" style="display: none;" onclick="saveMovement(${
                                    movement.id
                                }, ${movement.account}, ${movement.category})">
                                    <i class="fa-solid fa-check"></i>
                                </button>
                                <button class="btn btn-danger delete-btn" onclick="deleteMovement(${
                                    movement.id
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

function deleteMovement(movementId) {
    if (confirm("Are you sure you want to delete this user?")) {
        $.ajax({
            url: "/api/movements?movement-id=" + movementId,
            method: "DELETE",
            success: function (response) {
                refreshMovementTable();
            },
            error: function (xhr, status, error) {
                console.error(error);
            },
        });
    }
}

function toggleEdit(movementId, accountId, categoryId) {
    var row = $("#movement-" + movementId);
    populateAccounts(movementId, accountId);
    populateCategories(movementId, categoryId);
    row.find(".editable").toggle();
    row.find("input").toggle();
    row.find("select").toggle();
    row.find("textarea").toggle();
    row.find(".delete-btn").toggle();
    row.find(".save-btn").toggle();
}

function saveMovement(movementId, accountId, categoryId) {
    var movementData = {
        id: movementId,
        account: $("#edit-account-" + movementId).val(),
        category: $("#edit-category-" + movementId).val(),
        info: $("#edit-info-" + movementId).val(),
        ammount: $("#edit-ammount-" + movementId).val(),
    };

    $.ajax({
        url: "/api/movements",
        method: "PUT",
        contentType: "application/json",
        data: JSON.stringify(movementData),
        success: function (response) {
            console.log(response);
            refreshMovementTable();
            toggleEdit(movementId, accountId, categoryId);
        },
        error: function (xhr, status, error) {
            console.error(error);
        },
    });
}

function populateAccounts(movementId, accountId) {
    var row = $("#movement-" + movementId);
    var selectField = row.find(".account-select");

    $.ajax({
        url: "/api/accounts",
        method: "GET",
        dataType: "json",
        success: function (response) {
            var options = "";
            response.data.forEach(function (account) {
                let sel = account.id == accountId ? "selected" : "";
                options += `<option value="${account.id}" ${sel}>${account.user} - ${account.nickname}</option>`;
            });
            selectField.html(options);
        },
        error: function (xhr, status, error) {
            console.error(error);
        },
    });
}

function populateCategories(movementId, categoryId) {
    var row = $("#movement-" + movementId);
    var selectField = row.find(".category-select");

    $.ajax({
        url: "/api/categories",
        method: "GET",
        dataType: "json",
        success: function (response) {
            var options = "";
            response.data.forEach(function (category) {
                let sel = category.id == categoryId ? "selected" : "";
                options += `<option value="${category.id}" ${sel}>${category.user} - ${category.name}</option>`;
            });
            selectField.html(options);
        },
        error: function (xhr, status, error) {
            console.error(error);
        },
    });
}