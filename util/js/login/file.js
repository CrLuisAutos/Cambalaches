jQuery(document).ready(function($) {
    $("#signIn").submit(function(event) {
        if ($.trim(($("#form-username").val())) == "" || ($.trim($("#form-password").val())) == "") {
            $("#error").text(gouigo);
            return false;
        } else {
            return true;
        }
    });
});