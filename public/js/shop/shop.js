$(document).ready(function () {
    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')

        }

    });

     $('.js-addCart').click(function () {
        let idProduct = $(this).closest('tr').find('.js-idProduct').text();
        let name = $(this).closest('tr').find('.js-name').text();
        let price = $(this).closest('tr').find('.js-price').text();
        let currency = $(this).closest('tr').find('.js-currency').text();
        let quantity = $(this).closest('tr').find('.js-quantity').val();
        let idCart = $('.js-idCart').val();
        let idCustomer = $('.js-idCustomer').val();

       addCart(idProduct, name, price, currency, quantity, idCart, idCustomer);
    });


    function addCart(idProduct, name, price, currency, quantity, idCart, idCustomer) {
        $.ajax({
            method: 'POST',
            url: '/shop/store',
            data: {idCart: idCart, idCustomer: idCustomer,
                idProduct: idProduct, name: name,
                price: price, currency: currency,
                quantity: quantity},

        });
    }


});