<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width" />
        <style type="text/css">
            @media only screen and (max-width: 550px), screen and (max-device-width: 550px) {
                body[yahoo] .buttonwrapper { background-color: transparent !important; }
                body[yahoo] .button { padding: 0 !important; }
                body[yahoo] .button a { background-color: #de4b39; padding: 15px 25px !important; }
            }

            @media only screen and (min-device-width: 601px) {
                .content { width: 600px !important; }
                .col387 { width: 387px !important; }
            }
        </style>
    </head>
    <body bgcolor="#252d2f" style="margin: 0; padding: 0;" yahoo="fix">
        <!--[if (gte mso 9)|(IE)]>
        <table width="600" align="center" cellpadding="0" cellspacing="0" border="0">
          <tr>
            <td>
        <![endif]-->
        <table align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; width: 100%; max-width: 600px;" class="content">
            <tr>
                <td align="center" style="padding: 20px 20px 20px 20px; color: #ffffff; font-family: Arial, sans-serif; font-size: 36px; font-weight: bold;">
                   
                </td>
            </tr>
            <tr>
                <td align="center" bgcolor="#ffffff" style="padding: 20px 20px 0 20px; color: #555555; font-family: Arial, sans-serif; font-size: 20px; line-height: 30px;">
                    <p>Hi, {{ $mailData["name"] }}</p>
                    <b>Forgot your password?</b>
                </td>
            </tr>
            <tr>
                <td align="center" bgcolor="#ffffff" style="padding: 0 20px 40px 20px; color: #777777; font-family: Arial, sans-serif; font-size: 18px; line-height: 30px; border-bottom: 1px solid #f6f6f6;">
                    Don't worry, let's get you a new one!
                </td>
            </tr>
            <tr>
                <td align="center" bgcolor="#f9f9f9" style="padding: 30px 20px 30px 20px; font-family: Arial, sans-serif;">
                    <p style="color: #252d2f; font-size: 20px;">You password reset code is</p>
                    <table bgcolor="#de4b39" border="0" cellspacing="0" cellpadding="0" class="buttonwrapper">
                        <tr>
                            <td align="center" height="55" style=" padding: 0 35px 0 35px; font-family: Arial, sans-serif; font-size: 22px;" class="button">
                                <a href="#" style="color: #ffffff; text-align: center; text-decoration: none;">{{ $mailData["code"] }}</a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td align="center" bgcolor="#ffffff" style="padding: 20px 20px 20px 20px; color: #555555; font-family: Arial, sans-serif; font-size: 15px; line-height: 24px;">
                    Contact the website administrator if you didn't request to reset your password.
                </td>
            </tr>
            <tr>
                <td align="center" bgcolor="#e9e9e9" style="padding: 12px 10px 12px 10px; color: #888888; font-family: Arial, sans-serif; font-size: 12px; line-height: 18px;">
                    {{-- <b>Company Inc.</b> | 355 Example St. &bull; Suite A9 &bull; Syndey, Australia --}}
                </td>
            </tr>
        </table>
        <!--[if (gte mso 9)|(IE)]>
                </td>
            </tr>
        </table>
        <![endif]-->
    </body>
</html>