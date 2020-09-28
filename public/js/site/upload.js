$(document).ready(function() {
    $("#zero_day_csv").change(function() {
        if ($(this).get(0).files.length > 0) {
            $("#upload-btn-1").prop("disabled", false);
        } else {
            $("#upload-btn-1").prop("disabled", true);
        }
    });
    $("#active_exp_csv").change(function() {
        if ($(this).get(0).files.length > 0) {
            $("#upload-btn-2").prop("disabled", false);
        } else {
            $("#upload-btn-2").prop("disabled", true);
        }
    });
});
