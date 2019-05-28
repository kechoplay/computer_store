@extends('layout.admin.main')

@push('css')
    <!-- bootstrap-wysiwyg -->
    <link href="../vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    <link href="../vendors/starrr/dist/starrr.css" rel="stylesheet">
@endpush()

@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Thông tin cá nhân</h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Báo cáo người dùng</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                            <div class="profile_img">
                                <div id="crop-avatar">
                                    <!-- Current avatar -->
                                    <img class="img-responsive avatar-view" src="{{ \Illuminate\Support\Facades\Auth::user()->image }}" alt="Avatar"
                                         title="Change the avatar">
                                </div>
                            </div>
                            <h3>{{ \Illuminate\Support\Facades\Auth::user()->fullname }}</h3>

                            <ul class="list-unstyled user_data">
                                <li>
                                    <i class="fa fa-map-marker user-profile-icon"></i>
                                    {{ \Illuminate\Support\Facades\Auth::user()->address }}
                                </li>

                                <li>
                                    <i class="fa fa-envelope user-profile-icon"></i> {{ \Illuminate\Support\Facades\Auth::user()->email }}
                                </li>

                                <li>
                                    <i class="fa fa-birthday-cake user-profile-icon"></i> {{ \Illuminate\Support\Facades\Auth::user()->birthday }}
                                </li>

                                <li>
                                    <i class="fa fa-phone user-profile-icon"></i>
                                    {{ \Illuminate\Support\Facades\Auth::user()->mobile }}
                                </li>

                                <li class="m-top-xs">
                                    <i class="fa fa-lock user-profile-icon"></i>
                                    {{ \Illuminate\Support\Facades\Auth::user()->level == 1 ? 'Admin' : 'Nhân viên' }}
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <div class="profile_title" style="padding: 0;">
                                <div class="col-md-12 x_panel">
                                    <div class="x_title">
                                        <h2><i class="fa fa-edit m-right-xs"></i> Edit Profile</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <!-- start form for validation -->
                                        <form id="demo-form2" data-parsley-validate method="post"
                                              action="{{ route('updateProfile') }}" enctype='multipart/form-data'>
                                            {{ csrf_field() }}
                                            <input type="hidden" id="id" name="id"
                                                   value="{{ \Illuminate\Support\Facades\Auth::id() }}">
                                            <label for="fullname">Tên đầy đủ :</label>
                                            <input type="text" id="fullname" class="form-control" name="fullname"
                                                   value="{{ \Illuminate\Support\Facades\Auth::user()->fullname }}"/>

                                            <label for="address">Địa chỉ :</label>
                                            <input type="text" id="address" class="form-control" name="address"
                                                   value="{{ \Illuminate\Support\Facades\Auth::user()->address }}"/>

                                            <label for="email">Email :</label>
                                            <input type="email" id="email" class="form-control" name="email"
                                                   value="{{ \Illuminate\Support\Facades\Auth::user()->email }}"
                                                   data-parsley-trigger="change"/>

                                            <label for="phone">Số điệnt thoại * :</label>
                                            <input type="text" id="phone" class="form-control" name="phone"
                                                   value="{{ \Illuminate\Support\Facades\Auth::user()->mobile }}"/>

                                            <label for="phone">Ngày sinh * :</label>
                                            <input type="date" id="birthday" class="form-control" name="birthday"
                                                   value="{{ \Carbon\Carbon::createFromTimestamp(strtotime(\Illuminate\Support\Facades\Auth::user()->birthday))->format('Y-m-d') }}"/>

                                            <label for="phone">Ảnh :</label>
                                            <input type="file" id="imageProfile" class="form-control" name="image" onchange="readImage(event)" accept="image/*">
                                            <div>
                                                <img src="{{ \Illuminate\Support\Facades\Auth::user()->image ? \Illuminate\Support\Facades\Auth::user()->image : '' }}"
                                                     style="width: 200px; height: 200px;" id="screenImage">
                                            </div>
                                            <label>Giới tính :</label>
                                            <p>
                                                Nam:
                                                <input type="radio" class="flat" name="gender" id="genderM" value="1"
                                                       @if(\Illuminate\Support\Facades\Auth::user()->gender == 1)checked=""
                                                       @endif required/>
                                                Nữ:
                                                <input type="radio" class="flat" name="gender" id="genderF" value="2"
                                                       @if(\Illuminate\Support\Facades\Auth::user()->gender == 2)checked=""@endif/>
                                            </p>

                                            <button class="btn btn-primary" type="submit">Cập nhật</button>
                                        </form>
                                        <!-- end form for validations -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()

@push('js')
    <!-- bootstrap-wysiwyg -->
    <script src="../vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="../vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="../vendors/google-code-prettify/src/prettify.js"></script>
    <!-- Switchery -->
    <script src="../vendors/switchery/dist/switchery.min.js"></script>
    <!-- Parsley -->
    <script src="../vendors/parsleyjs/dist/parsley.min.js"></script>
    <script>
        function readImage(event) {
            var input = event.target;
            var reader = new FileReader();

            reader.onload = function () {
                var dataUrl = reader.result;
                $('#screenImage').prop('src', dataUrl);
            };

            reader.readAsDataURL(input.files[0]);
        }


    </script>
@endpush()