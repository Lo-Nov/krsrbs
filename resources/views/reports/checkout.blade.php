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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                            <li class="breadcrumb-item active">Data Tables</li>
                        </ol>
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
                                        <th>Drv Id</th>
                                        <th>Drv Number</th>
                                        <th>Occupants</th>
                                        <th>Destination</th>
                                        <th>Slot</th>
                                        <th>Amount Due</th>
                                        <th>Duration</th>
                                        <th>Slot</th>
                                        <th>Attendant Name</th>
                                        <th>Attendant Id</th>
                                    </tr>
                                    </thead>


                                    <tbody>
                                    @foreach($checkouts->data as $key=>$item)
                                        <tr>
                                            <td>{{ $item->number_plate }}</td>
                                            <td>{{ $item->driver_name }}</td>
                                            <td>{{ $item->driver_id }}</td>
                                            <td>{{ $item->driver_phone_number }}</td>
                                            <td>{{ $item->number_of_occupants }}</td>
                                            <td>{{ $item->destination }}</td>
                                            <td>{{ $item->slot }}</td>
                                            <td>{{ number_format($item->amount_due,2) }}</td>
                                            <td>{{ $item->duration }}</td>
                                            <td>{{ $item->slot }}</td>
                                            <td>{{ $item->attendant_name }}</td>
                                            <td>{{ $item->attendant_id }}</td>
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
