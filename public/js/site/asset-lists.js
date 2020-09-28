var asset_list_table;

$(document).ready(function() {
    initTable();

    $("#select-all").change(function() {
        $(".row-checkbox").prop("checked", $(this).is(":checked"));
    });
});

function initTable() {
    asset_list_table = $("#asset-list").DataTable({
        ajax: {
            url: "/asset-lists/all",
            type: "get",
            data: function(d) {},
            complete: function(data) {}
        },
        pageLength: 25,
        autoWidth: false,
        destroy: true,
        scrollX: true,
        lengthMenu: [
            [10, 25, 50, 100, 500],
            [10, 25, 50, 100, 500]
        ],
        columns: [
            {
                orderable: false,
                data: "id",
                name: "id",
                render: setCheckbox
            },
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
                data: "criticality",
                name: "criticality",
                render: setCriticality
            },
            {
                data: "exposure",
                name: "exposure",
                render: setExposure
            }
        ],
        createdRow: function(row, data, dataIndex) {
            // $(row).addClass("table-row");
        },
        rowCallback: function(row, data, dataIndex) {
            // $(".action-btn", row).unbind("click");
            // //actions
            // $(".edit", row).bind("click", function() {
            //     edit(data);
            // });
        }
    });
}

function setdata(data, type, row, meta) {
    return data ? data : "NOT AVAILABLE";
}

function setCheckbox(data, type, row, meta) {
    return (
        "<input class='row-checkbox' style='margin-left: 8px;' type='checkbox' value=" +
        data +
        " name='ids[]'>"
    );
}

function setCriticality(data, type, row, meta) {
    var high = "";
    var medium = "";
    var low = "";

    if (data == "High") {
        high = "selected";
    } else if (data == "Medium") {
        medium = "selected";
    } else if (data == "Low") {
        low = "selected";
    }

    return (
        '<select id="criticality-' +
        row.id +
        '" name="criticality-' +
        row.id +
        '">' +
        '<option value="">none</option>' +
        "<option " +
        high +
        ' value="High">High</option>' +
        "<option " +
        medium +
        ' value="Medium">Medium</option>' +
        "<option " +
        low +
        ' value="Low">Low</option>' +
        "</select>"
    );
}

function setExposure(data, type, row, meta) {
    var high = "";
    var medium = "";
    var low = "";

    if (data == "High") {
        high = "selected";
    } else if (data == "Medium") {
        medium = "selected";
    } else if (data == "Low") {
        low = "selected";
    }

    return (
        '<select id="exposure-' +
        row.id +
        '" name="exposure-' +
        row.id +
        '">' +
        '<option value="">none</option>' +
        "<option " +
        high +
        ' value="High">High</option>' +
        "<option " +
        medium +
        ' value="Medium">Medium</option>' +
        "<option " +
        low +
        ' value="Low">Low</option>' +
        "</select>"
    );
}

function criticality(criticality) {
    $(".row-checkbox").each(function() {
        if (this.checked) {
            $("#criticality-" + $(this).val()).val(criticality);
        }
    });
}

function exposure(exposure) {
    $(".row-checkbox").each(function() {
        if (this.checked) {
            $("#exposure-" + $(this).val()).val(exposure);
        }
    });
}

function update() {
    var data = [];
    $(".row-checkbox").each(function() {
        if (this.checked) {
            var temp = {
                id: $(this).val(),
                criticality: $("#criticality-" + $(this).val()).val(),
                exposure: $("#exposure-" + $(this).val()).val()
            };
            data.push(temp);
        }
    });

    if (data.length == 0) return false;

    $("#data").val(JSON.stringify(data));
    $("#asset-list-form").submit();
}
