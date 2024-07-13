<?php 

function contact_form() {
    // Enqueue the script 
    wp_enqueue_script('custom-contact-script', get_template_directory_uri() . '/admin/contact/form.js', array('jquery'), null, true);
    wp_localize_script('custom-contact-script', 'kg_contact_ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('contact_form_save_action')
    ));

    $site_key = GOOGLE_RECAPTCHA_SITE_KEY;
    
    ob_start(); ?>
    <div class="kg_contact_wrapper">
        <div class="kg_contact_formWrap">
            <form class="kg_contact_form" id="kg_contact_form" method="POST">
                <input type="hidden" id="selected_services" name="selected_services" value="">
                <input type="hidden" name="action" id="action" value="kg_contact_form_save" />
                <?php wp_nonce_field('contact_form_save_action', 'contact_form_save_nonce_field'); ?> 
                <div class="kg_contact_wrap">
                    <div class="kg_loader" style="display: none;"><div class="jobLoader"></div></div>
                    <div class="kg_contact_cmnError" style="display: none;"><div class="kg_contact_cmnError_in"></div></div>
                    <div class="kg_contact_row row"> 
                        <div class="kg_contact_col col-md-6">
                            <div class="kg_contact_inputWrap">
                                <label class="kg_contact_label"> Name<sup>*</sup></label>
                                <input type="text" class="inputField" id="kg_contact_name" name="kg_contact_name" placeholder="Your Name">
                                <div class="contact_error"></div>
                            </div>
                        </div>
                        <div class="kg_contact_col col-md-6">
                            <div class="kg_contact_inputWrap">
                                <label class="kg_contact_label"> Title<sup>*</sup> </label>
                                <input type="text" class="inputField" id="kg_contact_title" name="kg_contact_title" placeholder="Your Title">
                                <div class="contact_error"></div>
                            </div>
                        </div>
                        <div class="kg_contact_col col-md-6">
                            <div class="kg_contact_inputWrap">
                                <label class="kg_contact_label"> Work Email<sup>*</sup> </label>
                                <input type="text" class="inputField" id="kg_contact_email" name="kg_contact_email" placeholder="Work Email">
                                <div class="contact_error"></div>
                            </div>
                        </div>  
                        <div class="kg_contact_col col-md-6">
                            <div class="kg_contact_inputWrap">
                                <label class="kg_contact_label"> Phone Number<sup>*</sup> </label>
                                <input type="text" class="inputField" id="kg_contact_phone" name="kg_contact_phone" placeholder="Your Phone">
                                <div class="contact_error"></div>
                            </div>
                        </div>  
                        <div class="kg_contact_col col-md-12">
                            <div class="kg_contact_inputWrap kg_contact_selectWrap kg_contact_multi_services">
                                <label class="kg_contact_label"> Select Service<sup>*</sup> </label>
                                <select id="kg_contact_services" nname="kg_contact_services[]" class="selectFieldl" multiple>
                                    <option value="" class="placeholder" disabled="">Select</option>
                                    <option value="Security Guard">Security Guard</option>
                                    <option value="Portable Surveillance System">Portable Surveillance System</option>
                                    <option value="Mobile Patrol">Mobile Patrol</option>
                                    <option value="Parking Enforcement">Parking Enforcement</option>
                                    <option value="Security Systems">Security Systems</option>
                                </select>
                                <div class="contact_error"></div>
                            </div>
                        </div>  
                        <div class="kg_contact_col col-md-12" id="kg_contact_parking_service_col">
                            <div class="kg_contact_inputWrap kg_contact_checkWrap"> 
                                <fieldset>
                                    <legend class="kg_contact_label">Parking Enforcement<sup>*</sup></legend>
                                    <ul class="kg_contact_checkbox_list">
                                        <li>
                                            <input type="checkbox" id="kg_contact_parking1" name="kg_contact_parking_services[]" value="Ticket Issuing">
                                            <label for="kg_contact_parking1">Ticket Issuing</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="kg_contact_parking2" name="kg_contact_parking_services[]" value="Towing Assistance">
                                            <label for="kg_contact_parking2">Towing Assistance</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="kg_contact_parking3" name="kg_contact_parking_services[]" value="Signage">
                                            <label for="kg_contact_parking3">Signage</label>
                                        </li>
                                    </ul>
                                    <div class="contact_error"></div>
                                </fieldset> 
                            </div>
                        </div>  
                        <div class="kg_contact_col col-md-12" id="kg_contact_security_service_col">
                            <div class="kg_contact_inputWrap kg_contact_checkWrap">
                                <fieldset>
                                    <legend class="kg_contact_label">Security Systems<sup>*</sup></legend>
                                    <ul class="kg_contact_checkbox_list">
                                        <li>
                                            <input type="checkbox" id="kg_contact_security1" name="kg_contact_security_services[]" value="Security Cameras" >
                                            <label for="kg_contact_security1">Security Cameras</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="kg_contact_security2" name="kg_contact_security_services[]" value="Siren" >
                                            <label for="kg_contact_security2">Siren</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="kg_contact_security3" name="kg_contact_security_services[]" value="Lights" >
                                            <label for="kg_contact_security3">Lights</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="kg_contact_security4" name="kg_contact_security_services[]" value="Access Control" >
                                            <label for="kg_contact_security4">Access Control</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="kg_contact_security5" name="kg_contact_security_services[]" value="Fobs" >
                                            <label for="kg_contact_security5">Fobs</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="kg_contact_security6" name="kg_contact_security_services[]" value="Automatic Doors" >
                                            <label for="kg_contact_security6">Automatic Doors</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="kg_contact_security7" name="kg_contact_security_services[]" value="Accessibility Buttons" >
                                            <label for="kg_contact_security7">Accessibility Buttons</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="kg_contact_security8" name="kg_contact_security_services[]" value="Facial Recognition" >
                                            <label for="kg_contact_security8">Facial Recognition</label>
                                        </li>
                                    </ul>
                                    <div class="contact_error"></div>
                                </fieldset>
                            </div>
                        </div>  
                        <div class="kg_contact_col col-md-12">
                            <div class="kg_contact_inputWrap kg_contact_selectWrap">
                                <label class="kg_contact_label"> Type of Site<sup>*</sup> </label>
                                <select id="kg_contact_site_types" name="kg_contact_site_types" class="selectField">
                                    <option value="" class="placeholder" disabled="" selected="selected">Select</option>
                                    <option value="Construction Site">Construction Site</option>
                                    <option value="Hotel">Hotel</option>
                                    <option value="Condominium">Condominium</option>
                                    <option value="Retail">Retail</option>
                                    <option value="Commercial">Commercial</option>
                                    <option value="Industrial">Industrial</option>
                                    <option value="Event Venue">Event Venue</option>
                                    <option value="Other">Other</option>
                                </select>
                                <div class="contact_error"></div>
                            </div>
                        </div>  
                        <div class="kg_contact_col col-md-12">
                            <div class="kg_contact_inputWrap kg_contact_selectWrap">
                                <label class="kg_contact_label"> Length of Cover  </label>
                                <select id="kg_contact_length_cover" name="kg_contact_length_cover" class="selectField">
                                    <option value="" class="placeholder" disabled selected>Select</option>
                                    <option value="1 to 5 Days">1 to 5 Days</option>
                                    <option value="Couple Weeks">Couple Weeks</option>
                                    <option value="Couple Months">Couple Months</option>
                                    <option value="6 to 12 Months">6 to 12 Months</option>
                                    <option value="1 Year +">1 Year +</option>
                                </select>
                                <div class="contact_error"></div>
                            </div>
                        </div>  
                        <div class="kg_contact_col col-md-12">
                            <div class="kg_contact_inputWrap kg_contact_inputWrap_textarea">
                                <label class="kg_contact_label"> Additional Information </label>
                                <textarea class="inputField" id="kg_contact_add_info" name="kg_contact_add_info" placeholder="Additional Information"></textarea>
                                <div class="contact_error"></div>
                            </div>
                        </div>  
                        <div class="kg_contact_col col-md-12">
                            <div class="kg_contact_captcha_Wrap">
                                <div class="g-recaptcha" data-callback="kg_contact_recaptchaCallback" data-sitekey="<?php echo esc_attr($site_key); ?>"></div>
                                <div class="contact_error"></div>
                            </div>
                        </div>
                        <div class="kg_contact_col col-md-12">
                            <div class="kg_contact_inputWrap">
                                <button type="submit" name="submit" class="btn-style gradientBtn">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="kg_contact_thankWrap">
                <h2>Confirmation</h2>
                <p>Thanks for contacting us! We will be in touch with you shortly.</p>
                <div class="backHome"><a class="btn-style" href="/">Back to Home</a></div>
            </div>
        </div>  
    </div> 
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <?php
    return ob_get_clean();
}

add_shortcode('contact_form', 'contact_form');

?>