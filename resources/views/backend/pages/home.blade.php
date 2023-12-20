@extends('backend.master.layout')
@section('title', 'Dashboard')
@section('content')

    <div class="container-fluid px-4">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                </ol>
                <div class="row">
                    <div class="col-xl-4 col-md-6">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                             Users</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"> {{ $usersCount }} </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa-solid fa-users fa-xl"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" style="text-decoration: none"
                                    href="{{ route('admin.users.index') }}">View
                                    Details</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="card bg-warning text-white mb-4">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                            Categories</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"> {{ $categoryCount }} </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa-solid fa-tag"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" style="text-decoration: none"
                                    href="{{ route('admin.categories.index') }}">View
                                    Details</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="card bg-success text-white mb-4">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                            Blogs </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $postCount }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa-solid fa-book"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" style="text-decoration: none"
                                    href="{{ route('admin.blogs.index') }}">View
                                    Details</a>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                </div>
            </div>
        </main>
    </div>
@endsection
