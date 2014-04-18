e/**
 * Created with JetBrains PhpStorm.
 * User: adam
 * Date: 4/15/14
 * Time: 9:31 AM
 * To change this template use File | Settings | File Templates.
 */

var locationInfo = location.pathname.split("/");
var turnoverGroupId = locationInfo[locationInfo.length-1];


$(document).ready(function() {

    console.log("j_turnovers_add working");
    // When user clicks on the new turnover, new turnover option will slide into view
    $('.add_turnover').click(function() {
        console.log('clicked');
        $('.add_turnover').css("display", "none");
        $('.new_turnover').css('display', 'block');
    });

    $('.delete').click(function() {
        console.log("clicked delete!");
        $(this).parent().hide();
    })
});

