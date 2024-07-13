jQuery(document).ready(function($) {
    // Open modal
    $('.open-modal').on('click', function() {
        var applicationIndex = $(this).data('index');
        var status = $(this).data('status');

        $('#modal_application_index').val(applicationIndex);
        $('#modal_status').val(status);

        $('#statusModal').show();
    });

    // Close modal
    $('.statusModalClose').on('click', function() {  
        $('#statusModal').hide();
    });

    // Confirmation before submitting form
    $('#statusForm').on('submit', function() {
        return confirm('Are you sure you want to update the status?');
    });
    
});