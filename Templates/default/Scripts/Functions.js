/**
 * Created on 4/28/2017.
 */
$().ready(function () {

    doAjaxCall = function (postData) {
        $.post("Ajax/ajaxGateway.php", postData, function (data) {
                parseResults(data);
            });
    };

    doAjaxCallSynchronus = function (postData) {
        var response = null;
        $.ajax({url: 'Ajax/ajaxGateway.php', type: 'POST', async: false, data: postData, success: function (data) {
                response = parseResults(data);
            }
        });
        return response;
    };

    //toggles the side nav bar
    toggleSideBar = function () {
        $("#mySidenav").toggleClass("toggled");
        $("#openNav").toggleClass("lighten");
    };

    showAjaxAlerts = function (result) {
        var alertHtml = '<div><span class="close" id="alertClose" aria-label="close">&#215;</span>' + result.friendlyText + '</div>';
        $("#buttonResults > div").hide(400, function () {
            $("#buttonResults > div").removeClass();
            $("#buttonResults").html(alertHtml);
            if (result.status == 'success') {
                $("#buttonResults > div").addClass('alert alert-success alert-dismissable');
            } else {
                $("#buttonResults > div").addClass('alert alert-danger alert-dismissable');
                $("#buttonResults > div").show(400);
                console.log(result);
                console.log(result.message);
            }

            //Here we check to see if the backend wants us to alert the user
            if (typeof result.alert != 'undefined') {
                if ('false' != result.alert) {
                    $("#buttonResults > div").show(400);
                }
            }
        });
    };

    parseResults = function (data) {
        // Handles issues with json structure, if we don't get json back we get a friendly message and some info in the console
        try {
            var result = JSON.parse(data);
            showAjaxAlerts(result);
            return result;
        } catch (e) {
            result = {};
            result.friendlyText = 'There was an error please contact the site administrator!';
            result.status = 'error';
            result.message = data;
            showAjaxAlerts(result);
        }
    };

    simpleAjaxSubmitter = function (form) {
        var values = {};
        $.each($(form).serializeArray(), function (i, field) {
            values[field.name] = field.value;
        });
        doAjaxCall(values);
    }
});