@extends('layouts.admin')

@section('content')
    <x-admin.page-header title="Course Translations" :breadcrumb="[['label' => 'Dashboard', 'link' => route('admin.dashboard')], ['label' => 'Courses', 'link' => route('admin.courses.index')], ['label' => 'Translations']]" />

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <x-admin.alert type="success" />
                    <x-admin.table :headers="['#', 'Lang', 'Title', 'Status', 'Actions']">
                        <x-slot name="header">
                            <button onclick="createUpdate(0)" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add Translation</button>
                        </x-slot>
                    </x-admin.table>
                </div>
            </div>
        </div>
    </div>

    <x-admin.modal size="modal-lg">
        <input type="hidden" id="edit_id">
        <input type="hidden" id="course_id" value="{{ $course->id }}">

        <div class="row">
            <div class="col-md-6 form-group mb-3">
                <label for="lang">Language</label>
                <select id="lang" class="form-control">
                    <option value="en">English (en)</option>
                    <option value="ml">Malayalam (ml)</option>
                    <option value="ar">Arabic (ar)</option>
                    <option value="ur">Urdu (ur)</option>
                </select>
            </div>

            <div class="col-md-6 form-group mb-3">
                <label for="title">Title</label>
                <input type="text" id="title" class="form-control" placeholder="Course Title">
            </div>
        </div>

        <div class="form-group mb-3">
            <label for="desc">Description</label>
            <textarea id="desc" class="form-control" rows="3" placeholder="Course Description"></textarea>
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
                    url: "{{ route('admin.course-translations.dataTable') }}",
                    data: function(d) {
                        d.course_id = "{{ $course->id }}";
                    }
                },
                columns: [{
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
            });
        });

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
                $('#desc').val('');
            } else {
                let row = window['rowData' + id];
                if (row) {
                    $('#lang').val(row.lang);
                    $('#title').val(row.title);
                    $('#desc').val(row.desc);
                }
            }
        }

        function createUpdatePost() {
            const data = {
                _token: "{{ csrf_token() }}",
                id: $('#edit_id').val(),
                course_id: $('#course_id').val(),
                lang: $('#lang').val(),
                title: $('#title').val(),
                desc: $('#desc').val(),
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
