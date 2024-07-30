<?php 

function render_kg_newsletter_form() {
    // Enqueue the script 
    wp_enqueue_script('custom-newsletter-script', get_template_directory_uri() . '/admin/jobseekers/js/kg-newsletter.js', array('jquery'), null, true);
    wp_localize_script('custom-newsletter-script', 'kg_newsletter_ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('kg_newsletter_form_save_action')
    ));

    $site_key = GOOGLE_RECAPTCHA_SITE_KEY;
    
    ob_start(); ?> 
    <div class="kg_newsletter_formWrap">
        <form class="kg_newsletter_form" id="kg_newsletter_form" method="POST">
            <input type="hidden" name="action" id="action" value="kg_newsletter_form_save" />
            <?php wp_nonce_field('kg_newsletter_form_save_action', 'kg_newsletter_form_save_nonce_field'); ?>  
            <input type="hidden" name="kg_newsletter_start_time" value="<?php echo time(); ?>">
            <input type="text" name="kg_newsletter_honeypot" style="display:none;">
            <div class="jobseek_loader" style="display: none;"><div class="jobLoader"></div></div>
            <div class="kg_newsletter_cmnError" style="display: none;"><div class="kg_newsletter_cmnError_in"></div></div> 
            <div class="getstarted_input_main"> 
                <div class="getstarted_input_mainWrap"> 
                    <input type="text" class="newInputField" id="kg_newsletter_email" name="kg_newsletter_email" placeholder="Enter your email">
                    <button type="submit" name="submit" class="btn-style gradientBtn">Subscribe</button> 
                </div>
                <div class="jobseek_error"></div> 
            </div> 
        </form>
        <div class="kg_newsletter_thankWrap" id="kg_newsletter_thankWrap">
            <h4> Thank you for subscribing to our newsletter!  </h4>
            <p> We’re excited to share our latest updates, news, and exclusive content with you. Keep an eye on your inbox! </p>
        </div>
    </div>   
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <?php
    return ob_get_clean();
}

add_shortcode('kg_newsletter_form', 'render_kg_newsletter_form');

?>