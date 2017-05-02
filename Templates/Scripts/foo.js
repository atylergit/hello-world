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
    var array = jQuery(form).serializeArray();
    var json = [];
    jQuery.each(array, function() {
        json[array.name] = array.value || '';
    });
    console.log(json);
    jQuery.post("Ajax/ajaxGateway.php", json[0], function(data){
        var result = JSON.parse(data);
        if (result.status == 'error') {
            $("#buttonResults").html('<div><a href="#" class="close" data-dismiss="alert" aria-label="close">&#215;</a>'+ result.friendlyText +'</div>');
            $("#buttonResults > div").removeClass();
            $("#buttonResults > div").addClass('alert alert-danger alert-dismissable');
            console.log(result);
        } else {
            $("#buttonResults").html('<div><a href="#" class="close" data-dismiss="alert" aria-label="close">&#215;</a>' + result.friendlyText + '</div>');
            $("#buttonResults > div").removeClass();
            $("#buttonResults > div").addClass('alert alert-success alert-dismissable');
        }
    });
}
