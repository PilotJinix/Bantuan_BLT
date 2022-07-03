@extends('layout.main')
@section('content')
    <div class="app-main" id="main">
        <!-- begin container-fluid -->
        <div class="container-fluid">
            <!-- begin row -->
            <div class="row">
                <div class="col-md-12 m-b-30">
                    <!-- begin page title -->
                    <div class="d-block d-sm-flex flex-nowrap align-items-center">
                        <div class="page-title mb-2 mb-sm-0">
                            <h1>Daftar Calon Penerima Bantuan </h1>
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
                                        <th>Prioritas</th>
                                        <th>Terakhir Update</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
{{--                                    @php--}}
{{--                                        $i = 1;--}}
{{--                                    @endphp--}}
{{--                                    @foreach($data_sub_kriteria as $items)--}}
{{--                                        <tr>--}}
{{--                                            <td>{{$i++}}</td>--}}
{{--                                            <td>{{$items->nama_sub_kriteria}}</td>--}}
{{--                                            <td>{{$items->kode_sub}}</td>--}}
{{--                                            <td>{{$items->prioritas_sub}}</td>--}}
{{--                                            <td>{{date_format(date_create($items->updated_at), "D, d F Y h:i A")}}</td>--}}
{{--                                            <td>--}}
{{--                                                <div class="d-flex gap-2">--}}
{{--                                                    --}}{{--                                                    <a href= "#" class='btn btn-outline-primary btn-sm detail mr-2' title='Detail'><i class='fas fa fa-eye'></i></a>--}}
{{--                                                    <a href="javascript:void(0)" class="btn btn-outline-warning btn-sm detail mr-2" data-toggle="modal" data-target="{{__("#editpengguna".$items->id)}}"><i class="fa fa-pencil"></i></a>--}}
{{--                                                    <a href="javascript:void(0)" class="btn btn-outline-danger btn-sm delete mr-2" data-toggle="modal" data-target="{{__("#deletepengguna".$items->id)}}"><i class="fa fa-trash" ></i></a>--}}

{{--                                                    <div class="modal fade" id="{{__('editpengguna'.$items->id)}}" tabindex="-1" role="dialog" aria-labelledby="defaultModal" aria-hidden="true">--}}
{{--                                                        <div class="modal-dialog" role="document">--}}
{{--                                                            <div class="modal-content">--}}
{{--                                                                <div class="modal-header">--}}
{{--                                                                    <h5 class="modal-title">Edit Data User</h5>--}}
{{--                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                                                                        <span aria-hidden="true">&times;</span>--}}
{{--                                                                    </button>--}}
{{--                                                                </div>--}}
{{--                                                                <form method="POST" enctype="multipart/form-data" action="{{route("edit_sub_kriteria", $items->id)}}">--}}
{{--                                                                    @csrf--}}
{{--                                                                    <div class="modal-body">--}}
{{--                                                                        <div class="mb-3">--}}
{{--                                                                            <label for="customername-field" class="form-label">Nama Kriteria</label>--}}
{{--                                                                            <input type="text" value="{{$items->nama_sub_kriteria}}" name="nama_kriteria" id="customername-field" class="form-control" placeholder="Masukkan Kriteria" required />--}}
{{--                                                                        </div>--}}
{{--                                                                        <div class="mb-3">--}}
{{--                                                                            <label for="customername-field" class="form-label">Nama Kode</label>--}}
{{--                                                                            <input type="text" value="{{$items->kode_sub}}" name="nama_kode" id="customername-field" class="form-control" placeholder="Masukkan Kode" required />--}}
{{--                                                                        </div>--}}
{{--                                                                    </div>--}}
{{--                                                                    <div class="modal-footer">--}}
{{--                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>--}}
{{--                                                                        <button type="submit" class="btn btn-success">Submit</button>--}}
{{--                                                                    </div>--}}
{{--                                                                </form>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="modal fade" id="{{__('deletepengguna'.$items->id)}}" tabindex="-1" role="dialog" aria-labelledby="defaultModal" aria-hidden="true">--}}
{{--                                                        <div class="modal-dialog" role="document">--}}
{{--                                                            <div class="modal-content">--}}
{{--                                                                <div class="modal-header">--}}
{{--                                                                    <h5 class="modal-title" id="exampleModalCenterTitle">PERINGATAN</h5>--}}
{{--                                                                    <a href="javascript:void(0);" class="btn-close" data-bs-dismiss="modal"></a>--}}
{{--                                                                </div>--}}
{{--                                                                <div class="modal-body">--}}
{{--                                                                    <div style="text-align: center;">--}}
{{--                                                                        <i class="fa fa-warning"--}}
{{--                                                                           style="font-size: 100px; color: orange"></i>--}}
{{--                                                                        <p>Semua data <strong>{{$items->nama_sub_kriteria}}</strong> akan dihapus!!</p>--}}
{{--                                                                    </div>--}}

{{--                                                                </div>--}}
{{--                                                                <div class="modal-footer">--}}
{{--                                                                    <a href="{{route("delete_sub_kriteria", $items->id)}}">--}}
{{--                                                                        <button type="button" class="btn btn-danger">Hapus Data</button>--}}
{{--                                                                    </a>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </td>--}}
{{--                                        </tr>--}}
{{--                                    @endforeach--}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


{{--            <!-- begin row 1 -->--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-12 m-b-30">--}}
{{--                    <!-- begin page title -->--}}
{{--                    <div class="d-block d-sm-flex flex-nowrap align-items-center">--}}
{{--                        <div class="page-title mb-2 mb-sm-0">--}}
{{--                            <h1>Mapping Skala</h1>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- end page title -->--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!-- end row -->--}}
{{--            <!-- begin row -->--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-12">--}}
{{--                    <div class="card card-statistics">--}}
{{--                        <div class="card-body">--}}

{{--                            <div class="row g-4 mb-3">--}}
{{--                                <div class="col-sm">--}}
{{--                                    <div class="d-flex justify-content-sm-end">--}}
{{--                                        <button type="button" class="btn btn-success add-btn m-1" data-toggle="modal" data-target="#tambah_nilai_kriteria"><i class="ri-add-line align-bottom me-1"></i>Tambah Nilai Kriteria</button>--}}
{{--                                        <button type="button" class="btn btn-warning add-btn m-1" id="perhitungan" style="display: none;"><i class="ri-add-line align-bottom me-1"></i>Perhitungan</button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="datatable-wrapper table-responsive">--}}
{{--                                <table id="datatable" class="display text-md-center compact table table-striped table-bordered">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th>Kriteria</th>--}}
{{--                                        @foreach($data_sub_kriteria as $item_kriteria)--}}
{{--                                            <th>{{$item_kriteria -> nama_sub_kriteria}}</th>--}}
{{--                                        @endforeach--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                    @foreach($data_skala_sub_kriteria as $items_skala_kriteria)--}}
{{--                                        <tr>--}}
{{--                                            @foreach($items_skala_kriteria as $key => $data)--}}
{{--                                                @if($key == 0)--}}
{{--                                                    <th>{{$data}}</th>--}}
{{--                                                @else--}}
{{--                                                    <td>{{$data}}</td>--}}
{{--                                                @endif--}}
{{--                                            @endforeach--}}
{{--                                        </tr>--}}
{{--                                    @endforeach--}}
{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="row" style="display: block;">--}}
{{--                <div class="col-lg-12">--}}
{{--                    <div class="card card-statistics">--}}
{{--                        <div class="card-body">--}}

{{--                            <div class="row g-4 mb-3">--}}
{{--                                <div class="col-sm">--}}
{{--                                    <div class="d-flex justify-content-sm-start">--}}
{{--                                        <h3>Normalisasi</h3>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="datatable-wrapper table-responsive">--}}
{{--                                <table id="dt_normalisasi" class="compact table table-striped table-bordered" style="width: 100%;">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th>No</th>--}}
{{--                                        <th>Nama Kriteria</th>--}}
{{--                                        <th>Nilai Kriteria</th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                </table>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="modal fade" id="tambah_nilai_kriteria" tabindex="-1" role="dialog" aria-labelledby="defaultModal" aria-hidden="true">--}}
{{--                <div class="modal-dialog" role="document">--}}
{{--                    <div class="modal-content">--}}
{{--                        <div class="modal-header">--}}
{{--                            <h5 class="modal-title">Data Nilai Kriteria</h5>--}}
{{--                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                                <span aria-hidden="true">&times;</span>--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                        <form method="POST" enctype="multipart/form-data" action="{{route("create_skala_sub_kriteria", $data_kriteria->kode_unik)}}">--}}
{{--                            @csrf--}}
{{--                            <div class="modal-body" id="perbandingan">--}}

{{--                                <div class="mb-3">--}}
{{--                                    <label for="status-field" class="form-label">Kriteria Awal</label>--}}
{{--                                    <select class="form-control" data-trigger name="awal" id="kriteria_awal" disabled>--}}
{{--                                        <option selected disabled>Pilih Kriteria Awal</option>--}}
{{--                                        @foreach($data_sub_kriteria as $data)--}}
{{--                                            @if($data->prioritas_sub == "1")--}}
{{--                                                <option value="{{$data->kode_unik}}" {{$data->prioritas_sub == "1" ? "selected" : ""}} >{{$data->nama_sub_kriteria}}</option>--}}
{{--                                            @endif--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="modal-footer">--}}
{{--                                <div class="hstack gap-2 justify-content-end">--}}
{{--                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>--}}
{{--                                    <button type="submit" class="btn btn-success">Submit</button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="modal fade" id="tambah_kriteria" tabindex="-1" role="dialog" aria-labelledby="defaultModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Data User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" enctype="multipart/form-data" action="{{route('create_user_informasi')}}">
                            @csrf
                            <div class="modal-body">
                                <div class="duallistbox">
                                    <select name="multiple[]" multiple="multiple" size="10" id="duallistbox">
                                        @foreach($data_calon_penerima as $items)
                                            <option value="{{$items->nik}}">{{$items->nama. ' - '. $items->nik}}</option>
                                        @endforeach
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
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
@endsection

