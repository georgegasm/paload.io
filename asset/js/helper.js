function populateTableBodyWithJSON(tableID, response)
{
    if (response === "null" || response === null || response ==="" || typeof response === "undefined") 
    {
        console.log("Response is empty.");
        return;
    }
    $("#"+tableID+" tbody").empty();
    $.each(response, function(key, value) {
        var tr = $("<tr />");
        $.each(value, function(k, v) {
         tr.append(
                 $("<td />", {
                        html: v
                        })[0].outerHTML
         );
         $("#"+tableID+" tbody").append(tr);
        });
    });
}

function validateInputField(inputID, validationType, invalidMessage, compareAgainst)
{
    var hasViolation = false;
    var input = $("#"+inputID).val();
    switch(validationType)
    {
        case "number":
            if(isNaN(input))
                hasViolation = true;
            break;
        case "money":
            var regex  = /^\d+(?:\.\d{0,2})$/;
            if(regex.test(input))
                hasViolation = true;
            break;
        case "length_equal":
            if(input.length != compareAgainst)
                hasViolation = true;
            break;
        case "minimum":
            if(input < compareAgainst)
                hasViolation = true;
            break;
        case "maximum":
            if(input > compareAgainst)
                hasViolation = true;
            break;
        case "negative":
            if(input < 0)
                hasViolation = true;
            break;
    }

    if(input.trim().length === 0)
    {
        hasViolation = true;
    }

    if(hasViolation)
    {
        swal({
          title: "Invalid Input!",
          text: invalidMessage,
          type: "error",
          confirmButtonText: "Okay"
        });
    }
    return hasViolation;
}