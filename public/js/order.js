$(document).ready(function() {

    $('.add-row').click(function() {

        if($('#elements >tr').length !== 10) {

            $tr = $('#elements >tr').last().clone().find('input').val('').end();
            $tr.find('small').empty().end();
            $tr.insertAfter($('#elements >tr').last());
        }
    });
    
    $('.delete-row').click(function() {

        $('table tbody').find('input[name="record"]').each(function() {

            if($(this).is(':checked') && $('#elements >tr').length > 1) {

                $(this).parents('tr').remove();

            } else {

                $(this).prop('checked', false);
            }
        });

        calculateTotalAmount();
    });

    $('#orderForm').on('input', function() {

        $('input').each(function() {
    
            $(this).change(validateInput);
        });

        $('tr').each(function() {

            var quantity = $(this).find('input[name="quantity[]"]').val();
            var unitPrice = $(this).find('input[name="unitPrice[]"]').val();
    
            if(quantity !== '' && unitPrice !== '') {

                var totalPrice = quantity * unitPrice;

                $(this).find('input[name="totalPrice[]"]').val(totalPrice.toFixed(2));

            } else {

                $(this).find('input[name="totalPrice[]"]').val('');
            }

            calculateTotalAmount();
        });

    });
});

function calculateTotalAmount()
{
    var totalAmount = 0;

    $('#orderForm').find('input[name="totalPrice[]"]').each(function(i,n){

        if($(n).val() !== '') {

            totalAmount += parseFloat($(n).val());
        }
    });

    $('input[name="totalAmount"]').val(totalAmount.toFixed(2));
}


function validateInput()
{
    if($(this).attr('name') === 'productName[]') {

        var productName = $(this).val();
        
        if(productName === '') {

            $(this).next().html('This field is required.');
        }
        else if(!productName.match(/^[A-Za-z0-9]+$/)) {

            $(this).next().html('Product name must contain letters and numbers only.');
        }
        else {
            $(this).next().html('');
        }
    }

    if($(this).attr('name') === 'quantity[]') {

        var quantity = $(this).val();
        
        if(quantity === '') {

            $(this).next().html('This field is required.');
        }
        else if(!$.isNumeric(quantity) || !quantity.match(/^[0-9]+$/)) {

            $(this).next().html('Please enter positive integer.');
        }
        else {
            $(this).next().html('');
        }
    }

    if($(this).attr('name') === 'unitPrice[]') {

        var unitPrice = $(this).val();
        
        if(unitPrice === '') {

            $(this).next().html('This field is required.');
        }
        else if(!$.isNumeric(unitPrice) || !unitPrice.match(/^\d+(,\d{3})*(\.\d{1,2})?$/)) {

            $(this).next().html('Please enter valid positive number.');
        }
        else {
            $(this).next().html('');
        }
    }

    if($(this).attr('name') === 'name') {

        var name = $(this).val();
        
        if(name === '') {

            $(this).next().html('This field is required.');
        }
        else if(!name.match(/^[A-Za-z]+$/)) {

            $(this).next().html('Name must contain letters only.');
        }
        else {
            $(this).next().html('');
        }
    }

    if($(this).attr('name') === 'phone') {

        var phone = $(this).val();
        
        if(phone === '') {

            $(this).next().html('This field is required.');
        }
        else if(!phone.match(/^[0-9\+]{8,13}$/)) {

            $(this).next().html('Enter valid phone number');
        }
        else {
            $(this).next().html('');
        }
    }

    if($(this).attr('name') === 'email') {

        var email = $(this).val();
        
        if(email === '') {

            $(this).next().html('This field is required.');
        }
        else if(!email.match(/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/)) {

            $(this).next().html('Enter valid email address');
        }
        else {
            $(this).next().html('');
        }
    }
}

$("form").submit(function(e){

    $('input').each(validateInput);

    if($('small').html() !== '') {

        e.preventDefault();
    }
});
