$(document).ready(function () {
    $.ajax({
        url: "/api/movements",
        method: "GET",
        data: {
            "user-id": $("#user-id").val(),
        },
        dataType: "json",
        success: function (response) {
            response.data.forEach((movement) => {
                populateCard(movement.account, movement);
            });
        },
        error: function (xhr, status, error) {
            console.error(error);
        },
    });

    $.ajax({
        url: "/api/accounts",
        method: "GET",
        data: {
            "user-id": $("#user-id").val(),
        },
        dataType: "json",
        success: function (response) {
            let select = $("#account");
            response.data.forEach((account) => {
                select.append(
                    new Option(`${account.nickname}`, `${account.id}`)
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
        data: {
            "user-id": $("#user-id").val(),
        },
        dataType: "json",
        success: function (response) {
            let select = $("#category");
            response.data.forEach((category) => {
                let colorHex =
                    "#" +
                    parseInt(category.color).toString(16).padStart(6, "0");
                let fgColor = 16777215 - category.color;
                let fgColorHex = "#" + fgColor.toString(16).padStart(6, "0");
                let newOpt = $("<option></option>");
                newOpt.text(`${category.name}`);
                newOpt.val(`${category.id}`);
                newOpt.css({
                    color: fgColorHex,
                    "background-color": colorHex,
                });
                select.append(newOpt);
            });
        },
        error: function (xhr, status, error) {
            console.error(error);
        },
    });

    $("#addMovementForm").submit((e) => {
        e.preventDefault();
        var isValid = true;

        if ($("#account").val() === null) {
            setErrorFor($("#account"), "Please select an account");
        } else {
            setSuccessFor($("#account"));
        }

        if ($("#category").val() === null) {
            setErrorFor($("#category"), "Please select a category");
        } else {
            setSuccessFor($("#category"));
        }

        if ($("#ammount").val() === "") {
            setErrorFor($("#ammount"), "Please enter an ammount");
        } else if ($("#ammount").val() === "0") {
            setErrorFor($("#ammount"), "Ammount can't be 0");
        } else {
            setSuccessFor($("#ammount"));
        }

        if ($("#movement_sign").val() === null) {
            setErrorFor($("#movement_sign"), "Please select a option");
        } else {
            setSuccessFor($("#movement_sign"));
        }
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

function setCardBorderColor(categoryId, card) {
    $.ajax({
        url: "/api/categories?category-id=" + categoryId,
        method: "GET",
        dataType: "json",
        success: function (response) {
            // Assuming response contains category data including color
            let colorHex = "#" + parseInt(response.data.color).toString(16);
            // Set card border color
            card.css("border-color", colorHex);
        },
        error: function (xhr, status, error) {
            console.error("Error fetching category information:", error);
        },
    });
}

function populateCard(accountId, movement) {
    $.ajax({
        url: '/api/accounts?account-id=' + accountId,
        dataType: "json",
        method: 'GET',
        success: function(response) {
            var accountName = response.data.nickname;

            var card = $('<div class="card mb-3 style="border-color"></div>');

            // Create card body
            var cardBody = $('<div class="card-body"></div>');

            // Add movement details to the card body
            cardBody.append('<h5 class="card-title">' + accountName + '</h5>');
            cardBody.append('<p class="card-text">Description: ' + movement.info + '</p>');
            cardBody.append('<p class="card-text">Amount: ' + movement.ammount + '</p>');
            cardBody.append('<p class="card-text">Date: ' + movement.created_at + '</p>');

            // Append card body to the card
            card.append(cardBody);

            // Append the card to the main container
            $('#mainContainer').append(card);

            // Set card border color based on category ID
            setCardBorderColor(movement.category, card);
        },
        error: function(xhr, status, error) {
            console.error('Error fetching account information:', error);
        }
    });
}