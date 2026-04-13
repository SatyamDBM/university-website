<div class="w-full px-6 py-8">
    <div class="bg-white border border-gray-200 rounded-2xl p-8 w-full max-w-2xl mx-auto shadow-sm">

    {{-- Icon + Title --}}
    <div class="text-center mb-7">
        <div class="flex items-center justify-center mx-auto mb-4 rounded-xl"
             style="background:#EEEDFE; width:52px; height:52px;">
            <svg width="24" height="24" fill="none" stroke="#534AB7" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"/>
            </svg>
        </div>
        <h2 class="text-2xl font-semibold text-gray-900">Link Your University</h2>
        <p class="text-sm text-gray-500 mt-1">Search and link your university to activate the portal</p>
    </div>

    @if($status === 'pending')
    <div class="flex flex-col items-center text-center py-6">
        <div class="w-14 h-14 rounded-full flex items-center justify-center mb-4"
             style="background:#FEF3C7;">
            <svg width="28" height="28" fill="none" stroke="#D97706" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2m6-2a10 10 0 11-20 0 10 10 0 0120 0z"/>
            </svg>
        </div>
        <h3 class="text-base font-semibold text-gray-800 mb-1">Request Under Review</h3>
        <p class="text-sm text-gray-500">Your linking request has been submitted and is awaiting admin approval. We'll notify you once approved.</p>
    </div>

    @elseif($status === 'rejected')
    <div class="flex items-start gap-3 bg-red-50 border border-red-200 rounded-lg px-4 py-3 mb-5">
        <svg class="w-4 h-4 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
        </svg>
        <p class="text-sm text-red-700">Your previous request was <strong>rejected</strong>. Please resubmit with correct details.</p>
    </div>
    @endif

    @if($status !== 'pending')
    <form method="POST" action="{{ route('university.linking.store') }}" enctype="multipart/form-data">
        @csrf

        {{-- Select University (Static Dropdown) --}}
        <div class="mb-5">
            <label class="block text-sm font-medium text-gray-600 mb-1.5">Select University</label>
          <select name="university_id" required
    class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm">
    
    <option value="">-- Select University --</option>

    <option value="1">Amity University</option>
    <option value="2">Chandigarh University</option>
    <option value="3">Mumbai University</option>
    <option value="4">Delhi University</option>
    <option value="5">Pune University</option>
    <option value="6">Lovely Professional University</option>
    <option value="7">Manipal University</option>
    <option value="8">SRM University</option>
    <option value="9">VIT University</option>
    <option value="10">Symbiosis International University</option>
    <option value="11">Jamia Millia Islamia</option>
    <option value="12">Aligarh Muslim University</option>
    <option value="13">Banaras Hindu University</option>
    <option value="14">Anna University</option>
    <option value="15">Osmania University</option>
    <option value="16">Jadavpur University</option>
    <option value="17">Calcutta University</option>
    <option value="18">Hyderabad University</option>
    <option value="19">Pondicherry University</option>
    <option value="20">Tezpur University</option>
</select>
            @error('university_id')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Upload Document --}}
        {{-- <div class="mb-6" x-data="{ fileName: '' }">
            <label class="block text-sm font-medium text-gray-600 mb-1.5">
                Upload Authorization Document
            </label>
            <label class="flex items-center gap-2.5 border border-dashed border-gray-300 rounded-lg px-4 py-3 cursor-pointer bg-gray-50 hover:bg-purple-50 hover:border-purple-300 transition">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="#534AB7" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18.375 12.739l-7.693 7.693a4.5 4.5 0 01-6.364-6.364l10.94-10.94A3 3 0 1119.5 7.372L8.552 18.32m.009-.01l-.01.01m5.699-9.941l-7.81 7.81a1.5 1.5 0 002.112 2.13"/>
                </svg>
                <span class="text-sm text-gray-500" x-text="fileName || 'Upload File'"></span>
                <input type="file" name="document" class="hidden"
                    @change="fileName = $event.target.files[0]?.name || ''">
            </label>
            @error('document')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div> --}}

        {{-- Submit --}}
        <button type="submit"
            class="w-full py-3 rounded-lg text-white text-sm font-semibold tracking-wide hover:opacity-90 transition"
            style="background:#785144;">
            Submit Request
        </button>

    </form>
    @endif



</div>
</div>
