@extends('layouts.admin')

@push('styles')
    <style>
        .ck-editor__editable_inline {
            min-height: 200px;
        }
        .ck.ck-balloon-panel,
        .ck.ck-dropdown__panel {
            z-index: 1060 !important;
        }
        .lesson-header-card {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            color: #fff;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .nav-tabs .nav-link {
            font-weight: 600;
            color: #475569;
            border-radius: 8px 8px 0 0;
            padding: 0.75rem 1.25rem;
            transition: all 0.2s ease;
        }
        .nav-tabs .nav-link.active {
            color: #2563eb;
            background-color: #fff;
            border-color: #cbd5e1 #cbd5e1 #fff;
        }
        .repeater-card {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 0.75rem;
            position: relative;
        }
    </style>
@endpush

@section('content')
    <x-admin.page-header :title="'Lesson Studio - ' . ($lesson->translation ? $lesson->translation->title : $lesson->slug)" :breadcrumb="[
        ['label' => 'Dashboard', 'link' => route('admin.dashboard')],
        ['label' => 'Courses', 'link' => route('admin.courses.index')],
        ['label' => 'Chapters', 'link' => route('admin.chapters.index', $lesson->chapter?->course_id)],
        ['label' => 'Lessons', 'link' => route('admin.lessons.index', $lesson->chapter_id)],
        ['label' => 'Studio & References'],
    ]" />

    <!-- Lesson Top Overview Banner -->
    <div class="lesson-header-card">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div>
                <div class="d-flex align-items-center gap-2 mb-1">
                    <span class="badge bg-primary px-2 py-1"><i class="fa fa-book-open me-1"></i> Lesson</span>
                    <span class="badge {{ $lesson->status ? 'bg-success' : 'bg-danger' }}">
                        {{ $lesson->status ? 'Active' : 'Inactive' }}
                    </span>
                </div>
                <h3 class="text-white mb-1 fw-bold">
                    {{ $lesson->translation ? $lesson->translation->title : $lesson->slug }}
                </h3>
                <div class="text-white-50 fs-6">
                    <span><strong>Course:</strong> {{ $lesson->chapter?->course?->translation?->title ?: $lesson->chapter?->course?->slug }}</span>
                    <span class="mx-2">•</span>
                    <span><strong>Chapter:</strong> {{ $lesson->chapter?->translation?->title ?: $lesson->chapter?->slug }}</span>
                    <span class="mx-2">•</span>
                    <span><strong>Slug:</strong> <code>{{ $lesson->slug }}</code></span>
                </div>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.lesson-translations.index', $lesson->id) }}" class="btn btn-outline-light btn-sm">
                    <i class="fa fa-language me-1"></i> Translations
                </a>
                <a href="{{ route('admin.lessons.index', $lesson->chapter_id) }}" class="btn btn-light btn-sm">
                    <i class="fa fa-arrow-left me-1"></i> Back to Lessons
                </a>
            </div>
        </div>
    </div>

    <!-- Main Navigation Tabs -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white pb-0 border-bottom">
            <ul class="nav nav-tabs card-header-tabs" id="lessonTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="contents-tab" data-bs-toggle="tab" data-bs-target="#tab-contents" type="button" role="tab">
                        <i class="fa fa-file-text me-2 text-primary"></i> 1. Lesson Contents & Notes
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="references-tab" data-bs-toggle="tab" data-bs-target="#tab-references" type="button" role="tab">
                        <i class="fa fa-bookmark me-2 text-info"></i> 2. Lesson References
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="quran-tab" data-bs-toggle="tab" data-bs-target="#tab-quran" type="button" role="tab">
                        <i class="fa fa-quran me-2 text-success"></i> 3. Quran References
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="hadith-tab" data-bs-toggle="tab" data-bs-target="#tab-hadith" type="button" role="tab">
                        <i class="fa fa-book me-2 text-warning"></i> 4. Hadith References
                    </button>
                </li>
            </ul>
        </div>

        <div class="card-body">
            <div class="tab-content" id="lessonTabsContent">

                <!-- ======================================================== -->
                <!-- TAB 1: LESSON CONTENTS & NOTES -->
                <!-- ======================================================== -->
                <div class="tab-pane fade show active" id="tab-contents" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h5 class="mb-0 fw-bold">Lesson Notes & Key Points</h5>
                            <small class="text-muted">Rich notes, descriptions, and structured key takeaway points per language.</small>
                        </div>
                        <button type="button" class="btn btn-primary btn-sm" onclick="openContentModal(0)">
                            <i class="fa fa-plus me-1"></i> Add Lesson Content
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped w-100" id="contentsTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Language</th>
                                    <th>Notes (Preview)</th>
                                    <th>Key Points</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>

                <!-- ======================================================== -->
                <!-- TAB 2: LESSON REFERENCES -->
                <!-- ======================================================== -->
                <div class="tab-pane fade" id="tab-references" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h5 class="mb-0 fw-bold">Lesson References Hub</h5>
                            <small class="text-muted">Reference citations, simplified commentary, multi-language translations, and linked Quran / Hadith verses.</small>
                        </div>
                        <button type="button" class="btn btn-info text-white btn-sm" onclick="openReferenceModal(0)">
                            <i class="fa fa-plus me-1"></i> Add Reference
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped w-100" id="referencesTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Reference Title</th>
                                    <th>Simplified Note</th>
                                    <th>Translations</th>
                                    <th>Linked Quran</th>
                                    <th>Linked Hadith</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>

                <!-- ======================================================== -->
                <!-- TAB 3: QURAN REFERENCES -->
                <!-- ======================================================== -->
                <div class="tab-pane fade" id="tab-quran" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h5 class="mb-0 fw-bold">Quran References (Ayah Linkage)</h5>
                            <small class="text-muted">Link specific Quran Surah and Ayah verses directly to a Lesson Reference.</small>
                        </div>
                        <button type="button" class="btn btn-success btn-sm" onclick="openQuranModal(0)">
                            <i class="fa fa-plus me-1"></i> Add Quran Reference
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped w-100" id="quranTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Belongs To Reference</th>
                                    <th>Surah Name</th>
                                    <th>Surah Number</th>
                                    <th>Verse / Ayah No</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>

                <!-- ======================================================== -->
                <!-- TAB 4: HADITH REFERENCES -->
                <!-- ======================================================== -->
                <div class="tab-pane fade" id="tab-hadith" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h5 class="mb-0 fw-bold">Hadith References (Collection Linkage)</h5>
                            <small class="text-muted">Link authentic Hadith collections and specific Hadith verses to a Lesson Reference.</small>
                        </div>
                        <button type="button" class="btn btn-warning text-dark btn-sm" onclick="openHadithModal(0)">
                            <i class="fa fa-plus me-1"></i> Add Hadith Reference
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped w-100" id="hadithTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Belongs To Reference</th>
                                    <th>Hadith Book</th>
                                    <th>Chapter & Hadith #</th>
                                    <th>Verse / Number</th>
                                    <th>Preview Text</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- MODAL 1: LESSON CONTENT (NOTES & KEY POINTS) -->
    <!-- ========================================================================= -->
    <div class="modal fade" id="contentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="contentModalTitle">Add Lesson Content</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="content_edit_id">

                    <div class="form-group mb-3">
                        <label for="content_lang" class="form-label fw-bold">Language <span class="text-danger">*</span></label>
                        <select id="content_lang" class="form-select">
                            <option value="en">English (en)</option>
                            <option value="ml">Malayalam (ml)</option>
                            <option value="ar">Arabic (ar)</option>
                            <option value="ur">Urdu (ur)</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="content_notes" class="form-label fw-bold">Lesson Notes (Rich Text)</label>
                        <textarea id="content_notes" class="form-control"></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label class="form-label mb-0 fw-bold">Key Notes / Points</label>
                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="addKeyNoteRow()">
                                <i class="fa fa-plus"></i> Add Key Point
                            </button>
                        </div>
                        <div id="key_notes_container"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="saveContentPost()">Save Content</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- MODAL 2: GENERAL REFERENCE -->
    <!-- ========================================================================= -->
    <div class="modal fade" id="referenceModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="referenceModalTitle">Add Lesson Reference</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="reference_edit_id">

                    <div class="form-group mb-3">
                        <label for="reference_title" class="form-label fw-bold">Title / Citation <span class="text-danger">*</span></label>
                        <input type="text" id="reference_title" class="form-control" placeholder="e.g. Tafsir Ibn Kathir, Vol 1, Page 204">
                    </div>

                    <div class="form-group mb-3">
                        <label for="reference_simplified" class="form-label fw-bold">Simplified Explanation / Summary</label>
                        <textarea id="reference_simplified" class="form-control" rows="3" placeholder="Brief explanation or summary of this reference..."></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label class="form-label mb-0 fw-bold">Multi-Language Translations</label>
                            <button type="button" class="btn btn-sm btn-outline-info" onclick="addRefTranslationRow()">
                                <i class="fa fa-plus"></i> Add Translation
                            </button>
                        </div>
                        <div id="ref_translations_container"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-info text-white" onclick="saveReferencePost()">Save Reference</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- MODAL 3: QURAN REFERENCE -->
    <!-- ========================================================================= -->
    <div class="modal fade" id="quranModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="quranModalTitle">Add Quran Reference</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="quran_edit_id">

                    <div class="form-group mb-3">
                        <label for="quran_reference_id" class="form-label fw-bold">Belongs to Lesson Reference <span class="text-danger">*</span></label>
                        <select id="quran_reference_id" class="form-select reference-select-dropdown">
                            <option value="">-- Select Lesson Reference --</option>
                            @foreach ($lessonReferences as $lRef)
                                <option value="{{ $lRef->id }}">{{ $lRef->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="quran_surah_id" class="form-label fw-bold">Surah (Chapter) <span class="text-danger">*</span></label>
                        <select id="quran_surah_id" class="form-select" onchange="updateSurahHint()">
                            <option value="">-- Select Surah --</option>
                            @foreach ($surahs as $surah)
                                @php
                                    $sTrans = $surah->translations->first();
                                    $sTitle = $sTrans ? $sTrans->name : $surah->name;
                                @endphp
                                <option value="{{ $surah->id }}" data-verses="{{ $surah->no_of_verses }}" data-name="{{ $surah->name }}" data-title="{{ $sTitle }}">
                                    {{ $surah->id }}. {{ $surah->name }} ({{ $sTitle }}) - {{ $surah->no_of_verses }} Verses
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="quran_verse_no" class="form-label fw-bold">Verse / Ayah Number <span class="text-danger">*</span></label>
                        <input type="number" id="quran_verse_no" class="form-control" placeholder="e.g. 255" min="1">
                        <small id="surah_verse_hint" class="text-muted d-block mt-1"></small>
                    </div>

                    <div class="alert alert-light border py-2 px-3 mb-0" id="quran_preview_badge" style="display: none;">
                        <i class="fa fa-info-circle text-success me-1"></i> <span id="quran_preview_text"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success" onclick="saveQuranPost()">Save Quran Reference</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- MODAL 4: HADITH REFERENCE -->
    <!-- ========================================================================= -->
    <div class="modal fade" id="hadithModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="hadithModalTitle">Add Hadith Reference</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="hadith_edit_id">

                    <div class="form-group mb-3">
                        <label for="hadith_reference_id" class="form-label fw-bold">Belongs to Lesson Reference <span class="text-danger">*</span></label>
                        <select id="hadith_reference_id" class="form-select reference-select-dropdown">
                            <option value="">-- Select Lesson Reference --</option>
                            @foreach ($lessonReferences as $lRef)
                                <option value="{{ $lRef->id }}">{{ $lRef->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label for="hadith_book_filter" class="form-label fw-bold">Filter by Hadith Book</label>
                            <select id="hadith_book_filter" class="form-select" onchange="fetchHadithVerses()">
                                <option value="">All Hadith Books</option>
                                @foreach ($hadithBooks as $hBook)
                                    @php
                                        $bTrans = $hBook->translations->first();
                                        $bTitle = $bTrans ? $bTrans->title : $hBook->slug;
                                    @endphp
                                    <option value="{{ $hBook->id }}">{{ $bTitle }} ({{ $hBook->slug }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 form-group mb-3">
                            <label for="hadith_verse_search" class="form-label fw-bold">Search Hadith</label>
                            <div class="input-group">
                                <input type="text" id="hadith_verse_search" class="form-control" placeholder="Type hadith number or text..." onkeyup="debounceFetchHadith()">
                                <button class="btn btn-outline-secondary" type="button" onclick="fetchHadithVerses()"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="hadith_verse_id" class="form-label fw-bold">Select Hadith Record <span class="text-danger">*</span></label>
                        <select id="hadith_verse_id" class="form-select" onchange="onHadithSelectChange()">
                            <option value="">-- Search and Select Hadith --</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="hadith_verse_no" class="form-label fw-bold">Verse / Reference Number <span class="text-danger">*</span></label>
                        <input type="number" id="hadith_verse_no" class="form-control" placeholder="e.g. 1" min="1">
                    </div>

                    <div class="alert alert-light border py-2 px-3 mb-0" id="hadith_preview_box" style="display: none;">
                        <h6 class="fw-bold mb-1" id="hadith_preview_heading"></h6>
                        <p class="small text-muted mb-0" id="hadith_preview_text"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-warning text-dark" onclick="saveHadithPost()">Save Hadith Reference</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>

    <script>
        const lessonId = "{{ $lesson->id }}";
        const csrfToken = "{{ csrf_token() }}";
        let contentNotesEditor = null;
        let debounceTimer = null;

        $(document).ready(function() {
            // Initialize CKEditor 5 for Lesson Content
            ClassicEditor
                .create(document.querySelector('#content_notes'), {
                    toolbar: [
                        'heading', '|',
                        'bold', 'italic', 'underline', 'strikethrough', '|',
                        'bulletedList', 'numberedList', 'blockQuote', '|',
                        'link', 'insertTable', '|',
                        'undo', 'redo'
                    ]
                })
                .then(editor => {
                    contentNotesEditor = editor;
                })
                .catch(error => {
                    console.error('CKEditor Error:', error);
                });

            // 1. Initialize Contents DataTable
            $('#contentsTable').DataTable({
                pageLength: 10,
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.lessons.contents.dataTable', $lesson->id) }}",
                columns: [
                    { data: 'id', name: 'id', className: 'text-center' },
                    { 
                        data: 'lang', 
                        name: 'lang', 
                        className: 'text-center',
                        render: function(data) {
                            return `<span class="badge bg-secondary text-uppercase">${data}</span>`;
                        }
                    },
                    { 
                        data: 'notes', 
                        name: 'notes',
                        render: function(data) {
                            if (!data) return '<span class="text-muted">-</span>';
                            const plain = $('<div>').html(data).text();
                            return plain.length > 70 ? plain.substring(0, 70) + '...' : plain;
                        }
                    },
                    { 
                        data: 'key_notes', 
                        name: 'key_notes',
                        className: 'text-center',
                        render: function(data) {
                            if (Array.isArray(data) && data.length > 0) {
                                return `<span class="badge bg-light-primary text-primary">${data.length} Points</span>`;
                            }
                            return '<span class="text-muted">0</span>';
                        }
                    },
                    { 
                        data: 'status', 
                        name: 'status',
                        className: 'text-center',
                        render: function(data, type, row) {
                            const label = data ? 'Active' : 'Inactive';
                            const text = data ? 'text-success' : 'text-danger';
                            const url = "{{ route('admin.lessons.contents.status', [$lesson->id, ':id']) }}".replace(':id', row.id);
                            return `<button onclick="updateStatus('${url}', '${csrfToken}', 'contentsTable')" class="${text} btn btn-link p-0">${label}</button>`;
                        }
                    },
                    { 
                        data: null, 
                        name: 'actions',
                        className: 'text-center',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            window['contentRow' + row.id] = row;
                            const delUrl = "{{ route('admin.lessons.contents.destroy', [$lesson->id, ':id']) }}".replace(':id', row.id);
                            return `<button onclick="openContentModal(${row.id})" class="btn btn-sm btn-link">Edit</button> |
                                    <button onclick="deleteItem('${delUrl}', '${csrfToken}', 'contentsTable')" class="btn btn-sm btn-link text-danger">Delete</button>`;
                        }
                    }
                ]
            });

            // 2. Initialize References DataTable
            $('#referencesTable').DataTable({
                pageLength: 10,
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.lessons.references.dataTable', $lesson->id) }}",
                columns: [
                    { data: 'id', name: 'id', className: 'text-center' },
                    { data: 'title', name: 'title', className: 'fw-bold' },
                    { 
                        data: 'simplified', 
                        name: 'simplified',
                        render: function(data) {
                            return data ? (data.length > 60 ? data.substring(0, 60) + '...' : data) : '<span class="text-muted">-</span>';
                        }
                    },
                    { 
                        data: 'translations', 
                        name: 'translations',
                        className: 'text-center',
                        orderable: false,
                        searchable: false,
                        render: function(data) {
                            if (Array.isArray(data) && data.length > 0) {
                                return `<span class="badge bg-light-info text-info">${data.length} Languages</span>`;
                            }
                            return '<span class="text-muted">None</span>';
                        }
                    },
                    { 
                        data: 'all_quran_references_count', 
                        name: 'all_quran_references_count',
                        className: 'text-center',
                        orderable: false,
                        searchable: false,
                        render: function(data) {
                            return `<span class="badge bg-light-success text-success">${data || 0} Verses</span>`;
                        }
                    },
                    { 
                        data: 'all_hadith_references_count', 
                        name: 'all_hadith_references_count',
                        className: 'text-center',
                        orderable: false,
                        searchable: false,
                        render: function(data) {
                            return `<span class="badge bg-light-warning text-dark">${data || 0} Hadiths</span>`;
                        }
                    },
                    { 
                        data: 'status', 
                        name: 'status',
                        className: 'text-center',
                        render: function(data, type, row) {
                            const label = data ? 'Active' : 'Inactive';
                            const text = data ? 'text-success' : 'text-danger';
                            const url = "{{ route('admin.lessons.references.status', [$lesson->id, ':id']) }}".replace(':id', row.id);
                            return `<button onclick="updateStatus('${url}', '${csrfToken}', 'referencesTable')" class="${text} btn btn-link p-0">${label}</button>`;
                        }
                    },
                    { 
                        data: null, 
                        name: 'actions',
                        className: 'text-center',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            window['refRow' + row.id] = row;
                            const delUrl = "{{ route('admin.lessons.references.destroy', [$lesson->id, ':id']) }}".replace(':id', row.id);
                            return `<button onclick="openReferenceModal(${row.id})" class="btn btn-sm btn-link">Edit</button> |
                                    <button onclick="deleteReferenceItem('${delUrl}')" class="btn btn-sm btn-link text-danger">Delete</button>`;
                        }
                    }
                ]
            });

            // 3. Initialize Quran DataTable
            $('#quranTable').DataTable({
                pageLength: 10,
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.lessons.quran-references.dataTable', $lesson->id) }}",
                columns: [
                    { data: 'id', name: 'id', className: 'text-center' },
                    { 
                        data: 'reference.title', 
                        name: 'reference.title',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return data ? `<strong>${data}</strong>` : `<span class="text-muted">Ref #${row.lesson_reference_id}</span>`;
                        }
                    },
                    { 
                        data: 'surah', 
                        name: 'surah_id',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            if (!data) return `Surah #${row.surah_id}`;
                            const transl = (data.translations && data.translations[0]) ? data.translations[0].name : '';
                            return `<strong>${data.name}</strong> ${transl ? '(' + transl + ')' : ''}`;
                        }
                    },
                    { 
                        data: 'surah_id', 
                        name: 'surah_id',
                        className: 'text-center',
                        render: function(data) {
                            return `<span class="badge bg-light-success text-success">Surah ${data}</span>`;
                        }
                    },
                    { 
                        data: 'verse_no', 
                        name: 'verse_no',
                        className: 'text-center',
                        render: function(data) {
                            return `<span class="badge bg-secondary">Ayah ${data}</span>`;
                        }
                    },
                    { 
                        data: 'status', 
                        name: 'status',
                        className: 'text-center',
                        render: function(data, type, row) {
                            const label = data ? 'Active' : 'Inactive';
                            const text = data ? 'text-success' : 'text-danger';
                            const url = "{{ route('admin.lessons.quran-references.status', [$lesson->id, ':id']) }}".replace(':id', row.id);
                            return `<button onclick="updateStatus('${url}', '${csrfToken}', 'quranTable')" class="${text} btn btn-link p-0">${label}</button>`;
                        }
                    },
                    { 
                        data: null, 
                        name: 'actions',
                        className: 'text-center',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            window['quranRow' + row.id] = row;
                            const delUrl = "{{ route('admin.lessons.quran-references.destroy', [$lesson->id, ':id']) }}".replace(':id', row.id);
                            return `<button onclick="openQuranModal(${row.id})" class="btn btn-sm btn-link">Edit</button> |
                                    <button onclick="deleteQuranItem('${delUrl}')" class="btn btn-sm btn-link text-danger">Delete</button>`;
                        }
                    }
                ]
            });

            // 4. Initialize Hadith DataTable
            $('#hadithTable').DataTable({
                pageLength: 10,
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.lessons.hadith-references.dataTable', $lesson->id) }}",
                columns: [
                    { data: 'id', name: 'id', className: 'text-center' },
                    { 
                        data: 'reference.title', 
                        name: 'reference.title',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return data ? `<strong>${data}</strong>` : `<span class="text-muted">Ref #${row.lesson_reference_id}</span>`;
                        }
                    },
                    { 
                        data: 'hadith_verse.book', 
                        name: 'hadith_verse_id',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            if (!data) return '-';
                            const trans = (data.translations && data.translations[0]) ? data.translations[0].title : data.slug;
                            return `<strong>${trans}</strong>`;
                        }
                    },
                    { 
                        data: 'hadith_verse', 
                        name: 'hadith_verse_id',
                        className: 'text-center',
                        orderable: false,
                        searchable: false,
                        render: function(data) {
                            if (!data) return '-';
                            return `<span class="badge bg-light-warning text-dark">Hadith #${data.hadith_number || data.id}</span>`;
                        }
                    },
                    { 
                        data: 'verse_no', 
                        name: 'verse_no',
                        className: 'text-center',
                        render: function(data) {
                            return `<span class="badge bg-secondary">Verse ${data}</span>`;
                        }
                    },
                    { 
                        data: 'hadith_verse.heading', 
                        name: 'hadith_verse_id',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            const text = data || (row.hadith_verse ? row.hadith_verse.text : '');
                            if (!text) return '<span class="text-muted">-</span>';
                            return text.length > 50 ? text.substring(0, 50) + '...' : text;
                        }
                    },
                    { 
                        data: 'status', 
                        name: 'status',
                        className: 'text-center',
                        render: function(data, type, row) {
                            const label = data ? 'Active' : 'Inactive';
                            const text = data ? 'text-success' : 'text-danger';
                            const url = "{{ route('admin.lessons.hadith-references.status', [$lesson->id, ':id']) }}".replace(':id', row.id);
                            return `<button onclick="updateStatus('${url}', '${csrfToken}', 'hadithTable')" class="${text} btn btn-link p-0">${label}</button>`;
                        }
                    },
                    { 
                        data: null, 
                        name: 'actions',
                        className: 'text-center',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            window['hadithRow' + row.id] = row;
                            const delUrl = "{{ route('admin.lessons.hadith-references.destroy', [$lesson->id, ':id']) }}".replace(':id', row.id);
                            return `<button onclick="openHadithModal(${row.id})" class="btn btn-sm btn-link">Edit</button> |
                                    <button onclick="deleteHadithItem('${delUrl}')" class="btn btn-sm btn-link text-danger">Delete</button>`;
                        }
                    }
                ]
            });
        });

        // Helper to refresh reference dropdowns in modals dynamically
        function refreshReferenceDropdowns(selectedId = null) {
            $.ajax({
                url: "{{ route('admin.lessons.references.list', $lesson->id) }}",
                type: "GET",
                success: function(refs) {
                    const dropdowns = $('.reference-select-dropdown');
                    dropdowns.empty().append('<option value="">-- Select Lesson Reference --</option>');
                    refs.forEach(r => {
                        dropdowns.append(`<option value="${r.id}">${escapeHtml(r.title)}</option>`);
                    });
                    if (selectedId) {
                        dropdowns.val(selectedId);
                    }
                }
            });
        }

        // =========================================================================
        // 1. LESSON CONTENT (NOTES & KEY POINTS) FUNCTIONS
        // =========================================================================
        function openContentModal(id) {
            toastr.clear();
            const isCreate = id === 0;
            $('#content_edit_id').val(isCreate ? '' : id);
            $('#contentModalTitle').text(isCreate ? 'Add Lesson Content' : 'Edit Lesson Content');
            $('#key_notes_container').empty();

            if (isCreate) {
                $('#content_lang').val('en');
                if (contentNotesEditor) contentNotesEditor.setData('');
            } else {
                const row = window['contentRow' + id];
                if (row) {
                    $('#content_lang').val(row.lang);
                    if (contentNotesEditor) contentNotesEditor.setData(row.notes || '');

                    let keyNotes = row.key_notes;
                    if (typeof keyNotes === 'string') {
                        try { keyNotes = JSON.parse(keyNotes); } catch(e) { keyNotes = []; }
                    }
                    if (Array.isArray(keyNotes) && keyNotes.length > 0) {
                        keyNotes.forEach(kn => addKeyNoteRow(kn.title || '', kn.desc || ''));
                    }
                }
            }

            $('#contentModal').modal('show');
        }

        function addKeyNoteRow(title = '', desc = '') {
            const index = $('#key_notes_container .repeater-card').length;
            const html = `
                <div class="repeater-card" id="key_note_row_${index}">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="badge bg-light-primary text-primary">Key Point #${index + 1}</span>
                        <button type="button" class="btn btn-sm btn-link text-danger p-0" onclick="$('#key_note_row_${index}').remove()">
                            <i class="fa fa-trash"></i> Remove
                        </button>
                    </div>
                    <div class="row">
                        <div class="col-md-5 mb-2">
                            <input type="text" class="form-control form-control-sm kn-title" placeholder="Topic / Key Point Title" value="${escapeHtml(title)}">
                        </div>
                        <div class="col-md-7 mb-2">
                            <textarea class="form-control form-control-sm kn-desc" rows="2" placeholder="Key Point Description / Note">${escapeHtml(desc)}</textarea>
                        </div>
                    </div>
                </div>
            `;
            $('#key_notes_container').append(html);
        }

        function saveContentPost() {
            const id = $('#content_edit_id').val();
            const notes = contentNotesEditor ? contentNotesEditor.getData() : $('#content_notes').val();
            const keyNotes = [];

            $('#key_notes_container .repeater-card').each(function() {
                const t = $(this).find('.kn-title').val();
                const d = $(this).find('.kn-desc').val();
                if (t.trim() || d.trim()) {
                    keyNotes.push({ title: t, desc: d });
                }
            });

            const data = {
                _token: csrfToken,
                lesson_id: lessonId,
                lang: $('#content_lang').val(),
                notes: notes,
                key_notes: keyNotes
            };

            let url = "{{ route('admin.lessons.contents.store', $lesson->id) }}";
            let method = "POST";

            if (id) {
                url = "{{ route('admin.lessons.contents.update', [$lesson->id, ':id']) }}".replace(':id', id);
                method = "PUT";
            }

            toastr.clear();
            showLoader();

            $.ajax({
                url: url,
                type: method,
                data: data,
                success: function(res) {
                    toastr.success(res.message);
                    $('#contentModal').modal('hide');
                    $('#contentsTable').DataTable().ajax.reload(null, false);
                },
                error: function(xhr) {
                    toastr.error(xhr.responseJSON?.message || (xhr.responseJSON?.errors ? Object.values(xhr.responseJSON.errors).flat().join('<br>') : 'Error occurred'));
                },
                complete: function() {
                    hideLoader();
                }
            });
        }

        // =========================================================================
        // 2. LESSON REFERENCES FUNCTIONS
        // =========================================================================
        function openReferenceModal(id) {
            toastr.clear();
            const isCreate = id === 0;
            $('#reference_edit_id').val(isCreate ? '' : id);
            $('#referenceModalTitle').text(isCreate ? 'Add Lesson Reference' : 'Edit Lesson Reference');
            $('#ref_translations_container').empty();

            if (isCreate) {
                $('#reference_title').val('');
                $('#reference_simplified').val('');
            } else {
                const row = window['refRow' + id];
                if (row) {
                    $('#reference_title').val(row.title || '');
                    $('#reference_simplified').val(row.simplified || '');

                    let translations = row.translations;
                    if (typeof translations === 'string') {
                        try { translations = JSON.parse(translations); } catch(e) { translations = []; }
                    }
                    if (Array.isArray(translations) && translations.length > 0) {
                        translations.forEach(tr => addRefTranslationRow(tr.lang || 'en', tr.text || ''));
                    }
                }
            }

            $('#referenceModal').modal('show');
        }

        function addRefTranslationRow(lang = 'en', text = '') {
            const index = $('#ref_translations_container .repeater-card').length;
            const html = `
                <div class="repeater-card" id="ref_tr_row_${index}">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="badge bg-light-info text-info">Translation #${index + 1}</span>
                        <button type="button" class="btn btn-sm btn-link text-danger p-0" onclick="$('#ref_tr_row_${index}').remove()">
                            <i class="fa fa-trash"></i> Remove
                        </button>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <select class="form-select form-select-sm ref-tr-lang">
                                <option value="en" ${lang === 'en' ? 'selected' : ''}>English (en)</option>
                                <option value="ml" ${lang === 'ml' ? 'selected' : ''}>Malayalam (ml)</option>
                                <option value="ar" ${lang === 'ar' ? 'selected' : ''}>Arabic (ar)</option>
                                <option value="ur" ${lang === 'ur' ? 'selected' : ''}>Urdu (ur)</option>
                            </select>
                        </div>
                        <div class="col-md-9 mb-2">
                            <textarea class="form-control form-control-sm ref-tr-text" rows="2" placeholder="Translated Reference Text">${escapeHtml(text)}</textarea>
                        </div>
                    </div>
                </div>
            `;
            $('#ref_translations_container').append(html);
        }

        function saveReferencePost() {
            const id = $('#reference_edit_id').val();
            const title = $('#reference_title').val();

            if (!title.trim()) {
                toastr.error('Please enter Reference Title / Citation');
                return;
            }

            const translations = [];
            $('#ref_translations_container .repeater-card').each(function() {
                const l = $(this).find('.ref-tr-lang').val();
                const t = $(this).find('.ref-tr-text').val();
                if (t.trim()) {
                    translations.push({ lang: l, text: t });
                }
            });

            const data = {
                _token: csrfToken,
                lesson_id: lessonId,
                title: title,
                simplified: $('#reference_simplified').val(),
                translations: translations
            };

            let url = "{{ route('admin.lessons.references.store', $lesson->id) }}";
            let method = "POST";

            if (id) {
                url = "{{ route('admin.lessons.references.update', [$lesson->id, ':id']) }}".replace(':id', id);
                method = "PUT";
            }

            toastr.clear();
            showLoader();

            $.ajax({
                url: url,
                type: method,
                data: data,
                success: function(res) {
                    toastr.success(res.message);
                    $('#referenceModal').modal('hide');
                    $('#referencesTable').DataTable().ajax.reload(null, false);
                    refreshReferenceDropdowns();
                },
                error: function(xhr) {
                    toastr.error(xhr.responseJSON?.message || (xhr.responseJSON?.errors ? Object.values(xhr.responseJSON.errors).flat().join('<br>') : 'Error occurred'));
                },
                complete: function() {
                    hideLoader();
                }
            });
        }

        function deleteReferenceItem(url) {
            deleteItem(url, csrfToken, 'referencesTable');
            setTimeout(() => refreshReferenceDropdowns(), 1000);
        }

        // =========================================================================
        // 3. QURAN REFERENCE FUNCTIONS
        // =========================================================================
        function openQuranModal(id) {
            toastr.clear();
            const isCreate = id === 0;
            $('#quran_edit_id').val(isCreate ? '' : id);
            $('#quranModalTitle').text(isCreate ? 'Add Quran Reference' : 'Edit Quran Reference');

            if (isCreate) {
                $('#quran_reference_id').val('');
                $('#quran_surah_id').val('');
                $('#quran_verse_no').val('');
                $('#surah_verse_hint').text('');
                $('#quran_preview_badge').hide();
            } else {
                const row = window['quranRow' + id];
                if (row) {
                    $('#quran_reference_id').val(row.lesson_reference_id);
                    $('#quran_surah_id').val(row.surah_id);
                    $('#quran_verse_no').val(row.verse_no);
                    updateSurahHint();
                }
            }

            $('#quranModal').modal('show');
        }

        function updateSurahHint() {
            const sel = $('#quran_surah_id option:selected');
            const verses = sel.data('verses');
            const name = sel.data('name');
            const title = sel.data('title');
            const verseNo = $('#quran_verse_no').val();

            if (verses) {
                $('#surah_verse_hint').text(`Surah has ${verses} total verses.`);
                $('#quran_verse_no').attr('max', verses);

                if (verseNo) {
                    $('#quran_preview_text').html(`<strong>Surah ${name} (${title})</strong> [Ayah ${verseNo}]`);
                    $('#quran_preview_badge').show();
                } else {
                    $('#quran_preview_badge').hide();
                }
            } else {
                $('#surah_verse_hint').text('');
                $('#quran_preview_badge').hide();
            }
        }

        $('#quran_verse_no').on('input', updateSurahHint);

        function saveQuranPost() {
            const id = $('#quran_edit_id').val();
            const refId = $('#quran_reference_id').val();
            const surahId = $('#quran_surah_id').val();
            const verseNo = $('#quran_verse_no').val();

            if (!refId) {
                toastr.error('Please select a Lesson Reference');
                return;
            }
            if (!surahId) {
                toastr.error('Please select a Surah');
                return;
            }
            if (!verseNo || parseInt(verseNo) < 1) {
                toastr.error('Please enter a valid Verse / Ayah number');
                return;
            }

            const data = {
                _token: csrfToken,
                lesson_reference_id: refId,
                surah_id: surahId,
                verse_no: verseNo
            };

            let url = "{{ route('admin.lessons.quran-references.store', $lesson->id) }}";
            let method = "POST";

            if (id) {
                url = "{{ route('admin.lessons.quran-references.update', [$lesson->id, ':id']) }}".replace(':id', id);
                method = "PUT";
            }

            toastr.clear();
            showLoader();

            $.ajax({
                url: url,
                type: method,
                data: data,
                success: function(res) {
                    toastr.success(res.message);
                    $('#quranModal').modal('hide');
                    $('#quranTable').DataTable().ajax.reload(null, false);
                    $('#referencesTable').DataTable().ajax.reload(null, false);
                },
                error: function(xhr) {
                    toastr.error(xhr.responseJSON?.message || (xhr.responseJSON?.errors ? Object.values(xhr.responseJSON.errors).flat().join('<br>') : 'Error occurred'));
                },
                complete: function() {
                    hideLoader();
                }
            });
        }

        function deleteQuranItem(url) {
            deleteItem(url, csrfToken, 'quranTable');
            setTimeout(() => $('#referencesTable').DataTable().ajax.reload(null, false), 1000);
        }

        // =========================================================================
        // 4. HADITH REFERENCE FUNCTIONS
        // =========================================================================
        function openHadithModal(id) {
            toastr.clear();
            const isCreate = id === 0;
            $('#hadith_edit_id').val(isCreate ? '' : id);
            $('#hadithModalTitle').text(isCreate ? 'Add Hadith Reference' : 'Edit Hadith Reference');
            $('#hadith_preview_box').hide();

            if (isCreate) {
                $('#hadith_reference_id').val('');
                $('#hadith_book_filter').val('');
                $('#hadith_verse_search').val('');
                $('#hadith_verse_no').val('1');
                fetchHadithVerses();
            } else {
                const row = window['hadithRow' + id];
                if (row) {
                    $('#hadith_reference_id').val(row.lesson_reference_id);
                    $('#hadith_verse_no').val(row.verse_no);
                    if (row.hadith_verse) {
                        $('#hadith_book_filter').val(row.hadith_verse.hadith_book_id || '');
                    }
                    fetchHadithVerses(row.hadith_verse_id);
                }
            }

            $('#hadithModal').modal('show');
        }

        function debounceFetchHadith() {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                fetchHadithVerses();
            }, 300);
        }

        function fetchHadithVerses(selectedId = null) {
            const bookId = $('#hadith_book_filter').val();
            const query = $('#hadith_verse_search').val();

            $.ajax({
                url: "{{ route('admin.lessons.hadith-verses.search') }}",
                type: "GET",
                data: { book_id: bookId, query: query },
                success: function(verses) {
                    const sel = $('#hadith_verse_id');
                    sel.empty().append('<option value="">-- Select Hadith Record --</option>');

                    window.hadithVersesCache = {};

                    verses.forEach(v => {
                        window.hadithVersesCache[v.id] = v;
                        const bookName = (v.book && v.book.translations && v.book.translations[0]) ? v.book.translations[0].title : (v.book ? v.book.slug : 'Hadith');
                        const isSelected = selectedId && parseInt(selectedId) === v.id ? 'selected' : '';
                        const heading = v.heading ? ` - ${v.heading.substring(0, 40)}...` : '';
                        sel.append(`<option value="${v.id}" ${isSelected}>[${bookName}] Hadith #${v.hadith_number || v.id}${heading}</option>`);
                    });

                    onHadithSelectChange();
                }
            });
        }

        function onHadithSelectChange() {
            const id = $('#hadith_verse_id').val();
            if (id && window.hadithVersesCache && window.hadithVersesCache[id]) {
                const v = window.hadithVersesCache[id];
                const bookName = (v.book && v.book.translations && v.book.translations[0]) ? v.book.translations[0].title : 'Hadith';
                $('#hadith_preview_heading').text(`${bookName} - Hadith #${v.hadith_number || v.id}`);
                $('#hadith_preview_text').text(v.heading || v.text || '');
                $('#hadith_preview_box').show();
            } else {
                $('#hadith_preview_box').hide();
            }
        }

        function saveHadithPost() {
            const id = $('#hadith_edit_id').val();
            const refId = $('#hadith_reference_id').val();
            const verseId = $('#hadith_verse_id').val();
            const verseNo = $('#hadith_verse_no').val();

            if (!refId) {
                toastr.error('Please select a Lesson Reference');
                return;
            }
            if (!verseId) {
                toastr.error('Please select a Hadith Record');
                return;
            }
            if (!verseNo || parseInt(verseNo) < 1) {
                toastr.error('Please enter a valid Verse / Reference number');
                return;
            }

            const data = {
                _token: csrfToken,
                lesson_reference_id: refId,
                hadith_verse_id: verseId,
                verse_no: verseNo
            };

            let url = "{{ route('admin.lessons.hadith-references.store', $lesson->id) }}";
            let method = "POST";

            if (id) {
                url = "{{ route('admin.lessons.hadith-references.update', [$lesson->id, ':id']) }}".replace(':id', id);
                method = "PUT";
            }

            toastr.clear();
            showLoader();

            $.ajax({
                url: url,
                type: method,
                data: data,
                success: function(res) {
                    toastr.success(res.message);
                    $('#hadithModal').modal('hide');
                    $('#hadithTable').DataTable().ajax.reload(null, false);
                    $('#referencesTable').DataTable().ajax.reload(null, false);
                },
                error: function(xhr) {
                    toastr.error(xhr.responseJSON?.message || (xhr.responseJSON?.errors ? Object.values(xhr.responseJSON.errors).flat().join('<br>') : 'Error occurred'));
                },
                complete: function() {
                    hideLoader();
                }
            });
        }

        function deleteHadithItem(url) {
            deleteItem(url, csrfToken, 'hadithTable');
            setTimeout(() => $('#referencesTable').DataTable().ajax.reload(null, false), 1000);
        }

        function escapeHtml(text) {
            if (!text) return '';
            return text.toString()
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }
    </script>
@endpush
