function onSubmit(token) {
    $("#registerForm").submit();
}

function onSubmitMail(token) {
    $("#form-post-maillist1").submit();
}

function validate() {


    //var quantity = $('input[type="radio"][name="QuantityValue"]:checked').val();
    var kvkk = $('input[type="checkbox"][name="IsKvkk"]:checked').val();
    console.log(kvkk);
    if (!kvkk || "") {
        $("#kvkk").css('display', 'inline-block');
    }
    else {
        $("#kvkk").css('display', 'none');
    }

    var quantity = $('input[type="radio"][name="QuantityValue"]:checked').val();
    console.log(quantity);
    if (!quantity || "") {
        $("#quantity").css('display', 'inline-block');
    }
    else {
        $("#quantity").css('display', 'none');
    }
    //if (!quantity || "") {
    //    $("#quantity").css('display', 'block');
    //}
    //else {
    //    $("#quantity").css('display', 'none');
    //}
    var form = $("#registerForm");
    form.validate();

    $("#registerForm").submit();
    if (grecaptcha.getResponse() != "") {

    }
}
function validateMail() {
    if (grecaptcha.getResponse() != "") {
        $("#form-post-maillist1").submit();
    }
}