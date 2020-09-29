var pv_table;
$(document).ready(function() {
    initTable1();
    initTable2();
});

function initTable1() {
    $("#pv-table").DataTable({
        pageLength: 10,
        autoWidth: false,
        destroy: true,
        scrollX: true,
        lengthMenu: [
            [10, 15, 20],
            [10, 15, 20]
        ],
        dom: "Bfrtip",
        buttons: ["copy", "csv", "excel", "pdf", "print"],
        order: [[6, "desc"]]
    });
}

function initTable2() {
    $("#af-table").DataTable({
        pageLength: 10,
        autoWidth: false,
        destroy: true,
        scrollX: true,
        lengthMenu: [
            [10, 15, 20],
            [10, 15, 20]
        ],
        order: [[0, "asc"]]
    });
}
