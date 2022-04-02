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

            <div class="row">
                <div class="col-md-12 m-b-30">
                    <!-- begin page title -->
                    <div class="d-block d-sm-flex flex-nowrap align-items-center">
                        <div class="page-title mb-2 mb-sm-0">
                            <h1>Periode</h1>
                        </div>

                    </div>
                    <!-- end page title -->
                </div>
            </div>
            <!-- end row -->
            <!-- begin row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-statistics">
                        <div class="card-body">

                            <div class="row g-4 mb-3">
                                <div class="col-sm">
                                    <div class="d-flex justify-content-sm-end">
                                        <button type="button" class="btn btn-success add-btn" data-toggle="modal" data-target="#tambah_periode"><i class="ri-add-line align-bottom me-1"></i>Tambah Periode</button>
                                    </div>
                                </div>
                            </div>
                            <div class="datatable-wrapper table-responsive">
                                <table id="datatable" class="display compact table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Kuota</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach($data_periode as $items)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$items->nama}}</td>
                                            <td>{{$items->kuota}}</td>
                                            <td class="status">
                                                @if($items->status == "1")
                                                    <label class="badge badge-success-inverse">Dibuka</label>
                                                @elseif($items->status == "0")
                                                    <label class="badge badge-danger-inverse">Ditutup</label>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href= "{{route("index_kriteria_admin",$items->kode_unik)}}" class='btn btn-outline-primary btn-sm detail mr-2' title='Detail'><i class='fas fa fa-eye'></i></a>
                                                    <a href="javascript:void(0)" class="btn btn-outline-warning btn-sm detail mr-2" data-toggle="modal" data-target="{{__("#editpengguna".$items->id)}}"><i class="fa fa-pencil"></i></a>
                                                    <a href="javascript:void(0)" class="btn btn-outline-danger btn-sm delete mr-2" data-toggle="modal" data-target="{{__("#deletepengguna".$items->id)}}"><i class="fa fa-trash" ></i></a>

                                                    <div class="modal fade" id="{{__('editpengguna'.$items->id)}}" tabindex="-1" role="dialog" aria-labelledby="defaultModal" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Edit Data User</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form method="POST" enctype="multipart/form-data" action="{{route("update_periode", $items->kode_unik)}}">
                                                                    @csrf
                                                                    <div class="modal-body">
                                                                        <div class="mb-3">
                                                                            <label for="customername-field" class="form-label">Nama Periode</label>
                                                                            <input type="text" value="{{$items->nama}}" name="nama" id="customername-field" class="form-control" placeholder="Masukkan Nama" required />
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="customername-field" class="form-label">Kuota</label>
                                                                            <input type="number" value="{{$items->kuota}}" name="kuota" id="customername-field" min="1"class="form-control" placeholder="Masukkan kuota" required />
                                                                        </div>

                                                                        <div>
                                                                            <label for="status-field" class="form-label">Status</label>
                                                                            <select class="form-control" data-trigger name="status" id="status-field">
                                                                                <option value="" disabled>Status</option>
                                                                                <option value="1" {{$items->status == "1" ? "selected" : ""}}>Dibuka</option>
                                                                                <option value="0" {{$items->status == "0" ? "selected" : ""}}>Ditutup</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
                                                                        <button type="submit" class="btn btn-success">Submit</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal fade" id="{{__('deletepengguna'.$items->id)}}" tabindex="-1" role="dialog" aria-labelledby="defaultModal" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalCenterTitle">PERINGATAN</h5>
                                                                    <a href="javascript:void(0);" class="btn-close" data-bs-dismiss="modal"></a>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div style="text-align: center;">
                                                                        <i class="fa fa-warning"
                                                                           style="font-size: 100px; color: orange"></i>
                                                                        <p>Semua data <strong>{{$items->nama}}</strong> akan dihapus!!</p>
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <a href="{{route("delete_periode", $items->kode_unik)}}">
                                                                        <button type="button" class="btn btn-danger">Hapus Data</button>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="tambah_periode" tabindex="-1" role="dialog" aria-labelledby="defaultModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Data Periode</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" enctype="multipart/form-data" action="{{route("create_periode")}}">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="customername-field" class="form-label">Nama Periode</label>
                                    <input type="text" name="nama" id="customername-field" class="form-control" placeholder="Masukkan Nama Periode" required />
                                </div>
                                <div class="mb-3">
                                    <label for="customername-field" class="form-label">Kuota</label>
                                    <input type="number" name="kuota" id="customername-field" min="1" class="form-control" placeholder="Masukkan Kuota" required />
                                </div>

                                <div>
                                    <label for="status-field" class="form-label">Status</label>
                                    <select class="form-control" data-trigger name="status" id="status-field" >
                                        <option value="" selected disabled>Status</option>
                                        <option value="1">Aktif</option>
                                        <option value="0">Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- end container-fluid -->
    </div>
@endsection


