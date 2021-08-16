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
                    <h4 class="page-title">All Checked In Vehicles</h4>
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
                                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100" id="data-table">
                                    <thead>
                                    <tr>
                                        <th>Plate No.</th>
                                        <th>Drv Name</th>
                                        <th>Drv Number</th>
                                        <th>Occupants</th>
                                        <th>Destination</th>
                                        <th>Slot</th>
                                        <th>Amount Due</th>
                                        <th>Duration</th>
                                        <th>Slot</th>
                                        <th>Attendant Name</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>


                                    <tbody>
                                    @foreach($checkins->data as $key=>$item)
                                        <tr>
                                            <td>{{ $item->number_plate }}</td>
                                            <td>{{ $item->driver_name }}</td>
                                            <td>{{ $item->driver_phone_number }}</td>
                                            <td>{{ $item->number_of_occupants }}</td>
                                            <td>{{ $item->destination }}</td>
                                            <td>{{ $item->slot }}</td>
                                            <td>{{ number_format($item->amount_due,2) }}</td>
                                            <td>{{ $item->duration }}</td>
                                            <td>{{ $item->slot }}</td>
                                            <td>{{ $item->attendant_name }}</td>
                                            @if($item->amount_due > 0 )
                                                <td>
                                                    <button class="btn btn-primary btnSelect" data-bs-toggle="modal" data-bs-target="#get-id"> <i class="zmdi zmdi-check-square"></i> Pay</button>
                                                </td>

                                            @else
                                                <td>Paid</td>
                                            @endif

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <!--  Add new task modal -->
                                <div class="modal fade task-modal-content" id="get-id" tabindex="-1" role="dialog" aria-labelledby="NewTaskModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="NewTaskModalLabel">Create New Charge</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                                <form class="p-2">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label for="task-title" class="form-label">Number Plate</label>
                                                                <input type="text" class="form-control form-control-light the-id0" id="charge_type" placeholder="Enter charge type">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Category</label>
                                                        <select class="form-select form-control-light" id="category_id">
                                                            <option>Select Project</option>

                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="task-title" class="form-label">Charge Amount</label>
                                                        <input type="text" class="form-control form-control-light" id="charge_amount" placeholder="Enter charge_amount">
                                                    </div>


                                                    <div class="text-end">
                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="button" class="btn btn-warning addnewcharge">Create</button>
                                                        <span>
                                                            <div class="d-none" id="loader14">
                                                             <img class="the-loader-of" src="{{ asset('loader/loader2.gif') }}" alt="" />
                                                            </div>
                                                        </span>
                                                    </div>
                                                </form>


                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
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
        $(document).ready(function(){
            // code to read selected table row cell data (values).
            $("#data-table").on('click','.btnSelect',function(){
                 alert("clicked");
                // get the current row
                var currentRow = $(this).closest("tr");

                var col1=$(this).parent().siblings().eq(0).text(); // get current row 1st TD value

                var col2=$(this).parent().siblings().eq(2).text();// get current row 2nd TD
                var id_num=$(this).parent().siblings().eq(1).text();
                var col3=$(this).parent().siblings().eq(3).text(); // get current row 3rd TD
                var col8=$(this).parent().siblings().eq(8).text(); // get current row 3rd TD
                var col9=$(this).parent().siblings().eq(9).text(); // get current row 3rd TD
                var col10=$(this).parent().siblings().eq(10).text(); // get current row 3rd TD


                var results=$(this).parent().siblings('.test-results').text();
                var the_lab=$(this).parent().siblings('.the-lab').text();
                var lab_val=0;


                //alert(col1);

                $("#get-id textarea").val(results);
                $("#get-id #labId").val(lab_val);

                $('#get-id .modal-body .the-id0').val(col1);
                $('#get-id .modal-body .the-id1').val(col2);
                $('#get-id .modal-body .the-id2').val(col3);
                $('#inspectionCodeText').text($('#inspectionCode').val());

                $('#testTittle').html(`<code class="modal_text">  `+id_num+` </code>`);
                $('#inspectionComment').html('<h5><strong><code class="modal_subtext"> '+col10+' </code></strong><h5>');
                $('#insepctionCost').html('<h5><strong><code class="modal_subtext"> '+col9+' </code></strong></h5>');


            });
        });
    </script>



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
