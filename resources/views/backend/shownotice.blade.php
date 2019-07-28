<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All Notices</title>
    @include('backend/allcss')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        @include('backend/header')
        @include('backend/leftmenu')

        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <div class="box box-primary" style="margin-top:20px !important;">
                        <div class="box-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $id=1
                                    @endphp
                                    @foreach ($getnotices as $notice)
                                        <tr class="table-active">
                                            <th scope="row">{{$id}}</th>
                                            <td>{{$notice['notice_name']}}</td>
                                            <td>{{$notice['notice_type_name']}}</td>
                                            <td><a href="{{url('/admin/edit-notice',$notice['notice_id'])}}" class="btn btn-primary">edit</a></td>
                                            <td><a href="{{url('/admin/delete-notice',$notice['notice_id'])}}" class="btn btn-danger">Delete</a></td>
                                        </tr>
                                        @php
                                        $id++
                                        @endphp
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
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