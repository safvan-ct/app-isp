@extends('layouts.admin')

@push('styles')
    <style>
        .ck-editor__editable_inline {
            min-height: 150px;
        }
        .ck.ck-balloon-panel,
        .ck.ck-dropdown__panel {
            z-index: 1060 !important;
        }
    </style>
@endpush

@section('content')
    <x-admin.page-header title="Course Translations" :breadcrumb="[['label' => 'Dashboard', 'link' => route('admin.dashboard')], ['label' => 'Courses', 'link' => route('admin.courses.index')], ['label' => 'Translations']]" />

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <x-admin.alert type="success" />
                    <x-admin.table :headers="['#', 'Lang', 'Title', 'Duration (weeks)', 'Status', 'Actions']" />
                </div>
            </div>
        </div>
    </div>

    <x-admin.modal size="modal-lg">
        <input type="hidden" id="edit_id">
        <input type="hidden" id="course_id" value="{{ $course->id }}">

        <div class="row">
            <div class="col-md-6 form-group mb-3">
                <label for="lang">Language <span class="text-danger">*</span></label>
                <select id="lang" class="form-control">
                    <option value="en">English (en)</option>
                    <option value="ml">Malayalam (ml)</option>
                    <option value="ar">Arabic (ar)</option>
                    <option value="ur">Urdu (ur)</option>
                </select>
            </div>

            <div class="col-md-6 form-group mb-3">
                <label for="title">Title <span class="text-danger">*</span></label>
                <input type="text" id="title" class="form-control" placeholder="Course Title">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 form-group mb-3">
                <label for="author_id">Instructor / Author</label>
                <select id="author_id" class="form-control">
                    <option value="">Select Instructor (Optional)</option>
                    @foreach ($instructors as $instructor)
                        <option value="{{ $instructor->id }}">{{ $instructor->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 form-group mb-3">
                <label for="duration">Duration (in weeks)</label>
                <input type="number" id="duration" class="form-control" placeholder="e.g. 120" min="0">
            </div>
        </div>

        <div class="form-group mb-3">
            <label for="desc">Description</label>
            <textarea id="desc" class="form-control" rows="3" placeholder="Course Description"></textarea>
        </div>

        <div class="form-group mb-3">
            <label for="objectives" class="form-label fw-bold">Objectives (Rich Text)</label>
            <textarea id="objectives" class="form-control"></textarea>
        </div>

        <div class="form-group mb-3">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <label class="form-label mb-0 fw-bold">Key Points (Topics & Descriptions)</label>
                <button type="button" class="btn btn-sm btn-outline-primary" onclick="addKeyPointRow()">
                    <i class="fa fa-plus"></i> Add More
                </button>
            </div>
            <div id="key_points_container"></div>
        </div>

        <div class="d-flex justify-content-end">
            <x-admin.button class="btn btn-primary" onclick="createUpdatePost()">Save</x-admin.button>
        </div>
    </x-admin.modal>
@endsection

@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>

    <script>
        let objectivesEditor = null;

        $(document).ready(function() {
            ClassicEditor
                .create(document.querySelector('#objectives'), {
                    toolbar: [
                        'heading', '|',
                        'bold', 'italic', 'link', '|',
                        'bulletedList', 'numberedList', 'blockQuote', '|',
                        'undo', 'redo'
                    ]
                })
                .then(editor => {
                    objectivesEditor = editor;
                })
                .catch(error => {
                    console.error('CKEditor initialization error:', error);
                });

            $('#dataTable').DataTable({
                pageLength: 10,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.course-translations.dataTable') }}",
                    data: function(d) {
                        d.course_id = "{{ $course->id }}";
                    }
                },
                columns: [
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'lang',
                        name: 'lang'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'duration',
                        name: 'duration',
                        render: function(data) {
                            return data ? data + ' weeks' : '-';
                        }
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            let label = data ? 'Active' : 'Inactive';
                            let text = data ? 'text-success' : 'text-danger';
                            let url = "{{ route('admin.course-translations.status', ':id') }}".replace(':id', row.id);
                            return `<button onclick="toggleActive('${url}')" class="${text} btn btn-link">${label}</button>`;
                        }
                    },
                    {
                        data: null,
                        name: 'actions',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            window['rowData' + row.id] = row;
                            return `<button onclick="createUpdate(${row.id})" class="btn btn-link">Edit</button>`;
                        }
                    },
                ],
                columnDefs: [{
                    targets: '_all',
                    className: 'text-center'
                }],
                initComplete: function() {
                    $('#dataTable_filter')
                        .addClass('d-flex align-items-center justify-content-end')
                        .append('<button type="button" onclick="createUpdate(0)" class="btn btn-primary btn-sm ms-2"><i class="fa fa-plus"></i> Add Translation</button>');
                }
            });
        });

        function addKeyPointRow(topic = '', desc = '') {
            const rowId = 'kp_' + Date.now() + '_' + Math.floor(Math.random() * 1000);
            const safeTopic = $('<div>').text(topic).html();
            const safeDesc = $('<div>').text(desc).html();

            const html = `
                <div class="card card-body bg-light mb-2 p-2 border key-point-row" id="${rowId}">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="badge bg-secondary">Key Point</span>
                        <button type="button" class="btn btn-sm btn-link text-danger p-0" onclick="$('#${rowId}').remove()">
                            <i class="fa fa-trash"></i> Remove
                        </button>
                    </div>
                    <div class="row g-2">
                        <div class="col-md-5">
                            <input type="text" class="form-control form-control-sm key-point-topic" placeholder="Topic title" value="${safeTopic}">
                        </div>
                        <div class="col-md-7">
                            <textarea class="form-control form-control-sm key-point-desc" rows="2" placeholder="Topic description">${safeDesc}</textarea>
                        </div>
                    </div>
                </div>
            `;
            $('#key_points_container').append(html);
        }

        function decodeHtml(html) {
            if (!html) return '';
            const txt = document.createElement('textarea');
            txt.innerHTML = html;
            let decoded = txt.value;
            if (decoded.includes('&lt;') && decoded.includes('&gt;')) {
                txt.innerHTML = decoded;
                decoded = txt.value;
            }
            return decoded;
        }

        function createUpdate(id) {
            toastr.clear();
            const isCreate = id === 0;

            $('.createUpdate').modal('show');
            $('.modal-title').text(isCreate ? 'Add Translation' : 'Update Translation');
            $('.create').toggleClass('d-none', !isCreate);

            $('#edit_id').val(isCreate ? '' : id);

            if (isCreate) {
                $('#lang').val('en');
                $('#title').val('');
                $('#author_id').val('');
                $('#duration').val('');
                $('#desc').val('');

                if (objectivesEditor) {
                    objectivesEditor.setData('');
                } else {
                    $('#objectives').val('');
                }

                $('#key_points_container').empty();
                addKeyPointRow();
            } else {
                let row = window['rowData' + id];
                if (row) {
                    $('#lang').val(row.lang);
                    $('#title').val(row.title);
                    $('#author_id').val(row.author_id ?? '');
                    $('#duration').val(row.duration ?? '');
                    $('#desc').val(row.desc ?? '');

                    const objContent = decodeHtml(row.objectives ?? '');
                    if (objectivesEditor) {
                        objectivesEditor.setData(objContent);
                    } else {
                        $('#objectives').val(objContent);
                    }

                    $('#key_points_container').empty();
                    let kps = row.key_points;
                    if (typeof kps === 'string') {
                        try { kps = JSON.parse(kps); } catch (e) { kps = []; }
                    }
                    if (Array.isArray(kps) && kps.length > 0) {
                        kps.forEach(function(kp) {
                            addKeyPointRow(kp.topic ?? '', kp.desc ?? kp.description ?? '');
                        });
                    } else {
                        addKeyPointRow();
                    }
                }
            }
        }

        function createUpdatePost() {
            const keyPoints = [];
            $('#key_points_container .key-point-row').each(function() {
                const topic = $(this).find('.key-point-topic').val().trim();
                const desc = $(this).find('.key-point-desc').val().trim();
                if (topic || desc) {
                    keyPoints.push({ topic: topic, desc: desc });
                }
            });

            const objectivesContent = objectivesEditor ? objectivesEditor.getData() : $('#objectives').val();

            const data = {
                _token: "{{ csrf_token() }}",
                id: $('#edit_id').val(),
                course_id: $('#course_id').val(),
                lang: $('#lang').val(),
                title: $('#title').val(),
                author_id: $('#author_id').val() || null,
                duration: $('#duration').val() || null,
                desc: $('#desc').val(),
                objectives: objectivesContent,
                key_points: keyPoints,
            };

            if (!data.title.trim()) {
                toastr.error('Please fill Title field');
                return;
            }

            let url = "{{ route('admin.course-translations.store') }}";
            let method = "POST";

            if (data.id) {
                url = "{{ route('admin.course-translations.update', ':id') }}".replace(':id', data.id);
                method = "PUT";
            }

            storeData(data, url, method);
        }
    </script>
@endpush
