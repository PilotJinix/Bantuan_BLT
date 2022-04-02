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
                            <h1>Daftar Kriteria Periode Tahun {{date_format(date_create($data_periode->created_at), "Y")}}</h1>
                        </div>
                    </div>
                    <!-- end page title -->
                </div>
            </div>
            <!-- end row -->
            <!-- begin row -->
            <div class="row tabs-contant">
                <div class="col-xxl-12">
                    <div class="card card-statistics">
                        <div class="card-header d-block d-flex justify-content-between">
                            <div class="card-heading">
                                <h4 class="card-title">Daftar Kriteria</h4>
                            </div>
                            <div class="row g-4 mb-3">
                                <div class="col-sm">
                                    <div class="d-flex justify-content-sm-end">
                                        <button type="button" class="btn btn-success add-btn" data-toggle="modal" data-target="#tambah_kriteria"><i class="ri-add-line align-bottom me-1"></i>Tambah Kriteria</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="tab nav-border-bottom">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active show" id="home-02-tab" data-toggle="tab" href="#kondisi_ekonomi" role="tab" aria-controls="home-02" aria-selected="true">Kondisi Ekonomi</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-02-tab" data-toggle="tab" href="#taraf_kesejahteraan" role="tab" aria-controls="profile-02" aria-selected="false">Taraf Kesejahteraan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="portfolio-02-tab" data-toggle="tab" href="#penderita_penyakit_kronis" role="tab" aria-controls="portfolio-02" aria-selected="false">Penderita Penyakit Kronis</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="contact-02-tab" data-toggle="tab" href="#usia" role="tab" aria-controls="contact-02" aria-selected="false">Usia</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="contact-02-tab" data-toggle="tab" href="#kondisi_kepala_keluarga" role="tab" aria-controls="contact-02" aria-selected="false">Kondisi Kepala Keluarga</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade py-3 active show" id="kondisi_ekonomi" role="tabpanel" aria-labelledby="home-02-tab">
                                        <!-- begin row -->
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card card-statistics">
                                                    <div class="card-body">

                                                        <div class="datatable-wrapper table-responsive">
                                                            <table id="datatable_ke" class="display compact table table-striped table-bordered">
                                                                <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Keterangan</th>
                                                                    <th>Bobot</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @php
                                                                    $i = 1;
                                                                @endphp
                                                                @foreach($data_ke as $items)
                                                                    <tr>
                                                                        <td>{{$i++}}</td>
                                                                        <td>{{$items->keterangan}}</td>
                                                                        <td>{{$items->bobot}}</td>
                                                                        <td>
                                                                            <div class="d-flex gap-2">
                                                                                <a href="javascript:void(0)" class="mr-2"><i class="fa fa-pencil" data-toggle="modal" data-target="{{__("#editpengguna".$items->id)}}"></i></a>
                                                                                <a href="javascript:void(0)"><i class="fa fa-trash" data-toggle="modal" data-target="{{__("#deletepengguna".$items->id)}}"></i></a>

                                                                                <div class="modal fade" id="{{__('editpengguna'.$items->id)}}" tabindex="-1" role="dialog" aria-labelledby="defaultModal" aria-hidden="true">
                                                                                    <div class="modal-dialog" role="document">
                                                                                        <div class="modal-content">
                                                                                            <div class="modal-header">
                                                                                                <h5 class="modal-title">Edit Data User</h5>
                                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                    <span aria-hidden="true">&times;</span>
                                                                                                </button>
                                                                                            </div>
                                                                                            <form method="POST" enctype="multipart/form-data" action="{{route("update_kriteria_admin", $items->id)}}">
                                                                                                @csrf
                                                                                                <div class="modal-body">
                                                                                                    <div class="mb-3">
                                                                                                        <label for="customername-field" class="form-label">Keterangan</label>
                                                                                                        <input type="text" value="{{$items->keterangan}}" name="keterangan" id="customername-field" class="form-control" placeholder="Masukkan Keterangan" required />
                                                                                                    </div>
                                                                                                    <div class="mb-3">
                                                                                                        <label for="customername-field" class="form-label">Bobot</label>
                                                                                                        <input type="number" value="{{$items->bobot}}" min="1" name="bobot" id="customername-field" maxlength="16" class="form-control" placeholder="Masukkan Bobot" required />
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
                                                                                                    <p>Data dengan keterangan <strong>{{$items->keterangan}}</strong> akan dihapus!!</p>
                                                                                                </div>

                                                                                            </div>
                                                                                            <div class="modal-footer">
                                                                                                <a href="{{route("delete_kriteria_admin", $items->id)}}">
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
                                    </div>
                                    <div class="tab-pane fade py-3" id="taraf_kesejahteraan" role="tabpanel" aria-labelledby="profile-02-tab">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card card-statistics">
                                                    <div class="card-body">

                                                        <div class="datatable-wrapper table-responsive">
                                                            <table id="datatable_tk" class="display compact table table-striped table-bordered">
                                                                <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Keterangan</th>
                                                                    <th>Bobot</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @php
                                                                    $i = 1;
                                                                @endphp
                                                                @foreach($data_tk as $items_tk)
                                                                    <tr>
                                                                        <td>{{$i++}}</td>
                                                                        <td>{{$items_tk->keterangan}}</td>
                                                                        <td>{{$items_tk->bobot}}</td>
                                                                        <td>
                                                                            <div class="d-flex gap-2">
                                                                                <a href="javascript:void(0)" class="mr-2"><i class="fa fa-pencil" data-toggle="modal" data-target="{{__("#editpengguna".$items_tk->id)}}"></i></a>
                                                                                <a href="javascript:void(0)"><i class="fa fa-trash" data-toggle="modal" data-target="{{__("#deletepengguna".$items_tk->id)}}"></i></a>

                                                                                <div class="modal fade" id="{{__('editpengguna'.$items_tk->id)}}" tabindex="-1" role="dialog" aria-labelledby="defaultModal" aria-hidden="true">
                                                                                    <div class="modal-dialog" role="document">
                                                                                        <div class="modal-content">
                                                                                            <div class="modal-header">
                                                                                                <h5 class="modal-title">Edit Data User</h5>
                                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                    <span aria-hidden="true">&times;</span>
                                                                                                </button>
                                                                                            </div>
                                                                                            <form method="POST" enctype="multipart/form-data" action="{{route("update_kriteria_admin", $items_tk->id)}}">
                                                                                                @csrf
                                                                                                <div class="modal-body">
                                                                                                    <div class="mb-3">
                                                                                                        <label for="customername-field" class="form-label">Keterangan</label>
                                                                                                        <input type="text" value="{{$items_tk->keterangan}}" name="keterangan" id="customername-field" class="form-control" placeholder="Masukkan Keterangan" required />
                                                                                                    </div>
                                                                                                    <div class="mb-3">
                                                                                                        <label for="customername-field" class="form-label">Bobot</label>
                                                                                                        <input type="number" value="{{$items_tk->bobot}}" min="1" name="bobot" id="customername-field" maxlength="16" class="form-control" placeholder="Masukkan Bobot" required />
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
                                                                                <div class="modal fade" id="{{__('deletepengguna'.$items_tk->id)}}" tabindex="-1" role="dialog" aria-labelledby="defaultModal" aria-hidden="true">
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
                                                                                                    <p>Data dengan keterangan <strong>{{$items_tk->keterangan}}</strong> akan dihapus!!</p>
                                                                                                </div>

                                                                                            </div>
                                                                                            <div class="modal-footer">
                                                                                                <a href="{{route("delete_kriteria_admin", $items_tk->id)}}">
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
                                    </div>
                                    <div class="tab-pane fade py-3" id="penderita_penyakit_kronis" role="tabpanel" aria-labelledby="portfolio-02-tab">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card card-statistics">
                                                    <div class="card-body">

                                                        <div class="datatable-wrapper table-responsive">
                                                            <table id="datatable_ppk" class="display compact table table-striped table-bordered">
                                                                <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Keterangan</th>
                                                                    <th>Bobot</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @php
                                                                    $i = 1;
                                                                @endphp
                                                                @foreach($data_ppk as $items_ppk)
                                                                    <tr>
                                                                        <td>{{$i++}}</td>
                                                                        <td>{{$items_ppk->keterangan}}</td>
                                                                        <td>{{$items_ppk->bobot}}</td>
                                                                        <td>
                                                                            <div class="d-flex gap-2">
                                                                                <a href="javascript:void(0)" class="mr-2"><i class="fa fa-pencil" data-toggle="modal" data-target="{{__("#editpengguna".$items_ppk->id)}}"></i></a>
                                                                                <a href="javascript:void(0)"><i class="fa fa-trash" data-toggle="modal" data-target="{{__("#deletepengguna".$items_ppk->id)}}"></i></a>

                                                                                <div class="modal fade" id="{{__('editpengguna'.$items_ppk->id)}}" tabindex="-1" role="dialog" aria-labelledby="defaultModal" aria-hidden="true">
                                                                                    <div class="modal-dialog" role="document">
                                                                                        <div class="modal-content">
                                                                                            <div class="modal-header">
                                                                                                <h5 class="modal-title">Edit Data User</h5>
                                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                    <span aria-hidden="true">&times;</span>
                                                                                                </button>
                                                                                            </div>
                                                                                            <form method="POST" enctype="multipart/form-data" action="{{route("update_kriteria_admin", $items_ppk->id)}}">
                                                                                                @csrf
                                                                                                <div class="modal-body">
                                                                                                    <div class="mb-3">
                                                                                                        <label for="customername-field" class="form-label">Keterangan</label>
                                                                                                        <input type="text" value="{{$items_ppk->keterangan}}" name="keterangan" id="customername-field" class="form-control" placeholder="Masukkan Keterangan" required />
                                                                                                    </div>
                                                                                                    <div class="mb-3">
                                                                                                        <label for="customername-field" class="form-label">Bobot</label>
                                                                                                        <input type="number" value="{{$items_ppk->bobot}}" min="1" name="bobot" id="customername-field" maxlength="16" class="form-control" placeholder="Masukkan Bobot" required />
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
                                                                                <div class="modal fade" id="{{__('deletepengguna'.$items_ppk->id)}}" tabindex="-1" role="dialog" aria-labelledby="defaultModal" aria-hidden="true">
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
                                                                                                    <p>Data dengan keterangan <strong>{{$items_ppk->keterangan}}</strong> akan dihapus!!</p>
                                                                                                </div>

                                                                                            </div>
                                                                                            <div class="modal-footer">
                                                                                                <a href="{{route("delete_kriteria_admin", $items_ppk->id)}}">
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
                                    </div>
                                    <div class="tab-pane fade py-3" id="usia" role="tabpanel" aria-labelledby="contact-02-tab">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card card-statistics">
                                                    <div class="card-body">

                                                        <div class="datatable-wrapper table-responsive">
                                                            <table id="datatable_usia" class="display compact table table-striped table-bordered">
                                                                <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Keterangan</th>
                                                                    <th>Bobot</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @php
                                                                    $i = 1;
                                                                @endphp
                                                                @foreach($data_u as $items_u)
                                                                    <tr>
                                                                        <td>{{$i++}}</td>
                                                                        <td>{{$items_u->keterangan}}</td>
                                                                        <td>{{$items_u->bobot}}</td>
                                                                        <td>
                                                                            <div class="d-flex gap-2">
                                                                                <a href="javascript:void(0)" class="mr-2"><i class="fa fa-pencil" data-toggle="modal" data-target="{{__("#editpengguna".$items_u->id)}}"></i></a>
                                                                                <a href="javascript:void(0)"><i class="fa fa-trash" data-toggle="modal" data-target="{{__("#deletepengguna".$items_u->id)}}"></i></a>

                                                                                <div class="modal fade" id="{{__('editpengguna'.$items_u->id)}}" tabindex="-1" role="dialog" aria-labelledby="defaultModal" aria-hidden="true">
                                                                                    <div class="modal-dialog" role="document">
                                                                                        <div class="modal-content">
                                                                                            <div class="modal-header">
                                                                                                <h5 class="modal-title">Edit Data User</h5>
                                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                    <span aria-hidden="true">&times;</span>
                                                                                                </button>
                                                                                            </div>
                                                                                            <form method="POST" enctype="multipart/form-data" action="{{route("update_kriteria_admin", $items_u->id)}}">
                                                                                                @csrf
                                                                                                <div class="modal-body">
                                                                                                    <div class="mb-3">
                                                                                                        <label for="customername-field" class="form-label">Keterangan</label>
                                                                                                        <input type="text" value="{$items_u->keterangan}}" name="keterangan" id="customername-field" class="form-control" placeholder="Masukkan Keterangan" required />
                                                                                                    </div>
                                                                                                    <div class="mb-3">
                                                                                                        <label for="customername-field" class="form-label">Bobot</label>
                                                                                                        <input type="number" value="{{$items_u->bobot}}" min="1" name="bobot" id="customername-field" maxlength="16" class="form-control" placeholder="Masukkan Bobot" required />
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
                                                                                <div class="modal fade" id="{{__('deletepengguna'.$items_u->id)}}" tabindex="-1" role="dialog" aria-labelledby="defaultModal" aria-hidden="true">
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
                                                                                                    <p>Data dengan keterangan <strong>{{$items_u->keterangan}}</strong> akan dihapus!!</p>
                                                                                                </div>

                                                                                            </div>
                                                                                            <div class="modal-footer">
                                                                                                <a href="{{route("delete_kriteria_admin", $items_u->id)}}">
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
                                    </div>
                                    <div class="tab-pane fade py-3" id="kondisi_kepala_keluarga" role="tabpanel" aria-labelledby="contact-02-tab">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card card-statistics">
                                                    <div class="card-body">

                                                        <div class="datatable-wrapper table-responsive">
                                                            <table id="datatable_kkk" class="display compact table table-striped table-bordered">
                                                                <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Keterangan</th>
                                                                    <th>Bobot</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @php
                                                                    $i = 1;
                                                                @endphp
                                                                @foreach($data_kkk as $items_kkk)
                                                                    <tr>
                                                                        <td>{{$i++}}</td>
                                                                        <td>{{$items_kkk->keterangan}}</td>
                                                                        <td>{{$items_kkk->bobot}}</td>
                                                                        <td>
                                                                            <div class="d-flex gap-2">
                                                                                <a href="javascript:void(0)" class="mr-2"><i class="fa fa-pencil" data-toggle="modal" data-target="{{__("#editpengguna".$items_kkk->id)}}"></i></a>
                                                                                <a href="javascript:void(0)"><i class="fa fa-trash" data-toggle="modal" data-target="{{__("#deletepengguna".$items_kkk->id)}}"></i></a>

                                                                                <div class="modal fade" id="{{__('editpengguna'.$items_kkk->id)}}" tabindex="-1" role="dialog" aria-labelledby="defaultModal" aria-hidden="true">
                                                                                    <div class="modal-dialog" role="document">
                                                                                        <div class="modal-content">
                                                                                            <div class="modal-header">
                                                                                                <h5 class="modal-title">Edit Data User</h5>
                                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                    <span aria-hidden="true">&times;</span>
                                                                                                </button>
                                                                                            </div>
                                                                                            <form method="POST" enctype="multipart/form-data" action="{{route("update_kriteria_admin", $items_kkk->id)}}">
                                                                                                @csrf
                                                                                                <div class="modal-body">
                                                                                                    <div class="mb-3">
                                                                                                        <label for="customername-field" class="form-label">Keterangan</label>
                                                                                                        <input type="text" value="{{$items_kkk->keterangan}}" name="keterangan" id="customername-field" class="form-control" placeholder="Masukkan Keterangan" required />
                                                                                                    </div>
                                                                                                    <div class="mb-3">
                                                                                                        <label for="customername-field" class="form-label">Bobot</label>
                                                                                                        <input type="number" value="{{$items_kkk->bobot}}" min="1" name="bobot" id="customername-field" maxlength="16" class="form-control" placeholder="Masukkan Bobot" required />
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
                                                                                <div class="modal fade" id="{{__('deletepengguna'.$items_kkk->id)}}" tabindex="-1" role="dialog" aria-labelledby="defaultModal" aria-hidden="true">
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
                                                                                                    <p>Data dengan keterangan <strong>{{$items_kkk->keterangan}}</strong> akan dihapus!!</p>
                                                                                                </div>

                                                                                            </div>
                                                                                            <div class="modal-footer">
                                                                                                <a href="{{route("delete_kriteria_admin", $items_kkk->id)}}">
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="tambah_kriteria" tabindex="-1" role="dialog" aria-labelledby="defaultModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Data Kriteria</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" enctype="multipart/form-data" action="{{route("create_kriteria_admin", $data_periode->kode_unik)}}">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="kondisi-ekonomi-field" class="form-label">Pilih Kriteria</label>
                                    <select class="form-control" data-trigger name="kriteria" id="kondisi-ekonomi-field" required>
                                        <option value="" selected disabled>Pilih Kriteria</option>
                                        <option value="KE">Kondisi Ekonomi</option>
                                        <option value="TK">Taraf Kesejahteraan</option>
                                        <option value="PPK">Penderita Penyakit Kronis</option>
                                        <option value="U">Usia</option>
                                        <option value="KKK">Kondisi Kepala Keluarga</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="customername-field" class="form-label">Keterangan</label>
                                    <input type="text" name="keterangan" id="customername-field" class="form-control" placeholder="Masukkan Keterangan" required />
                                </div>
                                <div class="mb-3">
                                    <label for="customername-field" class="form-label">Bobot</label>
                                    <input type="number" min="1" name="bobot" id="customername-field" maxlength="16" class="form-control" placeholder="Masukkan Bobot" required />
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


