<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Banner Invoice #{{ $invoiceNo }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #2d2d2d;
            background: #fff;
            padding: 40px;
        }

        /* ── TOP HEADER ── */
        .top-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #6b4a36;
        }

        .brand-name {
            font-size: 22px;
            font-weight: bold;
            color: #6b4a36;
            letter-spacing: 1px;
        }

        .brand-sub {
            font-size: 10px;
            color: #888;
            margin-top: 3px;
        }

        .invoice-label { text-align: right; }

        .invoice-label .word {
            font-size: 28px;
            font-weight: bold;
            color: #6b4a36;
            letter-spacing: 4px;
        }

        .invoice-label .meta {
            font-size: 11px;
            color: #555;
            margin-top: 4px;
        }

        .status-badge {
            display: inline-block;
            padding: 3px 12px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            background: #d1fae5;
            color: #065f46;
        }

        /* ── INFO GRID ── */
        .info-grid {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 20px;
        }

        .info-box {
            flex: 1;
            background: #faf9f7;
            border: 1px solid #e8e0d8;
            border-radius: 8px;
            padding: 14px;
        }

        .info-box-title {
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #6b4a36;
            margin-bottom: 8px;
            padding-bottom: 6px;
            border-bottom: 1px solid #e8e0d8;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 4px;
        }

        .info-label { color: #888; font-size: 11px; }
        .info-value  { font-weight: bold; font-size: 11px; color: #2d2d2d; }

        /* ── CAMPAIGN STRIP ── */
        .campaign-strip {
            background: linear-gradient(135deg, #6b4a36, #8b6352);
            color: #fff;
            border-radius: 10px;
            padding: 14px 18px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cs-left .cs-label {
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            opacity: 0.75;
        }

        .cs-left .cs-name {
            font-size: 15px;
            font-weight: bold;
            margin-top: 3px;
        }

        .cs-right {
            text-align: right;
        }

        .cs-right .cs-label {
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 0.75;
        }

        .cs-right .cs-dates {
            font-size: 11px;
            font-weight: bold;
            margin-top: 3px;
        }

        /* ── TABLE ── */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .items-table thead tr {
            background: #6b4a36;
            color: #fff;
        }

        .items-table thead th {
            padding: 10px 12px;
            text-align: left;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .items-table tbody tr {
            border-bottom: 1px solid #f0ebe6;
        }

        .items-table tbody tr:nth-child(even) {
            background: #fdf9f7;
        }

        .items-table tbody td {
            padding: 10px 12px;
            font-size: 12px;
        }

        .items-table tfoot td {
            padding: 10px 12px;
            background: #faf9f7;
            border-top: 2px solid #6b4a36;
            font-weight: bold;
        }

        /* ── PAYMENT ROW ── */
        .payment-row {
            display: flex;
            gap: 14px;
            margin-bottom: 25px;
        }

        .payment-box {
            flex: 1;
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 8px;
            padding: 12px 14px;
        }

        .payment-box .p-title {
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #065f46;
            margin-bottom: 4px;
        }

        .payment-box .p-value {
            font-size: 11px;
            font-weight: bold;
            color: #2d2d2d;
        }

        /* ── FOOTER ── */
        .footer {
            border-top: 1px solid #e8e0d8;
            padding-top: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer-note { font-size: 10px; color: #aaa; }
        .footer-brand { font-size: 11px; font-weight: bold; color: #6b4a36; }
    </style>
</head>
<body>

    {{-- TOP HEADER --}}
    <div class="top-header">
        <div>
            <div class="brand-name">{{ strtoupper(config('app.name')) }}</div>
            <div class="brand-sub">University Discovery Platform</div>
        </div>
        <div class="invoice-label">
            <div class="word">INVOICE</div>
            <div class="meta"># {{ $invoiceNo }}</div>
            <div class="meta">{{ now()->format('d M Y') }}</div>
            <div style="margin-top:6px;">
                <span class="status-badge">Paid</span>
            </div>
        </div>
    </div>

    {{-- BILLED TO + INVOICE DETAILS --}}
    <div class="info-grid">
        <div class="info-box">
            <div class="info-box-title">Billed To</div>
            <div style="font-size:13px; font-weight:bold; margin-bottom:4px;">
                {{ $banner->university->name ?? '—' }}
            </div>
            @if($banner->university?->email)
            <div style="color:#555; font-size:11px;">{{ $banner->university->email }}</div>
            @endif
        </div>

        <div class="info-box">
            <div class="info-box-title">Invoice Details</div>
            <div class="info-row">
                <span class="info-label">Invoice No</span>
                <span class="info-value">{{ $invoiceNo }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Issue Date</span>
                <span class="info-value">{{ now()->format('d M Y') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Paid At</span>
                <span class="info-value">
                    {{ \Carbon\Carbon::parse($banner->paid_at)->format('d M Y H:i') }}
                </span>
            </div>
            <div class="info-row">
                <span class="info-label">Payment Mode</span>
                <span class="info-value">Razorpay</span>
            </div>
        </div>
    </div>

    {{-- CAMPAIGN STRIP --}}
    <div class="campaign-strip">
        <div class="cs-left">
            <div class="cs-label">Campaign Name</div>
            <div class="cs-name">{{ $banner->campaign_name }}</div>
        </div>
        <div class="cs-right">
            <div class="cs-label">Campaign Period</div>
            <div class="cs-dates">
                {{ \Carbon\Carbon::parse($banner->start_date)->format('d M Y') }}
                &nbsp;→&nbsp;
                {{ \Carbon\Carbon::parse($banner->end_date)->format('d M Y') }}
            </div>
        </div>
    </div>

    {{-- ITEMS TABLE --}}
    <table class="items-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Description</th>
                <th>Banner Slot</th>
                <th>Duration</th>
                <th style="text-align:right;">Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>01</td>
                <td>
                    <strong>Banner Advertisement</strong><br>
                    <span style="color:#888; font-size:10px;">{{ $banner->campaign_name }}</span>
                </td>
                <td>{{ $banner->banner->name ?? '—' }}</td>
                <td>
                    {{ \Carbon\Carbon::parse($banner->start_date)->format('d M') }}
                    –
                    {{ \Carbon\Carbon::parse($banner->end_date)->format('d M Y') }}
                </td>
                <td style="text-align:right; font-weight:bold;">
                    ₹{{ number_format($banner->price, 2) }}
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" style="text-align:right; color:#555; font-weight:normal;">Subtotal</td>
                <td style="text-align:right;">₹{{ number_format($banner->price, 2) }}</td>
            </tr>
            <tr>
                <td colspan="4" style="text-align:right; color:#6b4a36; font-size:13px;">
                    <strong>Total Paid</strong>
                </td>
                <td style="text-align:right; color:#6b4a36; font-size:14px;">
                    <strong>₹{{ number_format($banner->price, 2) }}</strong>
                </td>
            </tr>
        </tfoot>
    </table>

    {{-- PAYMENT INFO --}}
    <div class="payment-row">
        <div class="payment-box">
            <div class="p-title">✅ Payment ID</div>
            <div class="p-value">{{ $banner->razorpay_payment_id ?? 'N/A' }}</div>
        </div>
        <div class="payment-box">
            <div class="p-title">🏢 Banner Slot</div>
            <div class="p-value">{{ $banner->banner->slot_name ?? $banner->banner->name ?? '—' }}</div>
        </div>
        <div class="payment-box">
            <div class="p-title">💳 Status</div>
            <div class="p-value" style="color:#065f46;">Paid</div>
        </div>
    </div>

    {{-- FOOTER --}}
    <div class="footer">
        <div class="footer-note">
            Thank you for advertising with us. This is a computer-generated invoice.
        </div>
        <div class="footer-brand">{{ config('app.name') }}</div>
    </div>

</body>
</html>