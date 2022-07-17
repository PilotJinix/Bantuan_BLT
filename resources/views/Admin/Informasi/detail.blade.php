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

            <div class="row tabs-contant">
                <div class="col-xxl-6">
                    <div class="card card-statistics">
                        <div class="card-body">
                            <div class="tab nav-border-bottom">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active show" id="home-02-tab" data-toggle="tab" href="#home-02" role="tab" aria-controls="home-02" aria-selected="true">Daftar Calon Penerima</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-02-tab" data-toggle="tab" href="#profile-02" role="tab" aria-controls="profile-02" aria-selected="false">Perhitungan</a>
                                    </li>

                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade py-3 active show" id="home-02" role="tabpanel" aria-labelledby="home-02-tab">
                                        <div class="row g-4 mb-3">
                                            <div class="col-sm">
                                                <div class="d-flex justify-content-sm-end">
                                                    <button type="button" class="btn btn-success add-btn" data-toggle="modal" data-target="#tambah_kriteria"><i class="ri-add-line align-bottom me-1"></i>Tambah Data</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="datatable-wrapper table-responsive">
                                            <table id="datatable" class="display compact table table-striped table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>NIK</th>
                                                    <th>Nama Penerima</th>
                                                    <th>Status Data</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $i = 1;
                                                @endphp
                                                @foreach($data_pengajuan as $items)
                                                    <tr>
                                                        <td>{{$i++}}</td>
                                                        <td>{{$items->kode_penerima}}</td>
                                                        <td>{{$items->nama}}</td>
                                                        <td>
                                                            @if($items->is_hasil == '1')
                                                                <a href="javascript:void(0)" class="mr-2 mb-2 mr-sm-0 mb-sm-0 badge badge-success">Data Telah Terinput</a>
                                                            @else
                                                                <a href="javascript:void(0)" class="mr-2 mb-2 mr-sm-0 mb-sm-0 badge badge-warning">Tidak Ditemukan</a>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="d-flex gap-2">
                                                                @if($items->is_hasil == '1')
                                                                    <a href= "#" class='btn btn-outline-warning btn-sm detail mr-2' title='Edit Data' data-toggle="modal" data-target="{{__("#editpengguna".$items->id)}}"><i class='fas fa fa-pencil'></i></a>
                                                                    <div class="modal fade" id="{{__('editpengguna'.$items->id)}}" tabindex="-1" role="dialog" aria-labelledby="defaultModal" aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">Edit Data Penerima</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <form method="POST" enctype="multipart/form-data" action="{{route("create_user_hasil", $items->kode_unik)}}">
                                                                                    @csrf
                                                                                    <div class="modal-body">
                                                                                        <div class="mb-3">
                                                                                            <label for="customername-field" class="form-label">Nama Penerima</label>
                                                                                            <input type="text" value="{{$items->nama}}" name="nama_kriteria" id="customername-field" class="form-control" placeholder="Masukkan Kriteria" disabled/>
                                                                                        </div>
                                                                                        <div class="mb-3">
                                                                                            <label for="customername-field" class="form-label">NIK</label>
                                                                                            <input type="text" value="{{$items->kode_penerima}}" name="nama_kode" id="customername-field" class="form-control" placeholder="Masukkan Kode" disabled/>
                                                                                        </div>
                                                                                        @foreach($data_kriteria['kriteria'] as $data)
                                                                                            <div class="mb-3">
                                                                                                <label for="status" class="form-label">{{$data->nama_kriteria}}</label>
                                                                                                <select name="status[]" class="form-control" id="status">
                                                                                                    <option selected disabled>Pilih Jawaban</option>
                                                                                                    @foreach($data_kriteria['sub_kriteria'] as $data_sub)
                                                                                                        @if($data->kode_unik == $data_sub -> kode_unik_kriteria )
                                                                                                            @foreach($data_pengajuan_edit as $edit)
                                                                                                                @if($data->kode_unik == $edit-> kriteria and $edit->kode_pengajuan == $items->kode_unik)
                                                                                                                    <option value="{{$data_sub->kode_unik}}" {{$data_sub -> kode_unik == $edit->jawaban?'selected':''}}>{{$data_sub->nama_sub_kriteria}}</option>
                                                                                                                @endif
                                                                                                            @endforeach

                                                                                                        @endif
                                                                                                    @endforeach
                                                                                                </select>
                                                                                            </div>
                                                                                        @endforeach

                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
                                                                                        <button type="submit" class="btn btn-success">Submit</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @else
                                                                    <a href="javascript:void(0)" class="btn btn-outline-primary btn-sm detail mr-2" title='Input Data' data-toggle="modal" data-target="{{__("#insertpengguna".$items->id)}}"><i class="fa fa-pencil-square-o"></i></a>
                                                                    <div class="modal fade" id="{{__('insertpengguna'.$items->id)}}" tabindex="-1" role="dialog" aria-labelledby="defaultModal" aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">Input Data Penerima</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <form method="POST" enctype="multipart/form-data" action="{{route("create_user_hasil", $items->kode_unik)}}">
                                                                                    @csrf
                                                                                    <div class="modal-body">
                                                                                        <div class="mb-3">
                                                                                            <label for="customername-field" class="form-label">Nama Penerima</label>
                                                                                            <input type="text" value="{{$items->nama}}" name="nama_kriteria" id="customername-field" class="form-control" placeholder="Masukkan Kriteria" disabled/>
                                                                                        </div>
                                                                                        <div class="mb-3">
                                                                                            <label for="customername-field" class="form-label">NIK</label>
                                                                                            <input type="text" value="{{$items->kode_penerima}}" name="nama_kode" id="customername-field" class="form-control" placeholder="Masukkan Kode" disabled/>
                                                                                        </div>
                                                                                        @foreach($data_kriteria['kriteria'] as $data)
                                                                                            <div class="mb-3">
                                                                                                <label for="status" class="form-label">{{$data->nama_kriteria}}</label>
                                                                                                <select name="status[]" class="form-control" id="status">
                                                                                                    <option selected disabled>Pilih Jawaban</option>
                                                                                                    @foreach($data_kriteria['sub_kriteria'] as $data_sub)
                                                                                                        @if($data->kode_unik == $data_sub -> kode_unik_kriteria )
                                                                                                            <option value="{{$data_sub->kode_unik}}">{{$data_sub->nama_sub_kriteria}}</option>
                                                                                                        @endif
                                                                                                    @endforeach
                                                                                                </select>
                                                                                            </div>
                                                                                        @endforeach

                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
                                                                                        <button type="submit" class="btn btn-success">Submit</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                <a href="javascript:void(0)" class="btn btn-outline-danger btn-sm delete mr-2" title='Delete Data' data-toggle="modal" data-target="{{__("#deletepengguna".$items->id)}}"><i class="fa fa-trash" ></i></a>
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
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade py-3" id="profile-02" role="tabpanel" aria-labelledby="profile-02-tab">
                                        <div class="row g-4 mb-3">
                                            <div class="col-sm">
                                                <div class="d-flex justify-content-sm-end">
                                                    <a id="final" class="btn btn-success add-btn text-white"><i class="ri-add-line align-bottom me-1"></i>Hasil Penerima Bantuan</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="datatable-wrapper table-responsive">
                                            <table id="final_result" class="display compact table table-striped table-bordered" style="width: 100%;">
                                                <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>NIK</th>
                                                    <th>Nama Penerima</th>
                                                    <th>Jumlah</th>
                                                </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="tambah_kriteria" tabindex="-1" role="dialog" aria-labelledby="defaultModal" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Data User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" enctype="multipart/form-data" action="{{route('create_user_informasi', $data_kriteria['periode']->kode_unik)}}">
                            @csrf
                            <div class="modal-body">
                                <div class="duallistbox">
                                    <select name="multiple[]" multiple id="duallistbox1">
                                        @foreach($data_calon_penerima as $items)
                                            <option value="{{$items->nik}}">{{$items->nama}}</option>
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

@section('js')
    <script>
        $(document).ready(function () {
            $('#final').on("click", function () {
                $("#final_result").DataTable({
                    scrollX: true,
                    dom: 'Bfrtip',
                    sortable: false,
                    ordering: false,
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url:'{{route('ranking', $data_kriteria['periode']->id)}}',
                    },
                    columns: [
                        {
                            "data" :null, "sortable": false,
                            "searchable":false,
                            render : function (data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1
                            }
                        },
                        { data: 'nik', name: 'nik'},
                        { data: 'nama', name: 'nama'},
                        { data: 'total', name: 'total'}
                    ]
                })
            })
        })





        $('#duallistbox1').bootstrapDualListbox({
            nonSelectedListLabel: 'Non-selected',
            selectedListLabel: 'Selected',
            preserveSelectionOnMove: 'moved',
            moveOnSelect: false
        });
    </script>
@endsection

