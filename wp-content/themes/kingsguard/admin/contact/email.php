<?php  

// Function to create email html
function generate_contact_user_email_html($name) {
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
                                            <td valign="top" style="background-color:#000000;color: #ffffff;border-top:0;border:1px solid #c1c1c1;padding-top:0;padding-bottom:0px">
                                                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;border-collapse:collapse">
                                                    <tbody>
                                                        <tr>
                                                            <td valign="top">
                                                                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;border-collapse:collapse">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td valign="top" class="ls_space_left_right" style="padding: 15px;color: #ffffff;">
                                                                                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;border-collapse:collapse">
                                                                                    <tr>
                                                                                        <td style="height: 10px;" height="10"></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td align="center" style="text-align: center;">
                                                                                            <img src="https://kingsguard.ca/wp-content/uploads/2024/07/blue-logo-kings.png" alt="Kingsguard Security Logo" width="70px" height="85px">
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td style="height: 15px;" height="15"></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td align="center" style="font-size: 26px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: center;font-style: normal;font-weight: bold;line-height: 125%;letter-spacing: normal;color: #ffffff;"> We Received Your Request! </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td style="height: 25px;" height="25"></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #ffffff;"> Dear {{name}}, </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td style="height: 15px;" height="15"></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #ffffff;"> Thank you for requesting a quote from KingsGuard Security. We are thrilled to have the opportunity to provide you with our top-notch security services. Below, you will find an overview of the comprehensive security solutions we offer to meet your specific needs. </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td style="height: 25px;" height="25"></td>
                                                                                    </tr> 
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td valign="top">
                                                                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;border-collapse:collapse">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td valign="top" >
                                                                                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;border-collapse:collapse"> 
                                                                                    <tr>
                                                                                        <td align="left" style=""><a href="https://kingsguard.ca/" target="_blank"><img src="https://kingsguard.ca/wp-content/themes/kingsguard/admin/assets/images/quote_banner.png" style="width: 100%" width="100%" alt="Image"></a></td>
                                                                                    </tr> 
                                                                                    <tr>
                                                                                        <td style="height: 40px;" height="40"></td>
                                                                                    </tr> 
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td valign="top">
                                                                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;border-collapse:collapse">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td valign="top" class="ls_space_left_right" style="padding: 15px;color: #ffffff;">
                                                                                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;border-collapse:collapse">  
                                                                                    <tr>
                                                                                        <td align="left" width="25" style="width:25px"></td>
                                                                                        <td align="center" style="padding: 0 7px;"><img src="https://kingsguard.ca/wp-content/themes/kingsguard/admin/assets/images/Costco.jpg" style="width: 70px" width="70" alt="Image"></td>
                                                                                        <td align="center" style="padding: 0 7px;"><img src="https://kingsguard.ca/wp-content/themes/kingsguard/admin/assets/images/Grand-River-Foods.jpg" style="width: 60px" width="60" alt="Image"></td>
                                                                                        <td align="center" style="padding: 0 7px;"><img src="https://kingsguard.ca/wp-content/themes/kingsguard/admin/assets/images/Ellis-Don.jpg" style="width: 140px" width="140" alt="Image"></td>
                                                                                        <td align="center" style="padding: 0 7px;"><img src="https://kingsguard.ca/wp-content/themes/kingsguard/admin/assets/images/Crowne-Plaza.jpg" style="width: 90px" width="90" alt="Image"></td>
                                                                                        <td align="left" width="25" style="width:25px"></td>
                                                                                    </tr> 
                                                                                    <tr>
                                                                                        <td style="height: 10px;" height="10"></td>
                                                                                    </tr> 
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td valign="top">
                                                                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;border-collapse:collapse">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td valign="top" class="ls_space_left_right" style="padding: 15px;color: #ffffff;">
                                                                                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;border-collapse:collapse">  
                                                                                    <tr> 
                                                                                        <td align="center" style="width: 30%;font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: center;color: #ffffff;"><img src="https://kingsguard.ca/wp-content/themes/kingsguard/admin/assets/images/email-icon-1.jpg" style="width: 45px" width="45" alt="Image"><p style="font-size: 15px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: center;color: #ffffff;margin: 20px 0 0;font-weight: 600;"> Advanced Electronic Reports </p></td>
                                                                                        <td align="center" style="width: 30%;font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: center;color: #ffffff;padding: 0 5px;" width="30%"><img src="https://kingsguard.ca/wp-content/themes/kingsguard/admin/assets/images/email-icon-2.jpg" style="width: 45px" width="45" alt="Image"><p style="font-size: 15px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: center;color: #ffffff;margin: 20px 0 0;font-weight: 600;"> 24/7 <br> Dispatch </p></td>
                                                                                        <td align="center" style="width: 30%;font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: center;color: #ffffff;" width="30%"><img src="https://kingsguard.ca/wp-content/themes/kingsguard/admin/assets/images/email-icon-3.jpg" style="width: 45px" width="45" alt="Image"><p style="font-size: 15px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: center;color: #ffffff;margin: 20px 0 0;font-weight: 600;"> Customer <br> Satisfaction </p></td> 
                                                                                    </tr> 
                                                                                    <tr>
                                                                                        <td style="height: 40px;" height="40"></td>
                                                                                    </tr> 
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td valign="top">
                                                                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;border-collapse:collapse">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td valign="top" class="ls_space_left_right" style="padding: 15px;color: #ffffff;">
                                                                                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;border-collapse:collapse">  
                                                                                    <tr> 
                                                                                        <td align="left" style="width: 30%;font-size: 12px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #ffffff;"><img src="https://kingsguard.ca/wp-content/themes/kingsguard/admin/assets/images/email-ftr-icon-1.jpg" style="width: 12px;margin-right: 3px;vertical-align: middle;" width="12" alt="Image"><span style="font-size: 12px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #ffffff;margin: 20px 0 0;">info@kingsguard.ca</span></td>
                                                                                        <td align="left" style="width: 2%;" width="2%"></td>
                                                                                        <td align="left" style="width: 30%;font-size: 12px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #ffffff;"><img src="https://kingsguard.ca/wp-content/themes/kingsguard/admin/assets/images/email-ftr-icon-2.jpg" style="width: 12px;margin-right: 3px;vertical-align: middle;" width="12" alt="Image"><span style="font-size: 12px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #ffffff;margin: 20px 0 0;">1241 Strasburg Rd, Unit 205 Kitchener, ON, N2R1S6</span></td>
                                                                                        <td align="left" style="width: 2%;" width="2%"></td>
                                                                                        <td align="left" style="width: 24%;font-size: 12px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #ffffff;"><img src="https://kingsguard.ca/wp-content/themes/kingsguard/admin/assets/images/email-ftr-icon-3.jpg" style="width: 12px;margin-right: 3px;vertical-align: middle;" width="12" alt="Image"><span style="font-size: 12px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #ffffff;margin: 20px 0 0;">www.kingsguard.ca</span></td>
                                                                                    </tr> 
                                                                                    <tr>
                                                                                        <td style="height: 10px;" height="10"></td>
                                                                                    </tr> 
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
function generate_contact_admin_email_html($name,$email,$phone,$service,$parkingservice,$securityservice,$sitetype,$addinfo) {
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
                                                                                    <td align="center" style="font-size: 26px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: center;font-style: normal;font-weight: bold;line-height: 125%;letter-spacing: normal;color: #ffffff;"> Customer Enquiry Form </td>
                                                                                </tr>
                                                                                <tr><td style="height: 25px;" height="25"></td></tr>
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #ffffff;"> Dear Admin, </td>
                                                                                </tr>
                                                                                <tr><td style="height: 15px;" height="15"></td></tr> 
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #ffffff;"> New enquiry form submitted, here are the customer enquiry form fields: </td>
                                                                                </tr> 
                                                                                <tr><td style="height: 15px;" height="15"></td></tr>  
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #ffffff;"> <strong> Name: </strong> {{name}} </td>
                                                                                </tr>
                                                                                <tr><td style="height: 2px;" height="2"></td></tr>  
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #ffffff;"> <strong> Email: </strong> {{email}} </td>
                                                                                </tr>
                                                                                <tr><td style="height: 2px;" height="2"></td></tr>  
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #ffffff;"> <strong> Phone: </strong> {{phone}} </td>
                                                                                </tr>
                                                                                <tr><td style="height: 2px;" height="2"></td></tr>  
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #ffffff;"> <strong> Service: </strong> {{service}} </td>
                                                                                </tr>
                                                                                <tr><td style="height: 2px;" height="2"></td></tr>  
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #ffffff;"> <strong> Parking Enforcement Service: </strong> {{parkingservice}} </td>
                                                                                </tr>
                                                                                <tr><td style="height: 2px;" height="2"></td></tr>  
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #ffffff;"> <strong> Security Systems Service: </strong> {{securityservice}} </td>
                                                                                </tr>
                                                                                <tr><td style="height: 2px;" height="2"></td></tr> 
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #ffffff;"> <strong> Type of Site: </strong> {{sitetype}} </td>
                                                                                </tr>
                                                                                <tr><td style="height: 2px;" height="2"></td></tr>  
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #ffffff;"> <strong> Additional Information: </strong> {{addinfo}} </td>
                                                                                </tr>
                                                                                <tr><td style="height: 2px;" height="2"></td></tr>  
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

// Function to send email to user with replaced placeholders
function send_contact_user_email($email, $name) {
    $subject = 'Quote Form!';
    $message = generate_contact_user_email_html($name);

    // Replace placeholders with actual values 
    $message = str_replace('{{name}}', $name, $message);  
    send_email_via_outlook_api([$email], $subject, $message);  
}

// Function to send email to admin with replaced placeholders
function send_contact_admin_email($name,$email,$phone,$service,$parkingservice,$securityservice,$sitetype,$addinfo) {
    $subject = 'Quote Form!';
    $adminemail= ADMIN_EMAILS_QUOTE;
    $message = generate_contact_admin_email_html($name,$email,$phone,$service,$parkingservice,$securityservice,$sitetype,$addinfo);

    // Replace placeholders with actual values 
    $message = str_replace('{{name}}', $name, $message); 
    $message = str_replace('{{email}}', $email, $message);  
    $message = str_replace('{{phone}}', $phone, $message); 
    $message = str_replace('{{service}}', $service, $message); 
    $message = str_replace('{{parkingservice}}', $parkingservice, $message); 
    $message = str_replace('{{securityservice}}', $securityservice, $message); 
    $message = str_replace('{{sitetype}}', $sitetype, $message); 
    $message = str_replace('{{addinfo}}', $addinfo, $message);   
    send_email_via_outlook_api($adminemail, $subject, $message); 
}

?>