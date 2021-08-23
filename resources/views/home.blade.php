@extends('layouts.app')

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <form method="post" action="{{ route('dashboard') }}">@csrf
                        <ol class="breadcrumb m-0">
                            <li class=""><input type="date" name="start_date" class="form-control"></li>
                            <li class=""><input type="date" name="end_date" class="form-control"></li>
                            <li class="breadcrumb-item"><button class="btn btn-warning" type="submit">Search</button></li>
                        </ol>
                        </form>
                    </div>
                    <h4 class="page-title">Revenue Collection Statistics</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card widget-inline">
                    <div class="card-body p-0">
                        <div class="row g-0">
                            <div class="col-sm-6 col-xl-3">
                                <div class="card shadow-none m-0">
                                    <div class="card-body text-center">
                                        <i class="dripicons-briefcase text-muted" style="font-size: 24px;"></i>
                                        <h3><span>KES {{ number_format($dashboard->data->period->today,2) }}</span></h3>
                                        <p class="text-muted font-15 mb-0">Today</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-xl-3">
                                <div class="card shadow-none m-0 border-start">
                                    <div class="card-body text-center">
                                        <i class="dripicons-checklist text-muted" style="font-size: 24px;"></i>
                                        <h3><span> KES {{ number_format($dashboard->data->period->week,2) }}</span></h3>
                                        <p class="text-muted font-15 mb-0">This Week</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-xl-3">
                                <div class="card shadow-none m-0 border-start">
                                    <div class="card-body text-center">
                                        <i class="dripicons-user-group text-muted" style="font-size: 24px;"></i>
                                        <h3><span>KES  {{ number_format($dashboard->data->period->month,2) }}</span></h3>
                                        <p class="text-muted font-15 mb-0">This Month</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-xl-3">
                                <div class="card shadow-none m-0 border-start">
                                    <div class="card-body text-center">
                                        <i class="dripicons-graph-line text-muted" style="font-size: 24px;"></i>
                                        <h3><span>KES {{ number_format($dashboard->data->period->year,2) }}</span> <i class="mdi mdi-arrow-up text-success"></i></h3>
                                        <p class="text-muted font-15 mb-0">This Year</p>
                                    </div>
                                </div>
                            </div>

                        </div> <!-- end row -->
                    </div>
                </div> <!-- end card-box-->
            </div> <!-- end col-->
        </div>
        <!-- end row-->
        <div class="row">

            <div class="col-xl-6 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <a href="#" class="p-0 float-end"><script>document.write(new Date().getFullYear())</script> <i class="mdi mdi-download ms-1"></i></a>
                        <h4 class="header-title mt-1 mb-3">CHARGE TYPE STATISTICS</h4>

                        <div class="table-responsive">
                            <table class="table table-sm table-centered mb-0 font-14">
                                <thead class="table-light">
                                <tr>
                                    <th>Charge Type</th>
                                    <th>Counts</th>
                                    <th>Amount (KES)</th>
                                </tr>
                                </thead>


                                <tbody>
                                @foreach($dashboard->data->charge_type as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->vehicle_count }}</td>
                                    <td>{{ number_format($item->total,2) }}</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div> <!-- end table-responsive-->
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->

            <div class="col-xl-6 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <a href="#" class="p-0 float-end"><script>document.write(new Date().getFullYear())</script> <i class="mdi mdi-download ms-1"></i></a>
                        <h4 class="header-title mt-1 mb-3">REVENUE BY CATEGORY</h4>

                        <div class="table-responsive">
                            <table class="table table-sm table-centered mb-0 font-14">
                                <thead class="table-light">
                                <tr>
                                    <th>Category Type</th>
                                    <th>Count</th>
                                    <th>Amount (KES)</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($dashboard->data->category as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->vehicle_count }}</td>
                                    <td>{{ number_format($item->total,2) }}</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div> <!-- end table-responsive-->
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->


        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="dropdown float-end">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Weekly Report</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Monthly Report</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                            </div>
                        </div>
                        <h4 class="header-title mb-4">Charge Type Statistics</h4>

                        <div class="card user_statistics dark-card">
                            <div class="card-body" style="background: #fff; border-radius: 10px">
                                <div id="transaction-data" style="height: 338px"></div>
                            </div>
                        </div>

                        <!-- end row-->

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="dropdown float-end">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Weekly Report</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Monthly Report</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                            </div>
                        </div>
                        <h4 class="header-title mb-3">Revenue by Category</h4>


                        <div class="card user_statistics dark-card">
                            <div class="card-body" style="background: #fff; border-radius: 10px">
                                <div id="transaction-data1" style="height: 338px"></div>
                            </div>
                        </div>

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->
    </div>
    <!-- container -->


    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    @php
        $jsonResponse = collect($dashboard->data->charge_type);
        $charge_names = $jsonResponse->pluck('name');
        $charge_total = $jsonResponse->pluck('total');


        $jsonResponse1 = collect($dashboard->data->category);
        $category_names = $jsonResponse1->pluck('name');
        $category_total = $jsonResponse1->pluck('total');


    @endphp

    <script>
        var options = {
            series: [{
                name: 'KES',
                data: [
                    @foreach($category_total as $num)
                        {{$num}},
                    @endforeach
                ]
            }],
            chart: {
                height: 350,
                type: 'line',
            },
            plotOptions: {
                bar: {
                    borderRadius: 10,
                    dataLabels: {
                        position: 'top', // top, center, bottom
                    },
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function (val) {
                    return val + " KES";
                },
                offsetY: -20,
                style: {
                    fontSize: '12px',
                    colors: ["#304758"]
                }
            },

            xaxis: {
                categories: [
                    @foreach($category_names as $name)
                        "{{$name}}",
                    @endforeach
                ],
                position: 'top',
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                crosshairs: {
                    fill: {
                        type: 'gradient',
                        gradient: {
                            colorFrom: '#D8E3F0',
                            colorTo: '#4CAF50',
                            stops: [0, 100],
                            opacityFrom: 0.4,
                            opacityTo: 0.5,
                        }
                    }
                },
                tooltip: {
                    enabled: true,
                }
            },
            yaxis: {
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false,
                },
                labels: {
                    show: false,
                    formatter: function (val) {
                        return val + "";
                    }
                }
            },
            colors: ["#4CAF50"],
            title: {
                // text: 'Revenue by charge type',
                floating: true,
                offsetY: 330,
                align: 'center',
                style: {
                    color: '#000'
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#transaction-data1"), options);
        chart.render();

    </script>
    <script>
        var options = {
            series: [{
                name: 'Charge',
                data: [
                    @foreach($charge_total as $num)
                        {{$num}},
                    @endforeach
                ]
            }],
            chart: {
                height: 350,
                type: 'line',
            },
            plotOptions: {
                bar: {
                    borderRadius: 10,
                    dataLabels: {
                        position: 'top', // top, center, bottom
                    },
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function (val) {
                    return val + " KES";
                },
                offsetY: -20,
                style: {
                    fontSize: '12px',
                    colors: ["#304758"]
                }
            },

            xaxis: {
                categories: [
                    @foreach($charge_names as $charge)
                        "{{$charge}}",
                    @endforeach
                ],
                position: 'top',
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                crosshairs: {
                    fill: {
                        type: 'gradient',
                        gradient: {
                            colorFrom: '#D8E3F0',
                            colorTo: '#4CAF50',
                            stops: [0, 100],
                            opacityFrom: 0.4,
                            opacityTo: 0.5,
                        }
                    }
                },
                tooltip: {
                    enabled: true,
                }
            },
            yaxis: {
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false,
                },
                labels: {
                    show: false,
                    formatter: function (val) {
                        return val + "";
                    }
                }
            },
            colors: ["#532350"],
            title: {
                // text: 'Revenue by charge type',
                floating: true,
                offsetY: 330,
                align: 'center',
                style: {
                    color: '#000'
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#transaction-data"), options);
        chart.render();

    </script>



@endsection
