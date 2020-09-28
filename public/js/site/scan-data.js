var scan_data_table;

$(document).ready(function() {
    initTable();

    $("#scan_csv").change(function() {
        if ($(this).get(0).files.length > 0) {
            $("#upload-btn").prop("disabled", false);
        } else {
            $("#upload-btn").prop("disabled", true);
        }
    });
});

function initTable() {
    scan_data_table = $("#scan-data").DataTable({
        ajax: {
            url: "/scan_data/all",
            type: "get",
            data: function(d) {},
            complete: function(data) {}
        },
        pageLength: 25,
        autoWidth: false,
        destroy: true,
        scrollX: true,
        lengthMenu: [
            [10, 25, 50, 100, 500, 1000, 10000, 15000],
            [10, 25, 50, 100, 500, 1000, 10000, 15000]
        ],
        columns: [
            {
                data: "ip_address",
                name: "ip_address",
                render: setdata
            },
            {
                data: "host_name_fdqn",
                name: "host_name_fdqn",
                render: setdata
            },
            {
                data: "vuln_name",
                name: "vuln_name",
                render: setdata
            },
            {
                data: "severity",
                name: "severity",
                render: setdata
            },
            {
                data: "protocol",
                name: "protocol",
                render: setdata
            },
            {
                data: "port",
                name: "port",
                render: setdata
            },
            {
                data: "vulnerability",
                name: "vulnerability",
                render: setdata
            },
            {
                data: "solution",
                name: "solution",
                render: setdata
            },
            {
                data: "cvssv3_score",
                name: "cvssv3_score",
                render: setdata
            },
            {
                data: "cve_id",
                name: "cve_id",
                render: setdata
            },
            {
                data: null,
                name: "action",
                className: "action-row",
                render: setActions,
                orderable: false
            }
        ],
        createdRow: function(row, data, dataIndex) {
            $(row).addClass("table-row");
        },
        rowCallback: function(row, data, dataIndex) {
            $(".action-btn", row).unbind("click");

            //actions

            $(".edit", row).bind("click", function() {
                edit(data);
            });

            $(".delete", row).bind("click", function() {
                remove(data.id, row);
            });
        }
    });
}

function setdata(data, type, row, meta) {
    return data ? data : "NOT AVAILABLE";
}

function setActions(data, type, row, meta) {
    view_btn =
        '<button type="button" class="btn btn-primary btn-sm mr-1 action-btn view" title="View">' +
        '<i class="fa fa-eye" aria-hidden="true"></i>' +
        "</button>";

    edit_btn =
        '<button type="button" class="btn btn-warning btn-sm mr-1 action-btn edit" title="Edit">' +
        '<i class="fa fa-pencil" aria-hidden="true"></i>' +
        "</button>";

    remove_btn =
        '<button type="button" class="btn btn-danger btn-sm mr-1 action-btn delete" title="Remove">' +
        '<i class="fa fa-trash" aria-hidden="true"></i>' +
        "</button>";

    return edit_btn + remove_btn;
}
function remove(id, row) {
    $.ajax({
        url: "/scan-data/" + id,
        type: "DELETE",
        dataType: "JSON",
        beforeSend: function() {
            blockUiFullPage();
        },
        success: function(res) {
            scan_data_table
                .row($(row))
                .remove()
                .draw(false);
        },
        error: function(xhr, status, error) {},
        complete: function() {
            unblockFullPage();
        }
    });
}

function edit(data) {
    $("#scan-data-from").attr("action", "/scan-data/" + data.id);

    $.each(Object.keys(data), function(index, value) {
        $("#" + value).val(data[value]);
    });

    $(".sacn-data-modal").modal("show");
}

function closeModal() {
    $(".sacn-data-modal").modal("hide");
}
