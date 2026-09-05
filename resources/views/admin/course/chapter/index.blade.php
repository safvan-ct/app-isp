@extends('layouts.admin')

@section('content')
    <x-admin.page-header :title="isset($course) ? 'Chapters - ' . ($course->translation ? $course->translation->title : $course->slug) : 'Chapters'" :breadcrumb="[
        ['label' => 'Dashboard', 'link' => route('admin.dashboard')],
        ['label' => 'Courses', 'link' => route('admin.courses.index')],
        ['label' => 'Chapters'],
    ]" />

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <x-admin.alert type="success" />

                    <div class="d-none">
                        <select id="course_filter" class="form-select selectFilter me-2" style="width: 220px;">
                            <option value="">All Courses</option>
                            @foreach ($courses as $c)
                                <option value="{{ $c->id }}" {{ isset($course) && $course->id == $c->id ? 'selected' : '' }}>
                                    {{ $c->title ?: $c->slug }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <x-admin.table :headers="['#', 'Course', 'Title', 'Slug', 'Status', 'Actions']" />
                </div>
            </div>
        </div>
    </div>

    <x-admin.modal>
        <input type="hidden" id="edit_id">

        <div class="form-group mb-3">
            <label for="course_id">Course <span class="text-danger">*</span></label>
            <select id="course_id" class="form-control">
                @foreach ($courses as $c)
                    <option value="{{ $c->id }}" {{ isset($course) && $course->id == $c->id ? 'selected' : '' }}>
                        {{ $c->title ?: $c->slug }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="slug">Slug <span class="text-danger">*</span></label>
            <input type="text" id="slug" class="form-control" placeholder="chapter-slug">
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
                    url: "{{ route('admin.chapters.dataTable') }}",
                    data: function(d) {
                        d.course_id = $('#course_filter').val();
                    }
                },
                columns: [
                    {
                        data: 'id',
                        name: 'chapters.id'
                    },
                    {
                        data: 'course_title',
                        name: 'course_translations.title',
                        render: function(data, type, row) {
                            return data || row.course_slug || '-';
                        }
                    },
                    {
                        data: 'title',
                        name: 'chapter_translations.title',
                        render: function(data) {
                            return data || '-';
                        },
                        visible: false
                    },
                    {
                        data: 'slug',
                        name: 'chapters.slug'
                    },
                    {
                        data: 'status',
                        name: 'chapters.status',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            let label = data ? 'Active' : 'Inactive';
                            let text = data ? 'text-success' : 'text-danger';
                            let url = "{{ route('admin.chapters.status', ':id') }}".replace(':id', row.id);
                            return `<button onclick="toggleActive('${url}')" class="${text} btn btn-link">${label}</button>`;
                        }
                    },
                    {
                        data: null,
                        name: 'actions',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            const translUrl = "{{ route('admin.chapter-translations.index', [':id']) }}".replace(':id', row.id);
                            return `<a href="${translUrl}" class="btn btn-link">Translations</a> |
                                <button onclick="createUpdate(${row.id})" class="btn btn-link" id="editBtn${row.id}" data-slug="${row.slug}" data-course_id="${row.course_id}">Edit</button>`;
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
                        .prepend($('#course_filter').removeClass('d-none'))
                        .append('<button type="button" onclick="createUpdate(0)" class="btn btn-primary btn-sm ms-2"><i class="fa fa-plus"></i> Add Chapter</button>');
                }
            });

            $('#course_filter').on('change', function() {
                table.ajax.reload();
            });
        });

        function createUpdate(id) {
            toastr.clear();
            const isCreate = id === 0;

            $('.createUpdate').modal('show');
            $('.modal-title').text(isCreate ? 'Create Chapter' : 'Update Chapter');
            $('.create').toggleClass('d-none', !isCreate);

            $('#edit_id').val(isCreate ? '' : id);
            $('#slug').val(isCreate ? '' : $(`#editBtn${id}`).data('slug'));

            if (isCreate) {
                const currentFilter = $('#course_filter').val();
                if (currentFilter) {
                    $('#course_id').val(currentFilter);
                }
            } else {
                $('#course_id').val($(`#editBtn${id}`).data('course_id'));
            }
        }

        function createUpdatePost() {
            const data = {
                _token: "{{ csrf_token() }}",
                id: $('#edit_id').val(),
                course_id: $('#course_id').val(),
                slug: $('#slug').val(),
            };

            if (!data.course_id) {
                toastr.error('Please select Course');
                return;
            }

            if (!data.slug.trim()) {
                toastr.error('Please fill Slug field');
                return;
            }

            let url = "{{ route('admin.chapters.store') }}";
            let method = "POST";

            if (data.id) {
                url = "{{ route('admin.chapters.update', ':id') }}".replace(':id', data.id);
                method = "PUT";
            }

            storeData(data, url, method);
        }
    </script>
@endpush
