function Validate_frmAddClient() {
    var form = $("#frmAddVehicle");
    form.validate(
        {
            rules: {
                name: {
                    required: true,
                    rangelength: [2, 30]
                },
                address: {
                    required: true,
                    addressCheck: true
                },
                city: {
                    required: true,
                    rangelength: [2, 30]
                },
                phone: {
                    required: true,
                    phoneCheck: true
                },
                email: {
                    required: true,
                    email: true
                },
                vehicleInfo: {
                    required: true,
                    vehicleCheck: true
                }
            },
            messages: {
                name: {
                    required: "Seller name is required",
                    rangelength: "Must be 2-30 characters long"
                },
                address: {
                    required: "Address is required",
                    addressCheck: "Invalid address"
                },
                city: {
                    required: "City is required",
                    rangelength: "Must be 2-30 characters long"
                },
                phone: {
                    required: "Phone number is required",
                    phoneCheck: "Invalid phone number (123-123-1234 or (123)123-1234)"
                },
                email: {
                    required: "Email address is required",
                    email: "Invalid email address"
                },
                vehicleInfo: {
                    required: "Vehicle information is required",
                    vehicleCheck: "Invalid vehicle information (2018 BMW 328i)"
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