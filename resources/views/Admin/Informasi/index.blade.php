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
                            <h1>Informasi Penerima Bantuan</h1>
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
                                    <div class="d-flex justify-content-sm-between align-items-end">
                                        <div>
                                            <label for="versi">Filter Versi Perhitungan</label>
                                            <select class="js-basic-single form-control" name="data_versi" id="versi">
                                                <option value="" selected disabled>Pilih Versi</option>
                                                @foreach($data_skala as $items)
                                                    <option value="{{$items->kode_unik}}">{{$items->versi}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <button style="display: none;" id="btn_modal" type="button" class="btn btn-success add-btn" data-toggle="modal" data-target="#tambah_versi"><i class="ri-add-line align-bottom me-1"></i>Tambah Versi</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="datatable-wrapper table-responsive">
                                <table id="dt_versi" class="display compact table table-striped table-bordered" style="width: 100%;">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Periode</th>
                                        <th>Kuota</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
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
                        <form id="form-add">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="customername-field" class="form-label">Nama Periode</label>
                                    <input type="text" name="nama_periode" id="nama_periode" class="form-control" placeholder="Masukkan Versi" required />
                                </div>
                                <div class="mb-3">
                                    <label for="period" class="form-label">Periode</label>
                                    <input type="text" name="period" id="period" class="form-control" placeholder="Masukkan Periode" required />
                                </div>
                                <div class="mb-3">
                                    <label for="kuota" class="form-label">Kuota</label>
                                    <input type="number" min="1" name="kuota" id="kuota" class="form-control" placeholder="Masukkan Versi" required />
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" class="form-control" id="status">
                                        <option selected disabled>Pilih Status</option>
                                        <option value="1">Aktif</option>
                                        <option value="0">Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                        <div class="modal-footer">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
                                <button id="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
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
        var versi;
        var nama_periode;
        var period;
        var kuota;
        var status;

        var edit_nama_periode;
        var edit_period;
        var edit_kuota;
        var edit_status;

        $("#period").datepicker({
            format: "dd-mm-yyyy",
            viewMode: "month",
            minViewMode: "month",
            autoclose:true
        });


        $(document).ready(function () {
            $('#versi').on('change', data_versi);


            $('#submit').on('click', function () {
                nama_periode = document.getElementById('nama_periode').value;
                period = document.getElementById('period').value;
                kuota = document.getElementById('kuota').value;
                status = document.getElementById('status').value;
                $.ajax({
                    url: '{{ route('create_periode') }}',
                    type : 'POST',
                    data : {
                        'versi': versi,
                        'nama_periode': nama_periode,
                        'period' : period,
                        'kuota' : kuota,
                        'status' : status,
                        '_token' : '{{csrf_token()}}'
                    },
                    success: function (res) {
                        $('#tambah_versi').modal('hide');
                        document.getElementById("form-add").reset();
                        $('#dt_versi').DataTable().ajax.reload();
                    }
                })

            })



            function data_versi() {
                $('#dt_versi').DataTable().clear().destroy();
                versi = document.getElementById('versi').value;
                document.getElementById('btn_modal').style.display = 'block';
                console.log('in');
                $("#dt_versi").DataTable({
                    scrollX: true,
                    dom: 'Bfrtip',
                    sortable: false,
                    ordering: false,
                    processing: true,
                    serverSide: true,
                    order: [[0, 'desc']],
                    ajax: {
                        url:'{{url()->current()}}',
                        data:{
                            "versi":versi,
                        }
                    },

                    columns: [
                        {
                            "data" :null, "sortable": false,
                            "searchable":false,
                            render : function (data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1
                            }
                        },
                        { data: 'nama', name: 'nama'},
                        { data: 'periode', name: 'periode'},
                        { data: 'kuota', name: 'kuota'},
                        { data: 'data_status'},
                        { data: 'Aksi'},
                    ]
                })

            }
        })
    </script>
@endsection

