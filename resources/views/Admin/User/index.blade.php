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
                            <h1>Kelola User</h1>
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
                                        <button type="button" class="btn btn-success add-btn" data-toggle="modal" data-target="#tambah_user"><i class="ri-add-line align-bottom me-1"></i>Tambah Pengguna</button>
                                    </div>
                                </div>
                            </div>
                            <div class="datatable-wrapper table-responsive">
                                <table id="datatable" class="display compact table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>No Telepon</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach($data_user as $items)
                                        <tr>
                                            <td class="sort" data-sort="customer_name">{{$i++}}</td>
                                            <td class="customer_name">{{$items->nama}}</td>
                                            <td class="email">{{$items->username}}</td>
                                            <td class="phone">{{$items->no_hp}}</td>
                                            <td class="status">
                                                @if($items->role == "Admin")
                                                    <span class="badge badge-soft-success text-uppercase">Admin</span>
                                                @elseif($items->role == "Kades")
                                                    <span class="badge badge-soft-secondary text-uppercase">Kepala Desa</span>
                                                @elseif($items->role == "Kadus")
                                                    <span class="badge badge-soft-warning text-uppercase">Kepala Dusun</span>
                                                @elseif($items->role == "Super Admin")
                                                    <span class="badge badge-soft-primary text-uppercase">Super Admin</span>
                                                @endif

                                            </td>
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
                                                                <form method="POST" enctype="multipart/form-data" action="{{route("update_user_admin", $items->id)}}">
                                                                    @csrf
                                                                    <div class="modal-body">
                                                                        <div class="mb-3">
                                                                            <label for="customername-field" class="form-label">Nama Pengguna</label>
                                                                            <input type="text" value="{{$items->nama}}" name="nama_pengguna" id="customername-field" class="form-control" placeholder="Masukkan Nama" required />
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="customername-field" class="form-label">NO KK</label>
                                                                            <input type="text" value="{{$items->nik}}" name="nik" id="customername-field" minlength="16" maxlength="16" class="form-control" placeholder="Masukkan NO KK" required />
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="email-field" class="form-label">Username</label>
                                                                            <input type="text" value="{{$items->username}}" name="username" id="email-field" class="form-control" placeholder="Masukkan Email" required />
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label for="phone-field" class="form-label">Nomer Telepon</label>
                                                                            <input type="text" value="{{$items->no_hp}}" name="no_hp" id="phone-field" minlength="11" maxlength="12" class="form-control"  placeholder="Masukkan Nomer" required />
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label for="date-field" class="form-label">Kata Sandi(Isi jika ingin mengubah)</label>
                                                                            <input type="text" name="sandi" id="date-field" class="form-control" placeholder="Masukkan Kata Sandi" />
                                                                        </div>

                                                                        <div>
                                                                            <label for="status-field" class="form-label">Role</label>
                                                                            <select class="form-control" data-trigger name="role" id="status-field">
                                                                                <option value="" disabled>Status</option>
                                                                                <option value="Admin" {{$items->role == "Admin" ? "selected" : ""}}>Admin</option>
                                                                                <option value="Kades" {{$items->role == "Kades" ? "selected" : ""}}>Kepala Desa</option>
                                                                                <option value="Kadus" {{$items->role == "Kadus" ? "selected" : ""}}>Kepala Dusun</option>
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
                                                                    <a href="{{route("delete_user_admin", $items->id)}}">
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
            <div class="modal fade" id="tambah_user" tabindex="-1" role="dialog" aria-labelledby="defaultModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Data User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" enctype="multipart/form-data" action="{{route("create_user_admin")}}">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="customername-field" class="form-label">Nama Pengguna</label>
                                    <input type="text" name="nama_pengguna" id="customername-field" class="form-control" placeholder="Masukkan Nama" required />
                                </div>
                                <div class="mb-3">
                                    <label for="customername-field" class="form-label">NO KK</label>
                                    <input type="text" name="nik" id="customername-field" minlength="16" maxlength="16" class="form-control" placeholder="Masukkan NO KK" required />
                                </div>
                                <div class="mb-3">
                                    <label for="email-field" class="form-label">Username</label>
                                    <input type="text" name="username" id="email-field" class="form-control" placeholder="Masukkan Email" required />
                                </div>

                                <div class="mb-3">
                                    <label for="phone-field" class="form-lsabel">Nomer Telepon</label>
                                    <input type="text" name="no_hp" id="phone-field" minlength="11" maxlength="12" class="form-control"  placeholder="Masukkan Nomer" required />
                                </div>

                                <div class="mb-3">
                                    <label for="date-field" class="form-label">Kata Sandi</label>
                                    <input type="text" name="sandi" id="date-field" class="form-control" placeholder="Masukkan Kata Sandi" required />
                                </div>

                                <div>
                                    <label for="status-field" class="form-label">Role</label>
                                    <select class="form-control" data-trigger name="role" id="status-field" >
                                        <option value="" selected disabled>Status</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Kades">Kepala Desa</option>
                                        <option value="Kadus">Kepala Dusun</option>
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

