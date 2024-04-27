$('#registerForm').submit(function(event) {
    event.preventDefault();

    var formData = $(this).serializeArray();
    var userData = {};

    // Convert serialized array to object
    $.each(formData, function(index, field) {
        userData[field.name] = field.value;
    });
    
    console.log(userData);

    // Sending data to the PHP script using jQuery
    $.ajax({
        url: '/api/users',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(userData),
        success: function(response) {
            alert(`New user creatred with ID: ${response.id}`);
            console.log(response);
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
        }
    });
});