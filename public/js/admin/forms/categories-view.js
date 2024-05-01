$(document).ready(function () {
    refreshCategoryTable();

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

    $("#addCategoryForm").submit(function (e) {
        e.preventDefault();
        var form = $(this)[0];
        var isValid = true;

        // validation

        if (!isValid) {
            e.preventDefault();
            e.stopPropagation();
        } else {
            categoryData = {
                name: $("#name").val(),
                color: parseInt(
                    $("#color")
                        .val()
                        .replace("#", ""),
                    16
                ),
                user: $("#user").val(),
            };

            $.ajax({
                url: "/api/categories",
                type: "POST",
                contentType: "application/json",
                data: JSON.stringify(categoryData),
                dataType: "json",
                success: function (response) {
                    alert("New category registered");
                    refreshCategoryTable();
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

function refreshCategoryTable() {
    $.ajax({
        url: "/api/categories",
        method: "GET",
        dataType: "json",
        success: function (response) {
            $("#categoriesTable tbody").html(
                $.map(response.data, function (category) {
                    let colorHex = "#" + parseInt(category.color).toString(16);
                    return `
                        <tr id="category-${category.id}">
                            <td>${category.id}</td>
                            <td>
                                <span class="editable" data-field="name">${category.name}</span>
                                <input type="text" class="form-control" id="edit-name-${category.id}" style="display: none;" value="${category.name}">
                            </td>
                            <td>
                                <div class="editable" style="width: 20px; height: 20px; border: 1px; display: inline-block; background-color: ${colorHex}"></div>
                                <span class="editable" data-field="color">${colorHex}</span>
                                <input type="color" class="form-control form-control-color" id="edit-color-${category.id}"  style="display: none;" value="${colorHex}">
                            </td>
                            <td>
                                <span class="editable" data-field="user">${
                                    category.user
                                }</span>
                                <select class="form-select user-select" id="edit-user-${
                                    category.id
                                }" style="display: none;">
                                </select>
                            </td>
                            <td>
                                <button class="btn btn-secondary edit-btn" onclick="toggleEdit(${category.id}, ${category.user})">
                                    <i class="fa-solid fa-pencil"></i>
                                </button>
                                <button class="btn btn-secondary save-btn" style="display: none;" onclick="saveCategory(${category.id}, ${category.user})">
                                    <i class="fa-solid fa-check"></i>
                                </button>
                                <button class="btn btn-danger delete-btn" onclick="deleteCategory(${category.id})">
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

function deleteCategory(categoryId) {
    if (confirm("Are you sure you want to delete this category?")) {
        $.ajax({
            url: "/api/categories?category-id=" + categoryId,
            method: "DELETE",
            success: function (response) {
                refreshCategoryTable();
            },
            error: function (xhr, status, error) {
                console.error(error);
            },
        });
    }
}

function toggleEdit(categoryId, userId) {
    var row = $("#category-" + categoryId);
    populateUsers(categoryId, userId);
    row.find(".editable").toggle();
    row.find("input").toggle();
    row.find("select").toggle();
    row.find(".delete-btn").toggle();
    row.find(".save-btn").toggle();
}

function saveCategory(categoryId, userId) {
    var categoryData = {
        id: categoryId,
        name: $("#edit-name-" + categoryId).val(),
        color: parseInt(
            $("#edit-color-" + categoryId)
                .val()
                .replace("#", ""),
            16
        ),
        user: $("#edit-user-" + categoryId).val()
    };

    $.ajax({
        url: "/api/categories",
        method: "PUT",
        contentType: "application/json",
        data: JSON.stringify(categoryData),
        success: function (response) {
            console.log(response);
            refreshCategoryTable();
            toggleEdit(categoryId, userId);
        },
        error: function (xhr, status, error) {
            console.error(error);
        },
    });
}

function populateUsers(categoryId, userId) {
    var row = $("#category-" + categoryId);
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
