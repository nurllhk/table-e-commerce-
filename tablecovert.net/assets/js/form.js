/*! /*! ARTAŞ KUTU - v1.0.0 - 2021
 * Copyright (c) 2021 - designerAgency: Diverseffect.com;
 */
$(function () {
    $.form = {
        formLoad: function () {
            $.form.formContent();
            $.form.phoneMask();

            if ($("#form-post-maillist").length) {
                $.form.maillistForm();
            };
            if ($("#form-post-contact").length) {
                $.form.formpostcontact();
            };
            if ($("#form-post-callyou").length) {
                $.form.formCallYou();
            };

        },
        formContent: function () {
            //select kontrol
            if ($('select').length) {
                $('select:not(.ignore)').niceSelect();
            }
            if ($('input[type="number"]').length) {
                $('input[type="number"]').each(function () {
                    $(this).number();
                });
            }

            $("#uploadBtn").change(function (e) {
                if (this.value != '') {
                    var names = [];
                    for (var i = 0; i < $(this).get(0).files.length; ++i) {
                        names.push($(this).get(0).files[i].name);
                    }
                    $("#uploadFile").attr("placeholder", names);
                }
            });

            //checkBox
            $("ul li").each(function () {
                if ($(this).find('input[type="checkbox"]').length) {
                    var checkBox = $(this).find('input[type="checkbox"]');
                    $(checkBox).each(function () {
                        $(this).wrap("<span class='custom-checkbox'></span>");
                        if ($(this).is(':checked')) {
                            $(this).parent().addClass("selected");
                            $(this).attr("checked", true);
                            //$(this).val('1');
                        }
                    });
                    $(checkBox).click(function () {
                        $(this).parent().toggleClass("selected");
                        if ($(this).is(':checked')) {
                            $(this).attr("checked", true);
                            //$(this).val('1');
                        }else{
                            $(this).attr("checked", false);
                            //$(this).val('0');
                        }
                    });
                }
            });

            //radioButton
            $("ul li").each(function () {
                if($(this).find(".custom-radio").length){}
                else{
                    if ($(this).find('input[type="radio"]').length) {
                        var radioButton = $(this).find('input[type="radio"]');
                        $(radioButton).each(function () {
                            $(this).wrap("<span class='custom-radio'></span>");
                            if ($(this).is(':checked')) {
                                $(this).parent().addClass("selected");
                                $(this).closest("label").addClass("labelSelected");
                            }
                        });
                        $(radioButton).click(function () {
                            if ($(this).is(':checked')) {
                                $(this).parent().addClass("selected");
                                $(this).closest("label").addClass("labelSelected");
                            }
                            $(radioButton).not(this).each(function () {
                                $(this).parent().removeClass("selected");
                                $(this).closest("label").removeClass("labelSelected");
                            });
                        });
                    }
                }
            });
        },

        //maillist
        maillistForm: function () {
            $('#form-post-maillist').validate({
                lang: 'tr',
                highlight: function(element, errorClass, validClass) {
                    $(element).closest("div").addClass(errorClass).removeClass(validClass);
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).closest("div").removeClass(errorClass).addClass(validClass);
                },
                errorClass: 'error',
                validClass: 'valid',
                rules: {
                    "eMail": {
                        required: true,
                        email: true
                    }
                },
                submitHandler: function(form) { // for demo
                    AlertPopup("E-BÜLTEN ÜYELİĞİ", "Kaydınız alınmıştır. Teşekkür ederiz.");
                    return false; // for demo
                }
            });
        },
        //İletişim
        formpostcontact: function () {
            // İLETİŞİM FORMU
            $('#form-post-contact').validate({
                lang: 'en',
                highlight: function (element, errorClass, validClass) {
                    $(element).closest("li").addClass(errorClass).removeClass(validClass);
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).closest("li").removeClass(errorClass).addClass(validClass);
                },

                errorClass: 'error',
                validClass: 'valid',
                rules: {
                    "Name": {
                        required: true
                    },
                    "Surname": {
                        required: true
                    },
                    "Email": {
                        required: true,
                        email: true
                    },
                    "Telephone": {
                        required: true
                    },
                    "Message": {
                        required: true
                    },
                    "IsKvkk": {
                        required: true
                    }
                },
                submitHandler: function(form) { // for demo
                    AlertPopup("BİZE ULAŞIN", "Kaydınız alınmıştır. Teşekkür ederiz.");
                    return false; // for demo
                }
            });
        },

        //Sizi Arayalım Modalı
        formCallYou: function () {
            // SİZİ ARAYALIM FORMU
            $('#form-post-callyou').validate({
                lang: 'en',
                highlight: function (element, errorClass, validClass) {
                    $(element).closest("li").addClass(errorClass).removeClass(validClass);
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).closest("li").removeClass(errorClass).addClass(validClass);
                },

                errorClass: 'error',
                validClass: 'valid',
                rules: {
                    "Name": {
                        required: true
                    },
                    "Surname": {
                        required: true
                    },
                    "Email": {
                        required: true,
                        email: true
                    },
                    "Telephone": {
                        required: true
                    },
                    "IsKvkk": {
                        required: true
                    }
                },
                submitHandler: function(form) { // for demo
                    AlertPopup("BİZE ULAŞIN", "Kaydınız alınmıştır. Teşekkür ederiz.");
                    return false; // for demo
                }
            });
        },

        //maillist
        phoneMask: function () {
            var phones = [{
                "mask": "(A##) ###-####"
            }, {
                "mask": "(A##) ###-####"
            }];
            $('input[name="phone"],input[name="Phone"], input[name="Telephone"],input[name="Telephone"]').inputmask({
                mask: phones,
                greedy: false,
                definitions: {
                    '#': {
                        validator: "[0-9]",
                        cardinality: 1
                    },
                    'A': {
                        validator: "[1-9]",
                        cardinality: 1
                    }
                }
            });
        }

    }
});

//AlertPopup
function AlertPopup(title, text) {
    $("body").append("<div id='Alert' class='modalAlert'><span class='Baslik'>" + title + "</span><div class='AlertText'>" + text + "</div><div class='AlertButon'><a href='javascript:$.fancybox.close();'>KAPAT</a></div></div>");
    $.fancybox.open({
        src: '#Alert',
        type: 'inline',
        opts: {
            margin: [0, 0],
            afterClose: function () {
                $("#Alert").remove();
            }
        } // Object containing item options (optional)
    });
};
$(document).ready(function () {
    $.form.formLoad();
});