(function(window){
    $("#crudUsers").on("click", 
        function(e){
            e.preventDefault();

            $('#crudContainer').load('/admin/users', function() {
                $.getScript("/js/admin/users-view.js");
            });
        }
    );
})(window);