@extends('layouts.app')
@section('content')
@include('partials.swal')

<div class="p-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">FAQs</h1>
            <p class="text-sm text-gray-500 mt-1">Manage frequently asked questions for your university</p>
        </div>
        <button onclick="openFaqModal()"
                class="inline-flex items-center gap-2 text-white text-sm font-medium px-4 py-2 rounded-lg transition"
                style="background-color:#6b4a36;">
            + Add FAQ
        </button>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr style="background-color:#6b4a36;">
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">#</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Question</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Answer</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($faqs as $index => $faq)
                    <tr class="hover:bg-gray-50 transition" id="faq-row-{{ $faq->id }}">
                        <td class="px-4 py-4 text-sm text-gray-400">{{ $index + 1 }}</td>
                        <td class="px-4 py-4">
                            <div class="text-sm font-medium text-gray-800">{{ $faq->question }}</div>
                        </td>
                        <td class="px-4 py-4">
                            <div class="text-sm text-gray-600">{{ Str::limit($faq->answer, 100) }}</div>
                        </td>
                        <td class="px-4 py-4">
                            <div class="flex items-center gap-1.5">
                                <button onclick="editFaq({{ $faq->id }})"
                                        class="text-xs font-medium text-amber-600 hover:text-amber-800 bg-amber-50 hover:bg-amber-100 px-2.5 py-1.5 rounded-lg transition">
                                    Edit
                                </button>
                                <button onclick="confirmDeleteFaq({{ $faq->id }})"
                                        class="text-xs font-medium text-red-600 hover:text-red-800 bg-red-50 hover:bg-red-100 px-2.5 py-1.5 rounded-lg transition">
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-5 py-16 text-center">
                            <div class="text-gray-400 text-sm">No FAQs found.</div>
                            <button onclick="openFaqModal()"
                                    class="inline-flex items-center gap-1 mt-3 text-sm font-medium"
                                    style="color:#6b4a36;">
                                + Add your first FAQ
                            </button>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- ── FAQ Modal (Add / Edit) ── --}}
<div id="faqModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-lg mx-4">

        {{-- Modal Header --}}
        <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100" style="background-color:#6b4a36; border-radius: 12px 12px 0 0;">
            <h3 id="faqModalTitle" class="text-sm font-semibold text-white">Add FAQ</h3>
            <button onclick="closeFaqModal()" class="text-white/60 hover:text-white text-xl leading-none">×</button>
        </div>

        {{-- Modal Body --}}
        <form id="faqForm" method="POST" action="{{ route('university.faq.store') }}">
            @csrf
            <input type="hidden" name="id" id="faq_id">

            <div class="p-5 space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Question <span class="text-red-500">*</span></label>
                    <textarea name="question" id="question" rows="2" required
                              placeholder="Enter the question..."
                              class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Answer <span class="text-red-500">*</span></label>
                    <textarea name="answer" id="answer" rows="4" required
                              placeholder="Enter the answer..."
                              class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition"></textarea>
                </div>
            </div>

            {{-- Modal Footer --}}
            <div class="flex items-center justify-end gap-3 px-5 py-4 border-t border-gray-100 bg-gray-50 rounded-b-xl">
                <button type="button" onclick="closeFaqModal()"
                        class="text-sm text-gray-600 bg-white hover:bg-gray-100 border border-gray-200 px-4 py-2 rounded-lg transition">
                    Cancel
                </button>
                <button type="submit"
                        class="text-sm text-white font-medium px-5 py-2 rounded-lg transition"
                        style="background-color:#6b4a36;">
                    Save FAQ
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ── Delete Confirmation Modal ── --}}
<div id="deleteFaqModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-sm mx-4">

        <div class="p-6 text-center">
            <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </div>
            <h3 class="text-base font-bold text-gray-800 mb-1">Delete FAQ?</h3>
            <p class="text-sm text-gray-500 mb-6">This action cannot be undone.</p>

            <div class="flex items-center justify-center gap-3">
                <button onclick="closeDeleteModal()"
                        class="text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 px-5 py-2 rounded-lg transition">
                    Cancel
                </button>
                <button id="confirmDeleteBtn"
                        class="text-sm text-white font-medium px-5 py-2 rounded-lg transition bg-red-500 hover:bg-red-600">
                    Yes, Delete
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// ── FAQ Modal ──
function openFaqModal() {
    document.getElementById('faqForm').reset();
    document.getElementById('faq_id').value = '';
    document.getElementById('faqModalTitle').textContent = 'Add FAQ';
    document.getElementById('faqModal').classList.remove('hidden');
    document.getElementById('faqModal').classList.add('flex');
}

function closeFaqModal() {
    document.getElementById('faqModal').classList.add('hidden');
    document.getElementById('faqModal').classList.remove('flex');
}

function editFaq(id) {
    fetch('/faq/' + id + '/edit')
        .then(res => res.json())
        .then(data => {
            document.getElementById('faq_id').value   = data.id;
            document.getElementById('question').value = data.question;
            document.getElementById('answer').value   = data.answer;
            document.getElementById('faqModalTitle').textContent = 'Edit FAQ';
            document.getElementById('faqModal').classList.remove('hidden');
            document.getElementById('faqModal').classList.add('flex');
        });
}

// Close modal on backdrop click
document.getElementById('faqModal').addEventListener('click', function(e) {
    if (e.target === this) closeFaqModal();
});

// ── Delete Modal ──
let deleteFaqId = null;

function confirmDeleteFaq(id) {
    deleteFaqId = id;
    document.getElementById('deleteFaqModal').classList.remove('hidden');
    document.getElementById('deleteFaqModal').classList.add('flex');
}

function closeDeleteModal() {
    document.getElementById('deleteFaqModal').classList.add('hidden');
    document.getElementById('deleteFaqModal').classList.remove('flex');
    deleteFaqId = null;
}

document.getElementById('deleteFaqModal').addEventListener('click', function(e) {
    if (e.target === this) closeDeleteModal();
});

document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
    if (!deleteFaqId) return;

    fetch('/faq/' + deleteFaqId, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
        },
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            document.getElementById(`faq-row-${deleteFaqId}`)?.remove();
            closeDeleteModal();
            showSwal('success', 'FAQ deleted successfully!');
        }
    })
    .catch(() => showSwal('error', 'Failed to delete FAQ.'));
});
</script>
@endsection