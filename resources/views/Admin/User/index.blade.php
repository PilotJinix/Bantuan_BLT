@extends("layout.main")
@section("content")
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Daftar Pengguna</h4>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <div id="customerList">
                                    <div class="row g-4 mb-3">
                                        <div class="col-sm">
                                            <div class="d-flex justify-content-sm-end">
                                                <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i>Tambah Pengguna</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="table-responsive table-card m-3">
                                        <table class="table align-middle table-nowrap" id="customerTable">
                                            <thead class="table-light">
                                            <tr>
                                                <th class="sort" data-sort="customer_name">No</th>
                                                <th class="sort" data-sort="customer_name">Nama</th>
                                                <th class="sort" data-sort="email">Username</th>
                                                <th class="sort" data-sort="phone">No Telepon</th>
                                                <th class="sort" data-sort="status">Role</th>
                                                <th class="sort" data-sort="action">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody class="list form-check-all">
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
                                                            <div class="edit">
                                                                <button class="btn btn-sm btn-success edit-item-btn"
                                                                        data-bs-toggle="modal" data-bs-target="{{__("#editpengguna".$items->id)}}">Edit</button>
                                                            </div>
                                                            <div class="modal fade" id="{{__('editpengguna'.$items->id)}}" tabindex="-1" aria-labelledby="exampleModalLabel"
                                                                 aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header bg-light p-3">
                                                                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                                                                    id="close-modal"></button>
                                                                        </div>
                                                                        <form method="POST" enctype="multipart/form-data" action="{{route("update_user_admin", $items->id)}}">
                                                                            @csrf
                                                                            <div class="modal-body">
                                                                                <div class="mb-3">
                                                                                    <label for="customername-field" class="form-label">Nama Pengguna</label>
                                                                                    <input type="text" value="{{$items->nama}}" name="nama_pengguna" id="customername-field" class="form-control" placeholder="Masukkan Nama" required />
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label for="customername-field" class="form-label">NIK</label>
                                                                                    <input type="text" value="{{$items->nik}}" name="nik" id="customername-field" minlength="16" maxlength="16" class="form-control" placeholder="Masukkan NIK" required />
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
                                                                                <div class="hstack gap-2 justify-content-end">
                                                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Kembali</button>
                                                                                    <button type="submit" class="btn btn-success">Submit</button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="remove">
                                                                <button class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal" data-bs-target="{{__("#deletepengguna".$items->id)}}">Hapus</button>
                                                            </div>
                                                            <div class="modal fade" id={{__('deletepengguna'.$items->id)}} tabindex="-1" role="dialog"
                                                                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalCenterTitle">PERINGATAN</h5>
                                                                            <a href="javascript:void(0);" class="btn-close" data-bs-dismiss="modal"></a>
                                                                        </div>
                                                                        <div class="modal-body text-sm-start">
                                                                            <i class="fa fa-warning"
                                                                               style="font-size: 100px; color: orange"></i>
                                                                            <p>Semua data <strong>{{$items->nama}}</strong> akan dihapus!!
                                                                            </p>
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
                                        <div class="noresult" style="display: none">
                                            <div class="text-center">
                                                <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                                           colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px">
                                                </lord-icon>
                                                <h5 class="mt-2">Sorry! No Result Found</h5>
                                                <p class="text-muted mb-0">We've searched more than 150+ Orders We did not find any
                                                    orders for you search.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <div class="pagination-wrap hstack gap-2">
                                            <a class="page-item pagination-prev disabled" href="#">
                                                Previous
                                            </a>
                                            <ul class="pagination listjs-pagination mb-0"></ul>
                                            <a class="page-item pagination-next" href="#">
                                                Next
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
                <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-light p-3">
                                <h5 class="modal-title" id="exampleModalLabel"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                        id="close-modal"></button>
                            </div>
                            <form method="POST" enctype="multipart/form-data" action="{{route("create_user_admin")}}">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="customername-field" class="form-label">Nama Pengguna</label>
                                        <input type="text" name="nama_pengguna" id="customername-field" class="form-control" placeholder="Masukkan Nama" required />
                                    </div>
                                    <div class="mb-3">
                                        <label for="customername-field" class="form-label">NIK</label>
                                        <input type="text" name="nik" id="customername-field" minlength="16" maxlength="16" class="form-control" placeholder="Masukkan NIK" required />
                                    </div>
                                    <div class="mb-3">
                                        <label for="email-field" class="form-label">Username</label>
                                        <input type="text" name="username" id="email-field" class="form-control" placeholder="Masukkan Email" required />
                                    </div>

                                    <div class="mb-3">
                                        <label for="phone-field" class="form-label">Nomer Telepon</label>
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
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Kembali</button>
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>document.write(new Date().getFullYear())</script> © Velzon.
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">
                            Design & Develop by Themesbrand
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
@endsection

@section("js")
    <!-- prismjs plugin -->
    <script src="{{asset("assets/libs/prismjs/prism.js")}}"></script>
    <script src="{{asset("assets/libs/list.js/list.min.js")}}"></script>
    <script src="{{asset("assets/libs/list.pagination.js/list.pagination.min.js")}}"></script>

    <!-- listjs init -->
    <script src="{{asset("assets/js/pages/listjs.init.js")}}"></script>
@endsection
