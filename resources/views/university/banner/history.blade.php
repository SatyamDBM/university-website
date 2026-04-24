@extends('layouts.app')

@section('content')

<div class="p-6">

    <h1 class="text-2xl font-bold mb-6">Banner Payment History</h1>

    <div class="bg-white rounded-xl shadow border border-gray-200 overflow-hidden">

        <table class="w-full text-sm">
            <thead class="bg-gray-100 text-gray-600">
                <tr>
                    <th class="p-3 text-left">Campaign</th>
                    <th class="p-3 text-left">Banner</th>
                    <th class="p-3 text-left">Price</th>
                    <th class="p-3 text-left">Start</th>
                    <th class="p-3 text-left">End</th>
                    <th class="p-3 text-left">Payment</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Paid At</th>
                </tr>
            </thead>
            <tbody>
                @forelse($banners as $item)
                <tr class="border-t">

                    <td class="p-3">
                        {{ $item->campaign_name }}
                    </td>

                    <td class="p-3">
                        {{ $item->banner->name ?? '-' }}
                    </td>

                    <td class="p-3">
                        ₹{{ number_format($item->price) }}
                    </td>

                    <td class="p-3">
                        {{ \Carbon\Carbon::parse($item->start_date)->format('d M Y') }}
                    </td>

                    <td class="p-3">
                        {{ \Carbon\Carbon::parse($item->end_date)->format('d M Y') }}
                    </td>

                    <td class="p-3">
                        @if($item->payment_status === 'paid')
                            <span class="text-green-600 font-semibold">Paid</span>
                        @else
                            <span class="text-yellow-500">Pending</span>
                        @endif
                    </td>

                    <td class="p-3">
                        <span class="text-xs px-2 py-1 rounded 
                            @if($item->live_status === 'live') bg-green-100 text-green-700
                            @elseif($item->live_status === 'scheduled') bg-blue-100 text-blue-700
                            @else bg-gray-100 text-gray-600
                            @endif">
                            {{ ucfirst($item->live_status) }}
                        </span>
                    </td>

                    <td class="p-3">
                        {{ $item->paid_at ? \Carbon\Carbon::parse($item->paid_at)->format('d M Y H:i') : '-' }}
                        @if($item->payment_status === 'paid')
                            <a href="{{ route('university.banners.invoice', $item->id) }}"
                            class="text-blue-600 text-xs underline">
                            Download Invoice
                            </a>
                        @endif
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="8" class="p-4 text-center text-gray-400">
                        No banner history found
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>

    </div>

    <div class="mt-4">
        {{ $banners->links() }}
    </div>

</div>

@endsection