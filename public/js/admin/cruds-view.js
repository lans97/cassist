(function(window){
    $("#crudUsers").on("click", 
        function(e){
            e.preventDefault();
            $('#crudContainer').load('/admin/users', function() {
                $.getScript("/js/admin/forms/users-view.js");
            });
        }
    );

    $("#crudAccounts").on("click", 
        function(e){
            e.preventDefault();
            $('#crudContainer').load('/admin/accounts', function() {
                $.getScript("/js/admin/forms/accounts-view.js");
            });
        }
    );

    $("#crudCategories").on("click", 
        function(e){
            e.preventDefault();
            $('#crudContainer').load('/admin/categories', function() {
                $.getScript("/js/admin/forms/categories-view.js");
            });
        }
    );

    $("#crudMovements").on("click", 
        function(e){
            e.preventDefault();
            $('#crudContainer').load('/admin/movements', function() {
                $.getScript("/js/admin/forms/movements-view.js");
            });
        }
    );
})(window);