;
window.addEventListener("DOMContentLoaded", function(event) {
    //Date and time picker
    $('#publishedAt').datetimepicker({
        icons: { time: 'far fa-clock' },
        format: 'YYYY-MM-DD HH:mm:ss'
    });

    $('#content').summernote({
        height: 250,   //set editable area's height
        width: 900
    });

    $('[name="display"]').bootstrapSwitch({
        // onText:"啟動",
        // offText:"停止",
        onColor:"success",
        offColor:"danger",
        size:"small"
    });
});
