@extends('layouts.admin')

@section('content')
    <x-admin.page-header :title="isset($chapter) ? 'Lessons - ' . ($chapter->translation ? $chapter->translation->title : $chapter->slug) : 'Lessons'" :breadcrumb="[
        ['label' => 'Dashboard', 'link' => route('admin.dashboard')],
        ['label' => 'Courses', 'link' => route('admin.courses.index')],
        ['label' => 'Chapters', 'link' => route('admin.chapters.index')],
        ['label' => 'Lessons'],
    ]" />

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <x-admin.alert type="success" />

                    <div class="d-none">
                        <select id="chapter_filter" class="form-select selectFilter me-2" style="width: 250px;">
                            <option value="">All Chapters</option>
                            @foreach ($chapters as $ch)
                                <option value="{{ $ch->id }}" {{ isset($chapter) && $chapter->id == $ch->id ? 'selected' : '' }}>
                                    {{ ($ch->course_title ?: $ch->course_slug) . ' → ' . ($ch->title ?: $ch->slug) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <x-admin.table :headers="['#', 'Chapter', 'Title', 'Slug', 'Status', 'Actions']" />
                </div>
            </div>
        </div>
    </div>

    <x-admin.modal>
        <input type="hidden" id="edit_id">

        <div class="form-group mb-3">
            <label for="chapter_id">Chapter <span class="text-danger">*</span></label>
            <select id="chapter_id" class="form-control">
                @foreach ($chapters as $ch)
                    <option value="{{ $ch->id }}" {{ isset($chapter) && $chapter->id == $ch->id ? 'selected' : '' }}>
                        {{ ($ch->course_title ?: $ch->course_slug) . ' → ' . ($ch->title ?: $ch->slug) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="slug">Slug <span class="text-danger">*</span></label>
            <input type="text" id="slug" class="form-control" placeholder="lesson-slug">
        </div>

        <div class="d-flex justify-content-end">
            <x-admin.button class="btn btn-primary" onclick="createUpdatePost()">Save</x-admin.button>
        </div>
    </x-admin.modal>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            const table = $('#dataTable').DataTable({
                pageLength: 10,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.lessons.dataTable') }}",
                    data: function(d) {
                        d.chapter_id = $('#chapter_filter').val();
                    }
                },
                columns: [
                    {
                        data: 'id',
                        name: 'lessons.id'
                    },
                    {
                        data: 'chapter_title',
                        name: 'chapter_translations.title',
                        render: function(data, type, row) {
                            const course = row.course_title || row.course_slug || '';
                            const chapter = data || row.chapter_slug || '-';
                            return course ? `${course} → ${chapter}` : chapter;
                        }
                    },
                    {
                        data: 'title',
                        name: 'lesson_translations.title',
                        render: function(data) {
                            return data || '-';
                        }
                    },
                    {
                        data: 'slug',
                        name: 'lessons.slug'
                    },
                    {
                        data: 'status',
                        name: 'lessons.status',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            let label = data ? 'Active' : 'Inactive';
                            let text = data ? 'text-success' : 'text-danger';
                            let url = "{{ route('admin.lessons.status', ':id') }}".replace(':id', row.id);
                            return `<button onclick="toggleActive('${url}')" class="${text} btn btn-link">${label}</button>`;
                        }
                    },
                    {
                        data: null,
                        name: 'actions',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            const translUrl = "{{ route('admin.lesson-translations.index', [':id']) }}".replace(':id', row.id);
                            const manageUrl = "{{ route('admin.lessons.manage', [':id']) }}".replace(':id', row.id);
                            return `<a href="${manageUrl}" class="btn btn-sm btn-outline-primary me-1"><i class="fa fa-layer-group"></i> Content & References</a>
                                <a href="${translUrl}" class="btn btn-link">Translations</a> |
                                <button onclick="createUpdate(${row.id})" class="btn btn-link" id="editBtn${row.id}" data-slug="${row.slug}" data-chapter_id="${row.chapter_id}">Edit</button>`;
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
                        .prepend($('#chapter_filter').removeClass('d-none'))
                        .append('<button type="button" onclick="createUpdate(0)" class="btn btn-primary btn-sm ms-2"><i class="fa fa-plus"></i> Add Lesson</button>');
                }
            });

            $('#chapter_filter').on('change', function() {
                table.ajax.reload();
            });
        });

        function createUpdate(id) {
            toastr.clear();
            const isCreate = id === 0;

            $('.createUpdate').modal('show');
            $('.modal-title').text(isCreate ? 'Create Lesson' : 'Update Lesson');
            $('.create').toggleClass('d-none', !isCreate);

            $('#edit_id').val(isCreate ? '' : id);
            $('#slug').val(isCreate ? '' : $(`#editBtn${id}`).data('slug'));

            if (isCreate) {
                const currentFilter = $('#chapter_filter').val();
                if (currentFilter) {
                    $('#chapter_id').val(currentFilter);
                }
            } else {
                $('#chapter_id').val($(`#editBtn${id}`).data('chapter_id'));
            }
        }

        function createUpdatePost() {
            const data = {
                _token: "{{ csrf_token() }}",
                id: $('#edit_id').val(),
                chapter_id: $('#chapter_id').val(),
                slug: $('#slug').val(),
            };

            if (!data.chapter_id) {
                toastr.error('Please select Chapter');
                return;
            }

            if (!data.slug.trim()) {
                toastr.error('Please fill Slug field');
                return;
            }

            let url = "{{ route('admin.lessons.store') }}";
            let method = "POST";

            if (data.id) {
                url = "{{ route('admin.lessons.update', ':id') }}".replace(':id', data.id);
                method = "PUT";
            }

            storeData(data, url, method);
        }
    </script>
@endpush
