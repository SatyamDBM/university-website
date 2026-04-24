@extends('layouts.app')

@section('content')

<div class="p-6">

    <h2 class="text-xl font-bold mb-6">Subscription History</h2>

    <div class="bg-white rounded-xl shadow border overflow-hidden">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-100 text-gray-600">
                <tr>
                    <th class="p-3">Package</th>
                    <th class="p-3">Start Date</th>
                    <th class="p-3">End Date</th>
                    <th class="p-3">Amount</th>
                    <th class="p-3">Payment</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($subscriptions as $sub)
                <tr class="border-t">

                    <td class="p-3 font-semibold">
                        {{ $sub->package->name ?? 'N/A' }}
                    </td>

                    <td class="p-3">
                        {{ $sub->start_date ? \Carbon\Carbon::parse($sub->start_date)->format('d M Y') : '-' }}
                    </td>

                    <td class="p-3">
                        {{ $sub->end_date ? \Carbon\Carbon::parse($sub->end_date)->format('d M Y') : '-' }}
                    </td>

                    <td class="p-3">
                        ₹{{ number_format($sub->final_amount) }}
                    </td>

                    <td class="p-3">
                        <span class="px-2 py-1 rounded text-xs
                            {{ $sub->payment_status == 'paid' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                            {{ ucfirst($sub->payment_status) }}
                        </span>
                    </td>

                    <td class="p-3">
                        @if($sub->status == 'active')
                            <span class="px-2 py-1 text-xs bg-green-500 text-white rounded">Active</span>
                        @elseif($sub->status == 'expired')
                            <span class="px-2 py-1 text-xs bg-red-500 text-white rounded">Expired</span>
                        @else
                            <span class="px-2 py-1 text-xs bg-gray-400 text-white rounded">Pending</span>
                        @endif
                    </td>

                    <td class="p-3">
                        <a href="{{ route('university.subscription.invoice', $sub->id) }}" class="text-blue-500 hover:text-blue-700">
                            Download Invoice
                        </a>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="7" class="p-4 text-center text-gray-500">
                        No subscription history found
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection