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
    });

});
