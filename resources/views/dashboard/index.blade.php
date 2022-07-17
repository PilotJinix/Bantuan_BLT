@extends("layout.main")
@section("content")
    <div class="app-main" id="main">
        <!-- begin container-fluid -->
        <div class="container-fluid">
            <!-- begin row -->
            <div class="row">
                <div class="col-md-12 m-b-30">
                    <!-- begin page title -->
                    <div class="d-block d-lg-flex flex-nowrap align-items-center">
                        <div class="page-title mr-4 pr-4 border-right">
                            <h1>Dashboard</h1>
                        </div>
                    </div>
                    <!-- end page title -->
                </div>
            </div>
            <!-- end row -->
            <!-- begin row -->
            <div class="row">
                <div class="col-xs-6 col-xxl-3 m-b-30">
                    <div class="card card-statistics h-100 m-b-0 bg-pink">
                        <div class="card-body">
                            <h2 class="text-white mb-0">{{$s_periode}}</h2>
                            <p class="text-white">Periode</p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-xxl-3 m-b-30">
                    <div class="card card-statistics h-100 m-b-0 bg-primary">
                        <div class="card-body">
                            <h2 class="text-white mb-0">{{$s_pengguna}}</h2>
                            <p class="text-white">Pengguna</p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-xxl-3 m-b-30">
                    <div class="card card-statistics h-100 m-b-0 bg-orange">
                        <div class="card-body">
                            <h2 class="text-white mb-0">{{$s_c_penerima}}</h2>
                            <p class="text-white">Data Calon Penerima</p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-xxl-3 m-b-30">
                    <div class="card card-statistics h-100 m-b-0 bg-info">
                        <div class="card-body">
                            <h2 class="text-white mb-0">6</h2>
                            <p class="text-white">Jumlah Dusun</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end container-fluid -->
    </div>
@endsection


