// show/hide accordian
function accordianEvent() {

    var scrWidth = $(window).width();

    if (scrWidth > 991) {
        $('div#lefNav div.collapse').removeClass('hide').addClass('show');
    } else {
        $('div#lefNav div.collapse').removeClass('show').addClass('hide');
    }

}

// cookie consent
function ckiPrvcy(event) {

    event.preventDefault();

    var _token = $('input[name=_token]').val();

    $.ajax({
        type: 'POST',
        url: '/cookie-privacy',
        data: { _token: _token },
        success: function(rsp) {

            $('#modalCookie').delay(400).fadeOut(200);

        }

    });
}

// Banner Click Count
function clickCount(event, id, position, url, target) {

    event.preventDefault();

    $('#mdb-preloader').css({ 'display': 'flex' }).fadeIn();

    var _token = $('input[name=_token]').val();

    $.ajax({
        type: 'POST',
        url: '/banner-click',
        data: {
            id: id,
            position: position,
            _token: _token
        },
        success: function(rsp) {

            $('#mdb-preloader').delay(500).fadeOut(300);

            if (target == '_blank') {
                window.open(url, target);
            } else {
                window.location.href = url;
            }

        }

    });
}


// SubmitOrder
function getVal(id) {

    var mfc = [];
    $.each($("form#prodSearch input[name='manufacturers']:checked"), function() {
        mfc.push($(this).val());
    });

    // var available = [];
    // $.each($("form#prodSearch input[name='available']:checked"), function(){
    //     available.push($(this).val());
    // });

    var price = [];
    $.each($("form#prodSearch input[name='price']:checked"), function() {
        price.push($(this).val());
    });

    var CATCurrent = $("form#prodSearch input[name='CATCurrent']").val();


    var _token = $('input[name=_token]').val();

    const form = document.createElement('form');
    form.method = 'post';
    form.action = '/search';

    const hiddenField_1 = document.createElement('input');
    hiddenField_1.type = 'hidden';
    hiddenField_1.name = 'mfc';
    hiddenField_1.value = mfc;
    form.appendChild(hiddenField_1);

    // const hiddenField_2 = document.createElement('input');
    // hiddenField_2.type = 'hidden';
    // hiddenField_2.name = 'available';
    // hiddenField_2.value = available;
    // form.appendChild(hiddenField_2);

    const hiddenField_3 = document.createElement('input');
    hiddenField_3.type = 'hidden';
    hiddenField_3.name = 'price';
    hiddenField_3.value = price;
    form.appendChild(hiddenField_3);

    const hiddenField_4 = document.createElement('input');
    hiddenField_4.type = 'hidden';
    hiddenField_4.name = '_token';
    hiddenField_4.value = _token;
    form.appendChild(hiddenField_4);

    const hiddenField_5 = document.createElement('input');
    hiddenField_5.type = 'hidden';
    hiddenField_5.name = 'CATCurrent';
    hiddenField_5.value = CATCurrent;
    form.appendChild(hiddenField_5);

    document.body.appendChild(form);
    form.submit();

    console.log(form);

    console.log(mfc + ' // ' + available + ' // ' + price);

}

// SubmitOrder
function submitOrder(event) {

    var shippinAddress = $('div#shippingAddress input[name=cart_shipping_address_option]:checked').val();

    if (shippinAddress == 'other') {
        $('input[name=cart_new_shp_name]').prop('required', true);
        $('input[name=cart_new_shp_last_name]').prop('required', true);
        $('input[name=cart_new_shp_email]').prop('required', true);
        $('input[name=cart_new_shp_phone]').prop('required', true);
        $('input[name=cart_new_shp_address]').prop('required', true);
        $('input[name=cart_new_shp_zip]').prop('required', true);
        $('input[name=cart_new_shp_city]').prop('required', true);
    } else {
        $('input[name=cart_new_shp_name]').prop('required', false);
        $('input[name=cart_new_shp_last_name]').prop('required', false);
        $('input[name=cart_new_shp_email]').prop('required', false);
        $('input[name=cart_new_shp_phone]').prop('required', false);
        $('input[name=cart_new_shp_address]').prop('required', false);
        $('input[name=cart_new_shp_zip]').prop('required', false);
        $('input[name=cart_new_shp_city]').prop('required', false);
    }

    MDBformValidate();

}

function MDBformValidate() {
    //'use strict';
    //window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });
    //}, false);
}

function toolTipINIT(ttipClass) {
    $('.' + ttipClass).tooltip({
        template: '<div class="tooltip md-tooltip"><div class="tooltip-arrow md-arrow"></div><div class="tooltip-inner md-inner"></div></div>'
    });
}


