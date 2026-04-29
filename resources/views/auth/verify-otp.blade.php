@extends('layouts.website')
@section('content')

<div style="max-width:420px; margin:80px auto; background:#fff; border-radius:16px; padding:40px; box-shadow:0 4px 24px rgba(0,0,0,0.08);">

    <div style="text-align:center; margin-bottom:24px;">
        <div style="font-size:48px;">📧</div>
        <h2 style="font-size:22px; font-weight:700; color:#2d2d2d; margin-top:8px;">Verify Your Email</h2>
        <p style="color:#888; font-size:14px; margin-top:6px;">
            We sent a 6-digit OTP to<br>
            <strong style="color:#6b4a36;">{{ $email }}</strong>
        </p>
    </div>

    {{-- Errors --}}
    @if($errors->any())
    <div style="background:#fef2f2; border:1px solid #fca5a5; border-radius:8px; padding:12px; margin-bottom:16px;">
        @foreach($errors->all() as $error)
            <p style="color:#dc2626; font-size:13px; margin:0;">⚠ {{ $error }}</p>
        @endforeach
    </div>
    @endif

    {{-- Success --}}
    @if(session('success'))
    <div style="background:#f0fdf4; border:1px solid #86efac; border-radius:8px; padding:12px; margin-bottom:16px;">
        <p style="color:#16a34a; font-size:13px; margin:0;">✅ {{ session('success') }}</p>
    </div>
    @endif

    <form method="POST" action="{{ route('otp.verify') }}">
        @csrf

        {{-- ✅ email session se aa raha hai --}}
<input type="hidden" name="user_id" value="{{ $user_id }}">
        <div style="margin-bottom:20px;">
            <label style="display:block; font-size:13px; font-weight:600; color:#555; margin-bottom:6px;">
                Enter 6-digit OTP
            </label>
            <input type="text"
       name="otp"
       maxlength="6"
       pattern="\d{6}"
       inputmode="numeric"
       required>
        </div>

        <button type="submit"
                style="width:100%; background:#6b4a36; color:#fff; border:none; padding:14px; border-radius:10px; font-size:15px; font-weight:600; cursor:pointer;">
            ✅ Verify OTP
        </button>

    </form>

    {{-- Resend OTP --}}
    <form method="POST" action="{{ route('otp.resend') }}" style="margin-top:16px; text-align:center;">
        @csrf
<input type="hidden" name="user_id" value="{{ $user_id }}">        <button type="submit"
                style="background:none; border:none; color:#6b4a36; font-size:13px; font-weight:600; cursor:pointer; text-decoration:underline;">
            Didn't receive OTP? Resend
        </button>
    </form>

    <p style="text-align:center; font-size:12px; color:#aaa; margin-top:20px;">
        OTP expires in 10 minutes
    </p>

</div>

@endsection