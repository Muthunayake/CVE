var cve_table;

$(document).ready(function() {
    initTable();

    $("#cve_csv").change(function() {
        if ($(this).get(0).files.length > 0) {
            $("#upload-btn").prop("disabled", false);
        } else {
            $("#upload-btn").prop("disabled", true);
        }
    });
});

function initTable() {
    cve_table = $("#cve").DataTable({
        ajax: {
            url: "/cve/all",
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
                data: "severity_v2",
                name: "severity_v2",
                render: setdata
            },
            {
                data: "severity_v3",
                name: "severity_v3",
                render: setdata
            },
            {
                data: "type",
                name: "type",
                render: setdata
            },
            {
                data: "title",
                name: "title",
                render: setdata
            },
            {
                data: "cve",
                name: "cve",
                render: setdata
            },
            {
                data: "cvss_v2",
                name: "cvss_v2",
                render: setdata
            },
            {
                data: "cvss_v3",
                name: "cvss_v3",
                render: setdata
            },
            {
                data: "cwe_id",
                name: "cwe_id",
                render: setdata
            },
            {
                data: "cwe_label",
                name: "cwe_label",
                render: setdata
            },
            {
                data: "affected_vendors",
                name: "affected_vendors",
                render: setdata
            },
            {
                data: "affected_cpes",
                name: "affected_cpes",
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
        url: "/cve/" + id,
        type: "DELETE",
        dataType: "JSON",
        beforeSend: function() {
            blockUiFullPage();
        },
        success: function(res) {
            cve_table
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
    $("#cve-from").attr("action", "/cve/" + data.id);

    $.each(Object.keys(data), function(index, value) {
        $("#" + value).val(data[value]);
    });

    $(".cve-modal").modal("show");
}

function closeModal() {
    $(".cve-modal").modal("hide");
}
