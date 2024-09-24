<?php  

// Function to create email html
function generate_newsletter_user_email_html() {
    ob_start();
    ?>
    <html>
        <head>
            <meta charset="UTF-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" /> 
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <style type="text/css"> 
                table {
                    border-collapse: collapse;
                    border-spacing: 0;
                }  
                a {
                    border: 0 !important;
                    outline: 0 !important;
                    box-shadow: none !important;
                } 
                @media(min-width: 500px) {
                    .space_left_right {
                        padding: 50px !important;
                    }  
                    .ls_space_left_right {
                        padding: 30px !important;
                    }
                } 
            </style>
        </head>
        <body>
            <table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" style="border-collapse:collapse;height:100%;margin:0;padding:0;width:100%;background-color:#eeeeee">
                <tbody>
                    <tr>
                        <td align="center" valign="top" class="space_left_right" style="height:100%;margin:0;padding:0;width:100%">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;border:0;max-width:600px!important">
                                <tbody>
                                    <tr>
                                        <td valign="top" style="background-color:#000000;border-top:0;border:1px solid #ffffff;padding-top:0;padding-bottom:0px">
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;border-collapse:collapse">
                                                <tbody>
                                                    <tr>
                                                        <td valign="top">
                                                            <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;border-collapse:collapse">
                                                                <tbody>
                                                                    <tr>
                                                                        <td valign="top" class="ls_space_left_right" style="padding: 15px;color: #ffffff;">
                                                                            <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;border-collapse:collapse">
                                                                                <tr><td style="height: 10px;" height="10"></td></tr>
                                                                                <tr>
                                                                                    <td align="center" style="text-align: center;">  
                                                                                        <img src="https://kingsguard.ca/wp-content/uploads/2024/07/blue-logo-kings.png" alt="Kingsguard Security Logo" width="70px" height="85px"> 
                                                                                    </td>
                                                                                </tr> 
                                                                                <tr><td style="height: 15px;" height="15"></td></tr>
                                                                                <tr>
                                                                                    <td align="center" style="font-size: 26px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: center;font-style: normal;font-weight: bold;line-height: 125%;letter-spacing: normal;color: #ffffff;"> Thank you for subscribing to our newsletter! </td>
                                                                                </tr> 
                                                                                <tr><td style="height: 15px;" height="15"></td></tr> 
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #ffffff;"> If you ever have any questions or need assistance, feel free to reach out to us at info@kingsguard.ca. </td>
                                                                                </tr> 
                                                                                <tr><td style="height: 15px;" height="15"></td></tr>  
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #ffffff;"> Thank you once again for subscribing. Stay tuned for our next newsletter! </td>
                                                                                </tr>
                                                                                <tr><td style="height: 35px;" height="35"></td></tr>  
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #ffffff;"> <strong style="color: #ffffff;">Best regards,</strong><br>KingsGuard Security Team </td>
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

// Function to create admin html
function generate_newsletter_admin_email_html($email) {
    ob_start();
    ?>
    <html>
        <head>
            <meta charset="UTF-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" /> 
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <style type="text/css"> 
                table {
                    border-collapse: collapse;
                    border-spacing: 0;
                }  
                a {
                    border: 0 !important;
                    outline: 0 !important;
                    box-shadow: none !important;
                } 
                @media(min-width: 500px) {
                    .space_left_right {
                        padding: 50px !important;
                    }  
                    .ls_space_left_right {
                        padding: 30px !important;
                    }
                } 
            </style>
        </head>
        <body>
            <table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" style="border-collapse:collapse;height:100%;margin:0;padding:0;width:100%;background-color:#eeeeee">
                <tbody>
                    <tr>
                        <td align="center" valign="top" class="space_left_right" style="height:100%;margin:0;padding:0;width:100%">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;border:0;max-width:600px!important">
                                <tbody>
                                    <tr>
                                        <td valign="top" style="background-color:#000000;border-top:0;border:1px solid #ffffff;padding-top:0;padding-bottom:0px">
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;border-collapse:collapse">
                                                <tbody>
                                                    <tr>
                                                        <td valign="top">
                                                            <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;border-collapse:collapse">
                                                                <tbody>
                                                                    <tr>
                                                                        <td valign="top" class="ls_space_left_right" style="padding: 15px;color: #ffffff;">
                                                                            <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;border-collapse:collapse">
                                                                                <tr><td style="height: 10px;" height="10"></td></tr>
                                                                                <tr>
                                                                                    <td align="center" style="text-align: center;">  
                                                                                        <img src="https://kingsguard.ca/wp-content/uploads/2024/07/blue-logo-kings.png" alt="Kingsguard Security Logo" width="70px" height="85px"> 
                                                                                    </td>
                                                                                </tr> 
                                                                                <tr><td style="height: 15px;" height="15"></td></tr>
                                                                                <tr>
                                                                                    <td align="center" style="font-size: 26px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: center;font-style: normal;font-weight: bold;line-height: 125%;letter-spacing: normal;color: #ffffff;"> Newsletter Subscription</td>
                                                                                </tr>
                                                                                <tr><td style="height: 25px;" height="25"></td></tr>
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #ffffff;"> Dear Admin, </td>
                                                                                </tr>
                                                                                <tr><td style="height: 15px;" height="15"></td></tr> 
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #ffffff;"> We have a new subscriber to the KingsGuard Security newsletter! Subscriber Details: </td>
                                                                                </tr> 
                                                                                <tr><td style="height: 15px;" height="15"></td></tr>  
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #ffffff;"> <strong> Email: </strong> {{email}} </td>
                                                                                </tr> 
                                                                                <tr><td style="height: 15px;" height="15"></td></tr> 
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #ffffff;"> This subscriber will now receive our latest updates, news, and special promotions. </td>
                                                                                </tr> 
                                                                                <tr><td style="height: 35px;" height="35"></td></tr>  
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #ffffff;"> <strong style="color: #ffffff;">Best regards,</strong><br>KingsGuard Security Team </td>
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

// Function to send email to user with replaced placeholders
function send_newsletter_user_email($email) {
    $subject = 'Welcome to KingsGuard Security Newsletter!';
    $message = generate_newsletter_user_email_html();  
    send_email_via_outlook_api([$email], $subject, $message);  
}

// Function to send email to admin with replaced placeholders
function send_newsletter_admin_email($email) {
    $subject = 'New Newsletter Subscription!';
    $adminemail= ADMIN_EMAILS;
    $message = generate_newsletter_admin_email_html($email);
    // Replace placeholders with actual values  
    $message = str_replace('{{email}}', $email, $message);   
    send_email_via_outlook_api($adminemail, $subject, $message); 
}

?>