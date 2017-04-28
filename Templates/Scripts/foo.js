/**
 * Created on 4/28/2017.
 */

$(document).on('click', "#DoSomethingButton", function () {
    jQuery.post("/Ajax/ajaxGateway.php", {command:'DoSomething'}, function(data){
        console.log(data);
    });
});