@extends('layouts.navbar')
@section('sidebar')
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="" class="brand-link">
            <img src="{{ asset('themes/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">AdminLTE 3</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('themes/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="{{route('user.profile')}} " class="d-block">Alexander Pierce</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <!-- User Menu -->
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item has-treeview @if(strpos($_SERVER['REQUEST_URI'], '/user') !== false) menu-open @endif">
                        <a href="#" class="nav-link">
                            <i class="fas fa-user nav-icon"></i>
                            <p>
                                Người dùng
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('user.list')}}" class="nav-link">
                                    <i class="fas fa-list nav-icon"></i>
                                    <p>Danh sách thành viên</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('user.create')}}" class="nav-link">
                                    <i class="fas fa-user-plus nav-icon"></i>
                                    <p>Tạo người dùng mới</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>

                <!-- Group, Department Menu -->
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item has-treeview ">
                        <a href="#" class="nav-link">
                            <i class="fas fa-layer-group nav-icon"></i>
                            <p>
                                Khu vực, phòng ban
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('group.list')}}" class="nav-link">
                                    <i class="fas fa-list nav-icon"></i>
                                    <p>Danh sách</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>

                <!-- Event Menu -->
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item has-treeview ">
                        <a href="#" class="nav-link">
                            <i class="fas fa-fire nav-icon"></i>
                            <p>
                                Sự kiện
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="fas fa-list nav-icon"></i>
                                    <p>Danh sách sự kiện</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="far fa-calendar-plus nav-icon"></i>
                                    <p>Tạo sự kiên mới</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>

                <!-- Class Menu -->
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item has-treeview ">
                        <a href="#" class="nav-link">
                            <i class="fas fa-graduation-cap nav-icon"></i>
                            <p>
                                Lớp học
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
{{--                        <ul class="nav nav-treeview">--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="" class="nav-link">--}}
{{--                                    <i class="fas fa-list nav-icon"></i>--}}
{{--                                    <p>Danh sách sự kiện</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
@endsection
