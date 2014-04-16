/**
 * Created with JetBrains PhpStorm.
 * User: adam
 * Date: 4/16/14
 * Time: 11:51 AM
 * To change this template use File | Settings | File Templates.
 */


$(document).ready(function() {

    $('#add_plant, #add_business_unit').click(function(){
        console.log("success");
        $('#add_plant, #add_business_unit').css("display", "none");
        $('#new_plant, #new_business_unit').css('display', 'block');
    });

    $('#hide').click(function() {
        console.log("hidden");
        $('#add_plant, #add_business_unit').css("display", "block");
        $('#new_plant, #new_business_unit').css("display", "none");
    })
});