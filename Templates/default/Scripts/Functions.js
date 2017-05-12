/**
 * Created on 4/28/2017.
 */
$().ready(function () {
    // // On Load functions
    // toggleSideBar();
    //
    // // Close nav sidebar if clicking outside
    // $('body').click(function (e) {
    //     // This prevents opening when clicking in the page by making sure it's already open
    //     if ($("#mySidenav").hasClass('toggled') === true) {
    //         // Calculate the target and distance, if its outside the div and is not the openNav then toggle
    //         if ($(e.target).closest("#mySidenav").length === 0 && $(e.target).closest("#openNav").length === 0) {
    //             toggleSideBar();
    //         }
    //     }
    // });
    //
    // // Event Listener stuff
    // $('form').submit(function (event) {
    //     event.preventDefault();
    // });
    //
    // $(document).on('click', "#alertClose", function (event) {
    //     console.log('Im here');
    //     $("#alertClose").parent().hide(400);
    // });
    //
    // $("#openNav").click(function () {
    //     toggleSideBar();
    // });

    doAjaxCall = function (form) {
        var array    = jQuery(form).serializeArray();
        var postData = [];
        //Parse the form, this is a bit messy but it gives me what I need so oh well
        postData     = $(array).each(function (name, value) {
            postData = $(value).each(function (name, value) {
                postData[name] = value;
                return postData;
            });

            return postData;
        });


        jQuery.post("Ajax/ajaxGateway.php", postData, function (data) {
            var result    = JSON.parse(data);
            var alertHtml = '<div><span class="close" id="alertClose" aria-label="close">&#215;</span>' + result.friendlyText + '</div>';
            $("#buttonResults > div").hide(400, function () {
                $("#buttonResults > div").removeClass();
                $("#buttonResults").html(alertHtml);
                if (result.status == 'error') {
                    $("#buttonResults > div").addClass('alert alert-danger alert-dismissable');
                    console.log(result);
                } else {
                    $("#buttonResults > div").addClass('alert alert-success alert-dismissable');
                }

                //Here we check to see if the backend wants us to alert the user
                if (typeof result.alert != 'undefined' && 'false' != result.alert) {
                    $("#buttonResults > div").show(400);
                }
            });
            //Share our results with the caller
            return result;
        });
    };

    //toggles the side nav bar
    toggleSideBar = function () {
        $("#mySidenav").toggleClass("toggled");
        $("#openNav").toggleClass("lighten");
    }
});