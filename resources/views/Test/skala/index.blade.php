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
                            <h1>Daftar Versi Perhitungan F-AHP</h1>
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
                                        <button type="button" class="btn btn-success add-btn" data-toggle="modal" data-target="#tambah_versi"><i class="ri-add-line align-bottom me-1"></i>Tambah Versi</button>
                                    </div>
                                </div>
                            </div>
                            <div class="datatable-wrapper table-responsive">
                                <table id="datatable" class="display compact table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Versi</th>
                                        <th>Terakhir Update</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach($data_skala as $items)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$items->versi}}</td>
                                            <td>{{date_format(date_create($items->updated_at), "D, d F Y h:i A")}}</td>
                                            <td>
                                                <div class="d-flex gap-2">

                                                    <a href= "{{route("index_kriteria", $items->kode_unik)}}" class='btn btn-outline-primary btn-sm detail mr-2' title='Detail'><i class='fas fa fa-eye'></i></a>
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
                                                                <form method="POST" enctype="multipart/form-data" action="{{route("edit_skala", $items->id)}}">
                                                                    @csrf
                                                                    <div class="modal-body">
                                                                        <div class="mb-3">
                                                                            <label for="customername-field" class="form-label">Nama Versi</label>
                                                                            <input type="text" value="{{$items->versi}}" name="nama_versi" id="customername-field" class="form-control" placeholder="Masukkan Versi" required />
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
                                                                        <p>Semua data <strong>{{$items->versi}}</strong> akan dihapus!!</p>
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <a href="{{route("delete_skala", $items->id)}}">
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
            <div class="modal fade" id="tambah_versi" tabindex="-1" role="dialog" aria-labelledby="defaultModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Data User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" enctype="multipart/form-data" action="{{route("create_skala")}}">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="customername-field" class="form-label">Nama Versi</label>
                                    <input type="text" name="nama_versi" id="customername-field" class="form-control" placeholder="Masukkan Versi" required />
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

