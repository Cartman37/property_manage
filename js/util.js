function Validate_frmAddClient() {
    var form = $("#frmAddClient");
    form.validate(
        {
            rules: {
                clientName: {
                    required: true
                },
                clientAddress1: {
                    addressCheck: true
                },
                clientPhone1: {
                    required: true,
                    phoneCheck: true
                },
                clientEmail: {
                    required: true,
                    email: true
                }
            },
            messages: {
                clientName: {
                    required: "Client is required"
                },
                clientAddress1: {
                    addressCheck: "Invalid Address"
                },
                clientPhone1: {
                    required: "Phone1 is required",
                    phoneCheck: "Invalid phone number"
                },
                clientEmail: {
                    required: "Email is required",
                    email: "invalid email address"
                }
            }
        });

    return form.valid();
}

jQuery.validator.addMethod("addressCheck",
    function (value, element)
    {
        var regex = /^\d+[ ](?:[A-Za-z0-9.-]+[ ]?)+(?:Crescent|Circle|Way|Avenue|Lane|Road|Boulevard|Drive|Street|Ave|Dr|Rd|Blvd|Ln|St|Cres|Cir)\.?$/;
        return this.optional(element) || regex.test(value);
    },
    "Customer address checker");

jQuery.validator.addMethod("phoneCheck",
    function (value, element)
    {
        var regex = /^((\(\d{3}\) ?)|(\d{3}-))?\d{3}-\d{4}$/;
        return this.optional(element) || regex.test(value);
    },
    "Customer phone checker");