// quantity PLUS
function qtyPLUS(prodID) {

    $('#mdb-preloader').css({ 'display': 'flex' }).fadeIn();

    var oldQTY = $('input#prodQuantity_' + prodID).val();
    var newQTY = Number(oldQTY) + 1;

    // CART page Update
    var old_discPrice = $('input[name=start_discount_price_' + prodID + ']').val();
    var new_discPrice = Number(old_discPrice) * newQTY;

    var old_finalPrice = $('input[name=start_final_price_' + prodID + ']').val();
    var new_finalPrice = Number(old_finalPrice) * newQTY;

    $('input#prodQuantity_' + prodID).val(newQTY);
    $('input[name=discount_price_' + prodID + ']').val(new_discPrice);
    $('input[name=final_price_' + prodID + ']').val(new_finalPrice);

    if (old_discPrice > 0) {
        $('tr#row_' + prodID + ' span.fullPrice').html(currencyFormat(new_discPrice));
    }
    $('tr#row_' + prodID + ' span.finalPrice').html(currencyFormat(new_finalPrice));


    // CART modal Update
    $('div#cartDATA div[name=row_' + prodID + '] span.qty').html(newQTY);

    cart_SumAllInputs();

    updateQTY(prodID, newQTY);

    // CART badge Update
    var cartSUM_QTY = cart_SumAllQTY();
    $('div#cartCount span.badge').html(cartSUM_QTY);
    var cartSUM_Pr = cart_SumAllPrice();
    $('span#head_price').html(currencyFormat(cartSUM_Pr));

    $('#mdb-preloader').delay(500).fadeOut(300);

}

// quantity MINUS
function qtyMINUS(prodID) {

    $('#mdb-preloader').css({ 'display': 'flex' }).fadeIn();

    var oldQTY = $('input#prodQuantity_' + prodID).val();

    if (oldQTY > 1) {
        var newQTY = Number(oldQTY) - 1;
        $('input#prodQuantity_' + prodID).val(newQTY);

        // CART page Update
        var old_discPrice = $('input[name=start_discount_price_' + prodID + ']').val();
        var new_discPrice = Number(old_discPrice) * newQTY;

        var old_finalPrice = $('input[name=start_final_price_' + prodID + ']').val();
        var new_finalPrice = Number(old_finalPrice) * newQTY;

        $('input[name=discount_price_' + prodID + ']').val(new_discPrice);
        $('input[name=final_price_' + prodID + ']').val(new_finalPrice);

        if (old_discPrice > 0) {
            $('tr#row_' + prodID + ' span.fullPrice').html(currencyFormat(new_discPrice));
        }
        $('tr#row_' + prodID + ' span.finalPrice').html(currencyFormat(new_finalPrice));

        // CART modal Update
        $('div#cartDATA div[name=row_' + prodID + '] span.qty').html(newQTY);

        cart_SumAllInputs();

        updateQTY(prodID, newQTY);

        // CART badge Update
        var cartSUM_QTY = cart_SumAllQTY();
        $('div#cartCount span.badge').html(cartSUM_QTY);
        var cartSUM_Pr = cart_SumAllPrice();
        $('span#head_price').html(currencyFormat(cartSUM_Pr));

        $('#mdb-preloader').delay(500).fadeOut(300);

    }

}

function updateQTY(prodID, newQTY) {

    var _token = $('input[name=_token]').val();

    $.ajax({
        type: 'POST',
        url: '/update-qty',
        data: {
            prodID: prodID,
            newQTY: newQTY,
            _token: _token
        },
        success: function(rsp) {

            //console.log(rsp);

        }

    });

}

// Currency Format with DOT
function currencyFormat(x) {
    return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ".");
}


// FAVOURITES add/remove
function cart_SumAllInputs() {

    var discountVAL = $('input[name=discount]').val();

    var cartSUM = 0;
    $('input#finalPRICE').each(function() {
        cartSUM += Number($(this).val());
    });

    var cartSUMwDiscount = cartSUM - (cartSUM / 100) * discountVAL;

    $('div#cartAmount_txt span').html(currencyFormat(cartSUM));
    $('div#cartTotal_txt label').html(currencyFormat(cartSUMwDiscount));

    $('div#cartDATA div#cartTOTAL span#cartAmount_modal').html(currencyFormat(cartSUMwDiscount));

    return cartSUMwDiscount;
}


// FAVOURITES add/remove
function cart_SumAllQTY() {

    var cartSUM_QTY = 0;
    $('input.prod_quantity').each(function() {
        cartSUM_QTY += Number($(this).val());
    });

    return cartSUM_QTY;
}

function cart_SumAllPrice() {

    var cartSUM_Price = 0;
    $('input#finalPRICE').each(function() {
        cartSUM_Price += Number($(this).val());
    });

    return cartSUM_Price;
}

