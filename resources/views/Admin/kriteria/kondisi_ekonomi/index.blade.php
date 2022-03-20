@extends("layout.main")

@section("content")
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Kondisi Ekonomi</h4>
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
                                                <th class="sort" data-sort="email">Bobot Ekonomi</th>
                                                <th class="sort" data-sort="email">Bobot Kesejahteraan</th>
                                                <th class="sort" data-sort="email">Bobot Penyakit</th>
                                                <th class="sort" data-sort="email">Bobot Usia</th>
                                                <th class="sort" data-sort="email">Bobot Kondisi Kepala Keluarga</th>
                                                <th class="sort" data-sort="action">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody class="list form-check-all">
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach($detail_data_penerima as $items)
                                                <tr>
                                                    <td class="sort" data-sort="customer_name">{{$i++}}</td>
                                                    <td>{{$items->nama}}</td>
                                                    <td>{{$items->bobot_ekonomi}}</td>
                                                    <td>{{$items->bobot_kesejahteraan}}</td>
                                                    <td>{{$items->bobot_penyakit}}</td>
                                                    <td>{{$items->bobot_usia}}</td>
                                                    <td>{{$items->bobot_k_keluarga}}</td>
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
                                                                                    <label for="autoCompleteFruit" class="form-label">Search Result of Fruit Names</label>
                                                                                    <input value="{{$items->nama}}" class="form-control" name="nama" id="autoCompleteFruit" type="text" dir="ltr" spellcheck=false autocomplete="off" autocapitalize="off" readonly>
                                                                                </div>

                                                                                <div class="mb-3">
                                                                                    <label for="kondisi-ekonomi-field" class="form-label">Kondisi Ekonomi</label>
                                                                                    <select class="form-control" data-trigger name="kondisi_ekonomi" id="kondisi-ekonomi-field" required>
                                                                                        <option value="" selected disabled>Pilih Kondisi Ekonomi</option>
                                                                                        <option value="1" {{$items->sub_ekonomi == "1" ? "selected" : ""}}><strong>Ekonomi</strong> < 1 juta</option>
                                                                                        <option value="2" {{$items->sub_ekonomi == "2" ? "selected" : ""}}>1 < <strong>Ekonomi</strong> < 1,5 juta</option>
                                                                                        <option value="3" {{$items->sub_ekonomi == "3" ? "selected" : ""}}><strong>Ekonomi</strong> > 1,5 juta</option>
                                                                                    </select>
                                                                                </div>

                                                                                <div class="mb-3">
                                                                                    <label for="Taraf-Kesejahteraan-field" class="form-label">Taraf Kesejahteraan</label>
                                                                                    <select class="form-control" data-trigger name="taraf_kesejahteraan" id="Taraf-Kesejahteraan-field" required>
                                                                                        <option value="" selected disabled>Pilih Taraf Kesejahteraan</option>
                                                                                        <option value="1" {{$items->sub_kesejahteraan == "1" ? "selected" : ""}}>Tidak Mampu</option>
                                                                                        <option value="2" {{$items->sub_kesejahteraan == "2" ? "selected" : ""}}>Mampu</option>
                                                                                        <option value="3" {{$items->sub_kesejahteraan == "3" ? "selected" : ""}}>Sangat Mampu</option>
                                                                                    </select>
                                                                                </div>

                                                                                <div class="mb-3">
                                                                                    <label for="Penderita-Penyakit-field-field" class="form-label">Penderita Penyakit Kronis</label>
                                                                                    <select class="form-control" data-trigger name="penderita_penyakit" id="Penderita-Penyakit-field" required>
                                                                                        <option value="" selected disabled>Pilih Status</option>
                                                                                        <option value="1" {{$items->sub_penyakit == "1" ? "selected" : ""}}>Tidak Parah</option>
                                                                                        <option value="2" {{$items->sub_penyakit == "2" ? "selected" : ""}}>Parah</option>
                                                                                    </select>
                                                                                </div>

                                                                                <div class="mb-3">
                                                                                    <label for="usia-field" class="form-label">Usia</label>
                                                                                    <select class="form-control" data-trigger name="usia" id="usia-field" required>
                                                                                        <option value="" selected disabled>Pilih Usia</option>
                                                                                        <option value="Dewasa" {{$items->sub_usia == "Dewasa" ? "selected" : ""}}>Dewasa</option>
                                                                                        <option value="Lansia" {{$items->sub_usia == "Lansia" ? "selected" : ""}}>Lansia</option>
                                                                                        <option value="Manula" {{$items->sub_usia == "Manula" ? "selected" : ""}}>Manula</option>
                                                                                    </select>
                                                                                </div>

                                                                                <div class="mb-3">
                                                                                    <label for="kepala-keluarga-field" class="form-label">Kondisi Kepala Keluarga</label>
                                                                                    <select class="form-control" data-trigger name="kepala_keluarga" id="kepala-keluarga-field" required>
                                                                                        <option value="" selected disabled>Pilih Kondisi Ekonomi</option>
                                                                                        <option value="Mampu Bekerja" {{$items->sub_k_keluarga == "Mampu Bekerja" ? "selected" : ""}}>Mampu Bekerja</option>
                                                                                        <option value="Tidak Mampu Bekerja" {{$items->sub_k_keluarga == "Tidak Mampu Bekerja" ? "selected" : ""}}>Tidak Mampu Bekerja</option>
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
                            <form method="POST" enctype="multipart/form-data" action="{{route("create_kriteria_admin")}}">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="autoCompleteFruit" class="form-label">Search Result of Fruit Names</label>
                                        <input class="form-control" name="nama" id="autoCompleteFruit" type="text" dir="ltr" spellcheck=false autocomplete="off" autocapitalize="off" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="kondisi-ekonomi-field" class="form-label">Kondisi Ekonomi</label>
                                        <select class="form-control" data-trigger name="kondisi_ekonomi" id="kondisi-ekonomi-field" required>
                                            <option value="" selected disabled>Pilih Kondisi Ekonomi</option>
                                            <option value="1"><strong>Ekonomi</strong> < 1 juta</option>
                                            <option value="2">1 < <strong>Ekonomi</strong> < 1,5 juta</option>
                                            <option value="3"><strong>Ekonomi</strong> > 1,5 juta</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="Taraf-Kesejahteraan-field" class="form-label">Taraf Kesejahteraan</label>
                                        <select class="form-control" data-trigger name="taraf_kesejahteraan" id="Taraf-Kesejahteraan-field" required>
                                            <option value="" selected disabled>Pilih Taraf Kesejahteraan</option>
                                            <option value="1">Tidak Mampu</option>
                                            <option value="2">Mampu</option>
                                            <option value="3">Sangat Mampu</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="Penderita-Penyakit-field-field" class="form-label">Penderita Penyakit Kronis</label>
                                        <select class="form-control" data-trigger name="penderita_penyakit" id="Penderita-Penyakit-field" required>
                                            <option value="" selected disabled>Pilih Status</option>
                                            <option value="1">Tidak Parah</option>
                                            <option value="2">Parah</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="usia-field" class="form-label">Usia</label>
                                        <select class="form-control" data-trigger name="usia" id="usia-field" required>
                                            <option value="" selected disabled>Pilih Usia</option>
                                            <option value="Dewasa">Dewasa</option>
                                            <option value="Lansia">Lansia</option>
                                            <option value="Manula">Manula</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="kepala-keluarga-field" class="form-label">Kondisi Kepala Keluarga</label>
                                        <select class="form-control" data-trigger name="kepala_keluarga" id="kepala-keluarga-field" required>
                                            <option value="" selected disabled>Pilih Kondisi Ekonomi</option>
                                            <option value="Mampu Bekerja">Mampu Bekerja</option>
                                            <option value="Tidak Mampu Bekerja">Tidak Mampu Bekerja</option>
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

    <!-- multi.js -->
    <script src="{{asset("assets/libs/multi.js/multi.min.js")}}"></script>
    <!-- autocomplete js -->
    <script src="{{asset("assets/libs/%40tarekraafat/autocomplete.js/autoComplete.min.js")}}"></script>

    <!-- init js -->
    <script>
        $(document).ready(function () {
            var data_calon = @json($data);
            console.log(data_calon);
            var autoCompleteFruit = new autoComplete({
                selector: "#autoCompleteFruit",
                placeHolder: "Masukkan Nama Calon Penerima",
                data: {
                    src: data_calon,
                    cache: !0
                },
                resultsList: {
                    element: function (e, t) {
                        var l;
                        t.results.length || ((l = document.createElement("div")).setAttribute("class", "no_result"), l.innerHTML = '<span>Found No Results for "' + t.query + '"</span>', e.prepend(l))
                    }, noResults: !0
                },
                resultItem: {highlight: !0},
                events: {
                    input: {
                        selection: function (e) {
                            e = e.detail.selection.value;
                            autoCompleteFruit.input.value = e
                        }
                    }
                }
            })
        })


    </script>
    <!-- input spin init -->
    <script src="{{asset("assets/js/pages/form-input-spin.init.js")}}"></script>
@endsection
