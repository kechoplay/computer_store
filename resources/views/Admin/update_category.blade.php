@extends('layout.admin.main')

@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Sửa danh mục</h3>
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
                        <h2>Thông tin danh mục</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form class="form-horizontal form-label-left" novalidate method="post"
                              action="{{ route('editCategory') }}">
                            {{ csrf_field() }}
                            <input type="hidden" value="{{ $category->id }}" name="id">

                            <div style="text-align: center; margin-bottom: 10px;color: red; font-size: 15px;">
                                <span>{{ $errors->first('error') ? $errors->first('error') : '' }}</span>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="categoryName">Tên danh muc
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="categoryName" class="form-control col-md-7 col-xs-12" name="cate_name"
                                           placeholder="" required="required" type="text" value="{{ $category->cat_name }}">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label for="parentId" class="control-label col-md-3">Danh muc cha <span
                                            class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="parentId" name="parentId" class="form-control col-md-7 col-xs-12">
                                        <option value="0" {{ $category->parent_id == 0 ? 'selected' : '' }}>---Chọn danh mục cha---</option>
                                        @foreach($danhmuccha as $danhmuc)
                                            <option value="{{ $danhmuc['id'] }}" {{ $category->parent_id == $danhmuc['id'] ? 'selected' : '' }}>{{ $danhmuc['cat_name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label for="order" class="control-label col-md-3 col-sm-3 col-xs-12">Vị trí
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="order" type="number" name="sortOrder" class="form-control col-md-7 col-xs-12"
                                           required="required" value="{{ $category->sort_order }}">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="genderM">Trạng thái <span
                                            class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label class="control-label">
                                        Hiển thị:
                                        <input type="radio" class="flat" name="status" id="status1" value="1" {{ $category->cat_status == 1 ? 'checked' : '' }}
                                               required/>
                                        Ẩn:
                                        <input type="radio" class="flat" name="status" id="status0" value="0" {{ $category->cat_status == 0 ? 'checked' : '' }}/>
                                    </label>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button id="send" type="submit" class="btn btn-success">Lưu</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <!-- validator -->
    <script src="/vendors/validator/validator.js"></script>
@endpush