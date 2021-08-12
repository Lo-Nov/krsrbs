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
                            <li class="breadcrumb-item"><a href="#" data-bs-toggle="modal" data-bs-target="#add-new-task-modal" class="btn btn-secondary btn-sm ms-3">Add New Charge</a></li>
                        </ol>
                    </div>
                    <h4 class="page-title">All Vehicle Charges</h4>
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
                                        <th>#</th>
                                        <th>charge_type</th>
                                        <th>charge_amount</th>
                                        <th>status</th>
                                        <th>created_at</th>
                                    </tr>
                                    </thead>


                                    <tbody>
                                    @foreach($charges->data as $key=>$item)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $item->charge_type }}</td>
                                            <td>{{ number_format($item->charge_amount,2) }}</td>
                                            <td>{{ $item->status }}</td>
                                            <td>{{ $item->created_at }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <!--  Add new task modal -->
                                <div class="modal fade task-modal-content" id="add-new-task-modal" tabindex="-1" role="dialog" aria-labelledby="NewTaskModalLabel" aria-hidden="true">
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
                                                                <label for="task-title" class="form-label">Charge Type</label>
                                                                <input type="text" class="form-control form-control-light" id="charge_type" placeholder="Enter charge type">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Category</label>
                                                        <select class="form-select form-control-light" id="category_id">
                                                            <option>Select Project</option>
                                                            @foreach($categories->data as $item)
                                                                <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="task-title" class="form-label">Charge Amount</label>
                                                        <input type="text" class="form-control form-control-light" id="charge_amount" placeholder="Enter charge_amount">
                                                    </div>


                                                    <div class="text-end">
                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="button" class="btn btn-primary addnewcharge">Create</button>
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
