@extends('layouts.admin')

@push('styles')
    <style>
        .stats-card {
            border: none;
            border-radius: 16px;
            background: #ffffff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stats-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 22px rgba(0, 0, 0, 0.08);
        }

        .stats-icon-bg {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .chapter-card {
            border: 1px solid rgba(0, 0, 0, 0.06);
            border-radius: 16px;
            background: #ffffff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
            transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .chapter-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            border-color: rgba(99, 102, 241, 0.2);
        }

        .chapter-badge-num {
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            color: #ffffff;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 8px;
            font-size: 0.8rem;
        }

        .custom-switch .form-check-input {
            width: 2.75em;
            height: 1.4em;
            cursor: pointer;
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

        .import-btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(16, 185, 129, 0.4);
            color: white;
        }

        .search-box-custom {
            position: relative;
        }

        .search-box-custom input {
            padding-left: 40px;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            height: 42px;
        }

        .search-box-custom i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 18px;
        }

        .view-btn {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #e5e7eb;
            background: #fff;
            color: #6b7280;
        }

        .view-btn.active {
            background: #4f46e5;
            color: #fff;
            border-color: #4f46e5;
        }
    </style>
@endpush

@section('content')
    <x-admin.page-header title="Hadith Chapters Management" :breadcrumb="[['label' => 'Dashboard', 'link' => route('admin.dashboard')], ['label' => 'Chapters']]" />

    {{-- Stats Cards Bar --}}
    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="stats-card p-3 d-flex align-items-center">
                <div class="stats-icon-bg bg-light-primary text-primary me-3">
                    <i class="ti ti-list-details"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1 text-uppercase fw-semibold" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                        Total Chapters</h6>
                    <h3 class="mb-0 fw-bold" id="stat-total-chapters">{{ number_format($stats['total_chapters']) }}</h3>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="stats-card p-3 d-flex align-items-center">
                <div class="stats-icon-bg bg-light-success text-success me-3">
                    <i class="ti ti-subtitles"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1 text-uppercase fw-semibold"
                        style="font-size: 0.75rem; letter-spacing: 0.5px;">Total Hadiths</h6>
                    <h3 class="mb-0 fw-bold" id="stat-total-hadiths">{{ number_format($stats['total_hadiths']) }}</h3>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="stats-card p-3 d-flex align-items-center">
                <div class="stats-icon-bg bg-light-warning text-warning me-3">
                    <i class="ti ti-circle-check"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1 text-uppercase fw-semibold"
                        style="font-size: 0.75rem; letter-spacing: 0.5px;">Active Status</h6>
                    <h3 class="mb-0 fw-bold" id="stat-active-chapters">{{ $stats['active_chapters'] }} /
                        {{ $stats['total_chapters'] }}</h3>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="stats-card p-3 d-flex align-items-center">
                <div class="stats-icon-bg bg-light-info text-info me-3">
                    <i class="ti ti-book"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1 text-uppercase fw-semibold"
                        style="font-size: 0.75rem; letter-spacing: 0.5px;">Selected Book</h6>
                    <h6 class="mb-0 fw-bold text-dark text-truncate" style="max-width: 160px;" id="stat-book-name">
                        {{ $stats['selected_book'] ? $stats['selected_book']->name : 'All Hadith Books' }}
                    </h6>
                </div>
            </div>
        </div>
    </div>

    {{-- Controls & Actions Toolbar --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-3">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">

                {{-- Book Selection Dropdown --}}
                <div class="d-flex align-items-center gap-2">
                    <label for="bookSelectFilter"
                        class="form-label mb-0 fw-bold text-muted small text-uppercase">Book:</label>
                    <select class="form-select rounded-3 border-secondary border-opacity-25" id="bookSelectFilter"
                        style="min-width: 220px;" onchange="onBookFilterChange()">
                        <option value="">All Hadith Books</option>
                        @foreach ($books as $b)
                            <option value="{{ $b->id }}" {{ $selectedBookId == $b->id ? 'selected' : '' }}>
                                {{ $b->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Right Search & Actions --}}
                <div class="d-flex align-items-center gap-2 ms-auto">
                    <div class="search-box-custom">
                        <i class="ti ti-search"></i>
                        <input type="text" id="searchInput" class="form-control"
                            placeholder="Search chapter title, #...">
                    </div>

                    <button class="view-btn active" id="btn-grid-view" onclick="switchView('grid')" title="Grid View">
                        <i class="ti ti-layout-grid"></i>
                    </button>
                    <button class="view-btn" id="btn-table-view" onclick="switchView('table')" title="List View">
                        <i class="ti ti-list"></i>
                    </button>

                    <button id="importChaptersBtn" onclick="importChapters()" class="import-btn-gradient ms-2">
                        <i class="ti ti-cloud-download me-1"></i> <span id="importBtnText">Import Chapters</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Grid View Container --}}
    <div id="grid-view-container" class="row g-4 mb-4">
        @forelse ($chapters as $chap)
            @php
                $enTrans = $chap->translations->firstWhere('lang', 'en');
                $arTrans = $chap->translations->firstWhere('lang', 'ar');
                $displayName = $enTrans?->name ?? $chap->name;
            @endphp
            <div class="col-xl-4 col-md-6 chapter-item"
                data-name="{{ strtolower($chap->name . ' ' . ($enTrans?->name ?? '')) }}"
                data-num="{{ $chap->chapter_number }}" data-book="{{ $chap->hadith_book_id }}">

                <div class="chapter-card">
                    <div class="p-3 border-bottom d-flex align-items-center justify-content-between bg-light bg-opacity-50">
                        <div class="d-flex align-items-center gap-2">
                            <span class="chapter-badge-num">CH #{{ $chap->chapter_number }}</span>
                            <span
                                class="badge bg-light-primary text-primary fw-medium small">{{ $chap->book?->abbreviation ?? 'BK' }}</span>
                        </div>

                        <div class="form-check form-switch custom-switch mb-0">
                            <input class="form-check-input" type="checkbox" role="switch"
                                {{ $chap->is_active ? 'checked' : '' }}
                                onchange="toggleChapterActive({{ $chap->id }}, '{{ route('admin.hadith-chapters.status', $chap->id) }}')">
                        </div>
                    </div>

                    <div class="p-3 flex-grow-1">
                        @if ($chap->name)
                            <h5 class="fw-bold mb-2 text-dark font-arabic" dir="rtl">{{ $chap->name }}</h5>
                        @endif

                        @if ($enTrans?->name)
                            <p class="fw-semibold text-secondary mb-1">{{ $enTrans->name }}</p>
                        @endif

                        @if ($enTrans?->description)
                            <p class="text-muted small mb-2 text-truncate" style="max-width: 100%;">
                                {{ $enTrans->description }}</p>
                        @endif

                        <div class="d-flex align-items-center gap-2 mt-3">
                            <span class="badge bg-light-info text-info rounded-pill">
                                <i class="ti ti-subtitles me-1"></i> {{ number_format($chap->hadith_count ?? 0) }} Hadiths
                            </span>
                            <span class="badge bg-light-secondary text-secondary rounded-pill font-monospace">
                                Sort: {{ $chap->sort }}
                            </span>
                        </div>
                    </div>

                    <div class="p-3 bg-light bg-opacity-20 border-top d-flex align-items-center justify-content-between">
                        <a href="{{ route('admin.hadith-chapter-translations.index', [$chap->id]) }}"
                            class="btn btn-sm btn-light-primary rounded-3 fw-semibold">
                            <i class="ti ti-language me-1"></i> Translations
                        </a>

                        <button onclick="openEditModal({{ json_encode($chap) }})"
                            class="btn btn-sm btn-outline-secondary rounded-3">
                            <i class="ti ti-edit me-1"></i> Edit
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <i class="ti ti-folder-off text-muted display-3 d-block mb-3"></i>
                <h5 class="text-muted">No chapters found for this selection.</h5>
                <p class="text-muted small mb-3">Click the "Import Chapters" button above to fetch chapters from API.</p>
            </div>
        @endforelse
    </div>

    {{-- List View Container --}}
    <div id="table-view-container" class="card border-0 shadow-sm rounded-4 mb-4 d-none">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Ch #</th>
                            <th>Book</th>
                            <th>Chapter Title (Arabic)</th>
                            <th>English Title</th>
                            <th>Hadiths Count</th>
                            <th>Sort</th>
                            <th>Active</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        @foreach ($chapters as $chap)
                            @php
                                $enTrans = $chap->translations->firstWhere('lang', 'en');
                            @endphp
                            <tr class="chapter-item-row"
                                data-name="{{ strtolower($chap->name . ' ' . ($enTrans?->name ?? '')) }}"
                                data-num="{{ $chap->chapter_number }}" data-book="{{ $chap->hadith_book_id }}">
                                <td class="ps-4 font-monospace fw-bold"><span
                                        class="chapter-badge-num">#{{ $chap->chapter_number }}</span></td>
                                <td><span
                                        class="badge bg-light-secondary text-secondary fw-semibold">{{ $chap->book?->name ?? 'N/A' }}</span>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark font-arabic fs-6" dir="rtl">
                                        {{ $chap->name ?? '-' }}</div>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark">{{ $enTrans?->name ?? '-' }}</div>
                                    <small class="text-muted font-monospace">{{ $chap->slug }}</small>
                                </td>
                                <td class="fw-semibold">{{ number_format($chap->hadith_count ?? 0) }}</td>
                                <td><span class="badge bg-light text-dark font-monospace">{{ $chap->sort }}</span></td>
                                <td>
                                    <div class="form-check form-switch custom-switch mb-0">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            {{ $chap->is_active ? 'checked' : '' }}
                                            onchange="toggleChapterActive({{ $chap->id }}, '{{ route('admin.hadith-chapters.status', $chap->id) }}')">
                                    </div>
                                </td>
                                <td class="text-end pe-4">
                                    <a href="{{ route('admin.hadith-chapter-translations.index', [$chap->id]) }}"
                                        class="btn btn-sm btn-light-primary me-1" title="Translations">
                                        <i class="ti ti-language"></i>
                                    </a>
                                    <button onclick="openEditModal({{ json_encode($chap) }})"
                                        class="btn btn-sm btn-light-secondary" title="Edit">
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
    @if ($chapters->hasPages())
        <div
            class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 bg-white p-3 rounded-4 shadow-sm border">
            <div class="text-muted small">
                Showing <span class="fw-semibold text-dark">{{ $chapters->firstItem() }}</span> to <span
                    class="fw-semibold text-dark">{{ $chapters->lastItem() }}</span> of <span
                    class="fw-semibold text-dark">{{ $chapters->total() }}</span> chapters
            </div>
            <div>
                {{ $chapters->links('pagination::bootstrap-5') }}
            </div>
        </div>
    @endif

    {{-- Modern Creative Edit Modal --}}
    <div class="modal fade" id="editChapterModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header border-0 pb-0 pt-4 px-4">
                    <div>
                        <h4 class="modal-title fw-bold text-dark" id="editModalTitle">Edit Hadith Chapter</h4>
                        <p class="text-muted small mb-0">Update chapter details and metadata</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form id="editChapterForm">
                        <input type="hidden" id="edit_chapter_id">

                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="modal_chapter_number" class="form-label fw-semibold">Chapter Number <span
                                        class="text-danger">*</span></label>
                                <input type="number" id="modal_chapter_number" class="form-control rounded-3"
                                    placeholder="e.g. 1" required>
                            </div>

                            <div class="col-md-8">
                                <label for="modal_chapter_name" class="form-label fw-semibold">Chapter Name
                                    (Arabic/Default) <span class="text-danger">*</span></label>
                                <input type="text" id="modal_chapter_name" class="form-control rounded-3"
                                    placeholder="Chapter Name" required>
                            </div>

                            <div class="col-md-6">
                                <label for="modal_slug" class="form-label fw-semibold">Slug</label>
                                <input type="text" id="modal_slug" class="form-control rounded-3"
                                    placeholder="chapter-slug">
                            </div>

                            <div class="col-md-3">
                                <label for="modal_hadith_count" class="form-label fw-semibold">Hadiths Count</label>
                                <input type="number" id="modal_hadith_count" class="form-control rounded-3"
                                    placeholder="0">
                            </div>

                            <div class="col-md-3">
                                <label for="modal_sort" class="form-label fw-semibold">Sort Order</label>
                                <input type="number" id="modal_sort" class="form-control rounded-3" placeholder="1">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-0 pt-0 pb-4 px-4 d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-light rounded-3 px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" onclick="submitEditForm()" class="btn btn-primary rounded-3 px-4">Save
                        Changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Restore filter selection from localStorage if present
            if (!$("#bookSelectFilter").val() && localStorage.getItem("SelectedHadithBookId")) {
                $("#bookSelectFilter").val(localStorage.getItem("SelectedHadithBookId"));
            }

            // Live Search Filter
            $('#searchInput').on('keyup', function() {
                applySearchFilter();
            });
        });

        function onBookFilterChange() {
            const val = $('#bookSelectFilter').val();
            localStorage.setItem("SelectedHadithBookId", val);
            window.location.href = "{{ route('admin.hadith-chapters.index') }}?book_id=" + val;
        }

        function switchView(view) {
            if (view === 'grid') {
                $('#grid-view-container').removeClass('d-none');
                $('#table-view-container').addClass('d-none');
                $('#btn-grid-view').addClass('active');
                $('#btn-table-view').removeClass('active');
            } else {
                $('#table-view-container').removeClass('d-none');
                $('#grid-view-container').addClass('d-none');
                $('#btn-table-view').addClass('active');
                $('#btn-grid-view').removeClass('active');
            }
        }

        function applySearchFilter() {
            const query = $('#searchInput').val().toLowerCase().trim();

            $('.chapter-item, .chapter-item-row').each(function() {
                const name = $(this).data('name') || '';
                const num = String($(this).data('num') || '');

                const matchesQuery = !query || name.includes(query) || num.includes(query);

                if (matchesQuery) {
                    $(this).removeClass('d-none');
                } else {
                    $(this).addClass('d-none');
                }
            });
        }

        function toggleChapterActive(id, url) {
            $.ajax({
                url: url,
                type: "PATCH",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    toastr.success(response.message || 'Status updated');
                },
                error: function(xhr) {
                    toastr.error('Failed to update status.');
                }
            });
        }

        function importChapters() {
            const selectedBookId = $('#bookSelectFilter').val();
            const bookText = selectedBookId ? $('#bookSelectFilter option:selected').text().trim() : 'ALL books';

            if (!confirm(`Are you sure you want to import/sync chapters for ${bookText}?`)) {
                return;
            }

            const btn = $('#importChaptersBtn');
            const originalText = $('#importBtnText').text();
            btn.prop('disabled', true);
            $('#importBtnText').html('<span class="spinner-border spinner-border-sm me-1"></span> Importing...');

            $.ajax({
                url: "{{ route('admin.hadith-chapters.import') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    book_id: selectedBookId
                },
                success: function(response) {
                    btn.prop('disabled', false);
                    $('#importBtnText').text(originalText);
                    if (response.status) {
                        toastr.success(response.message);
                        if (response.warnings && response.warnings.length > 0) {
                            response.warnings.forEach(w => toastr.warning(w));
                        }
                        setTimeout(() => location.reload(), 1200);
                    } else {
                        toastr.error(response.message || 'Import failed.');
                    }
                },
                error: function(xhr) {
                    btn.prop('disabled', false);
                    $('#importBtnText').text(originalText);
                    const msg = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message :
                        'Error during import.';
                    toastr.error(msg);
                }
            });
        }

        function openEditModal(chap) {
            $('#edit_chapter_id').val(chap.id);
            $('#modal_chapter_number').val(chap.chapter_number);
            $('#modal_chapter_name').val(chap.name);
            $('#modal_slug').val(chap.slug);
            $('#modal_hadith_count').val(chap.hadith_count || 0);
            $('#modal_sort').val(chap.sort || 1);

            $('#editChapterModal').modal('show');
        }

        function submitEditForm() {
            const id = $('#edit_chapter_id').val();
            const name = $('#modal_chapter_name').val().trim();

            if (!name) {
                toastr.error('Chapter name is required.');
                return;
            }

            const data = {
                _token: "{{ csrf_token() }}",
                chapter_number: $('#modal_chapter_number').val(),
                name: name,
                slug: $('#modal_slug').val(),
                hadith_count: $('#modal_hadith_count').val(),
                sort: $('#modal_sort').val(),
            };

            const url = "{{ route('admin.hadith-chapters.update', ':id') }}".replace(':id', id);

            $.ajax({
                url: url,
                type: "PUT",
                data: data,
                success: function(response) {
                    $('#editChapterModal').modal('hide');
                    toastr.success(response.message || 'Chapter updated successfully');
                    setTimeout(() => location.reload(), 800);
                },
                error: function(xhr) {
                    const msg = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message :
                        'Failed to update chapter.';
                    toastr.error(msg);
                }
            });
        }
    </script>
@endpush
