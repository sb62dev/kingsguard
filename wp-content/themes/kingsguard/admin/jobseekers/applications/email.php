<?php  

// Function to create email html for user
function generate_applications_email_html($firstname, $lastname, $job_title) {
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
                                                                        <td valign="top"  class="ls_space_left_right" style="padding: 15px;color: #ffffff;">
                                                                            <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;border-collapse:collapse">
                                                                                <tr><td style="height: 10px;" height="10"></td></tr>
                                                                                <tr>
                                                                                    <td align="center" style="text-align: center;">  
                                                                                        <img src="https://kingsguard.ca/wp-content/uploads/2024/07/blue-logo-kings.png" alt="Kingsguard Security Logo" width="70px" height="85px"> 
                                                                                    </td>
                                                                                </tr> 
                                                                                <tr><td style="height: 15px;" height="15"></td></tr>
                                                                                <tr>
                                                                                    <td align="center" style="font-size: 26px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: center;font-style: normal;font-weight: bold;line-height: 125%;letter-spacing: normal;color: #ffffff;"> Thank You for Applying to KingsGuard Security </td>
                                                                                </tr>
                                                                                <tr><td style="height: 25px;" height="25"></td></tr>
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #ffffff;"> Dear {{first_name}} {{last_name}}, </td>
                                                                                </tr>
                                                                                <tr><td style="height: 10px;" height="10"></td></tr> 
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #ffffff;"> Thank you for applying for the {{job_title}} position at KingsGuard Security. We have received your application and appreciate your interest in joining our team. </td>
                                                                                </tr> 
                                                                                <tr><td style="height: 10px;" height="10"></td></tr> 
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #ffffff;"> Our team is currently reviewing all applications, and we will be in touch soon if your qualifications match our needs for the position. </td>
                                                                                </tr> 
                                                                                <tr><td style="height: 10px;" height="10"></td></tr> 
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #ffffff;"> We wish you the best of luck in your job search and appreciate your interest in our company. </td>
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

// Function to create email html for admin
function generate_admin_applications_email_html($firstname, $lastname, $job_id) {
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
                                                                        <td valign="top"  class="ls_space_left_right" style="padding: 15px;color: #ffffff;">
                                                                            <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;border-collapse:collapse">
                                                                                <tr><td style="height: 10px;" height="10"></td></tr>
                                                                                <tr>
                                                                                    <td align="center" style="text-align: center;">  
                                                                                        <img src="https://kingsguard.ca/wp-content/uploads/2024/07/blue-logo-kings.png" alt="Kingsguard Security Logo" width="70px" height="85px"> 
                                                                                    </td>
                                                                                </tr> 
                                                                                <tr><td style="height: 15px;" height="15"></td></tr>
                                                                                <tr>
                                                                                    <td align="center" style="font-size: 26px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: center;font-style: normal;font-weight: bold;line-height: 125%;letter-spacing: normal;color: #ffffff;"> New Job Application Received </td>
                                                                                </tr>
                                                                                <tr><td style="height: 25px;" height="25"></td></tr>
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #ffffff;"> Dear admin, </td>
                                                                                </tr>
                                                                                <tr><td style="height: 10px;" height="10"></td></tr> 
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #ffffff;">  
                                                                                        {{first_name}} {{last_name}} has applied against your job opening ({{job_title}}) at KingsGuard Security. Please login to your account to download the CV or check from the applicant's list from the dashboard.   
                                                                                    </td>
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
function send_applications_email($email, $firstname, $lastname, $job_title) {
    $subject = 'Thank You for Applying to KingsGuard Security';
    $message = generate_applications_email_html($firstname, $lastname, $job_title);

    // Replace placeholders with actual values 
    $message = str_replace('{{first_name}}', $firstname, $message);
    $message = str_replace('{{last_name}}', $lastname, $message);
    $message = str_replace('{{job_title}}', $job_title, $message);
    $headers = array('Content-Type: text/html; charset=UTF-8');
    wp_mail($email, $subject, $message, $headers);
}

// Function to send email to admin with replaced placeholders
function send_admin_applications_email($firstname, $lastname, $job_title) {
    $subject = 'New Job Application Received';
    $adminemail= ADMIN_EMAILS;
    $message = generate_admin_applications_email_html($firstname, $lastname, $job_title);

    // Replace placeholders with actual values 
    $message = str_replace('{{first_name}}', $firstname, $message);
    $message = str_replace('{{last_name}}', $lastname, $message);
    $message = str_replace('{{job_title}}', $job_title, $message);
    $headers = array('Content-Type: text/html; charset=UTF-8');
    wp_mail($adminemail, $subject, $message, $headers);
}

?>