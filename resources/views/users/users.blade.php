@extends('layouts.app')

@section('content')

    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Users</h4>
                        <p class="text-muted font-14">
                            Use the platform to add system users
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
                            <form action="{{ route('users') }}" method="post">
                                @csrf
                                <div class="tab-pane show active" id="typeahead-preview">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">First Name</label>
                                                <input type="text" class="form-control" data-provide="typeahead" name="first_name" placeholder=" Enter first name">
                                            </div>
                                        </div> <!-- end col -->
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Middle Name</label>
                                                <input type="text" class="form-control" data-provide="typeahead" placeholder="middle name" name="middle_name">
                                            </div>
                                        </div> <!-- end col -->
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Last Name</label>
                                                <input type="text" class="form-control" data-provide="typeahead" placeholder="last name" name="last_name">
                                            </div>
                                        </div> <!-- end col -->
                                    </div>
                                    <!-- end row -->

                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                <input type="text" class="form-control" data-provide="typeahead" name="email" placeholder=" Enter email">
                                            </div>
                                        </div> <!-- end col -->
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Username</label>
                                                <input type="text" class="form-control" data-provide="typeahead" name="user_name" placeholder="Enter User name">
                                            </div>
                                        </div> <!-- end col -->
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Password</label>
                                                <input type="text" class="form-control" data-provide="typeahead" name="password" placeholder="Enter password">
                                            </div>
                                        </div> <!-- end col -->
                                    </div>
                                    <!-- end row -->

                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Phone Number</label>
                                                <input type="text" class="form-control" data-provide="typeahead" name="phone_number" placeholder=" Enter phone number">
                                            </div>
                                        </div> <!-- end col -->
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <div class="mb-3">
                                                    <label class="form-label">User Role</label>
                                                    <select class="form-select form-control-light" name="roles">
                                                        <option value="PARKINGADMIN">Admin</option>
                                                        <option value="REPORTS">Reports</option>
                                                        <option value="OFFSTREET">Attendant</option>
                                                        <option value="CASHOFFICE">Cashier</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div> <!-- end col -->
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">National Id</label>
                                                <input type="text" class="form-control" data-provide="typeahead" placeholder="Enter National ID" name="national_id">
                                            </div>
                                        </div> <!-- end col -->
                                    </div>
                                    <!-- end row -->

                                    <div class="row ">
                                        <div class="col-lg-6">
                                            <div class="mb-0 float-right">
                                                <button type="submit" class="btn btn-warning">Add User</button>
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
