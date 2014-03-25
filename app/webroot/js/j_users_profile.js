/**
 * Created with JetBrains PhpStorm.
 * User: adam
 * Date: 3/18/14
 * Time: 4:33 PM
 * To change this template use File | Settings | File Templates.
 */
$( document ).ready(function() {
    alert( "Javascript j_users_profile loaded!" );
});

$('span').click(function() {
   alert("clicked");
});

$('#modify_plants').on('hover', function() {
    $('#new_plants').html('test test tests');
});