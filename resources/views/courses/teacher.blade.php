@extends('layouts.sidebar')

@section('script')
    <!-- Ckeidtor -->
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
    <script src="{{ asset('assets/js/role/list.js') }}" defer></script> <!-- Change link assets -->
@endsection

@section("content")
    <style>
        .table thead th {
            vertical-align: middle;
        }
    </style>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Danh sách Giảng viên</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('index')}}">Trang chủ</a></li>
                            <li class="breadcrumb-item active">Danh sách Giảng viên khóa học</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"></h3>

                                <a class="btn btn-success text-white float-right" id="btnAddRole">
                                    <i class="fas fa-cog"></i>
                                    Thêm Giảng viên mới
                                </a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered table-hover">
                                    <thead >
                                    <tr style="text-align: center" >
                                        <th style="width: 3%">STT</th>
                                        <th>Tên</th>
                                        <th>Giới tính</th>
                                        <th>Ngày sinh</th>
                                        <th>Quê quán</th>
                                        <th>Nghề nghệp</th>
                                        <th>Trình độ</th>
                                        <th>Hành động</th>
                                    </tr>
                                    </thead>
                                    <tbody id="tableRoleList">
                                    @forelse($teachers as $key => $teacher)
                                        <tr id="teacher-{{$teacher->id}}">
                                            <th style="text-align: center">{{++$key}}</th>
                                            <th style="text-align: center">{{$teacher->name}}</th>
                                            <th style="text-align: center">{{$teacher->gender ? "Nam" : "Nữ"}}</th>
                                            <th style="text-align: center">{{$teacher->birthday}}</th>
                                            <th>{{$teacher->address}}</th>
                                            <th>{{$teacher->level}}</th>
                                            <th>{{$teacher->job}}</th>
                                            <th style="text-align: center"><button type="button" class="btn btn-outline-primary btn-sm btnView" data-id="{{$teacher->id}}">Xem</button></th>
                                            <th style="text-align: center"><button type="button" class="btn btn-outline-success btn-sm btnEdit" data-id="{{$teacher->id}}">Chỉnh sửa</button></th>
                                        </tr>
                                    @empty
                                        <tr>
                                            <th colspan="8" style="text-align: center">Không có dữ liệu hiển thị! Vui lòng thử lại!</th>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- modal Add New Role -->
    <div class="modal fade" id="modalAddRole">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalAddRoleTitle">Modal default</h4>
                    <button type="button" class="close closeModal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" id="" class="form-horizontal" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="id" class="form-control" name="id">

                        <div class="row">
                            <label class="col-lg-2 col-form-label" for="name" id="inputNameTitle">Họ và Tên: <span class="text-danger">*</span></label>
                            <div class="form-group col-lg-10">
                                <input type="text" name="name" id="name" class="form-control" >
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-lg-2 col-form-label" for="gender">Giới tính:  <span class="text-danger">*</span></label>
                            <div class="form-group col-lg-10">
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="gender1" name="gender" value="1" checked>
                                    <label for="gender1" style="margin-right: 10px">
                                        Nam
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="gender2" name="gender" value="0">
                                    <label for="gender2">
                                        Nữ
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="birthday"> Ngày sinh:  <span class="text-danger">*</span></label>
                            <div class="form-group col-lg-10">
                                <input type="date" name="birthday" id="birthday" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="native_place">Quê quán: </label>
                            <div class="form-group col-lg-10">
                                <input type="text" name="native_place" id="native_place" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="level">Trình độ: </label>
                            <div class="form-group col-lg-10">
                                <input type="text" name="level" id="level" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="job">Công việc: </label>
                            <div class="form-group col-lg-10">
                                <input type="text" name="job" id="job" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="position">Chức vụ: </label>
                            <div class="form-group col-lg-10">
                                <input type="text" name="position" id="póitition" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row" >
                            <label class="col-lg-2 col-form-label" for="description">Mô tả:</label>
                            <div class="col-lg-10">
                                <textarea type="text" name="description" id="description" class="form-control" ></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default closeModal" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary" id="btnSave"><i class="fas fa-save"></i> Lưu thông tin </button>
                    </div>
                </form>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection