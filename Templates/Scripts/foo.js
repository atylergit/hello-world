/**
 * Created on 4/28/2017.
 */

$(document).on('click', "#DoSomethingButton", function () {
    jQuery.post("Ajax/ajaxGateway.php", {command:'DoSomething'}, function(data){
        var result = JSON.parse(data);
        $("#buttonResults").html('</br><p>'+ result.friendlyText +'</p>');
    });
});

$(document).on('click', "#TriggerErrorButton", function () {
    jQuery.post("Ajax/ajaxGateway.php", {command:'triggerError'}, function(data){
        var result = JSON.parse(data);
        $("#buttonResults").html('</br><p>'+ result.friendlyText +'</p>');
    });
});