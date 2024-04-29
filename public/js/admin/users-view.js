(function(window){
    $("#addUser").on("click", 
        function(e){
            e.preventDefault();
            $('#addUserContainer').load('/admin/addUser', function() {
                console.log('click');
                $.getScript("/js/admin/forms/addUser.js");
            });
        }
    );
})(window);