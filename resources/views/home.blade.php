@extends('layouts.app')

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Hyper</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Projects</li>
                        </ol>
                    </div>
                    <h4 class="page-title">KRSRBS Revenue collection</h4>
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

                        <p><b> <script>document.write(new Date().getFullYear())</script></b> Revenue collected per the categories</p>

                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap table-hover mb-0">
                                <tbody>
                                @foreach($dashboard->data->category as $key=>$item)
                                <tr>
                                    <td>
                                        <h5 class="font-14 my-1"><a href="javascript:void(0);" class="text-body">{{ $item->name }}</a></h5>
                                        <span class="text-muted font-13">Due in 3 days</span>
                                    </td>
                                    <td>
                                        <span class="text-muted font-13">Status</span> <br/>
                                        <span class="badge badge-warning-lighten">In-progress</span>
                                    </td>
                                    <td>
                                        <span class="text-muted font-13">Assigned to</span>
                                        <h5 class="font-14 mt-1 fw-normal">Good Shed</h5>
                                    </td>
                                    <td>
                                        <span class="text-muted font-13">Total </span>
                                        <h5 class="font-14 mt-1 fw-normal">{{ number_format($item->total,2) }}</h5>
                                    </td>
                                    <td class="table-action" style="width: 90px;">
                                        <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
                                        <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                    </td>
                                </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div> <!-- end table-responsive-->

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
    @endphp

    <script>
        var options = {
            series: [{
                name: 'Businesses by Sub County',
                data: [
                    @foreach($charge_total as $num)
                        {{$num}},
                    @endforeach
                ]
            }],
            chart: {
                height: 350,
                type: 'donut',
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
                        return val + " kes";
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

        var chart = new ApexCharts(document.querySelector("#transaction-data"), options);
        chart.render();

    </script>



@endsection
