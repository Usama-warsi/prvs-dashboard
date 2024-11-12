<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PRVS Dashboard</title>
</head>

<body class="bb-bg-body"
    style="margin: 0; padding: 0; font-size: 14px; line-height: 171.4285714286%; mso-line-height-rule: exactly; color: #3A4859; width: 100%; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; -webkit-font-feature-settings: 'cv02', 'cv03', 'cv04', 'cv11'; font-feature-settings: 'cv02', 'cv03', 'cv04', 'cv11'; font-family: Inter, -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; background-color: #f6f7f9;">

    <center>
        <table class="bb-main bb-bg-body" width="100%" cellspacing="0" cellpadding="0"
            style="font-family: Inter, -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; border-collapse: collapse; width: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; background-color: #f6f7f9;">
            <tbody>
                <tr>
                    <td align="center" valign="top"
                        style="font-family: Inter, -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;">
                        <table class="bb-wrap" cellspacing="0" cellpadding="0"
                            style="font-family: Inter, -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; border-collapse: collapse; width: 100%; max-width: 640px; text-align: left; -premailer-cellpadding: 0; -premailer-cellspacing: 0;">
                            <tbody>
                                <tr>
                                    <td class="bb-p-sm"
                                        style="font-family: Inter, -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; padding: 8px;">
                                    

                                        <div class="bb-main-content">
                                            <table class="bb-box" cellpadding="0" cellspacing="0"
                                                style="font-family: Inter, -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; border-collapse: collapse; width: 100%; background: #ffffff; border-radius: 4px; -webkit-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05); box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05); border: 1px solid #dce0e5; -premailer-cellpadding: 0; -premailer-cellspacing: 0;">
                                                <tbody>
                                                    <tr>
                                                        <td class="bb-content bb-pb-0" align="center"
                                                            style="font-family: Inter, -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; padding: 40px 48px; padding-bottom: 0;">
                                                            <table class="bb-icon bb-icon-lg bb-bg-blue" cellspacing="0"
                                                                cellpadding="0"
                                                                style="font-family: Inter, -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; padding: 0; border-radius: 50%;  line-height: 100%; font-weight: 300; border-collapse: separate; text-align: center; width: 100px; height: 100px; font-size: 48px; color: #ffffff; -premailer-cellpadding: 0; -premailer-cellspacing: 0;">
                                                                <tbody>
                                                                    <tr>
                                                                        <td valign="middle" align="center"
                                                                            style="font-family: Inter, -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;">
                                                                            <a href="http://localhost/wow/public"
                                                                            style="color: ; text-decoration: none;">
                                                                            <img class="bb-logo"
                                                                                src="http://localhost/wow/public/storage/file66acf6b7390a2-site-logo.png"
                                                                                alt="PRVS Dashboard"
                                                                                style="line-height: 100%; outline: none; text-decoration: none; vertical-align: baseline; font-size: 0; border: 0 none; max-height: 80px;">
                                                                        </a>   
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <h1 class="bb-text-center bb-m-0 bb-mt-md"
                                                                style="font-weight: 600; color: #232b42; font-size: 28px; line-height: 130%; text-align: center; margin: 0; margin-top: 16px;">
                                                                Congratulation, you Got a new Report From PRVS
                                                                Dashboard!</h1>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bb-content"
                                                            style="font-family: Inter, -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; padding: 40px 48px;">
                                                            <p style="margin: 0 0 1em;">Dear {{$data['name']}},</p>
                                                            <div>Your Request Report is here on the behalf of
                                                                <strong>{{$sessn['ssn_number']}}</strong> SSN Number</div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bb-content bb-pt-0"
                                                            style="font-family: Inter, -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; padding: 40px 48px; padding-top: 0;">
                                                            <table class="bb-row bb-mb-md" cellpadding="0"
                                                                cellspacing="0"
                                                                style="font-family: Inter, -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; border-collapse: collapse; width: 100%; table-layout: fixed; margin-bottom: 16px; -premailer-cellpadding: 0; -premailer-cellspacing: 0;">
                                                                <tbody>
                                                                    @if(!empty($tenantDataArray))
                                                                    <tr>
                                                                        <td class="bb-bb-col"
                                                                            style="font-family: Inter, -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;">
                                                                            <h3 class="bb-m-0"
                                                                                style="font-weight: 600; color: #232b42;  margin: 0;">
                                                                                General Information</h3>
                                                                                <br>
                                                                                <table style="border:1px solid" border="1px" width="100%">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>Item</th>
                                                                                            <th>Value</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td>Name: </td>
                                                                                            <td>{{$tenantDataArray['name'] ?? '-'}}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Phone:</td>
                                                                                            <td>{{$tenantDataArray['phone'] ?? '-'}}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Email:</td>
                                                                                            <td>{{$tenantDataArray['email'] ?? '-'}}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Date Of Birth:</td>
                                                                                            <td>{{$tenantDataArray['dob'] ?? '-'}}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Last Updated: </td>
                                                                                            <td>{{$tenantDataArray['updated_at'] ?? '-'}}</td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                          
                                                                        </td>
                                                                    </tr>
                                                                   @if($sessn['credit_report'] == 'true')
                                                                   <tr>
                                                                        <td class="bb-bb-col"
                                                                            style="font-family: Inter, -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;">
                                                                           <br>
                                                                            <h3 class="bb-m-0"
                                                                                style="font-weight: 600; color: #232b42;  margin: 0;">
                                                                                Credit Score Information</h3>
                                                                                <br>
                                                                                <table style="border:1px solid" border="1px" width="100%">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th width="50%">Credit Score</th>
                                                                                            <th  width="50%">{{$tenantDataArray['credit_score'] ?? '-'}}</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                
                                                                                </table>
                                                                          
                                                                        </td>
                                                                    </tr>
                                                                   @endif
                                                                   @if($sessn['background_check'] == 'true')
                                                                   <tr>
                                                                        <td class="bb-bb-col"
                                                                            style="font-family: Inter, -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;">
                                                                           <br>
                                                                            <h3 class="bb-m-0"
                                                                                style="font-weight: 600; color: #232b42;  margin: 0;">
                                                                                Criminal Background Information</h3>
                                                                                <br>
                                                                                <table style="border:1px solid" border="1px" width="100%">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th >Criminal Background</th>
                                                                                           
                                                                                        </tr>
                                                                                    </thead>
                                                                                
                                                                                </table>
                                                                          
                                                                        </td>
                                                                    </tr>
                                                                    @endif
                                                                    @else
