
$(document).ready(function() {

    console.log("ready");

    $('#company_validate').change(function() {
        console.log('company selected');

        var company = $('#company_validate').val();

        $.ajax({
            type: 'POST',

            url: '/users/validate_user/'+company+'/',
            success: function(response) {
                data = $.parseJSON(response);

                // Generate the new refinery entry
                var $entry = '<div class = "input select">';
                $entry = $entry+'<label for = "refinery_validate">Refinery</label>';
                $entry = $entry+'<select name="data[User][refinery_id]" id = "refinery_validate">';
                $entry = $entry+'<option value>(select refinery)</option>';

                jQuery.each(data,function(i, val){
                    $entry = $entry+'<option value = '+val["Refinery"]["id"]+'>'+val["Refinery"]["name"]+'</option>';
                });
                $entry = $entry + '</select>';

                $('#refinery_select').html($entry);
            },
            data: {
                name: $('#company_validate').val()
            }
        }); // end ajax setup

    });

});