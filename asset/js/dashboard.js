$(function(){
    showTopUpButton(true);
    fetchLoadOrderList();

    $("#manageWalletModalSubmit").click(function(){
        showManageWalletButton(false);
    });

    $("#loadNowModalSubmit").click(function(){
        var payVia = $("#loadNowInput_payvia").val();
        var amountRequest = $("#loadNowInput_amount").val();
        var mobileNumber = $("#loadNowInput_mobileNumber").val();

        if(validateInputField("loadNowInput_amount","number","Amount input should be numerical."))
            return;
        if(validateInputField("loadNowInput_amount","money","Amount input should be in money format."))
            return;
        if(validateInputField("loadNowInput_amount","minimum","Amount input should be at least 10.0",10))
            return;
        if(validateInputField("loadNowInput_amount","maximum","Amount input maximum is 300.",300))
            return;
        if(validateInputField("loadNowInput_amount","negative","Amount input can't be negative."))
            return;
        if(validateInputField("loadNowInput_mobileNumber","length_equal","Mobile Number should be 10 digits.", 10))
            return;
        if(validateInputField("loadNowInput_mobileNumber","number","Mobile Number should be numerical"))
            return;

        createLoadOrder(payVia,amountRequest,mobileNumber);
        $('#loadNowModal').modal('hide');
        swal({
          title: "Success!",
          text: "Load Order submitted!",
          type: "success",
          confirmButtonText: "Okay"
        });
    });
});

function showTopUpButton(isVisible)
{
    if(!isVisible)
    {
        $("#manageWallet_pendingInputGroups").show();
        $("#manageWalletModalSubmit").hide();
        return;
    }
    $("#manageWallet_pendingInputGroups").hide();
    $("#manageWalletModalSubmit").show();
}

function showLoadTable(isVisible)
{
    if(!isVisible)
    {
        $("#loadOrderTable").hide();
        return;
    }
    $("#loadOrderTable").show();
}

function showLoading(isVisible)
{
    if(!isVisible)
    {
        $('#loadingModal').modal('hide');
        return;
    }
    $('#loadingModal').modal('show');
}

function createLoadOrder(payVia,amountRequest,mobileNumber)
{
    $.ajax({
        method: "POST",
        url: "dashboard/createLoadOrder",
        data: { 
            payVia: payVia,
            amountRequest: amountRequest,
            mobileNumber: mobileNumber
        }
    }).done(function( response ) {
        fetchLoadOrderList();
    });
}

function fetchLoadOrderList()
{
    showLoading(true);
    showLoadTable(false);
    $.ajax({
        method: "GET",
        url: "dashboard/fetchLoadOrderList"
    }).done(function( response ) {
        $('#loadOrderTable').DataTable().destroy().draw();
        populateTableBodyWithJSON("loadOrderTable",response);
        $('#loadOrderTable').DataTable({"ordering":false});
        showLoadTable(true);
        showLoading(false);
        $(".cancelButton").click(function(){
            var loadOrderID = $(this).val();
            cancelLoadOrder(loadOrderID);
        });
    });
}

function cancelLoadOrder(loadOrderID)
{
    swal({
        title: "Are you sure?",
        text: "This load order will not be processed anymore.",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes!",
        closeOnConfirm: false
    },
    function(){
        $.ajax({
            method: "POST",
            url: "dashboard/cancelLoadOrder",
            data:{loadOrderID: loadOrderID}
        }).done(function( response ) {
            swal("Success!", "Load Order has been cancelled!", "success");
            fetchLoadOrderList();
        });
    });
}

function checkWalletBalance()
{
    $.ajax({
        method: "GET",
        url: "dashboard/checkWalletBalance"
    }).done(function( response ) {
        return response;
    });
}