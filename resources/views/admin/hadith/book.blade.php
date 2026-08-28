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
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .stats-icon-bg {
            width: 54px;
            height: 54px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
        }

        .book-card {
            border: 1px solid rgba(0, 0, 0, 0.06);
            border-radius: 16px;
            background: #ffffff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
            transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
            position: relative;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .book-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.08);
            border-color: rgba(99, 102, 241, 0.2);
        }

        .book-card-header {
            padding: 1.25rem 1.25rem 0.75rem;
            border-bottom: 1px dashed #f0f0f0;
        }

        .book-card-body {
            padding: 1.25rem;
            flex: 1;
        }

        .book-card-footer {
            padding: 1rem 1.25rem;
            background: #fafafa;
            border-top: 1px solid #f0f0f0;
            border-bottom-left-radius: 16px;
            border-bottom-right-radius: 16px;
        }

        .badge-abbr {
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            color: #fff;
            font-weight: 700;
            padding: 5px 12px;
            border-radius: 8px;
            letter-spacing: 0.5px;
        }

        .badge-status-sahih {
            background: #ecfdf5;
            color: #059669;
            border: 1px solid #a7f3d0;
        }

        .badge-status-sunan {
            background: #eff6ff;
            color: #2563eb;
            border: 1px solid #bfdbfe;
        }

        .badge-status-jami {
            background: #fef3c7;
            color: #d97706;
            border: 1px solid #fde68a;
        }

        .badge-status-collection {
            background: #f3e8ff;
            color: #7c3aed;
            border: 1px solid #ddd6fe;
        }

        .filter-btn {
            border-radius: 20px;
            padding: 6px 16px;
            font-weight: 500;
            font-size: 0.875rem;
            border: 1px solid #e5e7eb;
            background: #ffffff;
            color: #4b5563;
            transition: all 0.2s ease;
        }

        .filter-btn.active,
        .filter-btn:hover {
            background: #4f46e5;
            color: #ffffff;
            border-color: #4f46e5;
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
    <x-admin.page-header title="Hadith Books Management" :breadcrumb="[['label' => 'Dashboard', 'link' => route('admin.dashboard')], ['label' => 'Hadith Books']]" />

    {{-- Stats Cards Bar --}}
    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="stats-card p-3 d-flex align-items-center">
                <div class="stats-icon-bg bg-light-primary text-primary me-3">
                    <i class="ti ti-books"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1 text-uppercase fw-semibold" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                        Total Books</h6>
                    <h3 class="mb-0 fw-bold" id="stat-total-books">{{ $stats['total_books'] }}</h3>
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
                <div class="stats-icon-bg bg-light-info text-info me-3">
                    <i class="ti ti-list-details"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1 text-uppercase fw-semibold"
                        style="font-size: 0.75rem; letter-spacing: 0.5px;">Total Chapters</h6>
                    <h3 class="mb-0 fw-bold" id="stat-total-chapters">{{ number_format($stats['total_chapters']) }}</h3>
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
                    <h3 class="mb-0 fw-bold" id="stat-active-books">{{ $stats['active_books'] }} /
                        {{ $stats['total_books'] }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- Controls & Actions Toolbar --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-3">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">

                {{-- Left: Filter Chips --}}
                <div class="d-flex flex-wrap align-items-center gap-2" id="filter-chips">
                    <button class="filter-btn active" data-filter="all">All Books</button>
                    <button class="filter-btn" data-filter="Kutub al-Sittah">Kutub al-Sittah</button>
                    <button class="filter-btn" data-filter="sahih">Sahih</button>
                    <button class="filter-btn" data-filter="sunan">Sunan</button>
                    <button class="filter-btn" data-filter="active">Active Only</button>
                </div>

                {{-- Right: Search & Actions --}}
                <div class="d-flex align-items-center gap-2 ms-auto">
                    <div class="search-box-custom">
                        <i class="ti ti-search"></i>
                        <input type="text" id="searchInput" class="form-control"
                            placeholder="Search book name, writer...">
                    </div>

                    <button class="view-btn active" id="btn-grid-view" onclick="switchView('grid')" title="Grid View">
                        <i class="ti ti-layout-grid"></i>
                    </button>
                    <button class="view-btn" id="btn-table-view" onclick="switchView('table')" title="List View">
                        <i class="ti ti-list"></i>
                    </button>

                    <button id="importBooksBtn" onclick="importBooks()" class="import-btn-gradient ms-2">
                        <i class="ti ti-cloud-download me-1"></i> Import Books
                    </button>

                    <button id="resetAllCountsBtn" onclick="resetCounts()"
                        class="btn btn-outline-warning rounded-3 fw-semibold ms-1"
                        title="Recalculate chapter and hadith counts for all books">
                        <i class="ti ti-refresh me-1"></i> Reset Counts
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Grid View Container --}}
    <div id="grid-view-container" class="row g-4 mb-4">
        @foreach ($books as $book)
            <div class="col-xl-4 col-md-6 book-item" data-name="{{ strtolower($book->name) }}"
                data-writer="{{ strtolower($book->writer) }}" data-group="{{ strtolower($book->group) }}"
                data-status="{{ strtolower($book->status) }}" data-active="{{ $book->is_active }}">

                <div class="book-card">
                    <div class="book-card-header d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge-abbr">{{ $book->abbreviation ?? 'BK' }}</span>
                            @if ($book->group)
                                <span class="badge bg-light-secondary text-secondary rounded-pill fw-medium"
                                    style="font-size: 0.75rem;">{{ $book->group }}</span>
                            @endif
                        </div>

                        <div class="form-check form-switch custom-switch mb-0">
                            <input class="form-check-input" type="checkbox" role="switch" id="switch-{{ $book->id }}"
                                {{ $book->is_active ? 'checked' : '' }}
                                onchange="toggleBookActive({{ $book->id }}, '{{ route('admin.hadith-books.status', $book->id) }}')">
                        </div>
                    </div>

                    <div class="book-card-body">
                        <div class="d-flex align-items-start justify-content-between mb-2">
                            <h5 class="fw-bold mb-0 text-dark book-title-display">{{ $book->name }}</h5>
                            @php
                                $statusClass = match (strtolower($book->status ?? '')) {
                                    'sahih' => 'badge-status-sahih',
                                    'sunan' => 'badge-status-sunan',
                                    'jami' => 'badge-status-jami',
                                    default => 'badge-status-collection',
                                };
                            @endphp
                            @if ($book->status)
                                <span class="badge {{ $statusClass }} text-uppercase ms-2"
                                    style="font-size: 0.7rem; padding: 4px 8px;">{{ $book->status }}</span>
                            @endif
                        </div>

                        <p class="text-muted small mb-3">
                            <i class="ti ti-user-edit me-1 text-primary"></i> <span
                                class="book-writer-display">{{ $book->writer ?? 'Unknown Writer' }}</span>
                            @if ($book->life_span)
                                <span class="badge bg-light-info text-info ms-1 font-monospace"
                                    style="font-size: 0.7rem;">{{ $book->life_span }}</span>
                            @endif
                        </p>

                        <div class="row text-center g-2 pt-2 border-top">
                            <div class="col-6 border-end">
                                <span class="text-muted d-block small mb-1">Chapters</span>
                                <span class="fw-bold text-dark fs-6">{{ number_format($book->chapter_count) }}</span>
                            </div>
                            <div class="col-6">
                                <span class="text-muted d-block small mb-1">Hadiths</span>
                                <span class="fw-bold text-dark fs-6">{{ number_format($book->hadith_count) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="book-card-footer d-flex align-items-center justify-content-between">
                        <a href="{{ route('admin.hadith-book-translations.index', [$book->id]) }}"
                            class="btn btn-sm btn-light-primary rounded-3 fw-semibold">
                            <i class="ti ti-language me-1"></i> Translations
                        </a>

                        <div class="d-flex gap-1">
                            <button onclick="resetCounts({{ $book->id }})"
                                class="btn btn-sm btn-outline-warning rounded-3" title="Reset counts for this book">
                                <i class="ti ti-refresh"></i>
                            </button>
                            <button onclick="openEditModal({{ json_encode($book) }})"
                                class="btn btn-sm btn-outline-secondary rounded-3">
                                <i class="ti ti-edit me-1"></i> Edit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Table View Container (Custom Styled HTML Table, non-Datatable) --}}
    <div id="table-view-container" class="card border-0 shadow-sm rounded-4 mb-4 d-none">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">#</th>
                            <th>Abbr</th>
                            <th>Book Name</th>
                            <th>Writer</th>
                            <th>Status / Group</th>
                            <th>Chapters</th>
                            <th>Hadiths</th>
                            <th>Priority</th>
                            <th>Active</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        @foreach ($books as $index => $book)
                            <tr class="book-item-row" data-name="{{ strtolower($book->name) }}"
                                data-writer="{{ strtolower($book->writer) }}"
                                data-group="{{ strtolower($book->group) }}"
                                data-status="{{ strtolower($book->status) }}" data-active="{{ $book->is_active }}">
                                <td class="ps-4 text-muted font-monospace">{{ $index + 1 }}</td>
                                <td><span class="badge-abbr">{{ $book->abbreviation ?? 'BK' }}</span></td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $book->name }}</div>
                                    <small class="text-muted font-monospace">{{ $book->slug }}</small>
                                </td>
                                <td>
                                    <div>{{ $book->writer ?? '-' }}</div>
                                    <small class="text-muted">{{ $book->life_span }}</small>
                                </td>
                                <td>
                                    @if ($book->status)
                                        <span
                                            class="badge bg-light-primary text-primary text-uppercase me-1">{{ $book->status }}</span>
                                    @endif
                                    @if ($book->group)
                                        <span class="badge bg-light-secondary text-secondary">{{ $book->group }}</span>
                                    @endif
                                </td>
                                <td class="fw-semibold">{{ number_format($book->chapter_count) }}</td>
                                <td class="fw-semibold">{{ number_format($book->hadith_count) }}</td>
                                <td><span class="badge bg-light text-dark font-monospace">{{ $book->priority }}</span>
                                </td>
                                <td>
                                    <div class="form-check form-switch custom-switch mb-0">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            {{ $book->is_active ? 'checked' : '' }}
                                            onchange="toggleBookActive({{ $book->id }}, '{{ route('admin.hadith-books.status', $book->id) }}')">
                                    </div>
                                </td>
                                <td class="text-end pe-4">
                                    <a href="{{ route('admin.hadith-book-translations.index', [$book->id]) }}"
                                        class="btn btn-sm btn-light-primary me-1" title="Translations">
                                        <i class="ti ti-language"></i>
                                    </a>
                                    <button onclick="resetCounts({{ $book->id }})"
                                        class="btn btn-sm btn-outline-warning me-1" title="Reset Counts">
                                        <i class="ti ti-refresh"></i>
                                    </button>
                                    <button onclick="openEditModal({{ json_encode($book) }})"
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

    {{-- Modern Creative Edit Modal --}}
    <div class="modal fade" id="editBookModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header border-0 pb-0 pt-4 px-4">
                    <div>
                        <h4 class="modal-title fw-bold text-dark" id="editModalTitle">Edit Hadith Book</h4>
                        <p class="text-muted small mb-0">Update book details and metadata</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form id="editBookForm">
                        <input type="hidden" id="edit_book_id">

                        <div class="row g-3">
                            <div class="col-md-8">
                                <label for="modal_book_name" class="form-label fw-semibold">Book Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" id="modal_book_name" class="form-control rounded-3"
                                    placeholder="Book Name" required>
                            </div>

                            <div class="col-md-4">
                                <label for="modal_abbreviation" class="form-label fw-semibold">Abbreviation</label>
                                <input type="text" id="modal_abbreviation" class="form-control rounded-3"
                                    placeholder="e.g. SB, SM">
                            </div>

                            <div class="col-md-6">
                                <label for="modal_writer" class="form-label fw-semibold">Writer / Author</label>
                                <input type="text" id="modal_writer" class="form-control rounded-3"
                                    placeholder="Writer Name">
                            </div>

                            <div class="col-md-6">
                                <label for="modal_life_span" class="form-label fw-semibold">Writer Life Span</label>
                                <input type="text" id="modal_life_span" class="form-control rounded-3"
                                    placeholder="e.g. 194-256 AH">
                            </div>

                            <div class="col-md-4">
                                <label for="modal_status" class="form-label fw-semibold">Status / Type</label>
                                <input type="text" id="modal_status" class="form-control rounded-3"
                                    placeholder="e.g. sahih, sunan">
                            </div>

                            <div class="col-md-4">
                                <label for="modal_group" class="form-label fw-semibold">Group</label>
                                <input type="text" id="modal_group" class="form-control rounded-3"
                                    placeholder="e.g. Kutub al-Sittah">
                            </div>

                            <div class="col-md-4">
                                <label for="modal_priority" class="form-label fw-semibold">Priority Order</label>
                                <input type="number" id="modal_priority" class="form-control rounded-3"
                                    placeholder="0">
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
        let currentFilter = 'all';

        $(document).ready(function() {
            // Live Search Filter
            $('#searchInput').on('keyup', function() {
                applyFilters();
            });

            // Filter Chips Click
            $('#filter-chips .filter-btn').on('click', function() {
                $('#filter-chips .filter-btn').removeClass('active');
                $(this).addClass('active');
                currentFilter = $(this).data('filter');
                applyFilters();
            });
        });

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

        function applyFilters() {
            const query = $('#searchInput').val().toLowerCase().trim();

            $('.book-item, .book-item-row').each(function() {
                const name = $(this).data('name') || '';
                const writer = $(this).data('writer') || '';
                const group = $(this).data('group') || '';
                const status = $(this).data('status') || '';
                const active = $(this).data('active');

                const matchesQuery = !query || name.includes(query) || writer.includes(query);

                let matchesFilter = true;
                if (currentFilter === 'active') {
                    matchesFilter = active == 1 || active === true;
                } else if (currentFilter !== 'all') {
                    const cf = currentFilter.toLowerCase();
                    matchesFilter = group.includes(cf) || status.includes(cf);
                }

                if (matchesQuery && matchesFilter) {
                    $(this).removeClass('d-none');
                } else {
                    $(this).addClass('d-none');
                }
            });
        }

        function toggleBookActive(id, url) {
            $.ajax({
                url: url,
                type: "PATCH",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    toastr.success(response.message || 'Status updated');
                    refreshData();
                },
                error: function(xhr) {
                    toastr.error('Failed to update status.');
                }
            });
        }

        function importBooks() {
            if (!confirm('Import/Update Hadith books from API?')) {
                return;
            }

            const btn = $('#importBooksBtn');
            const originalHtml = btn.html();
            btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span> Importing...');

            $.ajax({
                url: "{{ route('admin.hadith-books.import') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    btn.prop('disabled', false).html(originalHtml);
                    if (response.status) {
                        toastr.success(response.message);
                        if (response.warnings && response.warnings.length > 0) {
                            response.warnings.forEach(w => toastr.warning(w));
                        }
                        refreshData();
                    } else {
                        toastr.error(response.message || 'Import failed.');
                    }
                },
                error: function(xhr) {
                    btn.prop('disabled', false).html(originalHtml);
                    const msg = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message :
                        'Error during import.';
                    toastr.error(msg);
                }
            });
        }

        function openEditModal(book) {
            $('#edit_book_id').val(book.id);
            $('#modal_book_name').val(book.name);
            $('#modal_writer').val(book.writer || '');
            $('#modal_abbreviation').val(book.abbreviation || '');
            $('#modal_status').val(book.status || '');
            $('#modal_group').val(book.group || '');
            $('#modal_life_span').val(book.life_span || '');
            $('#modal_priority').val(book.priority || 0);

            $('#editBookModal').modal('show');
        }

        function submitEditForm() {
            const id = $('#edit_book_id').val();
            const name = $('#modal_book_name').val().trim();

            if (!name) {
                toastr.error('Book name is required.');
                return;
            }

            const data = {
                _token: "{{ csrf_token() }}",
                name: name,
                writer: $('#modal_writer').val(),
                abbreviation: $('#modal_abbreviation').val(),
                status: $('#modal_status').val(),
                group: $('#modal_group').val(),
                life_span: $('#modal_life_span').val(),
                priority: $('#modal_priority').val(),
            };

            const url = "{{ route('admin.hadith-books.update', ':id') }}".replace(':id', id);

            $.ajax({
                url: url,
                type: "PUT",
                data: data,
                success: function(response) {
                    $('#editBookModal').modal('hide');
                    toastr.success(response.message || 'Book updated successfully');
                    refreshData();
                },
                error: function(xhr) {
                    const msg = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message :
                        'Failed to update book.';
                    toastr.error(msg);
                }
            });
        }

        function refreshData() {
            $.ajax({
                url: "{{ route('admin.hadith-books.index') }}",
                type: "GET",
                dataType: "json",
                success: function(response) {
                    if (response.stats) {
                        $('#stat-total-books').text(response.stats.total_books);
                        $('#stat-total-hadiths').text(response.stats.total_hadiths.toLocaleString());
                        $('#stat-total-chapters').text(response.stats.total_chapters.toLocaleString());
                        $('#stat-active-books').text(response.stats.active_books + ' / ' + response.stats
                            .total_books);
                    }
                    // Reload page smoothly or re-render grid
                    location.reload();
                }
            });
        }

        function resetCounts(bookId) {
            const scope = bookId ? 'this book' : 'ALL books';
            if (!confirm(
                    `Recalculate chapter and hadith counts for ${scope}? This reads from the database and updates stored counts.`
                    )) return;

            const btn = bookId ?
                $(`button[onclick="resetCounts(${bookId})"]`).first() :
                $('#resetAllCountsBtn');

            const originalHtml = btn.html();
            btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span> Resetting...');

            $.ajax({
                url: "{{ route('admin.hadith-books.reset-counts') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    book_id: bookId || '',
                },
                success: function(r) {
                    btn.prop('disabled', false).html(originalHtml);
                    if (r.status) {
                        toastr.success(r.message);
                        setTimeout(() => location.reload(), 1000);
                    } else {
                        toastr.error(r.message || 'Reset failed.');
                    }
                },
                error: function(xhr) {
                    btn.prop('disabled', false).html(originalHtml);
                    const msg = xhr.responseJSON && xhr.responseJSON.message ?
                        xhr.responseJSON.message :
                        'Error resetting counts.';
                    toastr.error(msg);
                }
            });
        }
    </script>
@endpush
