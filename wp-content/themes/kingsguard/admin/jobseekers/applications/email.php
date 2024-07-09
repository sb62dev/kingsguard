<?php  

// Function to create email html for user
function generate_applications_email_html($firstname, $lastname) {
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
                                                                                    <td align="center" style="font-size: 26px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: center;font-style: normal;font-weight: bold;line-height: 125%;letter-spacing: normal;color: #000000;"> Job Application </td>
                                                                                </tr>
                                                                                <tr><td style="height: 25px;" height="25"></td></tr>
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #555555;"> Dear {{first_name}} {{last_name}}, </td>
                                                                                </tr>
                                                                                <tr><td style="height: 10px;" height="10"></td></tr> 
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #555555;"> Thank you for applied for the job! We will contact you shortly. You can check the application status from the dashboard as well. </td>
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

// Function to create email html for admin
function generate_admin_applications_email_html($firstname, $lastname, $job_id) {
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
                                                                                    <td align="center" style="font-size: 26px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: center;font-style: normal;font-weight: bold;line-height: 125%;letter-spacing: normal;color: #000000;"> Job Application </td>
                                                                                </tr>
                                                                                <tr><td style="height: 25px;" height="25"></td></tr>
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #555555;"> Dear admin, </td>
                                                                                </tr>
                                                                                <tr><td style="height: 10px;" height="10"></td></tr> 
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #555555;">  
                                                                                        {{first_name}} {{last_name}} has applied against your job opening ({{job_title}}) at KingsGuard Security. Please login to your account to download the CV or check from the applicant's list from the dashboard.   
                                                                                    </td>
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

// Function to send email to user with replaced placeholders
function send_applications_email($email, $firstname, $lastname) {
    $subject = 'Job Application';
    $message = generate_applications_email_html($firstname, $lastname);

    // Replace placeholders with actual values 
    $message = str_replace('{{first_name}}', $firstname, $message);
    $message = str_replace('{{last_name}}', $lastname, $message);
    $headers = array('Content-Type: text/html; charset=UTF-8');
    wp_mail($email, $subject, $message, $headers);
}

// Function to send email to admin with replaced placeholders
function send_admin_applications_email($firstname, $lastname, $job_title) {
    $subject = 'Job Application';
    $email = 'neetu62dev@gmail.com';
    $message = generate_admin_applications_email_html($firstname, $lastname, $job_title);

    // Replace placeholders with actual values 
    $message = str_replace('{{first_name}}', $firstname, $message);
    $message = str_replace('{{last_name}}', $lastname, $message);
    $message = str_replace('{{job_title}}', $job_title, $message);
    $headers = array('Content-Type: text/html; charset=UTF-8');
    wp_mail($email, $subject, $message, $headers);
}

?>