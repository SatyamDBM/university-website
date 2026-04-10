<div class="space-y-4">
    <div class="rounded-xl overflow-hidden border">
        <img
            src="{{ asset('storage/' . $record->banner_image) }}"
            alt="Banner Image"
            class="w-full h-auto"
        >
    </div>

    <div class="grid grid-cols-2 gap-4 text-sm">
        <div>
            <strong>University:</strong><br>
            {{ $record->university?->name ?? '-' }}
        </div>

        <div>
            <strong>Banner Slot:</strong><br>
            {{ $record->banner?->name ?? '-' }}
        </div>

        <div>
            <strong>Campaign Name:</strong><br>
            {{ $record->campaign_name ?? '-' }}
        </div>

        <div>
            <strong>Price:</strong><br>
            ₹{{ number_format($record->price, 2) }}
        </div>

        <div>
            <strong>Start Date:</strong><br>
            {{ \Carbon\Carbon::parse($record->start_date)->format('d M Y') }}
        </div>

        <div>
            <strong>End Date:</strong><br>
            {{ \Carbon\Carbon::parse($record->end_date)->format('d M Y') }}
        </div>

        <div class="col-span-2">
            <strong>Redirect URL:</strong><br>
            {{ $record->redirect_url ?? '-' }}
        </div>
    </div>
</div>