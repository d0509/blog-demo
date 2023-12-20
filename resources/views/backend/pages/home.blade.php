@extends('backend.master.layout')
@section('contentHeader')
    <title>{{ env('APP_NAME') }} | {{__('headers.dashboard')}} </title>
@endsection
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
                    <div class="col-xl-8">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-bar me-1"></i>
                                Month Wise Blog Posts
                            </div>
                            <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-bar me-1"></i>
                                Category Wise Blog Posts
                            </div>
                            <div class="card-body"><canvas id="myPieChart" width="100%" height="40"></canvas></div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
@section('contentfooter')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var data = @json($data);
            var ctx = document.getElementById('myBarChart').getContext('2d');
            var postsChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: Object.keys(data),
                    datasets: [{
                        label: 'Number of Posts',
                        data: Object.values(data),
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1,
                            },
                        }
                    }
                }
            });

            var categories = @json($categories);
            var ctx2 = document.getElementById('myPieChart').getContext('2d');
            var labels = categories.map(category => category.category_name);
            var data = categories.map(category => category.count);

            // Create a pie chart
            var myPieChart = new Chart(ctx2, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.7)',
                            'rgba(54, 162, 235, 0.7)',
                            'rgba(255, 206, 86, 0.7)',
                        ],
                    }],
                },
            });
        });
    </script>
@endsection
