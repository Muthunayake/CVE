function blockUiCustom(element) {
    $(element).block({
        message: '<img src="/img/com_loading.gif" alt="" style="width: 40%;">' +
            '<h1 style="font-size: 14px;font-size: 27px;font-weight: 300;">Please Wait...</h1>',
        css: {
            border: '1px solid #ccc',
            background: "#fff",
            'border-radius': '5px',
            'padding': '2px 15px 13px',
            color: '#555'
        }
    });
}
function blockUiCustom2(element,message) {
    $(element).block({
        message: '<img src="/img/com_loading.gif" alt="" style="width: 40%; margin-top: 9px; display:block;margin-left: auto;margin-right: auto;">' +
            '<h1 style="font-size: 14px;font-size: 27px;font-weight: 300; margin-top: 21px; text-align: center;">'+message+'</h1>',
        css: {
            border: '1px solid #ccc',
            background: "#fff",
            'border-radius': '5px',
            'padding': '2px 15px 13px',
            color: '#555'
        }
    });
}
function blockUiFullPage() {
    $.blockUI({
        message: '<img src="/img/com_loading.gif" alt="" style="width: 40%; margin-top: 9px; display:block;margin-left: auto;margin-right: auto;">' +
            '<h1 style="font-size: 14px;font-size: 27px;font-weight: 300; margin-top: 21px; text-align: center;">Please Wait...</h1>',
        css: {
            border: '1px solid #ccc',
            background: "#fff",
            'border-radius': '5px',
            'padding': '2px 15px 13px',
            color: '#555'
        },
        baseZ: 2000
    });
}

function unblockFullPage(){
    $.unblockUI();
}

function showBlockUIWithTimeOUT(timeOUT){
    blockUiFullPage();

    setTimeout(function () {
        unblockFullPage();
    },timeOUT);
}
// blockUiCustom2('#find_meeting_table','message')