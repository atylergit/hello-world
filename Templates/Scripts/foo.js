/**
 * Created on 4/28/2017.
 */

$(document).on('submit', "form", function (event) {
    event.preventDefault();
});

$(document).on('click', "#alertClose", function (event) {
    event.preventDefault();
    $("#alertClose").parent().hide(400);
});

function closeTheThing () {
    console.log('its in the function');
    $("#alertClose").parent().hide(400).delay(400);
    console.log('it didint bail...');
}

function doAjaxCall(form) {
    var array = jQuery(form).serializeArray();
    var postData = [];
    postData = $(array).each(function(name, value) {
        postData = $(value).each(function (name, value) {
           postData[name] = value;
           return postData;
        });

        return postData;
    });

    jQuery.post("Ajax/ajaxGateway.php", postData, function(data){
        closeTheThing();
        var result = JSON.parse(data);
        var alertHtml = '<div style="display: none"><a href="#" class="close" id="alertClose" aria-label="close">&#215;</a>'+ result.friendlyText +'</div>';
        $("#buttonResults > div").removeClass();
        $("#buttonResults").html(alertHtml);

        if (result.status == 'error') {
            $("#buttonResults > div").addClass('alert alert-danger alert-dismissable');
            console.log(result);
        } else {
            $("#buttonResults > div").addClass('alert alert-success alert-dismissable');
        }
        $("#buttonResults > div").show(400);
    });
}