<tr><th>No Record Found On behalf of <strong style="color:red">{{$sessn['ssn_number']}}</strong> this SSN Number</th></tr>

                                                                    @endif
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>

                                        <table cellspacing="0" cellpadding="0"
                                            style="font-family: Inter, -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; border-collapse: collapse; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0;">
                                            <tbody>
                                                <tr>
                                                    <td class="bb-py-xl"
                                                        style="font-family: Inter, -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; padding-top: 48px; padding-bottom: 48px;">
                                                        <table class="bb-text-center bb-text-muted" cellspacing="0"
                                                            cellpadding="0"
                                                            style="font-family: Inter, -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; border-collapse: collapse; width: 100%; color: #667382; text-align: center; -premailer-cellpadding: 0; -premailer-cellspacing: 0;">
                                                            <tbody>

                                                                <tr>
                                                                    <td class="bb-px-lg"
                                                                        style="font-family: Inter, -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; padding-right: 24px; padding-left: 24px;">
                                                                        Copyright PRVS 2024
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <!-- <td class="bb-pt-md" style="font-family: Inter, -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; padding-top: 16px;">
                                If you have any questions, feel free to message us at <a href="mailto:demo@example.com" style="color: #206bc4; text-decoration: none;">demo@example.com</a>.
                            </td> -->
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
    </center>

</body>

</html>
