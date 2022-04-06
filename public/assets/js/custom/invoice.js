$(document).ready(function () {
    "use strict";
    let invoice = $('#invoice').html();

    let clearInvoice = $('meta[name="clear-invoice-html"]').attr('content');
    if(clearInvoice)
        $('#invoice').html('');

    $(document).on('click', '.m-add', function () {
        $('#invoice').append(invoice);
    });

    $(document).on('click', '.m-remove', function () {
        $(this).parent().parent().remove();
    });

    let total = parseFloat($('meta[name="invoice-total"]').attr('content'));
    let grand_total = parseFloat($('meta[name="invoice-grand-total"]').attr('content'));
    console.log(total,grand_total);
    $(document).on('change keyup', '.quantity, .price', function () {
        let quantity = $(this).parent().parent().find('.quantity').val();
        quantity = isNaN(quantity) ? 0 : parseFloat(quantity);
        quantity = parseFloat(quantity.toFixed(2));

        let price = $(this).parent().parent().find('.price').val();
        price = isNaN(price) ? 0 : parseFloat(price);
        price = parseFloat(price.toFixed(2));

        if (isNaN(price) || isNaN(quantity))
            $(this).parent().parent().find('.sub_total').val(null);
        else {
            let subTotal = quantity * price;
            $(this).parent().parent().find('.sub_total').val(subTotal.toFixed(2));
        }

        total = 0;
        $('.sub_total').each(function() {
            let st = $(this).val();
            if (st && !isNaN(st))
                total += parseFloat(st);
        });
        $('.total').val(total.toFixed(2));

        calculateDiscount();
    });

    $(document).on('change keyup', '.discount_percentage', function () {
        calculateDiscount();
    });

    $(document).on('change keyup', '.vat_percentage', function () {
        calculateVatPercentage();
    });

    $(document).on('change keyup', '.discount', function () {
        $('.discount_percentage').val(0.00);
        calculateVat();
    });

    $(document).on('change keyup', '.vat', function () {
        $('.vat_percentage').val(0.00);
        calculateVat();
    });

    $(document).on('change keyup', '.paid', function () {
        calculatePaid();
    });

    function calculateDiscount() {
        let discount_percentage = $('.discount_percentage').val();
        discount_percentage = (!discount_percentage.length || isNaN(discount_percentage)) ? 0 : parseFloat(discount_percentage);
        discount_percentage = parseFloat(discount_percentage.toFixed(2));

        if (discount_percentage > 0) {
            let discount = (discount_percentage / 100) * total;
            $('.discount').val(discount.toFixed(2));
        }

        calculateVat();
    }

    function calculateVatPercentage() {
        let discount = $('.discount').val();
        discount = (!discount.length || isNaN(discount)) ? 0 : parseFloat(discount);

        let vat_percentage = $('.vat_percentage').val();
        vat_percentage = (!vat_percentage.length || isNaN(vat_percentage)) ? 0 : parseFloat(vat_percentage);
        vat_percentage = parseFloat(vat_percentage.toFixed(2));

        total = parseFloat(total.toFixed(2));
        grand_total = total - discount;
        let vat = (vat_percentage / 100) * (grand_total);
        grand_total += vat;
        $('.vat').val(vat.toFixed(2));
        $('.grand_total').val(grand_total.toFixed(2));

        calculatePaid();
    }

    function calculateVat() {
        let discount = $('.discount').val();
        discount = (!discount.length || isNaN(discount)) ? 0 : parseFloat(discount);

        let vat = $('.vat').val();
        vat = (!vat.length || isNaN(vat)) ? 0 : parseFloat(vat);

        total = parseFloat(total.toFixed(2));
        grand_total = total - discount;
        grand_total += vat;
        $('.grand_total').val(grand_total.toFixed(2));

        calculatePaid();
    }

    function calculatePaid() {
        let paid = $('.paid').val();
        paid = (!paid.length || isNaN(paid)) ? 0 : parseFloat(paid);
        paid = parseFloat(paid.toFixed(2));

        grand_total = parseFloat(grand_total.toFixed(2));
        let due = grand_total - paid;
        $('.due').val(due.toFixed(2));
    }
});
