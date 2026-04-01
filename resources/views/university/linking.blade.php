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

        {{-- Search University --}}
        <div class="mb-5"
             x-data="{
                open: false,
                search: '',
                selected: '',
                universities: [
                    'Amity University',
                    'Chandigarh University',
                    'Mumbai University',
                    'Delhi University',
                    'Pune University',
                    'Lovely Professional University',
                    'Manipal University',
                    'SRM University',
                    'VIT University',
                    'Symbiosis International University',
                    'Jamia Millia Islamia',
                    'Aligarh Muslim University',
                    'Banaras Hindu University',
                    'Anna University',
                    'Osmania University',
                    'Jadavpur University',
                    'Calcutta University',
                    'Hyderabad University',
                    'Pondicherry University',
                    'Tezpur University'
                ],
                get filtered() {
                    if (!this.search) return this.universities;
                    return this.universities.filter(u =>
                        u.toLowerCase().includes(this.search.toLowerCase())
                    );
                }
             }"
        >
            <label class="block text-sm font-medium text-gray-600 mb-1.5">
                <svg class="inline w-3.5 h-3.5 mr-1 -mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="8"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35"/>
                </svg>
                Search University
            </label>

            <div class="relative">
                <input
                    type="text"
                    x-model="search"
                    @focus="open = true"
                    @blur="setTimeout(() => { open = false }, 200)"
                    placeholder="Type university name..."
                    autocomplete="off"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm pr-8 focus:outline-none focus:ring-2 focus:ring-purple-400"
                >
                <svg class="absolute right-2.5 top-3 w-4 h-4 text-gray-400 pointer-events-none"
                     fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                </svg>

                <div
                    x-show="open && filtered.length > 0"
                    class="absolute z-20 w-full bg-white border border-gray-200 rounded-lg mt-1 shadow-lg overflow-auto"
                    style="max-height:200px; display:none;"
                >
                    <template x-for="uni in filtered" :key="uni">
                        <div
                            @mousedown.prevent="selected = uni; search = uni; open = false"
                            :class="selected === uni
                                ? 'bg-purple-50 text-purple-800 font-medium'
                                : 'text-gray-700 hover:bg-gray-50'"
                            class="px-4 py-2.5 text-sm cursor-pointer border-b border-gray-100 last:border-0"
                            x-text="uni"
                        ></div>
                    </template>
                </div>
            </div>

            <input type="hidden" name="university_name" :value="selected">

            @error('university_name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Upload Document --}}
        <div class="mb-6" x-data="{ fileName: '' }">
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
        </div>

        {{-- Submit --}}
        <button type="submit"
            class="w-full py-3 rounded-lg text-white text-sm font-semibold tracking-wide hover:opacity-90 transition"
            style="background:#3C3489;">
            Submit Request
        </button>

    </form>
    @endif

    {{-- Footer --}}
    <p class="text-center text-xs text-gray-400 mt-4">
        Need help?
        <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit" class="text-purple-600 font-medium hover:underline">Logout</button>
        </form>
    </p>

</div>
</div>