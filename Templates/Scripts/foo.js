/**
 * Created on 4/28/2017.
 */

$(document).on('submit', "form", function (event) {
    event.preventDefault();
});

$(".alert a.close").click(function (e) {
    $(this).parent().fadeOut('slow');
});

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
    console.log(postData);
    jQuery.post("Ajax/ajaxGateway.php", postData, function(data){
        var result = JSON.parse(data);
        var alertHtml = '<div style="display: none"><a href="#" class="close" data-dismiss="alert" aria-label="close">&#215;</a>'+ result.friendlyText +'</div>'
        if (result.status == 'error') {
            $("#buttonResults").html(alertHtml);
            $("#buttonResults > div").removeClass();
            $("#buttonResults > div").addClass('alert alert-danger alert-dismissable fade in');
            $("#buttonResults > div").show();
            console.log(result);
        } else if(result.alert !== 'undefined') {
            $("#buttonResults").html(alertHtml);
            $("#buttonResults > div").removeClass();
            $("#buttonResults > div").addClass('alert alert-success alert-dismissable fade in');
            $("#buttonResults > div").show();
            console.log(result.data);
        }
    });
}
