/**
 * Created on 4/28/2017.
 */

$(document).on('click', "#DoSomethingButton", function () {
    jQuery.post("Ajax/ajaxGateway.php", {command:'DoSomething'}, function(data){
        var result = JSON.parse(data);
        $("#buttonResults").html('<div>' + result.friendlyText + '<a href="#" class="close" data-dismiss="alert" aria-label="close">X</a></div>');
        $("#buttonResults").child().removeClass();
        $("#buttonResults").child().addClass('alert alert-success alert-dismissable');
    });
});

$(document).on('click', "#TriggerErrorButton", function () {
    jQuery.post("Ajax/ajaxGateway.php", {command:'triggerError'}, function(data){
        var result = JSON.parse(data);
        $("#buttonResults").html('<div>' + result.friendlyText + '<a href="#" class="close" data-dismiss="alert" aria-label="close">X</a></div>');
        $("#buttonResults").child().removeClass();
        $("#buttonResults").child().addClass('alert alert-danger alert-dismissable');
    });
});