(function(window){
    $("#addUserBTN").on("click", 
        function(e){
            e.preventDefault();
            $('#formContainer').load('/admin/addUser', function() {
                $.getScript("js/admin/addUser-view.js");
            });
        }
    );
})(window);