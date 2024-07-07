jQuery(document).ready(function($) {
    // Logout action
    $(document).on('click', '.jobseek-logout-trigger', function(e) {
        e.preventDefault();

        $.ajax({
            type: 'GET',
            url: jobseekers_ajax_object.ajax_url, // WordPress AJAX URL
            data: {
                action: 'jobseekers_logout' // AJAX action to handle logout
            },
            success: function(response) {
                if (response.success) {
                    // Redirect or update UI as needed upon successful logout
                    window.location.href = '/jobseekers-login';
                } else {
                    // Handle error scenarios if needed
                    console.log('Logout error:', response.data.message);
                }
            },
            error: function(xhr, status, error) {
                // Handle AJAX errors if needed
                console.error('Logout error:', error);
            }
        });
    });
});
