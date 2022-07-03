{{--<a href= "{{route("index_kriteria", $model->kode_unik)}}" class='btn btn-outline-primary btn-sm detail mr-2' title='Detail'><i class='fas fa fa-eye'></i></a>--}}
{{--<a href="javascript:void(0)" class="btn btn-outline-warning btn-sm detail mr-2" data-toggle="modal" data-target="{{__("#editpengguna".$model->id)}}"><i class="fa fa-pencil"></i></a>--}}
{{--<a href="javascript:void(0)" class="btn btn-outline-danger btn-sm delete mr-2" data-toggle="modal" data-target="{{__("#deletepengguna".$model->id)}}"><i class="fa fa-trash" ></i></a>--}}
@if($model->status == 1)
    <a href="{{route('index_user')}}" class="btn btn-outline-success btn-sm detail mr-2" title="Input Data Penerima"><i class="fa fa-user-circle-o"></i></a>
@endif
<a href="#" class="btn btn-outline-warning btn-sm detail mr-2" data-toggle="modal" data-target="{{__("#editpengguna".$model->id)}}" title="Edit Periode"><i class="fa fa-pencil"></i></a>
<a href="#" class="btn btn-outline-danger btn-sm detail mr-2" data-toggle="modal" data-target="{{__("#deletepengguna".$model->id)}}" title="Delete Periode"><i class="fa fa-trash"></i></a>

<div class="modal fade" id="{{__('editpengguna'.$model->id)}}" tabindex="-1" role="dialog" aria-labelledby="defaultModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Periode</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="edit_form" method="POST" action="{{route('edit_periode', $model->id)}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="customername-field" class="form-label">Nama Periode</label>
                        <input type="text" value="{{$model->nama}}" name="edit_nama_periode" id="edit_nama_periode" class="form-control" placeholder="Masukkan Versi" required />
                    </div>
                    <div class="mb-3">
                        <label for="edit_period" class="form-label">Periode</label>
                        <input type="text" name="edit_period" id="edit_period" class="form-control" value="{{date_format(date_create($model->periode), 'd-m-Y')}}" required />
                    </div>
                    <div class="mb-3">
                        <label for="kuota" class="form-label">Kuota</label>
                        <input type="number" value="{{$model->kuota}}" min="1" name="edit_kuota" id="edit_kuota" class="form-control" placeholder="Masukkan Versi" required />
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="edit_status" class="form-control" id="edit_status">
                            <option selected disabled>Pilih Status</option>
                            <option {{$model -> status == 1 ? "selected" : ""}} value="1">Aktif</option>
                            <option {{$model -> status == 0 ? "selected" : ""}} value="0">Tidak Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" >Kembali</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="{{__('deletepengguna'.$model->id)}}" tabindex="-1" role="dialog" aria-labelledby="defaultModal" aria-hidden="true">
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
                    <p>Semua data <strong>{{$model->nama}}</strong> akan dihapus!!</p>
                </div>

            </div>
            <div class="modal-footer">
                <a href="{{route("delete_periode", $model->id)}}">
                    <button type="button" class="btn btn-danger">Hapus Data</button>
                </a>
            </div>
        </div>
    </div>
</div>
<script>


    $("#edit_period").datepicker({
        format: "dd-mm-yyyy",
        viewMode: "month",
        minViewMode: "month",
        autoclose:true
    });

</script>

