@extends('layouts.site')

@section('title', 'My Account | GISBA Members')
@section('meta_description', 'View your GISBA membership details and update your account password.')

@section('banner')
  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
    <span><i class="bi bi-person-circle me-2"></i>My Account</span>
    <div class="d-flex gap-3 align-items-center">
      <a href="{{ route('members.chapters.index') }}"><i class="bi bi-arrow-left me-1"></i>Library</a>
      <a href="{{ route('home') }}"><i class="bi bi-house me-1"></i>Home</a>
      <form method="POST" action="{{ route('members.logout') }}" style="margin:0;">
        @csrf
        <button type="submit" style="background:none;border:none;padding:0;color:inherit;cursor:pointer;font-size:inherit;"><i class="bi bi-box-arrow-right me-1"></i>Log Out</button>
      </form>
    </div>
  </div>
@endsection

@section('footer_tagline')
  GISBA Members — Manage Your Account<br />
  View your membership status and update your password.
@endsection

@section('content')

<section style="padding:64px 0;">
  <div class="container">
    <div style="max-width:640px;margin:0 auto;">

      @if(session('success'))
        <div style="background:#f0fdf4;border:1px solid #bbf7d0;border-radius:8px;padding:14px 18px;margin-bottom:24px;">
          <p style="margin:0;font-size:14px;color:#15803d;"><i class="bi bi-check-circle me-2"></i>{{ session('success') }}</p>
        </div>
      @endif

      @if ($errors->any())
        <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:8px;padding:14px 18px;margin-bottom:24px;">
          @foreach ($errors->all() as $error)
            <p style="margin:0;font-size:14px;color:#dc2626;"><i class="bi bi-exclamation-circle me-2"></i>{{ $error }}</p>
          @endforeach
        </div>
      @endif

      {{-- Account info card --}}
      <div style="background:#fff;border:1px solid #e5e7eb;border-radius:10px;padding:32px;margin-bottom:32px;">
        <h2 style="font-family:var(--font-display);font-size:1.3rem;color:var(--navy);font-weight:800;margin-bottom:20px;">Account Information</h2>
        <p style="margin:0 0 12px;font-size:14px;color:#374151;"><strong>Email:</strong> {{ $user->email }}</p>

        @php
          $expiresAt = $user->memberExpiresAt();
          $expiringSoon = $user->isExpiringWithinDays(14);
        @endphp

        @if($expiresAt)
          <p style="margin:0;font-size:14px;color:#374151;">
            <strong>Membership expires:</strong> {{ $expiresAt->format('F j, Y') }}
          </p>
          @if($expiringSoon)
            <div style="margin-top:14px;background:#fffbeb;border:1px solid #fde68a;border-radius:8px;padding:12px 16px;">
              <p style="margin:0;font-size:13.5px;color:#92400e;">
                <i class="bi bi-exclamation-triangle me-2"></i>
                Your membership expires soon. <a href="{{ route('members.paywall') }}" style="color:#92400e;text-decoration:underline;">Renew your membership</a> to keep access.
              </p>
            </div>
          @endif
        @endif
      </div>

      {{-- Password update form --}}
      <div style="background:#fff;border:1px solid #e5e7eb;border-radius:10px;padding:32px;">
        <h2 style="font-family:var(--font-display);font-size:1.3rem;color:var(--navy);font-weight:800;margin-bottom:20px;">Change Password</h2>
        <form method="POST" action="{{ route('members.account.password') }}">
          @csrf
          @method('PUT')

          <div style="margin-bottom:20px;">
            <label style="display:block;font-size:13px;font-weight:600;color:#374151;margin-bottom:6px;">Current Password</label>
            <input
              type="password"
              name="current_password"
              required
              autocomplete="current-password"
              style="width:100%;padding:10px 14px;border:1px solid #d1d5db;border-radius:6px;font-size:15px;color:#111;outline:none;box-sizing:border-box;"
              placeholder="••••••••••••"
            />
          </div>
          <div style="margin-bottom:20px;">
            <label style="display:block;font-size:13px;font-weight:600;color:#374151;margin-bottom:6px;">New Password</label>
            <input
              type="password"
              name="password"
              required
              autocomplete="new-password"
              style="width:100%;padding:10px 14px;border:1px solid #d1d5db;border-radius:6px;font-size:15px;color:#111;outline:none;box-sizing:border-box;"
              placeholder="••••••••••••"
            />
          </div>
          <div style="margin-bottom:28px;">
            <label style="display:block;font-size:13px;font-weight:600;color:#374151;margin-bottom:6px;">Confirm New Password</label>
            <input
              type="password"
              name="password_confirmation"
              required
              autocomplete="new-password"
              style="width:100%;padding:10px 14px;border:1px solid #d1d5db;border-radius:6px;font-size:15px;color:#111;outline:none;box-sizing:border-box;"
              placeholder="••••••••••••"
            />
          </div>

          <button
            type="submit"
            style="width:100%;background:var(--navy);color:#fff;font-weight:700;font-size:16px;padding:13px;border:none;border-radius:6px;cursor:pointer;letter-spacing:0.3px;">
            Update Password
          </button>
        </form>
      </div>

    </div>
  </div>
</section>

@endsection
