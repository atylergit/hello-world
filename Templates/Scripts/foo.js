/**
 * Created on 4/28/2017.
 */
//
// $(document).on('click', "#DoSomethingButton", function () {
//     jQuery.post("Ajax/ajaxGateway.php", {command:'DoSomething'}, function(data){
//         var result = JSON.parse(data);
//         $("#buttonResults").html('<div><a href="#" class="close" data-dismiss="alert" aria-label="close">&#215;</a>' + result.friendlyText + '</div>');
//         $("#buttonResults > div").removeClass();
//         $("#buttonResults > div").addClass('alert alert-success alert-dismissable');
//     });
// });
//
// $(document).on('click', "#TriggerErrorButton", function () {
//     jQuery.post("Ajax/ajaxGateway.php", {command:'triggerError'}, function(data){
//         var result = JSON.parse(data);
//         $("#buttonResults").html('<div><a href="#" class="close" data-dismiss="alert" aria-label="close">&#215;</a>'+ result.friendlyText +'</div>');
//         $("#buttonResults > div").removeClass();
//         $("#buttonResults > div").addClass('alert alert-danger alert-dismissable');
//     });
// });
$(document).on('submit', "form", function (event) {
    event.preventDefault();
});

function doAjaxCall(form) {
    // console.log(form);
    var array = jQuery(form).serializeArray();
    var postData = [];
    // console.log(array);
    postData = $(array).each(function(name, value) {
        postData = jQuery.each(value, function (name, value) {
           postData[name] = value;
           return postData;
        });

        return postData;
    });
    // console.log(postData);
    jQuery.post("Ajax/ajaxGateway.php", postData, function(data){
        var result = JSON.parse(data);
        if (result.status == 'error') {
            $("#buttonResults").html('<div><a href="#" class="close" data-dismiss="alert" aria-label="close">&#215;</a>'+ result.friendlyText +'</div>');
            $("#buttonResults > div").removeClass();
            $("#buttonResults > div").addClass('alert alert-danger alert-dismissable');
            // console.log(result);
        } else {
            $("#buttonResults").html('<div><a href="#" class="close" data-dismiss="alert" aria-label="close">&#215;</a>' + result.friendlyText + '</div>');
            $("#buttonResults > div").removeClass();
            $("#buttonResults > div").addClass('alert alert-success alert-dismissable');
        }
    });
}
