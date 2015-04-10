jQuery.extend(jQuery.validator.messages, {
    required: "Thông tin này buộc phải nhập.",
    remote: "Vui lòng sửa thông tin này.",
    email: "Vui lòng nhập địa chỉ mail chính xác.",
    url: "Vui lòng nhập đường dẫn chính xác.",
    date: "Vui lòng nhập ngày chính xác.",
    dateISO: "Vui lòng nhập ngày chính xác (ISO).",
    number: "Vui lòng nhập số.",
    digits: "Vui lòng nhập số.",
    creditcard: "Please enter a valid credit card number.",
    equalTo: "Giá trị nhập chưa đúng.",
    accept: "Please enter a value with a valid extension.",
    maxlength: jQuery.validator.format("Bạn chỉ có thể nhập ít hơn {0} ký tự."),
    minlength: jQuery.validator.format("Bạn chỉ có thể nhập nhiều hơn {0} ký tự."),
    rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
    range: jQuery.validator.format("Please enter a value between {0} and {1}."),
    max: jQuery.validator.format("Please enter a value less than or equal to {0}."),
    min: jQuery.validator.format("Please enter a value greater than or equal to {0}."),
});
jQuery.validator.addMethod("required-checked", function(value, element) {
    return $(element).is(":checked");
}, "Please specify the correct domain for your documents");