/* document.getElementById('vid').play();*/
var base_url = $('#base_url').val();

$("#signup-form").validate({
    ignore: ".ignore",
    rules: {
        fname: {
            required: true,
            maxlength: 255
        },
        mname: {
            required: true,
            maxlength: 255
        },
        lname: {
            required: true,
            maxlength: 255
        },
        email: {
            required: true,
            email: true,
            maxlength: 255
        },
        mobile: {
            required: true,
            minlength: 10,
            maxlength: 10,
            number: true
        },
        password: {
            required: true
        },
        re_password: {
            required: true,
            equalTo: "#password"
        }
    },
    errorPlacement: function(error, element) {},
    submitHandler: function(form) {
        saveData(form);
    }
});

$("#login-form").validate({
    rules: {
        mobile: {
            required: true,
            minlength: 10,
            maxlength: 10,
            number: true
        },
        password: {
            required: true
        }
    },
    errorPlacement: function(error, element) {},
    submitHandler: function(form) {
        saveData(form);
    }
});

$("#otp-form").validate({
    rules: {
        mobile: {
            required: true,
            minlength: 10,
            maxlength: 10,
            number: true
        },
        otp: {
            required: true,
            minlength: 6,
            maxlength: 6,
            number: true
        }
    },
    errorPlacement: function(error, element) {},
    submitHandler: function(form) {
        saveData(form);
    }
});

$("#code-form").validate({
    rules: {
        coupen_code: {
            required: true
        }
    },
    errorPlacement: function(error, element) {},
    submitHandler: function(form) {
        saveData(form);
    }
});

$("#checkout-form").validate({
    rules: {
        address: {
            required: true
        },
        city: {
            required: true,
            maxlength: 255
        },
        state: {
            required: true,
            maxlength: 255
        },
        country: {
            required: true,
            maxlength: 255
        },
        postcode: {
            required: true,
            minlength: 6,
            maxlength: 6
        },
        pancard: {
            required: true,
            minlength: 10,
            maxlength: 10
        },
    },
    errorPlacement: function(error, element) {},
    submitHandler: function(form) {
        form.submit();
    }
});

function saveData(form) {
    $.ajax({
        url: $(form).attr('action'),
        type: $(form).attr('method'),
        data: $(form).serialize(),
        dataType: 'json',
        async: false,
        beforeSend: function() {
            $(form).find(':submit').hide();
        },
        success: function(res) {
            Swal.fire({
                icon: res.error ? 'error' : 'success',
                title: res.error ? 'Oops...' : 'Success',
                text: res.message
            }).then((result) => {
                if (!res.error && result.isConfirmed && res.redirect) {
                    window.location.href = res.redirect;
                }
            });
        },
        complete: function() {
            $(form).find(':submit').show();
        }
    });
    return;
}

function addToCart(prod) {
    let p_id = prod.dataset.p_id;
    let qty = ($("#add-qty-" + p_id).val()) ? $("#add-qty-" + p_id).val() : 1;
    let size = ($("#ca_size_id").val()) ? $("#ca_size_id").val() : ($("#ca_size").val()) ? $("#ca_size").val() : '';
    $.ajax({
        type: 'POST',
        url: base_url + "add-cart",
        data: { p_id: p_id, qty: qty, ca_size: size },
        dataType: "json",
        success: function(res) {
            Swal.fire({
                icon: res.error ? 'error' : 'success',
                title: res.error ? 'Oops...' : 'Success',
                text: res.message
            }).then(() => {
                location.reload();
            });
        }
    });
}

function addWishlist(prod) {
    $.ajax({
        type: 'POST',
        url: base_url + "add-wishlist",
        data: { p_id: prod.dataset.p_id },
        dataType: "json",
        success: function(res) {
            Swal.fire({
                icon: res.error ? 'error' : 'success',
                title: res.error ? 'Oops...' : 'Success',
                text: res.message
            }).then(() => {
                location.reload();
            });
        }
    });
}

function cancelOrder(order) {
    $.ajax({
        type: 'POST',
        url: base_url + "cancel",
        data: { order_id: $(order).attr('id') },
        dataType: "json",
        success: function(res) {
            Swal.fire({
                icon: res.error ? 'error' : 'success',
                title: res.error ? 'Oops...' : 'Success',
                text: res.message
            }).then(() => {
                location.reload();
            });
        }
    });
}

function returnOrder(order) {
    $.ajax({
        type: 'POST',
        url: base_url + "return",
        data: { order_id: $(order).attr('id') },
        dataType: "json",
        success: function(res) {
            Swal.fire({
                icon: res.error ? 'error' : 'success',
                title: res.error ? 'Oops...' : 'Success',
                text: res.message
            }).then(() => {
                location.reload();
            });
        }
    });
}

