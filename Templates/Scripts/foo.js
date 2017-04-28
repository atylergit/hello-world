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

function doAjaxCall(form) {
    console.log(form);
    var data = JSON.stringify( form.serializeArray() );
    console.log(data);
    // jQuery.post("Ajax/ajaxGateway.php", , function(data){
    //
    // });
}
