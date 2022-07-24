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
                            <h1>Data Penerima</h1>
                        </div>
                        <div class="ml-auto d-flex align-items-center">
                            <nav>
                                <ol class="breadcrumb p-0 m-b-0">
                                    <li class="breadcrumb-item">
                                        <a href="index.html"><i class="ti ti-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        Tables
                                    </li>
                                    <li class="breadcrumb-item active text-primary" aria-current="page">Data Table</li>
                                </ol>
                            </nav>
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
                                        <button type="button" class="btn btn-success add-btn" data-toggle="modal" data-target="#tambah_user"><i class="ri-add-line align-bottom me-1"></i>Tambah Calon Penerima</button>
                                    </div>
                                </div>
                            </div>
                            <div class="datatable-wrapper table-responsive">
                                <table id="datatable" class="display compact table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NO KK</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach($data_penerima as $items)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$items->nik}}</td>
                                            <td>{{$items->nama}}</td>
                                            <td>{{$items->alamat}}</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="javascript:void(0)" class="mr-2"><i class="fa fa-pencil" data-toggle="modal" data-target="{{__("#editpengguna".$items->id)}}"></i></a>
                                                    <a href="javascript:void(0)"><i class="fa fa-trash" data-toggle="modal" data-target="{{__("#deletepengguna".$items->id)}}"></i></a>

                                                    <div class="modal fade" id="{{__('editpengguna'.$items->id)}}" tabindex="-1" role="dialog" aria-labelledby="defaultModal" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Edit Data Penerima</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                @if(auth()->user()->role == 'Super Admin')
                                                                    <form method="POST" enctype="multipart/form-data" action="{{route("edit_penerima_admin", $items->id)}}">
                                                                @elseif(auth()->user()->role == 'Kades')
                                                                    <form method="POST" enctype="multipart/form-data" action="{{route("edit_penerima_admin-kades", $items->id)}}">
                                                                @elseif(auth()->user()->role == 'Kadus')
                                                                    <form method="POST" enctype="multipart/form-data" action="{{route("edit_penerima_admin-kadus", $items->id)}}">
                                                                @endif
                                                                    @csrf
                                                                    <div class="modal-body">
                                                                        <div class="mb-3">
                                                                            <label for="customername-field" class="form-label">NO KK</label>
                                                                            <input type="text" value="{{$items->nik}}" minlength="16" maxlength="16" name="nik" id="customername-field" class="form-control" placeholder="Masukkan NO KK" required />
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="customername-field" class="form-label">NAMA</label>
                                                                            <input type="text" value="{{$items->nama}}" name="nama" id="customername-field" class="form-control" placeholder="Masukkan NAMA" required />
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="email-field" class="form-label">ALAMAT</label>
                                                                            <input type="text" value="{{$items->alamat}}" name="alamat" id="email-field" class="form-control" placeholder="Masukkan ALAMAT" required />
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
                                                    <div class="modal fade" id="{{__('deletepengguna'.$items->id)}}" tabindex="-1" role="dialog" aria-labelledby="defaultModal" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalCenterTitle">PERINGATAN</h5>
                                                                    <a href="javascript:void(0);" class="btn-close" data-bs-dismiss="modal"></a>
                                                                </div>
                                                                <div class="modal-body" style="text-align: center;">
                                                                    <i class="fa fa-warning"
                                                                       style="font-size: 100px; color: orange"></i>
                                                                    <p>Semua data <strong>{{$items->nama}}</strong> akan dihapus!!
                                                                    </p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    @if(auth()->user()->role == 'Super Admin')
                                                                        <a href="{{route("delete_penerima_admin", $items->id)}}">
                                                                            <button type="button" class="btn btn-danger">Hapus Data</button>
                                                                        </a>
                                                                    @elseif(auth()->user()->role == 'Kades')
                                                                        <a href="{{route("delete_penerima_admin-kades", $items->id)}}">
                                                                            <button type="button" class="btn btn-danger">Hapus Data</button>
                                                                        </a>
                                                                    @elseif(auth()->user()->role == 'Kadus')
                                                                        <a href="{{route("delete_penerima_admin-kadus", $items->id)}}">
                                                                            <button type="button" class="btn btn-danger">Hapus Data</button>
                                                                        </a>
                                                                    @endif

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

            <div class="modal fade" id="tambah_user" tabindex="-1" role="dialog" aria-labelledby="defaultModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Data Penerima</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @if(auth()->user()->role == 'Super Admin')
                            <form method="POST" enctype="multipart/form-data" action="{{route("create_penerima_admin")}}">
                        @elseif(auth()->user()->role == 'Kades')
                            <form method="POST" enctype="multipart/form-data" action="{{route("create_penerima_admin-kades")}}">
                        @elseif(auth()->user()->role == 'Kadus')
                            <form method="POST" enctype="multipart/form-data" action="{{route("create_penerima_admin-kadus")}}">
                        @endif
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="customername-field" class="form-label">NO KK</label>
                                    <input type="text" name="nik" id="customername-field" minlength="16" maxlength="16" class="form-control" placeholder="Masukkan NO KK" required />
                                </div>
                                <div class="mb-3">
                                    <label for="customername-field" class="form-label">NAMA</label>
                                    <input type="text" name="nama" id="customername-field" class="form-control" placeholder="Masukkan Nama" required />
                                </div>
                                <div class="mb-3">
                                    <label for="email-field" class="form-label">ALAMAT</label>
                                    <input type="text" name="alamat" id="email-field" class="form-control" placeholder="Masukkan Alamat" required />
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