function showProd(p_id) {
    $.ajax({
        type: 'GET',
        url: base_url + "prod-info",
        data: { p_id: p_id },
        dataType: "html",
        success: function(result) {
            $("#show-prod").html(result);
            $('.pro-new').prepend('<span class="dec qtybtn">-</span>');
            $('.pro-new').append('<span class="inc qtybtn">+</span>');
            $('.product-large-slider-new').slick({
                fade: true,
                autoplay: false,
                arrows: false,
                speed: 1000,
                asNavFor: '.pro-nav-new'
            });
            // product details slider nav active
            $('.pro-nav-new').slick({
                slidesToShow: 4,
                asNavFor: '.product-large-slider-new',
                centerMode: true,
                speed: 1000,
                centerPadding: 0,
                focusOnSelect: true,
                prevArrow: '<button type="button" class="slick-prev"><i class="lnr lnr-chevron-left"></i></button>',
                nextArrow: '<button type="button" class="slick-next"><i class="lnr lnr-chevron-right"></i></button>',
                responsive: [{
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 3,
                    }
                }]
            });
            $("#quick_view").modal('show');
        }
    });
}

$(".qtybtn").click(function() {
    var str1 = window.location.pathname;
    var str2 = "cart";
    if (str1.indexOf(str2) != -1) {
        var $button = $(this);
        var oldValue = $button.parent().find('input').val();
        if ($button.hasClass('inc'))
            var qty = parseInt(oldValue) + 1;
        else
        if (oldValue > 1)
            var qty = parseInt(oldValue) - 1;
        else
            return false;

        let cart_id = $(this).siblings('input').data('id');

        $.ajax({
            type: 'POST',
            url: base_url + "update-cart",
            data: { qty: qty, cart_id: cart_id },
            dataType: "json",
            success: function(res) {
                Swal.fire({
                    icon: res.error ? 'error' : 'success',
                    title: res.error ? 'Oops...' : 'Success',
                    text: res.message
                }).then(() => {
                    location.reload();
                });
            }
        });
    }
});

$(".delete-cart").click(function(e) {
    e.preventDefault();
    let cart_id = $(this).data('id');
    $.ajax({
        type: 'POST',
        url: base_url + "cart-delete",
        data: { cart_id: cart_id },
        dataType: "json",
        success: function(res) {
            Swal.fire({
                icon: res.error ? 'error' : 'success',
                title: res.error ? 'Oops...' : 'Success',
                text: res.message
            }).then((result) => {
                if (!res.error && result.isConfirmed) {
                    location.reload()
                }
            });
        }
    });
});

$(".delete-wish").click(function(e) {
    e.preventDefault();
    let cart_id = $(this).data('id');
    $.ajax({
        type: 'POST',
        url: base_url + "wish-delete",
        data: { cart_id: cart_id },
        dataType: "json",
        success: function(res) {
            Swal.fire({
                icon: res.error ? 'error' : 'success',
                title: res.error ? 'Oops...' : 'Success',
                text: res.message
            }).then((result) => {
                if (!res.error && result.isConfirmed) {
                    location.reload()
                }
            });
        }
    });
});

function checkout(form) {
    var data = $(form).serialize();
    $(form).find('button[type=submit]').prop('disabled', true);
    $.ajax({
        url: $(form).attr('action'),
        type: 'POST',
        dataType: 'json',
        data: data,
        success: function(response) {
            if (response.error == true) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: response.message
                }).then((result) => {
                    $(form).find('button[type=submit]').prop('disabled', false);
                });
                return;
            } else {
                var totalAmount = response.message;
                var options = {
                    /*live api key*/
                    "key": "rzp_live_Jf7dJMbtMe1xSC",
                    "secret": "7QSfgUjxMW5xWKY3ingxBgWN",
                    /*testing api key*/
                    /* "key": "rzp_test_Ih6FtVWFIhWHOC",
                    "secret": "rLPBMsXLE70mTDiciFObL64u", */
                    "amount": (totalAmount * 100), // 2000 paise = INR 20
                    "description": "Payment",
                    "prefill": {
                        "name": response.name,
                        "contact": response.mobile,
                        "email": response.email,
                    },
                    "handler": function(response) {
                        data += "&payment_id=" + response.razorpay_payment_id;
                        $.ajax({
                            url: base_url + 'save-order',
                            type: 'POST',
                            dataType: 'json',
                            data: data,
                            success: function(msg) {
                                Swal.fire({
                                    icon: msg.error ? 'error' : 'success',
                                    title: msg.error ? 'Oops...' : 'Success',
                                    text: msg.message
                                }).then((result) => {
                                    $(form).find('button[type=submit]').prop('disabled', false);
                                    if (msg.redirect) window.location.href = msg.redirect;
                                });
                                return;
                            }
                        });
                    },
                    "modal": {
                        "ondismiss": function() {
                            $(form).find('button[type=submit]').prop('disabled', false);
                        }
                    }
                };
                var rzp1 = new Razorpay(options);
                rzp1.open();
                return;
            }
        }
    });
}

function checkout_develop(form) {
    var data = $(form).serialize();
    $.ajax({
        url: base_url + 'save-order',
        type: 'POST',
        dataType: 'json',
        data: data,
        success: function(msg) {
            Swal.fire({
                icon: msg.error ? 'error' : 'success',
                title: msg.error ? 'Oops...' : 'Success',
                text: msg.message
            }).then((result) => {
                if (msg.redirect) window.location.href = msg.redirect;
            });
            return;
        }
    });
}