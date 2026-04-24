<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $subscription->id }}</title>
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

        .invoice-label {
            text-align: right;
        }

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

        /* ── STATUS BADGE ── */
        .status-badge {
            display: inline-block;
            padding: 3px 12px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .status-paid {
            background: #d1fae5;
            color: #065f46;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        /* ── INFO GRID ── */
        .info-grid {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 25px;
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

        .info-label {
            color: #888;
            font-size: 11px;
        }

        .info-value {
            font-weight: bold;
            font-size: 11px;
            color: #2d2d2d;
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

        .items-table tfoot tr {
            background: #faf9f7;
            border-top: 2px solid #6b4a36;
        }

        .items-table tfoot td {
            padding: 10px 12px;
            font-weight: bold;
        }

        /* ── TOTAL BOX ── */
        .total-section {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 25px;
        }

        .total-box {
            background: #6b4a36;
            color: #fff;
            border-radius: 10px;
            padding: 16px 24px;
            min-width: 220px;
            text-align: right;
        }

        .total-label {
            font-size: 10px;
            opacity: 0.8;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .total-amount {
            font-size: 24px;
            font-weight: bold;
            margin-top: 4px;
        }

        /* ── PAYMENT INFO ── */
        .payment-row {
            display: flex;
            gap: 16px;
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
            font-size: 12px;
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

        .footer-note {
            font-size: 10px;
            color: #aaa;
        }

        .footer-brand {
            font-size: 11px;
            font-weight: bold;
            color: #6b4a36;
        }

        /* ── VALIDITY STRIP ── */
        .validity-strip {
            background: #fdf5ec;
            border: 1px solid #e8c99a;
            border-radius: 8px;
            padding: 10px 14px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .validity-strip .vs-label {
            font-size: 10px;
            color: #92400e;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .validity-strip .vs-dates {
            font-size: 11px;
            color: #6b4a36;
            font-weight: bold;
        }
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
            <div class="meta"># INV-{{ str_pad($subscription->id, 5, '0', STR_PAD_LEFT) }}</div>
            <div class="meta">{{ $subscription->created_at->format('d M Y') }}</div>
            <div style="margin-top:6px;">
                <span class="status-badge {{ $subscription->payment_status === 'paid' ? 'status-paid' : 'status-pending' }}">
                    {{ ucfirst($subscription->payment_status) }}
                </span>
            </div>
        </div>
    </div>

    {{-- BILLED TO + INVOICE DETAILS --}}
    <div class="info-grid">
        <div class="info-box">
            <div class="info-box-title">Billed To</div>
            <div style="font-size:13px; font-weight:bold; margin-bottom:4px;">{{ $user->name }}</div>
            <div style="color:#555; font-size:11px;">{{ $user->email }}</div>
            @if(!empty($user->mobile))
            <div style="color:#555; font-size:11px; margin-top:2px;">{{ $user->mobile }}</div>
            @endif
        </div>

        <div class="info-box">
            <div class="info-box-title">Invoice Details</div>
            <div class="info-row">
                <span class="info-label">Invoice No</span>
                <span class="info-value"># INV-{{ str_pad($subscription->id, 5, '0', STR_PAD_LEFT) }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Issue Date</span>
                <span class="info-value">{{ $subscription->created_at->format('d M Y') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Payment Date</span>
                <span class="info-value">{{ $subscription->updated_at->format('d M Y') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Payment Mode</span>
                <span class="info-value">Razorpay</span>
            </div>
        </div>
    </div>

    {{-- PLAN VALIDITY STRIP --}}
    <div class="validity-strip">
        <div class="vs-label">📅 Plan Validity</div>
        <div class="vs-dates">
            {{ \Carbon\Carbon::parse($subscription->start_date)->format('d M Y') }}
            &nbsp;→&nbsp;
            {{ \Carbon\Carbon::parse($subscription->end_date)->format('d M Y') }}
            &nbsp;·&nbsp;
            {{ $subscription->total_days ?? '' }} Days
        </div>
    </div>

    {{-- ITEMS TABLE --}}
    <table class="items-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Package</th>
                <th>Coverage</th>
                <th>Duration</th>
                <th style="text-align:right;">Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>01</td>
                <td>
                    <strong>{{ ucfirst($package->name) }}</strong><br>
                    <span style="color:#888; font-size:10px;">Featured Listing Package</span>
                </td>
                <td>{{ ucfirst(str_replace('_',' ', $package->coverage_type ?? 'Standard')) }}</td>
                <td>{{ $package->duration }} {{ $package->duration_type }}</td>
                <td style="text-align:right; font-weight:bold;">
                    ₹{{ number_format($subscription->final_amount, 2) }}
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" style="text-align:right; color:#555;">Subtotal</td>
                <td style="text-align:right;">₹{{ number_format($subscription->final_amount, 2) }}</td>
            </tr>
            <tr>
                <td colspan="4" style="text-align:right; font-size:13px; color:#6b4a36;">
                    <strong>Total Paid</strong>
                </td>
                <td style="text-align:right; font-size:14px; color:#6b4a36;">
                    <strong>₹{{ number_format($subscription->final_amount, 2) }}</strong>
                </td>
            </tr>
        </tfoot>
    </table>

    {{-- PAYMENT INFO --}}
    <div class="payment-row">
        <div class="payment-box">
            <div class="p-title">✅ Payment ID</div>
            <div class="p-value">{{ $subscription->razorpay_payment_id ?? 'N/A' }}</div>
        </div>
        <div class="payment-box">
            <div class="p-title">🔗 Order ID</div>
            <div class="p-value">{{ $subscription->razorpay_order_id ?? 'N/A' }}</div>
        </div>
        <div class="payment-box">
            <div class="p-title">💳 Status</div>
            <div class="p-value" style="color:#065f46;">{{ ucfirst($subscription->payment_status) }}</div>
        </div>
    </div>

    {{-- FOOTER --}}
    <div class="footer">
        <div class="footer-note">
            Thank you for your business. This is a computer-generated invoice.
        </div>
        <div class="footer-brand">{{ config('app.name') }}</div>
    </div>

</body>
</html>