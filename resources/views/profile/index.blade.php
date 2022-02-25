@extends('dashboard.dashboard_master');
@section('page_title')
Profile
@endsection
@section('dashboard_content')

<div class="row">
    <div class="col-lg-12">
        <div class="profile card card-body px-3 pt-3 pb-0">
            <div class="profile-head">
                <div class="photo-content">
                    <div class="cover-photo"></div>
                </div>
                <div class="profile-info">
                    <div class="profile-photo">
                        @if (auth()->user()->profile_photo)
                        <img src=" {{asset('dashboard/uploads/profile_photo')}}/{{ auth()->user()->profile_photo }}" class="img-fluid rounded-circle" alt="">
                        @else
                        <img src="{{asset('dashboard/images/profile/profile.png')}}" class="img-fluid rounded-circle" alt="">
                        @endif

                    </div>
                    <div class="profile-details">
                        <div class="profile-name px-3 pt-2">
                            <h4 class="text-primary mb-0">{{auth()->user()->name}}</h4>
                            <p>UX / UI Designer</p>
                        </div>
                        <div class="profile-email px-2 pt-2">
                            <h4 class="text-muted mb-0">{{auth()->user()->email}}</h4>
                            <p>Email</p>
                        </div>
                        <div class="dropdown ml-auto">
                            <a href="#" class="btn btn-primary light sharp" data-toggle="dropdown" aria-expanded="true"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li class="dropdown-item"><i class="fa fa-user-circle text-primary mr-2"></i> View profile</li>
                                <li class="dropdown-item"><i class="fa fa-users text-primary mr-2"></i> Add to close friends</li>
                                <li class="dropdown-item"><i class="fa fa-plus text-primary mr-2"></i> Add to group</li>
                                <li class="dropdown-item"><i class="fa fa-ban text-primary mr-2"></i> Block</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="pt-3">
                    <div class="settings-form">
                        <h4 class="text-primary">Account Setting</h4>
                        <hr>
                        <form action="{{route('change_name')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Name</label>
                                    <input type="text" value="{{auth()->user()->name}}" class="form-control " name="new_name">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Phone Number</label>
                                    <input type="text" class="form-control " name="phone_number" value="{{auth()->user()->phone_number}}">

                                </div>
                                <div class="form-group col-md-4">
                                    <label>Profile Photo</label>
                                    <input type="file" class="form-control " name="profile_photo">
                                </div>
                                <button class="btn btn-primary btn-sm mt-2" type="submit">Update Changed</button>
                            </div>

                        </form>
                        <form action="{{route('change_password')}} " method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Current Password</label>
                                    <input type="password" class="form-control" name="current_password">
                                    @if (session('current_password_not_match'))
                                        <small class="text-danger">
                                            {{session('current_password_not_match')}}
                                        </small>
                                    @endif
                                </div>
                                <div class="form-group col-md-4">
                                    <label>New Password</label>
                                    <input type="password" class="form-control" name="new_password">
                                    @if (session('pass_and_conpass_not_match'))
                                        <small class="text-danger">
                                            {{session('pass_and_conpass_not_match')}}
                                        </small>
                                    @endif
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Confirm Password</label>
                                    <input type="password" class="form-control" name="confirm_password">
                                    @if (session('pass_and_conpass_not_match'))
                                        <small class="text-danger">
                                            {{session('pass_and_conpass_not_match')}}
                                        </small>
                                    @endif
                                </div>
                            </div>
                            <button class="btn btn-primary btn-sm" type="submit">Changed Your Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('footer_script')
    @if (session('name_changed'))
        <script>
            Swal.fire(
            '{{session('name_changed')}}',
            'You clicked the button!',
            'success'
            )
    </script>
    @endif
    @if (session('password_changed'))
    <script>
        Swal.fire(
        '{{session('password_changed')}}',
        'You clicked the button!',
        'success'
        )
</script>
@endif
@endsection
@endsection

