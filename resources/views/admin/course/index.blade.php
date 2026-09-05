@extends('layouts.admin')

@section('content')
    <x-admin.page-header title="Courses" :breadcrumb="[['label' => 'Dashboard', 'link' => route('admin.dashboard')], ['label' => 'Courses']]" />

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <x-admin.alert type="success" />
                    <x-admin.table :headers="['#', 'Title', 'Slug', 'Type', 'Coming Soon', 'Status', 'Actions']" />
                </div>
            </div>
        </div>
    </div>

    <x-admin.modal>
        <input type="hidden" id="edit_id">
        
        <div class="form-group mb-3">
            <label for="slug">Slug</label>
            <input type="text" id="slug" class="form-control" placeholder="course-slug">
        </div>

        <div class="form-group mb-3">
            <label for="type">Type</label>
            <select id="type" class="form-control">
                @foreach ($types as $type)
                    <option value="{{ $type->value }}">{{ $type->label() }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3 form-check">
            <input type="checkbox" id="coming_soon" class="form-check-input">
            <label for="coming_soon" class="form-check-label">Coming Soon</label>
        </div>

        <div class="d-flex justify-content-end">
            <x-admin.button class="btn btn-primary" onclick="createUpdatePost()">Save</x-admin.button>
        </div>
    </x-admin.modal>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                pageLength: 10,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.courses.dataTable') }}",
                },
                columns: [
                    {
                        data: 'id',
                        name: 'courses.id'
                    },
                    {
                        data: 'title',
                        name: 'course_translations.title'
                    },
                    {
                        data: 'slug',
                        name: 'courses.slug'
                    },
                    {
                        data: 'type',
                        name: 'courses.type',
                        render: function(data) {
                            return data ? data.charAt(0).toUpperCase() + data.slice(1) : '';
                        }
                    },
                    {
                        data: 'coming_soon',
                        name: 'courses.coming_soon',
                        render: function(data, type, row) {
                            return data ? '<span class="badge bg-warning">Yes</span>' : '<span class="badge bg-secondary">No</span>';
                        }
                    },
                    {
                        data: 'status',
                        name: 'courses.status',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            let label = data ? 'Active' : 'Inactive';
                            let text = data ? 'text-success' : 'text-danger';
                            let url = "{{ route('admin.courses.status', ':id') }}".replace(':id', row.id);
                            return `<button onclick="toggleActive('${url}')" class="${text} btn btn-link">${label}</button>`;
                        }
                    },
                    {
                        data: null,
                        name: 'actions',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            const url = "{{ route('admin.course-translations.index', [':id']) }}".replace(':id', row.id);
                            return `<a href="${url}" class="btn btn-link">Translations</a> |
                                <button onclick="createUpdate(${row.id})" class="btn btn-link" id="editBtn${row.id}" data-slug="${row.slug}" data-type="${row.type}" data-coming_soon="${row.coming_soon}">Edit</button>`;
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
                        .append('<button type="button" onclick="createUpdate(0)" class="btn btn-primary btn-sm ms-2"><i class="fa fa-plus"></i> Add Course</button>');
                }
            });
        });

        function createUpdate(id) {
            toastr.clear();

            const isCreate = id === 0;

            $('.createUpdate').modal('show');
            $('.modal-title').text(isCreate ? 'Create Course' : 'Update Course');
            $('.create').toggleClass('d-none', !isCreate);

            $('#edit_id').val(isCreate ? '' : id);
            $('#slug').val(isCreate ? '' : $(`#editBtn${id}`).data('slug'));
            
            if (!isCreate) {
                const typeVal = $(`#editBtn${id}`).data('type')?.toString().toLowerCase();
                $('#type').val(typeVal);
            } else {
                $('#type').val($('#type option:first').val());
            }

            $('#coming_soon').prop('checked', isCreate ? false : Boolean($(`#editBtn${id}`).data('coming_soon')));
        }

        function createUpdatePost() {
            const data = {
                _token: "{{ csrf_token() }}",
                id: $('#edit_id').val(),
                slug: $('#slug').val(),
                type: $('#type').val(),
                coming_soon: $('#coming_soon').is(':checked') ? 1 : 0
            };

            if (!data.slug.trim()) {
                toastr.error('Please fill Slug field');
                return;
            }

            let url = "{{ route('admin.courses.store') }}";
            let method = "POST";

            if (data.id) {
                url = "{{ route('admin.courses.update', ':id') }}".replace(':id', data.id);
                method = "PUT";
            }

            storeData(data, url, method);
        }
    </script>
@endpush
