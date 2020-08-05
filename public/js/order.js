$(document).ready(function() {

    $('.add-row').click(function() {

        if($('#elements >tr').length !== 10) {

            $tr = $('#elements >tr').last().clone().find('input').val('').end();
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

        $('tr').each(function() {

            var quantity = $(this).find('input[name="quantity[]"]').val();
            var unitPrice = $(this).find('input[name="unitPrice[]"]').val();
    
            if(quantity !== '' && unitPrice !== '') {

                var totalPrice = quantity * unitPrice;

                $(this).find('input[name="totalPrice[]"]').val(totalPrice.toFixed(2));

            } else {

                $(this).find('input[name="totalPrice[]"]').val('');
            }
        });

        calculateTotalAmount();
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