// CART add/remove
function CartEvent(prodID) {

    $('#mdb-preloader').css({ 'display': 'flex' }).fadeIn();

    $('header div#cartDATA').html('');

    var cartCOUNT = $('div#cartCount span.badge').html();

    var _token = $('input[name=_token]').val();

    $.ajax({
        type: 'POST',
        url: '/add-to-cart',
        data: {
            prodID: prodID,
            _token: _token
        },
        success: function(rsp) {
            $('#mdb-preloader').delay(500).fadeOut(300);

            if (cartCOUNT == undefined) {

                $('div#cartCount span.badge').removeClass('d-block').addClass('d-none').html('');
                $('div#myCart div#cartCountTXT').removeClass('d-none').addClass('d-block');
                $('div#myCart div#cartPrice').removeClass('d-block').addClass('d-none');

            } else {

                var newCartCOUNT = Number(cartCOUNT) + 1;

                $('div#cartCount span.badge').removeClass('d-none').addClass('d-block').html(newCartCOUNT);
                $('div#myCart div#cartCountTXT').removeClass('d-block').addClass('d-none');
                $('div#myCart div#cartPrice').removeClass('d-none').addClass('d-block');
                $('span#head_price').html(currencyFormat(rsp.header_price));

            }

            $('header div#cartDATA').html(rsp.cart);
            $('#myCartModal').modal('show');

            new WOW().init();
        }
    });

}


// CART add/remove
function remove_CartEvent(prodID) {

    $('#mdb-preloader').css({ 'display': 'flex' }).fadeIn();

    var prodCartCount = $('input#prodQuantity_' + prodID + '').val();
    var cartCOUNT = $('div#cartCount span.badge').html();

    var newCartCOUNT = Number(cartCOUNT) - Number(prodCartCount);

    $('table#cartTable tr#row_' + prodID + '').remove();
    $('div#myCartModal div#cartDATA [name=row_' + prodID + ']').remove();

    if (newCartCOUNT == 0) {

        $('div#cartCount span.badge').removeClass('d-block').addClass('d-none');
        $('div#myCart div#cartCountTXT').removeClass('d-none').addClass('d-block');
        $('div#cartDATA span#emptyCart_modal').removeClass('d-none').addClass('d-block');
        $('div#myCart div#cartPrice').removeClass('d-block').addClass('d-none');

        $('div#cartDATA div#cartTOTAL').removeClass('d-block').addClass('d-none');

    } else {

        $('div#cartCount span.badge').removeClass('d-none').addClass('d-block').html(newCartCOUNT);
        $('div#myCart div#cartPrice').removeClass('d-none').addClass('d-block');
        var cartSUM_Pr = cart_SumAllPrice();
        $('span#head_price').html(currencyFormat(cartSUM_Pr));
    }

    cart_SumAllInputs();

    var _token = $('input[name=_token]').val();

    $.ajax({
        type: 'POST',
        url: '/remove-from-cart',
        data: {
            prodID: prodID,
            _token: _token
        },
        success: function(rsp) {

            $('#mdb-preloader').delay(500).fadeOut(300);

        }

    });

}


// CART add/remove
function FavEvent(prodID) {

    $('#mdb-preloader').css({ 'display': 'flex' }).fadeIn();

    var favCNTold = $('div#myFAV span.badge').html();

    var _token = $('input[name=_token]').val();

    $.ajax({
        type: 'POST',
        url: '/fav-event',
        data: {
            prodID: prodID,
            _token: _token
        },
        success: function(rsp) {
            if (favCNTold > rsp) {

                $('div#addTo_FAV.prod_' + prodID + ' i.fas').removeClass('d-block').addClass('d-none');
                $('div#addTo_FAV.prod_' + prodID + ' i.far').removeClass('d-none').addClass('d-block');

            } else {

                $('div#addTo_FAV.prod_' + prodID + ' i.fas').removeClass('d-none').addClass('d-block');
                $('div#addTo_FAV.prod_' + prodID + ' i.far').removeClass('d-block').addClass('d-none');

            }


            $('div#myFAV span.badge').html(rsp);

            if (rsp == 0) {

                $('div#myFAV span.badge').removeClass('d-block').addClass('d-none');
                $('div#myFAV div#addTo_FAV i.far').removeClass('d-none').addClass('d-block');
                $('div#myFAV div#addTo_FAV i.fas').removeClass('d-block').addClass('d-none');

            } else {

                $('div#myFAV span.badge').removeClass('d-none').addClass('d-block');
                $('div#myFAV div#addTo_FAV i.fas').removeClass('d-none').addClass('d-block');
                $('div#myFAV div#addTo_FAV i.far').removeClass('d-block').addClass('d-none');

            }

            $('#mdb-preloader').delay(500).fadeOut(300);

            //console.log(rsp);

        }

    });

    //console.log(prodID);

}