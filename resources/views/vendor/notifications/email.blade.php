<!doctype html>
<html lang="en">
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
    <title>Mail đặt lại mật khẩu</title>
    <meta name="description" content="Mail đặt lại mật khẩu">
    <style type="text/css">
        a:hover {
            text-decoration: underline !important;
        }
    </style>
</head>

<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
<!--100% body table-->
<table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
       style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: 'Open Sans', sans-serif;">
    <tr>
        <td>
            <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0"
                   align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td style="height:80px;">&nbsp;</td>
                </tr>
{{--                <tr>--}}
{{--                    <td style="text-align:center;">--}}
{{--                        <a href="" title="logo" target="_blank">--}}
{{--                            <img width="60px" src="{{asset('assets/img/HYSLogo.png')}}" title="logoHYS"--}}
{{--                                 alt="logoCiTEdu">--}}
{{--                        </a>--}}
{{--                    </td>--}}
{{--                </tr>--}}
                <tr>
                    <td style="height:20px;">&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                               style="max-width:670px;background:#fff; border-radius:3px; text-align:left;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                            <tr>
                                <td style="height:40px;">&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="padding:0 35px;">
                                    <h1 style="color:#1e1e2d; font-weight:500; margin:0;font-size:32px;font-family:'Rubik',sans-serif;">
                                        Bạn có yêu cầu đặt lại mật khẩu</h1>
                                    <span style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:70%;"></span>
                                    <p style="color:red; font-size:15px;line-height:24px; margin:0;">
                                        Dưới đây là mật khẩu đăng nhập. Vui lòng không chia sẻ mật khẩu với bất kì ai và đổi mật khẩu ngay sau lần đăng nhập tiếp theo!
                                    </p>
                                    <div style="text-align: center">
                                        <div style="background:#20e277;text-decoration:none !important;
                                        font-weight:500; margin-top: 20px; margin-bottom: 20px ; color:#fff;
                                        font-size:15px;padding:10px 24px;display:inline-block;border-radius:50px;">
                                            <strong>{{$password}}</strong>
                                        </div>
                                    </div>
                                    <p style="color:#455056; font-size:15px;line-height:24px; margin:0;">
                                        Nếu bạn không yêu cầu đặt lại mật khẩu, vui lòng bỏ qua email này. <br>
                                    </p>
                                    <br>
                                    <p style="color:#455056; font-size:15px;line-height:24px; margin:0;">
                                        Trân trọng,<br>
                                        <strong>{{config('app.name')}}</strong>
                                    </p>

                                </td>
                            </tr>
                            <tr>
                                <td style="height:40px;">&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                <tr>
                    <td style="height:20px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align:center;">
                        <p style="font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">
                            &copy; <strong> {{now()->year}} {{config('app.name')}} . All rights reserved </strong></p>
                    </td>
                </tr>
                <tr>
                    <td style="height:80px;">&nbsp;</td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<!--/100% body table-->
</body>

</html>
