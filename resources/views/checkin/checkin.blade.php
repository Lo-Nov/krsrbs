@extends('layouts.app')

@section('content')

    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Check in Vehicle</h4>
                        <p class="text-muted font-14">
                          Use the platform to check in the vehicle to the system
                        </p>

                        <ul class="nav nav-tabs nav-bordered mb-3">
                            <li class="nav-item">
                                <a href="#typeahead-preview" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                    Preview
                                </a>
                            </li>
                        </ul> <!-- end nav-->
                        <div class="tab-content">
                            @if(session()->has('message.level'))
                                <div class="alert alert-{{ session('message.level') }}">
                                    {!! session('message.content') !!}
                                </div>
                            @endif
                            <form action="{{ route('check-in') }}" method="post">@csrf
                            <div class="tab-pane show active" id="typeahead-preview">

                               <div class="row">
                                   <div class="col-lg-12">
                                       <div class="mb-3">
                                           <label class="form-label">Categories</label>
                                           <select class="form-select form-control-light" name="category_id">
                                               <option>Select Project</option>
                                               @foreach($categories->data as $item)
                                                   <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                                               @endforeach
                                           </select>


                                       </div>
                                   </div> <!-- end col -->
                               </div>


                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Number Plate</label>
                                            <input type="text" class="form-control" data-provide="typeahead" name="number_plate" placeholder=" Enter number plate">
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Checking Time</label>
{{--                                            <input type="time" class="form-control" data-provide="typeahead" value="{{Carbon\Carbon::now()->format('Y-m-d')."T".Carbon\Carbon::now()->format('H:i')}}" name="checkin_time" placeholder="Time">--}}
                                            <input type="datetime-local" class="form-control" data-provide="typeahead" name="checkin_time" placeholder="Time">
                                        </div>
                                    </div> <!-- end col -->
                                </div>
                                <!-- end row -->

                                <div class="row ">
                                    <div class="col-lg-6">
                                        <div class="mb-0 float-right">
                                            <button type="submit" class="btn btn-primary">Check In</button>
                                        </div>
                                    </div> <!-- end col -->
                                </div>
                                <!-- end row -->
                            </div> <!-- end preview-->
                            </form>
                        </div> <!-- end tab-content-->

                    </div> <!-- end card-body -->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row -->

    </div> <!-- container -->
@endsection
