var pv_table;
$(document).ready(function() {
    initTable1();
    initTable2();
});

function initTable1() {
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

function initTable2() {
    pv_table = $("#af-table").DataTable({
        pageLength: 10,
        autoWidth: false,
        destroy: true,
        lengthMenu: [
            [10, 15, 20],
            [10, 15, 20]
        ]
    });
}
