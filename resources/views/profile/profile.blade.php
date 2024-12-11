@extends('layouts.master')
@section('title')
    @lang('translation.settings')
@endsection
@section('content')
    <div class="row mt-5" >
        <div class="col-xxl-3">
            <div class="card mt-n5">
                <div class="card-body p-4">
                    <div class="text-center">
                        {{-- <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                            <img src="@if (Auth::user()->avatar != '') {{ URL::asset('images/' . Auth::user()->avatar) }}@else{{ URL::asset('build/images/users/avatar-1.jpg') }} @endif"
                                class="  rounded-circle avatar-xl img-thumbnail user-profile-image"
                                alt="user-profile-image">
                            <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                <input id="profile-img-file-input" type="file" class="profile-img-file-input">
                                <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                    <span class="avatar-title rounded-circle bg-light text-body">
                                        <i class="ri-camera-fill"></i>
                                    </span>
                                </label>
                            </div>
                        </div> --}}
                        <form id="profile-form" action="{{ route('update-avatar') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                <img src="@if ($user->avatar != '') {{ URL::asset('build/users/' . $user->avatar) }}@else{{ URL::asset('build/images/users/user-dummy-img.jpg') }} @endif"
                                    class="rounded-circle avatar-xl img-thumbnail user-profile-image  shadow"
                                    alt="user-profile-image">
                                <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                    <input id="profile-img-file-input" type="file" value="" name="avatar"
                                        accept="image/png, image/gif, image/jpeg" class="profile-img-file-input">
                                    <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                        <span class="avatar-title rounded-circle bg-light text-body shadow">
                                            <i class="ri-camera-fill"></i>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </form>

                        <script>
                            document.getElementById('profile-img-file-input').addEventListener('change', function () {
                                document.getElementById('profile-form').submit();
                            });
                        </script>
                        <h5 class="fs-16 mb-1">{{$user->name." ".$user->full_name}}</h5>
                        <p class="text-muted mb-0">{{$user->email}}</p>
                        {{-- <p class="text-muted mb-0" style="text-transform: capitalize;">{{auth()->user()->getRoleNames()->first()}}</p> --}}
                    </div>
                </div>
            </div>
            <!--end card-->
        </div>
        <!--end col-->
        <div class="col-xxl-9">
            <div class="card mt-xxl-n5">
                <div class="card-header">
                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist" id="Tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                <i class="fas fa-home"></i>
                                Personal Details
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">
                                <i class="far fa-user"></i>
                                Change Password
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#configuration" role="tab">
                                <i class="far fa-user"></i>
                                Configuration
                            </a>
                        </li> --}}
                    </ul>
                </div>
                <div class="card-body p-4">
                    <div class="tab-content">
                        <div class="tab-pane active" id="personalDetails" role="tabpanel">
                            @if (Session::has('message'))
                            <div class="alert {{ Session::get('alert-class', 'alert-info') }}" id="alert-message">
                                {{ Session::get('message') }}
                            </div>

                            <script>
                                // Add a timer to automatically dismiss the alert after 5 seconds (adjust as needed)
                                setTimeout(function() {
                                    document.getElementById('alert-message').style.display = 'none';
                                }, 5000); // 5000 milliseconds = 5 seconds
                            </script>
                        @endif
                        @error('password')
                            <div class="alert alert-danger" id="alert-message">
                                {{ $message }}
                            </div>

                            <script>
                                // Add a timer to automatically dismiss the alert after 5 seconds (adjust as needed)
                                setTimeout(function() {
                                    document.getElementById('alert-message').style.display = 'none';
                                }, 5000); // 5000 milliseconds = 5 seconds
                            </script>
                        @enderror
                            <form method="post" action="{{ route('profile-update') }}" >
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Full Name</label>
                                            <input type="text" class="form-control" name="name" id="name"
                                                placeholder="Enter your First Name" value="{{$user->name}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email
                                                Address</label>
                                            <input type="email" class="form-control" name="email" id="email"
                                                placeholder="Enter your Email" value="{{$user->email}}" disabled>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="telephone1" class="form-label">Telephone</label>
                                            <input type="text" class="form-control" name="telephone1"
                                                id="telephone1" placeholder="Enter your Telephone" value="{{$user->telephone1}}">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="address1" class="form-label">Address</label>
                                            <input type="text" class="form-control" name="address1" id="address1"
                                                placeholder="Enter your Address" value="{{$user->address1}}">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="city_town" class="form-label">City</label>
                                            <input type="text" class="form-control" name="city_town" id="city_town" placeholder="Enter your City"
                                                value="{{$user->city_town}}" />
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="country" class="form-label">Country</label>
                                            <input type="text" class="form-control" name="country" id="country"
                                                placeholder="Enter your Country" value="{{$user->country}}" />
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="postcode" class="form-label">Post
                                                Code</label>
                                            <input type="text" class="form-control" name="postcode" minlength="5" maxlength="6"
                                                id="postcode" placeholder="Enter your PostCode" value="{{$user->postcode}}">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="submit" class="btn btn-primary">Updates</button>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </form>
                        </div>
                        <!--end tab-pane-->
                        <div class="tab-pane" id="changePassword" role="tabpanel">
                            <form method="post" action="{{ route('change_password') }}">
                                @csrf
                                {{-- @method('put') --}}
                                <div class="row g-2">
                                    <div class="col-lg-4">
                                        <div>
                                            <label for="current_password" class="form-label">Current
                                                Password*</label>
                                            <input type="password" class="form-control" name="current_password" id="current_password"
                                                placeholder="Enter current password">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div>
                                            <label for="password" class="form-label">New
                                                Password*</label>
                                            <input type="password" class="form-control" name="password" id="password"
                                                placeholder="Enter new password">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div>
                                            <label for="password_confirmation" class="form-label">Confirm
                                                Password*</label>
                                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation"
                                                placeholder="Confirm password">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-success">Change
                                                Password</button>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </form>
                        </div>
                        <!--end tab-pane-->
                        {{-- <div class="tab-pane" id="configuration" role="tabpanel">

                            <p class="fw-bold fs-5">Email Configuration</p>
                            <form action="{{ url('/admin/admin-email-config') }}" method="post" >
                                @csrf
                                <input class="form-control" placeholder="" name="emailconfigid" value="{{ $emailconfig ? $emailconfig->id : ''}}"  hidden="">
                                <div class="row">
                                <div class="col-lg-12 row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="firstnameInput" class="form-label">Mail Mailer</label>
                                            <input type="text" class="form-control"
                                            placeholder="mail mailer e.g smtp.." name="mail_mailer" value="{{ $emailconfig ? $emailconfig->mail_mailer : '' }}" required>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="lastnameInput" class="form-label">Mail Host</label>
                                            <input type="text" name="mail_host" class="form-control" id=""
                                            placeholder="mail host e.g smtp.gmail.com" value="{{ $emailconfig ? $emailconfig->mail_host : '' }}" required >
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="lastnameInput" class="form-label">Mail Port</label>
                                            <input type="number" name="mail_port" class="form-control" id=""
                                            placeholder="mail port e.g 465" value="{{ $emailconfig ? $emailconfig->mail_port : '' }}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="lastnameInput" class="form-label">Mail username</label>
                                            <input type="text" name="mail_username" class="form-control" id=""
                                             placeholder="mail username e.g zeta@gmail.com.." value="{{ $emailconfig ? $emailconfig->mail_username : '' }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="lastnameInput" class="form-label">Mail password</label>
                                            <input type="text" name="mail_password" class="form-control" id=""
                                            placeholder="mail password" value="{{ $emailconfig ? $emailconfig->mail_password : '' }}" required>
                                        </div>
                                    </div>


                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="lastnameInput" class="form-label">Mail encryption</label>
                                            <input type="text" name="mail_encryption" class="form-control" id=""
                                            placeholder="mail encryption e.g ssl or tls" value="{{ $emailconfig ? $emailconfig->mail_encryption : '' }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="lastnameInput" class="form-label">Mail from address</label>
                                            <input type="text" name="mail_from_address" class="form-control" id=""
                                            placeholder="mail mailer e.g abc@gmail.com.." value="{{ $emailconfig ? $emailconfig->mail_from_address : '' }}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="lastnameInput" class="form-label">Mail from name</label>
                                            <input type="text" name="mail_from_name" class="form-control" id=""
                                            placeholder="mail mailer name e.g ZETA Enterprise" value="{{ $emailconfig ? $emailconfig->mail_from_name : '' }}" required>
                                        </div>
                                    </div>
                                </div>


                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </form>


                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->
@endsection
@section('script')
    <script src="{{ URL::asset('build/js/pages/profile-setting.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Your custom script -->
<script type="text/javascript">
    $(document).ready(function() {
        var ActiveTab = localStorage.getItem('ActiveTab');
        if (ActiveTab) {
            $('#Tabs a[href="' + ActiveTab + '"]').tab('show');
        }

        $('#Tabs a').on('shown.bs.tab', function(e) {
            var target = $(e.target).attr('href');
            localStorage.setItem('ActiveTab', target);
        });
    });
</script>
