@extends('layouts.admin')

@push('styles')
    <style>
        .stats-card {
            border: none;
            border-radius: 16px;
            background: #ffffff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 22px rgba(0, 0, 0, 0.08);
        }

        .stats-icon-bg {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .import-btn-gradient {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border: none;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
            border-radius: 10px;
            padding: 8px 18px;
            font-weight: 600;
            transition: all 0.25s ease;
        }

        .import-btn-gradient:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(16, 185, 129, 0.4);
            color: white;
        }

        .import-btn-gradient:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .filter-card {
            border-radius: 16px;
            background: #ffffff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .hadith-num-badge {
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            color: #fff;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 8px;
            font-size: 0.78rem;
            white-space: nowrap;
        }

        .verse-table-row:hover {
            background: rgba(99, 102, 241, 0.03);
        }

        .verse-table-row td {
            vertical-align: middle;
        }

        .custom-switch .form-check-input {
            width: 2.5em;
            height: 1.3em;
            cursor: pointer;
        }

        .arabic-text-cell {
            font-family: 'Amiri', 'Traditional Arabic', serif;
            font-size: 1rem;
            direction: rtl;
            text-align: right;
            line-height: 1.8;
            max-width: 240px;
        }

        .status-badge {
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: capitalize;
        }

        .empty-state-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 2rem;
            color: #9ca3af;
        }

        /* Import Log Card */
        .import-log-card {
            border-radius: 16px;
            background: #ffffff;
            border: 1px solid rgba(0, 0, 0, 0.06);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
        }

        .log-progress-bar {
            height: 10px;
            border-radius: 99px;
            background: #e5e7eb;
            overflow: hidden;
        }

        .log-progress-fill {
            height: 100%;
            border-radius: 99px;
            transition: width 0.5s ease;
        }

        .log-status-badge {
            padding: 4px 14px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .failed-hadiths-table td,
        .failed-hadiths-table th {
            font-size: 0.8rem;
        }
    </style>
@endpush

@section('content')
    <x-admin.page-header title="Hadith Verses Management" :breadcrumb="[['label' => 'Dashboard', 'link' => route('admin.dashboard')], ['label' => 'Hadith Verses']]" />

    {{-- Stats Cards --}}
    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="stats-card p-3 d-flex align-items-center gap-3">
                <div class="stats-icon-bg bg-light-primary text-primary">
                    <i class="ti ti-subtitles"></i>
                </div>
                <div>
                    <p class="text-muted mb-0 small fw-semibold text-uppercase"
                        style="font-size: 0.72rem; letter-spacing: 0.5px;">Total Verses</p>
                    <h3 class="mb-0 fw-bold">{{ number_format($stats['total_verses']) }}</h3>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="stats-card p-3 d-flex align-items-center gap-3">
                <div class="stats-icon-bg bg-light-success text-success">
                    <i class="ti ti-circle-check"></i>
                </div>
                <div>
                    <p class="text-muted mb-0 small fw-semibold text-uppercase"
                        style="font-size: 0.72rem; letter-spacing: 0.5px;">Active</p>
                    <h3 class="mb-0 fw-bold">{{ number_format($stats['active_verses']) }}</h3>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="stats-card p-3 d-flex align-items-center gap-3">
                <div class="stats-icon-bg bg-light-info text-info">
                    <i class="ti ti-book"></i>
                </div>
                <div>
                    <p class="text-muted mb-0 small fw-semibold text-uppercase"
                        style="font-size: 0.72rem; letter-spacing: 0.5px;">Selected Book</p>
                    <p class="mb-0 fw-bold text-dark text-truncate" style="max-width: 160px; font-size: 0.9rem;">
                        {{ $stats['selected_book'] ? $stats['selected_book']->name : 'None Selected' }}
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="stats-card p-3 d-flex align-items-center gap-3">
                <div class="stats-icon-bg bg-light-warning text-warning">
                    <i class="ti ti-list-details"></i>
                </div>
                <div>
                    <p class="text-muted mb-0 small fw-semibold text-uppercase"
                        style="font-size: 0.72rem; letter-spacing: 0.5px;">Chapter Filter</p>
                    <p class="mb-0 fw-bold text-dark text-truncate" style="max-width: 160px; font-size: 0.9rem;">
                        @if ($stats['selected_chapter'])
                            CH #{{ $stats['selected_chapter']->chapter_number }}
                        @else
                            All Chapters
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Filter & Actions Toolbar --}}
    <div class="filter-card p-3 mb-4">
        <div class="d-flex flex-wrap align-items-end gap-3">
            {{-- Book Select --}}
            <div class="flex-grow-1" style="min-width: 200px; max-width: 260px;">
                <label class="form-label mb-1 small fw-semibold text-uppercase text-muted">Book</label>
                <select class="form-select rounded-3" id="bookSelectFilter" onchange="onBookChange()">
                    <option value="">Select a Book</option>
                    @foreach ($books as $b)
                        <option value="{{ $b->id }}" {{ $selectedBookId == $b->id ? 'selected' : '' }}>
                            {{ $b->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Chapter Select --}}
            <div class="flex-grow-1" style="min-width: 200px; max-width: 280px;">
                <label class="form-label mb-1 small fw-semibold text-uppercase text-muted">Chapter (Optional)</label>
                <select class="form-select rounded-3" id="chapterSelectFilter" onchange="onChapterChange()">
                    <option value="">All Chapters</option>
                    @foreach ($chapters as $ch)
                        <option value="{{ $ch->id }}" {{ $selectedChapterId == $ch->id ? 'selected' : '' }}>
                            CH #{{ $ch->chapter_number }} — {{ Str::limit($ch->name, 40) }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Actions --}}
            <div class="ms-auto d-flex align-items-center gap-2">
                @if (!$selectedBookId)
                    <span class="text-muted small fst-italic">Select a book to view and import</span>
                @endif

                @php
                    $logStatus = $importLog?->status;
                    $btnClass = match ($logStatus) {
                        'completed' => 'import-btn-gradient opacity-75',
                        'failed' => 'btn btn-danger fw-semibold rounded-3',
                        default => 'import-btn-gradient',
                    };
                    $btnIcon = match ($logStatus) {
                        'completed' => 'ti-circle-check',
                        'failed' => 'ti-refresh',
                        default => 'ti-cloud-download',
                    };
                    $btnLabel = match ($logStatus) {
                        'completed' => 'Already Imported',
                        'failed' => 'Resume Import (' . ($importLog?->failedCount() ?? 0) . ' failed)',
                        default => 'Import Verses',
                    };
                @endphp

                <button id="importVerseBtn" onclick="importVerses()" class="{{ $btnClass }}"
                    data-log-status="{{ $logStatus ?? '' }}" {{ !$selectedBookId ? 'disabled' : '' }}>
                    <i class="ti {{ $btnIcon }} me-1"></i>
                    <span id="importBtnText">{{ $btnLabel }}</span>
                </button>

                @if (count($jsonFiles))
                    <div style="min-width: 180px;">
                        {{-- <label class="form-label mb-1 small fw-semibold text-uppercase text-muted">Local JSON</label> --}}
                        <select class="form-select form-select-sm rounded-3" id="jsonFileSelect">
                            <option value="">Import a JSON file</option>
                            @foreach ($jsonFiles as $jsonFile)
                                <option value="{{ $jsonFile }}">{{ $jsonFile }}.json</option>
                            @endforeach
                        </select>
                    </div>
                    <button id="importJsonBtn" onclick="importJsonHadiths()" class="btn btn-primary fw-semibold rounded-3">
                        <i class="ti ti-file-import me-1"></i>
                        <span id="importJsonBtnText">Import JSON</span>
                    </button>
                @endif
            </div>
        </div>
    </div>

    {{-- Import Log Status Card --}}
    @if ($importLog && $selectedBookId)
        @php
            $logColors = [
                'completed' => ['bg' => '#dcfce7', 'text' => '#166534', 'bar' => '#22c55e'],
                'failed' => ['bg' => '#fee2e2', 'text' => '#991b1b', 'bar' => '#ef4444'],
                'in_progress' => ['bg' => '#dbeafe', 'text' => '#1e40af', 'bar' => '#3b82f6'],
                'pending' => ['bg' => '#f3f4f6', 'text' => '#374151', 'bar' => '#9ca3af'],
            ];
            $lc = $logColors[$importLog->status] ?? $logColors['pending'];
        @endphp

        <div class="import-log-card p-4 mb-4" id="importLogCard">
            <div class="d-flex align-items-start justify-content-between flex-wrap gap-3 mb-3">
                <div>
                    <h6 class="fw-bold text-dark mb-1">
                        <i class="ti ti-file-text me-1 text-primary"></i>
                        Import Log
                        @if ($importLog->chapter)
                            &mdash; CH #{{ $importLog->chapter->chapter_number }}
                        @else
                            &mdash; Full Book
                        @endif
                    </h6>
                    <p class="text-muted small mb-0">
                        Started: {{ $importLog->started_at?->format('M d, Y H:i') ?? '—' }}
                        @if ($importLog->completed_at)
                            &nbsp;&middot;&nbsp; Completed: {{ $importLog->completed_at->format('M d, Y H:i') }}
                        @endif
                    </p>
                </div>

                <span class="log-status-badge" style="background: {{ $lc['bg'] }}; color: {{ $lc['text'] }};">
                    {{ $importLog->status }}
                </span>
            </div>

            {{-- Progress bar --}}
            <div class="log-progress-bar mb-2">
                <div class="log-progress-fill"
                    style="width: {{ $importLog->progressPercent() }}%; background: {{ $lc['bar'] }};"></div>
            </div>
            <div class="d-flex justify-content-between small text-muted mb-3">
                <span>
                    <span class="fw-semibold text-success">{{ $importLog->successCount() }}</span>
                    / {{ $importLog->total_pages }} pages imported
                </span>
                @if ($importLog->failedCount() > 0)
                    <span class="text-danger fw-semibold">
                        {{ $importLog->failedCount() }} page(s) failed
                    </span>
                @endif
            </div>

            {{-- Failed Pages --}}
            @if (count($importLog->failed_pages ?? []) > 0)
                <div class="mb-3">
                    <button class="btn btn-sm btn-outline-danger rounded-3 mb-2" type="button" data-bs-toggle="collapse"
                        data-bs-target="#failedPagesCollapse">
                        <i class="ti ti-alert-triangle me-1"></i>
                        {{ count($importLog->failed_pages) }} Failed Page(s)
                    </button>
                    <div class="collapse" id="failedPagesCollapse">
                        <div class="d-flex flex-wrap gap-1 mt-2">
                            @foreach ($importLog->failed_pages as $fp)
                                <span class="badge bg-light-danger text-danger font-monospace">Page
                                    {{ $fp }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            {{-- Failed Hadiths --}}
            @if (count($importLog->failed_hadiths ?? []) > 0)
                @php $hadithErrors = collect($importLog->failed_hadiths)->filter(fn($h) => !is_null($h['hadith_id'] ?? null)); @endphp
                @if ($hadithErrors->count() > 0)
                    <div>
                        <button class="btn btn-sm btn-outline-warning rounded-3 mb-2" type="button"
                            data-bs-toggle="collapse" data-bs-target="#failedHadithsCollapse">
                            <i class="ti ti-list me-1"></i>
                            {{ $hadithErrors->count() }} Hadith-Level Error(s)
                        </button>
                        <div class="collapse" id="failedHadithsCollapse">
                            <div class="table-responsive mt-2" style="max-height: 260px; overflow-y: auto;">
                                <table class="table table-sm table-bordered mb-0 failed-hadiths-table">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Page</th>
                                            <th>Hadith ID</th>
                                            <th>Reason</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($hadithErrors as $err)
                                            <tr>
                                                <td class="font-monospace">{{ $err['page'] }}</td>
                                                <td class="font-monospace">{{ $err['hadith_id'] ?? '—' }}</td>
                                                <td class="text-muted">{{ $err['reason'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    @endif

    {{-- Verses Table --}}
    @if (!$selectedBookId)
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body text-center py-5">
                <div class="empty-state-icon"><i class="ti ti-book-2"></i></div>
                <h5 class="text-muted fw-semibold">No Book Selected</h5>
                <p class="text-muted small">Choose a book from the dropdown above to view and manage its verses.</p>
            </div>
        </div>
    @elseif ($verses->isEmpty())
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body text-center py-5">
                <div class="empty-state-icon"><i class="ti ti-subtitles"></i></div>
                <h5 class="text-muted fw-semibold">No Verses Found</h5>
                <p class="text-muted small mb-3">No verses found for this selection. Use the "Import Verses" button to
                    fetch
                    from the API.</p>
            </div>
        </div>
    @else
        <div class="card border-0 shadow-sm rounded-4 mb-3">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4" style="width: 80px;">Hadith #</th>
                                <th style="width: 60px;">Vol.</th>
                                <th>Arabic Heading</th>
                                <th style="width: 300px;">Arabic Hadith Text</th>
                                <th>Status</th>
                                <th class="text-center" style="width: 80px;">Active</th>
                                <th class="text-end pe-4" style="width: 140px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($verses as $verse)
                                <tr class="verse-table-row">
                                    <td class="ps-4">
                                        <span class="hadith-num-badge">#{{ $verse->hadith_number }}</span>
                                    </td>
                                    <td>
                                        <span
                                            class="badge bg-light text-secondary fw-semibold">{{ $verse->volume ?? '—' }}</span>
                                    </td>
                                    <td>
                                        <div class="arabic-text-cell small text-muted">
                                            {{ Str::limit($verse->heading, 80) ?? '—' }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="arabic-text-cell small">
                                            {{ Str::limit($verse->text, 120) }}
                                        </div>
                                    </td>
                                    <td>
                                        @php
                                            $statusColor = match (strtolower($verse->status ?? '')) {
                                                'sahih' => 'success',
                                                'hasan' => 'info',
                                                'da\'if', "da'if" => 'warning',
                                                default => 'secondary',
                                            };
                                        @endphp
                                        <span class="status-badge bg-light-{{ $statusColor }} text-{{ $statusColor }}">
                                            {{ $verse->status ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div
                                            class="form-check form-switch custom-switch mb-0 d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                {{ $verse->is_active ? 'checked' : '' }}
                                                onchange="toggleVerseStatus({{ $verse->id }}, '{{ route('admin.hadith-verses.status', $verse->id) }}')">
                                        </div>
                                    </td>
                                    <td class="text-end pe-4">
                                        <a href="{{ route('admin.hadith-verse-translations.index', [$verse->id]) }}"
                                            class="btn btn-sm btn-light-primary me-1" title="Translations">
                                            <i class="ti ti-language"></i>
                                        </a>
                                        <button class="btn btn-sm btn-light-secondary"
                                            onclick="openEditModal({{ json_encode(['id' => $verse->id, 'heading' => $verse->heading, 'text' => $verse->text, 'volume' => $verse->volume, 'status' => $verse->status, 'hadith_number' => $verse->hadith_number]) }})"
                                            title="Edit">
                                            <i class="ti ti-edit"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Pagination Bar --}}
        @if ($verses->hasPages())
            <div
                class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 bg-white p-3 rounded-4 shadow-sm border">
                <div class="text-muted small">
                    Showing <span class="fw-semibold text-dark">{{ $verses->firstItem() }}</span> to
                    <span class="fw-semibold text-dark">{{ $verses->lastItem() }}</span> of
                    <span class="fw-semibold text-dark">{{ $verses->total() }}</span> verses
                </div>
                <div>
                    {{ $verses->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
    @endif

    {{-- Edit Modal --}}
    <div class="modal fade" id="editVerseModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header border-0 pt-4 pb-0 px-4">
                    <div>
                        <h5 class="modal-title fw-bold text-dark">Edit Hadith Verse</h5>
                        <p class="text-muted small mb-0">Update the Arabic text and metadata of this verse</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <input type="hidden" id="edit_verse_id">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Hadith Number</label>
                            <input type="number" id="edit_hadith_number" class="form-control rounded-3"
                                placeholder="e.g. 1">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Volume</label>
                            <input type="text" id="edit_volume" class="form-control rounded-3" placeholder="Vol.">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Status</label>
                            <input type="text" id="edit_status" class="form-control rounded-3"
                                placeholder="e.g. sahih">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Arabic Heading</label>
                            <input type="text" id="edit_heading" class="form-control rounded-3 text-end"
                                dir="rtl" placeholder="Arabic heading text">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Arabic Hadith Text <span
                                    class="text-danger">*</span></label>
                            <textarea id="edit_text" class="form-control rounded-3 text-end" dir="rtl" rows="8"
                                placeholder="Arabic hadith text..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pb-4 px-4 d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-light rounded-3 px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" onclick="submitEdit()" class="btn btn-primary rounded-3 px-4">Save
                        Changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Restore from localStorage on page load
        $(document).ready(function() {
            const savedBook = localStorage.getItem('HadithVerseBook');
            if (savedBook && !$('#bookSelectFilter').val()) {
                $('#bookSelectFilter').val(savedBook);
            }
        });

        function onBookChange() {
            const bookId = $('#bookSelectFilter').val();
            localStorage.setItem('HadithVerseBook', bookId || '');
            localStorage.setItem('HadithVerseChapter', '');
            window.location.href = "{{ route('admin.hadith-verses.index') }}?book_id=" + (bookId || '');
        }

        function onChapterChange() {
            const bookId = $('#bookSelectFilter').val();
            const chapterId = $('#chapterSelectFilter').val();
            localStorage.setItem('HadithVerseChapter', chapterId || '');
            window.location.href = "{{ route('admin.hadith-verses.index') }}?book_id=" + (bookId || '') +
                '&chapter_id=' + (chapterId || '');
        }

        function toggleVerseStatus(id, url) {
            $.ajax({
                url: url,
                type: 'PATCH',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(r) {
                    toastr.success(r.message || 'Status updated');
                },
                error: function() {
                    toastr.error('Failed to update status');
                }
            });
        }

        // ---------------------------------------------------------------
        // Import Verses — aware of log status
        // ---------------------------------------------------------------
        function importVerses() {
            const bookId = $('#bookSelectFilter').val();
            const chapterId = $('#chapterSelectFilter').val();

            if (!bookId) {
                toastr.error('Please select a book first.');
                return;
            }

            const logStatus = $('#importVerseBtn').data('log-status');

            // Guard: already completed → confirm re-import
            if (logStatus === 'completed') {
                if (!confirm(
                        'This scope is already fully imported. Do you want to re-import anyway? This will re-sync all pages from the API.'
                    )) return;
            } else {
                const scopeText = chapterId ? 'the selected chapter' :
                    'the entire selected book (may take several minutes)';
                if (!confirm('Import / sync verses for ' + scopeText + '?')) return;
            }

            const btn = $('#importVerseBtn');
            const originalText = $('#importBtnText').text();
            btn.prop('disabled', true);
            $('#importBtnText').html('<span class="spinner-border spinner-border-sm me-1"></span> ' +
                (logStatus === 'failed' ? 'Resuming...' : 'Importing...'));

            $.ajax({
                url: "{{ route('admin.hadith-verses.import') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    book_id: bookId,
                    chapter_id: chapterId || '',
                },
                success: function(r) {
                    btn.prop('disabled', false);
                    $('#importBtnText').text(originalText);

                    if (r.status) {
                        toastr.success(r.message);
                    } else {
                        toastr.warning(r.message || 'Import partially complete.');
                    }

                    if (r.warnings && r.warnings.length) {
                        r.warnings.slice(0, 3).forEach(w => toastr.warning(w, '', {
                            timeOut: 6000
                        }));
                    }

                    // Update log card if log data returned
                    if (r.log) {
                        renderLogCard(r.log);
                    }

                    setTimeout(() => location.reload(), 2000);
                },
                error: function(xhr) {
                    btn.prop('disabled', false);
                    $('#importBtnText').text(originalText);
                    const msg = xhr.responseJSON?.message || 'Error during import.';
                    toastr.error(msg);
                }
            });
        }

        // ---------------------------------------------------------------
        // Local JSON import — creates/updates book, chapters, and verses
        // ---------------------------------------------------------------
        function importJsonHadiths() {
            const file = $('#jsonFileSelect').val();
            if (!file) {
                toastr.error('Please select a local JSON file first.');
                return;
            }

            if (!confirm('Import ' + file +
                    '.json? This will create or update its book, chapters, verses, and English translations.')) {
                return;
            }

            const btn = $('#importJsonBtn');
            const originalText = $('#importJsonBtnText').text();
            btn.prop('disabled', true);
            $('#importJsonBtnText').html('<span class="spinner-border spinner-border-sm me-1"></span> Importing...');

            $.ajax({
                url: "{{ route('admin.hadith-verses.import-json') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    file: file,
                },
                success: function(r) {
                    toastr.success(r.message || 'JSON import completed.');
                    if (r.warnings?.length) {
                        r.warnings.slice(0, 3).forEach(w => toastr.warning(w, '', {
                            timeOut: 6000
                        }));
                    }
                    setTimeout(() => location.reload(), 1200);
                },
                error: function(xhr) {
                    const response = xhr.responseJSON || {};
                    toastr.error(response.message || 'JSON import failed.');
                    if (response.warnings?.length) {
                        response.warnings.slice(0, 3).forEach(w => toastr.warning(w, '', {
                            timeOut: 6000
                        }));
                    }
                },
                complete: function() {
                    btn.prop('disabled', false);
                    $('#importJsonBtnText').text(originalText);
                }
            });
        }

        // ---------------------------------------------------------------
        // Render log card from AJAX response data
        // ---------------------------------------------------------------
        function renderLogCard(log) {
            if (!log) return;

            const statusColors = {
                completed: {
                    bg: '#dcfce7',
                    text: '#166534',
                    bar: '#22c55e'
                },
                failed: {
                    bg: '#fee2e2',
                    text: '#991b1b',
                    bar: '#ef4444'
                },
                in_progress: {
                    bg: '#dbeafe',
                    text: '#1e40af',
                    bar: '#3b82f6'
                },
                pending: {
                    bg: '#f3f4f6',
                    text: '#374151',
                    bar: '#9ca3af'
                },
            };
            const c = statusColors[log.status] || statusColors.pending;

            // Update badge
            $('.log-status-badge').css({
                background: c.bg,
                color: c.text
            }).text(log.status.toUpperCase());

            // Update progress bar
            $('.log-progress-fill').css({
                width: log.progress + '%',
                background: c.bar
            });

            // Update text
            $('.log-success-text').text(log.success_count + ' / ' + log.total_pages + ' pages imported');
        }

        // ---------------------------------------------------------------
        // Edit Modal
        // ---------------------------------------------------------------
        function openEditModal(verse) {
            $('#edit_verse_id').val(verse.id);
            $('#edit_hadith_number').val(verse.hadith_number);
            $('#edit_volume').val(verse.volume || '');
            $('#edit_status').val(verse.status || '');
            $('#edit_heading').val(verse.heading || '');
            $('#edit_text').val(verse.text || '');
            $('#editVerseModal').modal('show');
        }

        function submitEdit() {
            const id = $('#edit_verse_id').val();
            const text = $('#edit_text').val().trim();

            if (!text) {
                toastr.error('Hadith text is required.');
                return;
            }

            const url = "{{ route('admin.hadith-verses.update', ':id') }}".replace(':id', id);

            $.ajax({
                url: url,
                type: 'PUT',
                data: {
                    _token: "{{ csrf_token() }}",
                    hadith_number: $('#edit_hadith_number').val(),
                    volume: $('#edit_volume').val(),
                    status: $('#edit_status').val(),
                    heading: $('#edit_heading').val(),
                    text: text,
                },
                success: function(r) {
                    $('#editVerseModal').modal('hide');
                    toastr.success(r.message || 'Verse updated successfully.');
                    setTimeout(() => location.reload(), 800);
                },
                error: function(xhr) {
                    const msg = xhr.responseJSON?.message || 'Failed to update verse.';
                    toastr.error(msg);
                }
            });
        }
    </script>
@endpush
