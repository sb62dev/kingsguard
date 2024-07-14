<?php  

// Function to create email html
function generate_contact_user_email_html($name) {
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
                                                                                    <td align="center" style="font-size: 26px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: center;font-style: normal;font-weight: bold;line-height: 125%;letter-spacing: normal;color: #000000;"> Thank You for Reaching Out! </td>
                                                                                </tr>
                                                                                <tr><td style="height: 25px;" height="25"></td></tr>
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #555555;"> Dear {{name}}, </td>
                                                                                </tr>
                                                                                <tr><td style="height: 15px;" height="15"></td></tr> 
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #555555;"> We appreciate your enquiry and have received your request. Our team will review your message and get back to you as soon as possible. </td>
                                                                                </tr> 
                                                                                <tr><td style="height: 15px;" height="15"></td></tr>  
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #555555;"> Thank you for your patience and understanding. </td>
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

// Function to create admin html
function generate_contact_admin_email_html($name,$email,$title,$phone,$service,$parkingservice,$securityservice,$sitetype,$lengthcover,$addinfo) {
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
                                                                                    <td align="center" style="font-size: 26px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: center;font-style: normal;font-weight: bold;line-height: 125%;letter-spacing: normal;color: #000000;"> Customer Enquiry Form </td>
                                                                                </tr>
                                                                                <tr><td style="height: 25px;" height="25"></td></tr>
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #555555;"> Dear Admin, </td>
                                                                                </tr>
                                                                                <tr><td style="height: 15px;" height="15"></td></tr> 
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #555555;"> New enquiry form submitted, here are the customer enquiry form fields: </td>
                                                                                </tr> 
                                                                                <tr><td style="height: 15px;" height="15"></td></tr>  
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #555555;"> <strong> Name: </strong> {{name}} </td>
                                                                                </tr>
                                                                                <tr><td style="height: 2px;" height="2"></td></tr>  
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #555555;"> <strong> Email: </strong> {{email}} </td>
                                                                                </tr>
                                                                                <tr><td style="height: 2px;" height="2"></td></tr>  
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #555555;"> <strong> Title: </strong> {{title}} </td>
                                                                                </tr>
                                                                                <tr><td style="height: 2px;" height="2"></td></tr>  
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #555555;"> <strong> Phone: </strong> {{phone}} </td>
                                                                                </tr>
                                                                                <tr><td style="height: 2px;" height="2"></td></tr>  
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #555555;"> <strong> Service: </strong> {{service}} </td>
                                                                                </tr>
                                                                                <tr><td style="height: 2px;" height="2"></td></tr>  
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #555555;"> <strong> Parking Enforcement Service: </strong> {{parkingservice}} </td>
                                                                                </tr>
                                                                                <tr><td style="height: 2px;" height="2"></td></tr>  
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #555555;"> <strong> Security Systems Service: </strong> {{securityservice}} </td>
                                                                                </tr>
                                                                                <tr><td style="height: 2px;" height="2"></td></tr> 
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #555555;"> <strong> Type of Site: </strong> {{sitetype}} </td>
                                                                                </tr>
                                                                                <tr><td style="height: 2px;" height="2"></td></tr>  
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #555555;"> <strong> Length of Cover: </strong> {{lengthcover}} </td>
                                                                                </tr>
                                                                                <tr><td style="height: 2px;" height="2"></td></tr>  
                                                                                <tr>
                                                                                    <td align="left" style="font-size: 14px;font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;text-align: left;color: #555555;"> <strong> Additional Information: </strong> {{addinfo}} </td>
                                                                                </tr>
                                                                                <tr><td style="height: 2px;" height="2"></td></tr>  
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
function send_contact_user_email($email, $name) {
    $subject = 'Quote Form!';
    $message = generate_contact_user_email_html($name);

    // Replace placeholders with actual values 
    $message = str_replace('{{name}}', $name, $message); 
    $headers = array('Content-Type: text/html; charset=UTF-8');
    wp_mail($email, $subject, $message, $headers);
}

// Function to send email to admin with replaced placeholders
function send_contact_admin_email($name,$email,$title,$phone,$service,$parkingservice,$securityservice,$sitetype,$lengthcover,$addinfo) {
    $subject = 'Quote Form!';
    $adminemail= 'sb62dev@gmail.com';
    $message = generate_contact_admin_email_html($name,$email,$title,$phone,$service,$parkingservice,$securityservice,$sitetype,$lengthcover,$addinfo);

    // Replace placeholders with actual values 
    $message = str_replace('{{name}}', $name, $message); 
    $message = str_replace('{{email}}', $email, $message); 
    $message = str_replace('{{title}}', $title, $message); 
    $message = str_replace('{{phone}}', $phone, $message); 
    $message = str_replace('{{service}}', $service, $message); 
    $message = str_replace('{{parkingservice}}', $parkingservice, $message); 
    $message = str_replace('{{securityservice}}', $securityservice, $message); 
    $message = str_replace('{{sitetype}}', $sitetype, $message); 
    $message = str_replace('{{lengthcover}}', $lengthcover, $message); 
    $message = str_replace('{{addinfo}}', $addinfo, $message); 
    $headers = array('Content-Type: text/html; charset=UTF-8');
    wp_mail($adminemail, $subject, $message, $headers);
}

?>