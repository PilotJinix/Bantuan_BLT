@extends("layout.main")
@section("content")
    <div class="app-main" id="main">
        <!-- begin container-fluid -->
        <div class="container-fluid">
            <!-- begin row -->
            <div class="row">
                <div class="col-md-12 m-b-30">
                    <!-- begin page title -->
                    <div class="d-block d-sm-flex flex-nowrap align-items-center">
                        <div class="page-title mb-2 mb-sm-0">
                            <h1>Daftar Kriteria Dengan Skala {{$data_skala->versi}}</h1>
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
                                        <button type="button" class="btn btn-success add-btn" data-toggle="modal" data-target="#tambah_kriteria"><i class="ri-add-line align-bottom me-1"></i>Tambah Kriteria</button>
                                    </div>
                                </div>
                            </div>
                            <div class="datatable-wrapper table-responsive">
                                <table id="datatable" class="display compact table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kriteria</th>
                                        <th>Kode</th>
                                        <th>Terakhir Update</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach($data_kriteria as $items)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$items->nama_kriteria}}</td>
                                            <td>{{$items->kode}}</td>
                                            <td>{{date_format(date_create($items->updated_at), "D, d F Y h:i A")}}</td>
                                            <td>
                                                <div class="d-flex gap-2">
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
                                                                <form method="POST" enctype="multipart/form-data" action="{{route("edit_kriteria", $items->id)}}">
                                                                    @csrf
                                                                    <div class="modal-body">
                                                                        <div class="mb-3">
                                                                            <label for="customername-field" class="form-label">Nama Kriteria</label>
                                                                            <input type="text" value="{{$items->nama_kriteria}}" name="nama_kriteria" id="customername-field" class="form-control" placeholder="Masukkan Kriteria" required />
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="customername-field" class="form-label">Nama Kode</label>
                                                                            <input type="text" value="{{$items->kode}}" name="nama_kode" id="customername-field" class="form-control" placeholder="Masukkan Kode" required />
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
                                                                        <p>Semua data <strong>{{$items->nama_kriteria}}</strong> akan dihapus!!</p>
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <a href="{{route("delete_kriteria", $items->id)}}">
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
            <div class="modal fade" id="tambah_kriteria" tabindex="-1" role="dialog" aria-labelledby="defaultModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Data User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" enctype="multipart/form-data" action="{{route("create_kriteria", $data_skala->kode_unik)}}">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="customername-field" class="form-label">Nama Kriteria</label>
                                    <input type="text" name="nama_kriteria" id="customername-field" class="form-control" placeholder="Masukkan Kriteria" required />
                                </div>
                                <div class="mb-3">
                                    <label for="customername-field" class="form-label">Nama Kode</label>
                                    <input type="text" name="nama_kode" id="customername-field" class="form-control" placeholder="Masukkan Kode" required />
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
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
@endsection

