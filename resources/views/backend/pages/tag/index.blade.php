@extends('backend.master.layout')
@section('contentHeader')
    <title> {{ env('APP_NAME') }} | {{ __('headers.categories') }} </title>
@endsection
@section('content')
    <div class="container-fluid px-4">
        <main>
            <div class="container-fluid px-4">
                <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-5">
                    <h1 class="h3 mb-0 text-gray-800">Tags</h1>
                    <a href="{{ route('admin.tags.create') }}"
                        class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa-solid fa-tag"
                            style="margin-right: 5px"></i>Create Tag</a>
                </div>

                <div class="row"
                    style="margin-top: 70px;padding: 10px;border: 0 solid rgba(0,0,0,.125);
                border-radius: .25rem;background-color: #fff;box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);margin-bottom: 1rem;">
                    <table class="table" id="dataTable" style="width: 100%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>

            </div>
        </main>
    </div>
@endsection
@section('contentfooter')
    <script>
        $(document).ready(function() {
            var table = $('#dataTable').DataTable({
                responsive: true,
                processing: true,
                bAutoWidth: false,
                serverSide: true,
                order: [
                    [1, 'desc']
                ],
                ajax: {
                    type: 'GET',
                    url: "{{ route('admin.tags.index') }}",
                    dataType: "JSON",
                },
                columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                }, {
                    data: 'name',
                    name: 'name',
                }, {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }, ],

            });
        });

        function deleteTag(id) {
            var id = id;
            var url = "{{ route('admin.tags.destroy', ':id') }}";
            url = url.replace(':id', id);
            var token = "{{ csrf_token() }}";
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this tag?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: "JSON",
                        data: {
                            id: id,
                            "_token": "{{ csrf_token() }}",

                        },
                        success: function(response) {
                            toastr.success(response.message, "Success");
                            $('#dataTable').DataTable().ajax.reload();
                        }
                    });
                }

            })
        }
    </script>
@endsection
