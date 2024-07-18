<?php  

// Function to create email html for applicant rejected status
function generate_applicant_rejected_email_html($firstname, $lastname, $Job_title) {
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
                                                                        <td valign="top" class="ls_space_left_right" style="padding: 15px;color: #555555;">
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
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #555555;"> Thank you for taking the time to consider Kingsguard. Our hiring team reviewed your application and we’d like to inform you that we are not able to advance you to the next round for the {{job_title}} position at this time. </td>
                                                                                </tr> 
                                                                                <tr><td style="height: 10px;" height="10"></td></tr> 
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #555555;"> We encourage you to apply again in the future, if you find an open role at our company that suits you. </td>
                                                                                </tr> 
                                                                                <tr><td style="height: 10px;" height="10"></td></tr> 
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #555555;"> Thank you again for applying to Kingsguard and we wish you all the best in your job search. </td>
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

// Function to create email html for applicant approved status
function generate_applicant_approved_email_html($firstname, $lastname, $job_title) {
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
            <table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" style="border-collapse:collapse;height:100%;margin:0;padding:0;width:100%;background-color:#e9eaec">
                <tbody>
                    <tr>
                        <td align="center" valign="top" class="space_left_right" style="height:100%;margin:0;padding:25px 15px;width:100%">
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
                                                                        <td valign="top" class="ls_space_left_right" style="padding: 15px;color: #555555;">
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
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #555555;"> Thank you for taking the time to consider Kingsguard. Our hiring team reviewed your application and we are pleased to inform you that you have advanced to the next round for the {{job_title}} position. </td>
                                                                                </tr>  
                                                                                <tr><td style="height: 10px;" height="10"></td></tr> 
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #555555;"> Thank you again for applying to Kingsguard. </td>
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

// Function to send email to applicant rejected status
function send_applicant_rejected_email($email, $firstname, $lastname, $job_title) {
    $subject = 'Your Job Application Status!';
    $message = generate_applicant_rejected_email_html($firstname, $lastname, $job_title);

    // Replace placeholders with actual values 
    $message = str_replace('{{first_name}}', $firstname, $message);
    $message = str_replace('{{last_name}}', $lastname, $message);
    $message = str_replace('{{job_title}}', $job_title, $message);
    $headers = array('Content-Type: text/html; charset=UTF-8');
    wp_mail($email, $subject, $message, $headers);
}

// Function to send email to applicant approved status
function send_applicant_approved_email($email, $firstname, $lastname, $job_title) {
    $subject = 'Your Job Application Status!'; 
    $message = generate_applicant_approved_email_html($firstname, $lastname, $job_title);

    // Replace placeholders with actual values 
    $message = str_replace('{{first_name}}', $firstname, $message);
    $message = str_replace('{{last_name}}', $lastname, $message);
    $message = str_replace('{{job_title}}', $job_title, $message);
    $headers = array('Content-Type: text/html; charset=UTF-8');
    wp_mail($email, $subject, $message, $headers);
}

?>