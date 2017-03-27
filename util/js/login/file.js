jQuery(document).ready(function($) {
    $("#signIn").submit(function(event) {
        if (($("#form-username").val()) == "" || ($("#form-password").val()) == "") {
            $("#danger").css({
                'visibility': 'visible',
            });
            return false;
        }
        else{
        	$("#danger").css({
                'visibility': 'hidden',
            });
        	return true;
        }
    });
});