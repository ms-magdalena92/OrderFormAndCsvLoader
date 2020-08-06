$(document).ready(function() {

    $('input[type="file"]').change(function(e){

        if(e.target.files['length']) {

            var fileName = e.target.files[0].name;
            $('.custom-file-label').html(fileName);

        } else {
            
            $('.custom-file-label').html('Choose File');
        }
    });

    $('#fileForm').validate({
        rules: {
            csvFile: {
                required: true,
                extension: 'csv'
            }
        },
        messages: {
            csvFile: {
                required: 'Please select a file.',
                extension: 'File is not supported. Please select .csv file.'
            }
        },
        errorPlacement: function(error, element) {
            error.appendTo('small');
        }
    });

});
