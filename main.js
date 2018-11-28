$(document).ready(function(){
    $('#wordpress-installation').submit(function(evt){
        evt.preventDefault();

        $('#response').html('<img src="spinner.gif" class="loading-spinner">');

        var formData = $(this).serialize();
        var url = $(this).attr('action');

        $.post(url, formData, function(result){
            $('#response').html('<div class="alert alert-success" id="success-alert" role="alert">WordPress installed!</div>');
        });
    });
});