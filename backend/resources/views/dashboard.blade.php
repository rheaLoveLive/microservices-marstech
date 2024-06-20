@extends('layouts.template')

@section('title', 'Dashboard')
@section('page-title', $page_title)

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">

                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>
                        
                        <div class="info-box-content">
                            <span class="info-box-text"><b>Users</b></span>
                            <span class="info-box-number">
                                <h6>{{ $jumlah_user }} Person</h6>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-cloud-download-alt"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text"><b>Aplications</b></span>
                            <span class="info-box-number">
                                <h6>{{ $jumlah_addonc }} Apk</h6>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-shopping-cart"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text"><b>Transactions</b></span>
                            <span class="info-box-number">
                                <h6>{{ $jumlah_trans }} Trans</h6>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-map-marker-alt"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text"><b>Plug-Routes</b></span>
                            <span class="info-box-number">
                                <h6>{{ $jumlah_route }} Route</h6>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>
            </div>
            <!-- /.row -->
        </div>
    </section>
@endsection
