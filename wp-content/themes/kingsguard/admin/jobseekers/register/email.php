<?php 

// Function to verify email
function verify_jobseekers_email() {
    if (isset($_GET['verify']) && isset($_GET['email'])) {
        global $wpdb;

        $verification_token = sanitize_text_field($_GET['verify']);
        $email = sanitize_email($_GET['email']);

        if (!empty($verification_token) && !empty($email)) {
            $user = $wpdb->get_row($wpdb->prepare(
                "SELECT * FROM {$wpdb->prefix}custom_jobseekers WHERE email = %s AND verification_token = %s",
                $email, $verification_token
            ));

            if ($user) {
                $wpdb->update(
                    $wpdb->prefix . 'custom_jobseekers',
                    array('email_verified' => 1, 'verification_token' => ''),
                    array('id' => $user->id)
                );
                wp_redirect(home_url('/register?email-verification-success'));
                exit;
            }
        }
        wp_redirect(home_url('/register?email-verification-failed'));
        exit;
    }
}

add_action('template_redirect', 'verify_jobseekers_email'); 

// Function to create email html
function generate_email_html($firstname, $lastname, $verification_link) {
    ob_start();
    ?>
    <html>
        <body>
            <table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" style="border-collapse:collapse;height:100%;margin:0;padding:0;width:100%;background-color:#e9eaec">
                <tbody>
                    <tr>
                        <td align="center" valign="top" style="height:100%;margin:0;padding:50px 50px;width:100%">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;border:0;max-width:600px!important">
                                <tbody>
                                    <tr>
                                        <td valign="top" style="background-color:#ffffff;border-top:0;border:1px solid #c1c1c1;padding-top:0;padding-bottom:0px">
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;border-collapse:collapse">
                                                <tbody>
                                                    <tr>
                                                        <td valign="top">
                                                            <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;border-collapse:collapse">
                                                                <tbody>
                                                                    <tr>
                                                                        <td valign="top" style="padding-top:30px;padding-right:30px;padding-bottom:30px;padding-left:30px;color: #555555;">
                                                                            <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;border-collapse:collapse">
                                                                                <tr><td style="height: 10px;" height="10"></td></tr>
                                                                                <tr>
                                                                                    <td align="center" style="text-align: center;">  
                                                                                        <img src="https://kingsguardsecurity.ca/wp-content/uploads/2024/07/blue-logo-kings.png" alt="Kingsguard Security Logo" width="70px" height="85px"> 
                                                                                    </td>
                                                                                </tr> 
                                                                                <tr><td style="height: 15px;" height="15"></td></tr>
                                                                                <tr>
                                                                                    <td align="center" style="font-size: 26px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: center;font-style: normal;font-weight: bold;line-height: 125%;letter-spacing: normal;color: #000000;"> Thank you for registering! </td>
                                                                                </tr>
                                                                                <tr><td style="height: 25px;" height="25"></td></tr>
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #555555;"> Dear {{first_name}} {{last_name}}, </td>
                                                                                </tr>
                                                                                <tr><td style="height: 10px;" height="10"></td></tr> 
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #555555;"> Please verify your email address to complete your registration: </td>
                                                                                </tr>
                                                                                <tr><td style="height: 20px;" height="20"></td></tr> 
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #555555;"> 
                                                                                        <a href="{{verification_link}}" style="display: inline-block; padding: 10px 20px; background-color: #0098FF; color: #ffffff; text-decoration: none; border-radius: 5px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;">Verify Email Address </a> 
                                                                                    </td>
                                                                                </tr>
                                                                                <tr><td style="height: 35px;" height="35"></td></tr>  
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #555555;"> If you did not request this verification, you can safely ignore this email. </td>
                                                                                </tr>
                                                                                <tr><td style="height: 35px;" height="35"></td></tr>  
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #555555;"> <strong style="color: #000;">Best regards,</strong><br>Kingsguard Team </td>
                                                                                </tr>
                                                                                <tr><td style="height: 10px;" height="10"></td></tr>   
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="top" style="background-color:#e9eaec;border-top:0;border-bottom:0;padding-top:12px;padding-bottom:12px">
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;border-collapse:collapse">
                                                <tbody>
                                                    <tr>
                                                        <td valign="top">
                                                            <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;border-collapse:collapse">
                                                                <tbody>
                                                                    <tr>
                                                                        <td valign="top" style="padding-top:9px;padding-right:18px;padding-bottom:9px;padding-left:18px;word-break:break-word;color:#aaa;font-family:Helvetica;font-size:12px;line-height:150%;text-align:center">
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </body>
    </html>
    <?php
    return ob_get_clean();
}

// Function to send email with replaced placeholders
function send_verification_email($email, $firstname, $lastname, $verification_link) {
    $subject = 'Email Verification';
    $message = generate_email_html($firstname, $lastname, $verification_link);

    // Replace placeholders with actual values
    $message = str_replace('{{verification_link}}', $verification_link, $message);
    $message = str_replace('{{first_name}}', $firstname, $message);
    $message = str_replace('{{last_name}}', $lastname, $message);
    $headers = array('Content-Type: text/html; charset=UTF-8');
    wp_mail($email, $subject, $message, $headers);
}

?>