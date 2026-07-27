<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Reset Your GISBA Password</title>
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
              <h1 style="font-size:22px;color:#002150;margin:0 0 12px;">Reset Your Password</h1>
              <p style="font-size:15px;color:#444;line-height:1.7;margin:0 0 28px;">
                We received a request to reset the password for your GISBA members account. Click the button below to choose a new password.
              </p>

              <div style="text-align:center;margin:0 0 28px;">
                <a href="{{ $resetUrl }}"
                   style="display:inline-block;background:#002150;color:#fff;font-weight:700;font-size:16px;padding:14px 36px;border-radius:6px;text-decoration:none;letter-spacing:0.3px;">
                  Reset Password &rarr;
                </a>
              </div>

              <p style="font-size:13px;color:#888;line-height:1.6;margin:0 0 8px;">
                This link will expire in {{ $expireMinutes }} minutes.
              </p>
              <p style="font-size:13px;color:#888;line-height:1.6;margin:0;">
                If you did not request a password reset, no further action is required — your password will remain unchanged.
              </p>
            </td>
          </tr>

          <tr>
            <td style="padding:20px 40px 36px;border-top:1px solid #eee;">
              <p style="font-size:12px;color:#aaa;margin:0;line-height:1.6;">
                Need help? Contact us at <a href="{{ route('contact-us') }}" style="color:#002150;">{{ route('contact-us') }}</a>.<br />
                &copy; {{ date('Y') }} GISBA. All rights reserved.
              </p>
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>
</body>
</html>
