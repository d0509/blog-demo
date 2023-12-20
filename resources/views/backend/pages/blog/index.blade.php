@extends('backend.master.layout')
@section('title', 'Blogs')
@section('content')
    <div class="container-fluid px-4">
        <main>
            <div class="container-fluid px-4">
                <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-5">
                    <h1 class="h3 mb-0 text-gray-800">Blogs</h1>
                    <a href="{{ route('admin.blogs.create') }}"
                        class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fa-solid fa-book mr-2 ml-5" style="margin-right: 5px;"></i>Create Blog
                    </a>
                </div>

                <div class="row" style="margin-top: 70px;padding: 10px;border: 0 solid rgba(0,0,0,.125);
                border-radius: .25rem;background-color: #fff;box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);margin-bottom: 1rem;">
                    <table class="table" id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Author</th>
                                <th scope="col">Category</th>
                                <th scope="col">Status</th>
                                <th scope="col">Created On</th>
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
            $("#dataTable").removeAttr('style');

            var table = $('#dataTable').DataTable({

                processing: true,
                serverSide: true,
                order: [
                    [1, 'desc']
                ],
                ajax: {
                    type: 'GET',
                    url: "{{ route('admin.blogs.index') }}",
                    dataType: "JSON",
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'title',
                        name: 'title',
                    },
                    {
                        data: 'author',
                        name: 'author',
                    },
                    {
                        data: 'category.name',
                        name: 'category.name',
                        orderable: true,
                    },
                    {
                        data: 'status',
                        name: 'status',
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
            });


            $(document).on('click', '#flexSwitchCheckChecked', function(e) {
                e.preventDefault();
                var id = $(this).attr('data-categoryId');
                var url = "{{ route('admin.categories.status') }}";
                var token = "{{ csrf_token() }}";
                $.ajax({
                    url: url,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: {
                        id: id,
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function() {
                        console.log('updated successfuly');
                        $('#dataTable').DataTable().ajax.reload();
                    }
                });
            });
        });

        function deletePost(id) {
            var id = id;
            var url = "{{ route('admin.blogs.destroy', ':id') }}";
            url = url.replace(':id', id);
            var token = "{{ csrf_token() }}";
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this blog?",
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
