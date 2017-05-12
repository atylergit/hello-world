$().ready(function () {
    // On Load functions
    toggleSideBar();

    // Close nav sidebar if clicking outside
    $('body').click(function (e) {
        // This prevents opening when clicking in the page by making sure it's already open
        if ($("#mySidenav").hasClass('toggled') === true) {
            // Calculate the target and distance, if its outside the div and is not the openNav then toggle
            if ($(e.target).closest("#mySidenav").length === 0 && $(e.target).closest("#openNav").length === 0) {
                toggleSideBar();
            }
        }
    });

    // Event Listener stuff
    $('form').submit(function (event) {
        event.preventDefault();
    });

    $(document).on('click', "#alertClose", function (event) {
        console.log('Im here');
        $("#alertClose").parent().hide(400);
    });

    $("#openNav").click(function () {
        toggleSideBar();
    });
});