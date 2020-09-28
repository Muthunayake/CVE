var pv_table;
$(document).ready(function() {
    initTable();
});

function initTable() {
    pv_table = $("#pv-table").DataTable({
        pageLength: 20,
        autoWidth: false,
        destroy: true,
        scrollX: true,
        lengthMenu: [
            [10, 15, 20],
            [10, 15, 20]
        ],
        dom: "Bfrtip",
        buttons: ["copy", "csv", "excel", "pdf", "print"]
    });
}
