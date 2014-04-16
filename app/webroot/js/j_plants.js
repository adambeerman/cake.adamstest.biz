/**
 * Created with JetBrains PhpStorm.
 * User: adam
 * Date: 4/16/14
 * Time: 11:51 AM
 * To change this template use File | Settings | File Templates.
 */


$(document).ready(function() {

    $('#add_plant').click(function(){
        console.log("success");
        $('#add_plant').css("display", "none");
        $('#new_plant').css('display', 'block');
    });

    $('#hide').click(function() {
        console.log("hidden");
        $('#add_plant').css("display", "block");
        $('#new_plant').css("display", "none");
    })
});