@extends('backend.master.layout')
@section('contentHeader')
    <title> {{ env('APP_NAME') }} | {{ __('headers.users') }} </title>
@endsection
@section('content')
    <div class="container-fluid px-4">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Users</h1>
                <div class="row"
                    style="margin-top: 70px;padding: 10px;border: 0 solid rgba(0,0,0,.125);
                border-radius: .25rem;background-color: #fff;box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);margin-bottom: 1rem;">
                    <table class="table" id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Firstname</th>
                                <th scope="col">Lastname</th>
                                <th scope="col">Email</th>
                                <th scope="col">Mobile no.</th>
                                <th scope="col">Status</th>
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

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });



            // datatable

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
                    url: "{{ route('admin.users.index') }}",
                    dataType: "JSON",
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'first_name',
                        name: 'first_name',
                    },
                    {
                        data: 'last_name',
                        name: 'last_name',
                    },
                    {
                        data: 'email',
                        name: 'email',
                    },
                    {
                        data: 'mobile_no',
                        name: 'mobile_no',
                    },
                    {
                        data: 'status',
                        render: function(data, type, row) {
                            const statusOptions = [{
                                    value: "{{config('site.user_status.approved')}}" ,
                                    label: 'Approved'
                                },
                                {
                                    value: "{{config('site.user_status.pending')}}" ,
                                    label: 'Pending'
                                },
                                {
                                    value:" {{config('site.user_status.blocked')}}" ,
                                    label: 'Blocked'
                                },
                            ];
                                console.log(data);
                            let optionsHtml = '';

                            for (const option of statusOptions) {
                                const selected = data === option.value ? 'selected' : '';
                                optionsHtml +=
                                    `<option value="${option.value}" data-status="${option.value}" ${selected}>${option.label}</option>`;
                            }

                            const selectHtml =
                                `<select name="status" data-userId=${row.id}  class="form-select changeUserStatus" aria-label="Default select example" >${optionsHtml}</select>`;
                            return selectHtml;
                        }
                    },
                ],
            });

            $(document).on('change', '.changeUserStatus', function(e) {

                e.preventDefault();
                var userId = $(this).attr('data-userId');
                var status = $(this).val();
                var url = "{{ route('admin.change-status') }}";
                $.ajax({
                    url: url,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: {
                        userId: userId,
                        "_token": "{{ csrf_token() }}",
                        status: status,

                    },
                    success: function(response) {
                        toastr.success(response.message, "Success");
                        console.log('updated successfuly');
                    }
                });
            });

        });
    </script>
@endsection
