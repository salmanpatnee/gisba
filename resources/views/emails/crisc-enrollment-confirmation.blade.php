<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>You're enrolled — CRISC Online Course</title>
</head>
<body style="margin:0;padding:0;background:#f4f4f4;font-family:'Segoe UI',Arial,sans-serif;">
  <table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f4f4;padding:40px 20px;">
    <tr>
      <td align="center">
        <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:8px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,0.08);">

          <tr>
            <td style="background:#002150;padding:28px 40px;text-align:center;">
              <span style="font-size:22px;font-weight:900;color:#c8a84b;letter-spacing:1px;">GISBA</span>
              <span style="font-size:12px;color:rgba(255,255,255,0.7);display:block;margin-top:4px;">Global Reach in Consulting &amp; Training</span>
            </td>
          </tr>

          <tr>
            <td style="padding:40px 40px 20px;">
              <h1 style="font-size:22px;color:#002150;margin:0 0 12px;">You're enrolled in the CRISC Online Course!</h1>
              <p style="font-size:15px;color:#444;line-height:1.7;margin:0 0 28px;">
                Hi {{ $enrollment->name }}, thanks for enrolling — your payment of {{ $enrollment->currency }} {{ number_format((float) $enrollment->amount, 2) }} was successful. Your seat is confirmed, and a free copy of <em>CRISC and Beyond</em> is reserved for you.
              </p>

              {{-- Schedule box --}}
              <table width="100%" cellpadding="0" cellspacing="0" style="background:#f8fafc;border:1px solid #e5e7eb;border-radius:8px;margin-bottom:28px;">
                <tr>
                  <td style="padding:24px 28px;">
                    <p style="margin:0 0 16px;font-size:13px;font-weight:700;color:#002150;text-transform:uppercase;letter-spacing:0.8px;">Course Schedule</p>

                    <table cellpadding="0" cellspacing="0">
                      <tr>
                        <td style="font-size:13px;color:#888;padding-right:16px;padding-bottom:10px;white-space:nowrap;">Date</td>
                        <td style="font-size:14px;color:#111;font-weight:600;padding-bottom:10px;">{{ optional($settings->crisc_date)->format('F j, Y') }}</td>
                      </tr>
                      <tr>
                        <td style="font-size:13px;color:#888;padding-right:16px;white-space:nowrap;">Time</td>
                        <td style="font-size:14px;color:#111;font-weight:600;">{{ $settings->crisc_time_start }} &ndash; {{ $settings->crisc_time_end }} ({{ $settings->crisc_timezone }})</td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>

              <p style="font-size:13px;color:#888;line-height:1.6;margin:0;">
                We'll send joining instructions closer to the date. If you have any questions in the meantime, just reply to this email.
              </p>
            </td>
          </tr>

          <tr>
            <td style="background:#f8fafc;padding:20px 40px;text-align:center;border-top:1px solid #e5e7eb;">
              <span style="font-size:11px;color:#999;">&copy; {{ now()->year }} GISBA. All rights reserved.</span>
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>
</body>
</html>
