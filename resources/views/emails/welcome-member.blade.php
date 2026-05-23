<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Your GISBA Members Access</title>
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
              <h1 style="font-size:22px;color:#002150;margin:0 0 12px;">Welcome to GISBA Members!</h1>
              <p style="font-size:15px;color:#444;line-height:1.7;margin:0 0 28px;">
                Your payment was successful. Use the credentials below to log in and access the members-only library.
                @if($expiresAt)
                  Your 6-month access is valid until <strong>{{ $expiresAt }}</strong>.
                @endif
              </p>

              {{-- Credentials box --}}
              <table width="100%" cellpadding="0" cellspacing="0" style="background:#f8fafc;border:1px solid #e5e7eb;border-radius:8px;margin-bottom:28px;">
                <tr>
                  <td style="padding:24px 28px;">
                    <p style="margin:0 0 16px;font-size:13px;font-weight:700;color:#002150;text-transform:uppercase;letter-spacing:0.8px;">Your Login Credentials</p>

                    <table cellpadding="0" cellspacing="0">
                      <tr>
                        <td style="font-size:13px;color:#888;padding-right:16px;padding-bottom:10px;white-space:nowrap;">Email</td>
                        <td style="font-size:14px;color:#111;font-weight:600;padding-bottom:10px;">{{ $memberEmail }}</td>
                      </tr>
                      <tr>
                        <td style="font-size:13px;color:#888;padding-right:16px;white-space:nowrap;">Password</td>
                        <td style="font-size:14px;color:#111;font-weight:600;">
                          @if($password)
                            <span style="font-family:monospace;background:#fff;border:1px solid #ddd;padding:2px 8px;border-radius:4px;">{{ $password }}</span>
                          @else
                            <em style="color:#666;font-weight:400;">Use your existing password</em>
                          @endif
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>

              <div style="text-align:center;margin:0 0 28px;">
                <a href="{{ $loginUrl }}"
                   style="display:inline-block;background:#002150;color:#fff;font-weight:700;font-size:16px;padding:14px 36px;border-radius:6px;text-decoration:none;letter-spacing:0.3px;">
                  Log In to Members Library &rarr;
                </a>
              </div>

              @if($password)
              <p style="font-size:13px;color:#888;line-height:1.6;margin:0;">
                <strong>Tip:</strong> You can change your password after logging in via your profile settings.
              </p>
              @endif
            </td>
          </tr>

          <tr>
            <td style="padding:20px 40px 36px;border-top:1px solid #eee;">
              <p style="font-size:12px;color:#aaa;margin:0;line-height:1.6;">
                If you did not make this purchase, please contact <a href="mailto:support@gisba.net" style="color:#002150;">support@gisba.net</a>.<br />
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
