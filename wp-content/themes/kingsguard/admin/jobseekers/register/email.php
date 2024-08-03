<?php  

// Function to create email html
function generate_email_html($firstname, $lastname, $verification_link) {
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
                        <td align="center" valign="top" class="space_left_right" style="height:100%;margin:0;padding:25px 15px;width:100%">
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
                                                                                        <img src="https://kingsguardsecurity.ca/wp-content/uploads/2024/07/blue-logo-kings.png" alt="Kingsguard Security Logo" width="70px" height="85px"> 
                                                                                    </td>
                                                                                </tr> 
                                                                                <tr><td style="height: 15px;" height="15"></td></tr>
                                                                                <tr>
                                                                                    <td align="center" style="font-size: 26px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: center;font-style: normal;font-weight: bold;line-height: 125%;letter-spacing: normal;color: #ffffff;"> Thank you for registering! </td>
                                                                                </tr>
                                                                                <tr><td style="height: 25px;" height="25"></td></tr>
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #ffffff;"> Dear {{first_name}} {{last_name}}, </td>
                                                                                </tr>
                                                                                <tr><td style="height: 10px;" height="10"></td></tr> 
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #ffffff;"> Please verify your email address to complete your registration: </td>
                                                                                </tr>
                                                                                <tr><td style="height: 25px;" height="25"></td></tr> 
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #ffffff;"> 
                                                                                        <a href="{{verification_link}}" style="display: inline-block; padding: 10px 20px; background-color: #0098FF; color: #ffffff; text-decoration: none; border-radius: 5px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;">Verify Email Address</a> 
                                                                                    </td>
                                                                                </tr>
                                                                                <tr><td style="height: 25px;" height="25"></td></tr>  
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #ffffff;"> If you did not request this verification, you can safely ignore this email. </td>
                                                                                </tr>
                                                                                <tr><td style="height: 35px;" height="35"></td></tr>  
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #ffffff;"> <strong style="color: #ffffff;">Best regards,</strong><br>KingsGuard Security Team</td>
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