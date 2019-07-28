<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update {{$notice['notice_name']}}</title>
    @include('backend/allcss')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        @include('backend/header')
        @include('backend/leftmenu')

        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <div class="box box-primary" style="margin-top:20px !important;">
                        @if(session()->has('message'))
                            <div class="alert alert-{{ session()->get('type') }} alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <p>{{ session()->get('message') }}</p>
                            </div>
                        @endif
                        <form action="{{route('notice.update')}}" method="post">
                            @csrf
                            <input type="hidden" value="{{$notice['notice_id']}}" name="noticeid" id="noticeid">
                            <div class="box-body">
                                <div class="form-group @error('notice_name') has-error @enderror">
                                    <label for="">Notice Name</label>
                                    <input type="text" class="form-control" name="notice_name" id="notice_name" value="{{$notice['notice_name']}}">
                                    @error('notice_name')
                                        <span class="help-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group @error('description') has-error @enderror">
                                    <label for="">Description</label>
                                    <Textarea class="form-control" rows="10" name="description" id="description">{{$notice['description']}}</Textarea>
                                    @error('description')
                                        <span class="help-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group @error('notice_type_id') has-error @enderror">
                                    <label for="">Select Notice Type</label>
                                    <select name="notice_type_id" id="notice_type_id" class="form-control" value="{{$notice['notice_type_id']}}">
                                        <option value="">Select Role</option>
                                        @foreach ($noticetypes as $noticetype)
                                                @php $selected = ($notice['notice_type_id']==$noticetype->id)?'selected':''  @endphp
                                            <option value="{{$noticetype->id}}" {{$selected}}>{{$noticetype->notice_type_name}}   
                                                {{-- {{$notice->id}} --}}
                                        @endforeach
                                    </select>
                                    @error('notice_type_id')
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