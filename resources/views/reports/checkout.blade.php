@extends('layouts.app')

@section('content')

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <form method="post" action="{{ route('checkout') }}">@csrf
                            <ol class="breadcrumb m-0">
                                <li class=""><input type="date" name="start_date" class="form-control"></li>
                                <li class=""><input type="date" name="end_date" class="form-control"></li>
                                <li class="breadcrumb-item"><button class="btn btn-warning" type="submit">Search</button></li>
                            </ol>
                        </form>
                    </div>
                    <h4 class="page-title">All Checked Out Vehicles</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-bordered mb-3">
                            <li class="nav-item">
                                <a href="#buttons-table-preview" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                    Preview
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#buttons-table-code" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                                    Code
                                </a>
                            </li>
                        </ul> <!-- end nav-->
                        <div class="tab-content">
                            <div class="tab-pane show active" id="buttons-table-preview">
                                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                    <tr>
                                        <th>Plate No.</th>
                                        <th>Drv Name</th>
                                        <th>Drv Number</th>
                                        <th>created_at</th>
                                        <th>Total Amount</th>
                                        <th>Amount Paid</th>
                                        <th>Duration</th>
                                        <th>Checkout</th>
                                        <th>Attendant Name</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($checkouts->data as $key=>$item)
                                        <tr>
                                            <td>{{ $item->number_plate }}</td>
                                            <td>{{ $item->driver_name }}</td>
                                            <td>{{ $item->driver_phone_number }}</td>
                                            <td>  {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}</td>
                                            <td>KES  {{ number_format($item->total_amount,2) }}</td>
                                            <td> KES {{ number_format($item->amount_paid,2) }}</td>
                                            <td>{{ $item->duration }}</td>
                                            <td>  {{ \Carbon\Carbon::parse($item->checkout_time)->format('d/m/Y') }}</td>
                                            <td>{{ $item->attendant_name }}</td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <!--  Add new task modal -->
                            </div> <!-- end preview-->

                        </div> <!-- end tab-content-->

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->

    </div>
    <!-- container -->
    <script src="{{ asset('vendors/jquery/jquery.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">
    <script type="text/javascript">
        $('.addnewcharge').click(function(e){

            e.preventDefault();

            var charge_type = $('#charge_type').val();
            var category_id = $('#category_id').val();
            var charge_amount = $('#charge_amount').val();

            $('#loader14').removeClass('d-none');
            $.ajax({
                url: "{{url('/add-new-charge')}}",
                type : "POST",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:{
                    category_id:category_id,
                    charge_type:charge_type,
                    charge_amount:charge_amount,
                },

                success:function(data){
                    //console.log(data.message);
                    $('#loader14').addClass('d-none');
                    $('#add-new-task-modal').modal('hide');


                    Swal.fire({
                        icon: 'success',
                        title: 'Great!',
                        text: data.message
                    })
                } ,
                error: function(data) {
                    $('#loader14').addClass('d-none');
                    Swal.fire({
                        title: 'Error!',
                        text: data.message,
                        icon: 'error',
                        confirmButtonText: 'Cool'
                    })
                }
            });

        })
    </script>
@endsection
