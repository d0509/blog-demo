@extends('backend.master.layout')
@section('title', 'Users')
@section('content')
    <div class="container-fluid px-4">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Users</h1>
                <div class="row" style="margin-top: 70px;padding: 10px;border: 0 solid rgba(0,0,0,.125);
                border-radius: .25rem;background-color: #fff;box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);margin-bottom: 1rem;">
                    <table class="table">
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
                            @forelse ($users as $user)
                                <tr>
                                    <th scope="row"> {{ ++$loop->index }} </th>
                                    <td> {{ $user->first_name }} </td>
                                    <td> {{ $user->last_name }} </td>
                                    <td> {{ $user->email }} </td>
                                    <td> {{ $user->mobile_no }} </td>
                                    <td>
                                        <select class="form-select changeUserStatus" data-userId={{ $user->id }}
                                            aria-label="Default select example" name="status">

                                            <option value="pending"
                                                {{ $user->status == config('site.user_status.pending') ? 'selected' : '' }}>
                                                Pending
                                            </option>
                                            <option value="approved"
                                                {{ $user->status == config('site.user_status.approved') ? 'selected' : '' }}>
                                                Approved
                                            </option>
                                            <option value="blocked"
                                                {{ $user->status == config('site.user_status.blocked') ? 'selected' : '' }}>
                                                Blocked
                                            </option>
                                        </select>
                                    </td>
                                </tr>
                            @empty
                                <h1> No Users Found </h1>
                            @endforelse
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
            $('.changeUserStatus').on('change', function(e) {
                e.preventDefault();
                console.log("dfghjkl");
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
