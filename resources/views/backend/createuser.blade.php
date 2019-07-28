<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create User</title>
    @include('backend/allcss')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        @include('backend/header')
        @include('backend/leftmenu')

        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <div class="box box-primary" style="margin-top:20px !important;">
                        @if(session()->has('message'))
                            <div class="alert alert-{{ session()->get('type') }} alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <p>{{ session()->get('message') }}</p>
                            </div>
                        @endif
                        <form action="{{route('user.usersub')}}" method="post">
                            @csrf
                            <div class="box-body">
                                <div class="form-group @error('name') has-error @enderror">
                                    <label for="">User Name</label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}">
                                    @error('name')
                                        <span class="help-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group @error('email') has-error @enderror">
                                    <label for="">User Email</label>
                                    <input type="text" class="form-control" name="email" id="email" value="{{old('email')}}">
                                    @error('email')
                                        <span class="help-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group @error('role_id') has-error @enderror">
                                    <label for="">Select User Role</label>
                                    <select name="role_id" id="role_id" class="form-control" value="old('role_id')">
                                        <option value="">Select Role</option>
                                        @foreach ($userroles as $userrole)
                                            <option value="{{$userrole['id']}}">{{$userrole['user_role']}}   
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                        <span class="help-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group @error('password') has-error @enderror">
                                    <label for="">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" value="{{old('password')}}">
                                    @error('password')
                                        <span class="help-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group @error('password_confirmation') has-error @enderror">
                                    <label for="">Confirm Password</label>
                                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" value="{{old('password_confirmation')}}">
                                    @error('password_confirmation')
                                        <span class="help-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div style="text-align: center;">
                                    <button class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('backend/footer')
        <div class="control-sidebar-bg"></div>
    </div>
</body>
@include('backend/alljs')
</html>