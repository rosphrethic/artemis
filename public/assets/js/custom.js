setTimeout(() => {
    $(".loader_bg").fadeToggle();
}, 1000);

$(document).ready(function() {
    $("#datatable").DataTable();
});
