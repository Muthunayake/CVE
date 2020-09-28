var current_control_table;

$(document).ready(function() {
    initTable();

    $("#select-all").change(function() {
        $(".row-checkbox").prop("checked", $(this).is(":checked"));
    });
});

function initTable() {
    current_control_table = $("#current-control").DataTable({
        ajax: {
            url: "/current-control/all",
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
                data: "cve_id",
                name: "cve_id",
                render: setdata
            },
            {
                data: "ips_signature",
                name: "ips",
                render: setIPS,
                orderable: false
            },
            {
                data: "edr_prevention",
                name: "edr",
                render: setEDR,
                orderable: false
            },
            {
                data: "xdr_prevention",
                name: "xdr",
                render: setXDR,
                orderable: false
            },
            {
                data: "sandbox_prevention",
                name: "sandbox",
                render: setSandbox,
                orderable: false
            },
            {
                data: "anti_malware_prevention",
                name: "antimalware",
                render: setAntiMalware,
                orderable: false
            },
            {
                data: "multi_factor_authentication",
                name: "authentication",
                render: setAuthentication,
                orderable: false
            },
            {
                data: "virtual_patching",
                name: "virtualpatching",
                render: setVirtualPatching,
                orderable: false
            },
            {
                data: "zero_day_prevention",
                name: "zeroday",
                render: setZeroDay,
                orderable: false
            },
            {
                data: "exploit_prevention",
                name: "exploit",
                render: setExploit,
                orderable: false
            },
            {
                data: "other",
                name: "other",
                render: setOther,
                orderable: false
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

function setIPS(data, type, row, meta) {
    var yes = "";
    var no = "";

    if (data == "Yes") {
        yes = "selected";
    } else if (data == "No") {
        no = "selected";
    }

    return (
        '<select id="ips-' +
        row.id +
        '" name="ips-' +
        row.id +
        '">' +
        '<option value="">none</option>' +
        "<option " +
        yes +
        ' value="Yes">Yes</option>' +
        "<option " +
        no +
        ' value="No">No</option>' +
        "</select>"
    );
}

function setEDR(data, type, row, meta) {
    var yes = "";
    var no = "";

    if (data == "Yes") {
        yes = "selected";
    } else if (data == "No") {
        no = "selected";
    }

    return (
        '<select id="edr-' +
        row.id +
        '" name="edr-' +
        row.id +
        '">' +
        '<option value="">none</option>' +
        "<option " +
        yes +
        ' value="Yes">Yes</option>' +
        "<option " +
        no +
        ' value="No">No</option>' +
        "</select>"
    );
}

function setXDR(data, type, row, meta) {
    var yes = "";
    var no = "";

    if (data == "Yes") {
        yes = "selected";
    } else if (data == "No") {
        no = "selected";
    }

    return (
        '<select id="xdr-' +
        row.id +
        '" name="xdr-' +
        row.id +
        '">' +
        '<option value="">none</option>' +
        "<option " +
        yes +
        ' value="Yes">Yes</option>' +
        "<option " +
        no +
        ' value="No">No</option>' +
        "</select>"
    );
}

function setSandbox(data, type, row, meta) {
    var yes = "";
    var no = "";

    if (data == "Yes") {
        yes = "selected";
    } else if (data == "No") {
        no = "selected";
    }

    return (
        '<select id="sandbox-' +
        row.id +
        '" name="sandbox-' +
        row.id +
        '">' +
        '<option value="">none</option>' +
        "<option " +
        yes +
        ' value="Yes">Yes</option>' +
        "<option " +
        no +
        ' value="No">No</option>' +
        "</select>"
    );
}

function setAntiMalware(data, type, row, meta) {
    var yes = "";
    var no = "";

    if (data == "Yes") {
        yes = "selected";
    } else if (data == "No") {
        no = "selected";
    }

    return (
        '<select id="antimalware-' +
        row.id +
        '" name="antimalware-' +
        row.id +
        '">' +
        '<option value="">none</option>' +
        "<option " +
        yes +
        ' value="Yes">Yes</option>' +
        "<option " +
        no +
        ' value="No">No</option>' +
        "</select>"
    );
}

function setAuthentication(data, type, row, meta) {
    var yes = "";
    var no = "";

    if (data == "Yes") {
        yes = "selected";
    } else if (data == "No") {
        no = "selected";
    }

    return (
        '<select id="authentication-' +
        row.id +
        '" name="authentication-' +
        row.id +
        '">' +
        '<option value="">none</option>' +
        "<option " +
        yes +
        ' value="Yes">Yes</option>' +
        "<option " +
        no +
        ' value="No">No</option>' +
        "</select>"
    );
}

function setVirtualPatching(data, type, row, meta) {
    var yes = "";
    var no = "";

    if (data == "Yes") {
        yes = "selected";
    } else if (data == "No") {
        no = "selected";
    }

    return (
        '<select id="virtualpatching-' +
        row.id +
        '" name="virtualpatching-' +
        row.id +
        '">' +
        '<option value="">none</option>' +
        "<option " +
        yes +
        ' value="Yes">Yes</option>' +
        "<option " +
        no +
        ' value="No">No</option>' +
        "</select>"
    );
}

function setZeroDay(data, type, row, meta) {
    var yes = "";
    var no = "";

    if (data == "Yes") {
        yes = "selected";
    } else if (data == "No") {
        no = "selected";
    }

    return (
        '<select id="zeroday-' +
        row.id +
        '" name="zeroday-' +
        row.id +
        '">' +
        '<option value="">none</option>' +
        "<option " +
        yes +
        ' value="Yes">Yes</option>' +
        "<option " +
        no +
        ' value="No">No</option>' +
        "</select>"
    );
}

function setExploit(data, type, row, meta) {
    var yes = "";
    var no = "";

    if (data == "Yes") {
        yes = "selected";
    } else if (data == "No") {
        no = "selected";
    }

    return (
        '<select id="exploit-' +
        row.id +
        '" name="exploit-' +
        row.id +
        '">' +
        '<option value="">none</option>' +
        "<option " +
        yes +
        ' value="Yes">Yes</option>' +
        "<option " +
        no +
        ' value="No">No</option>' +
        "</select>"
    );
}

function setOther(data, type, row, meta) {
    var yes = "";
    var no = "";

    if (data == "Yes") {
        yes = "selected";
    } else if (data == "No") {
        no = "selected";
    }

    return (
        '<select id="other-' +
        row.id +
        '" name="other-' +
        row.id +
        '">' +
        '<option value="">none</option>' +
        "<option " +
        yes +
        ' value="Yes">Yes</option>' +
        "<option " +
        no +
        ' value="No">No</option>' +
        "</select>"
    );
}

function handelChange(val, id) {
    $(".row-checkbox").each(function() {
        if (this.checked) {
            $("#" + id + $(this).val()).val(val);
        }
    });
}

function update() {
    var data = [];
    $(".row-checkbox").each(function() {
        if (this.checked) {
            var row = current_control_table.row($(this).closest("tr")).data();
            var temp = {
                id: $(this).val(),
                ip_address: row.ip_address,
                port: row.port,
                protocol: row.protocol,
                host_name: row.host_name_fdqn,
                cve_id: row.cve_id,
                ips_signature: $("#ips-" + $(this).val()).val(),
                edr_prevention: $("#edr-" + $(this).val()).val(),
                xdr_prevention: $("#xdr-" + $(this).val()).val(),
                sandbox_prevention: $("#sandbox-" + $(this).val()).val(),
                anti_malware_prevention: $(
                    "#antimalware-" + $(this).val()
                ).val(),
                multi_factor_authentication: $(
                    "#authentication-" + $(this).val()
                ).val(),
                virtual_patching: $("#virtualpatching-" + $(this).val()).val(),
                zero_day_prevention: $("#zeroday-" + $(this).val()).val(),
                exploit_prevention: $("#exploit-" + $(this).val()).val(),
                other: $("#other-" + $(this).val()).val()
            };
            data.push(temp);
        }
    });

    if (data.length == 0) return false;

    $("#data").val(JSON.stringify(data));
    $("#current-control-form").submit();
}
