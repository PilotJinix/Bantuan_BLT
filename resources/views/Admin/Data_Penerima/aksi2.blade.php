{{--{{$row->id}}--}}
<div class="d-flex gap-2">

        @if($model->is_hasil == '1')
            <a href= "#" class='btn btn-outline-warning btn-sm detail mr-2' title='Edit Data' data-toggle="modal" data-target="{{__("#editpengguna".$model->id)}}"><i class='fas fa fa-pencil'></i></a>
            <div class="modal fade" id="{{__('editpengguna'.$model->id)}}" tabindex="-1" role="dialog" aria-labelledby="defaultModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Data Penerima</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" enctype="multipart/form-data" action="{{auth()->user()->role == 'Super Admin' ? route("edit_user_hasil", $model->kode_unik) : (auth()->user()->role == 'Kadus' ? route("edit_user_hasil-kadus", $model->kode_unik) : route("edit_user_hasil-kades", $model->kode_unik))}}">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="customername-field" class="form-label">Nama Penerima</label>
                                    <input type="text" value="{{$model->nama}}" name="nama_kriteria" id="customername-field" class="form-control" placeholder="Masukkan Kriteria" disabled/>
                                </div>
                                <div class="mb-3">
                                    <label for="customername-field" class="form-label">NO KK</label>
                                    <input type="text" value="{{$model->kode_penerima}}" name="nama_kode" id="customername-field" class="form-control" placeholder="Masukkan Kode" disabled/>
                                </div>
                                @foreach($data_kriteria['kriteria'] as $data)
                                    <div class="mb-3">
                                        <label for="status" class="form-label">{{$data->nama_kriteria}}</label>
                                        <select name="status[]" class="form-control" id="status">
                                            <option selected disabled>Pilih Jawaban</option>
                                            @foreach($data_kriteria['sub_kriteria'] as $data_sub)
                                                @if($data->kode_unik == $data_sub -> kode_unik_kriteria )
                                                    @foreach($data_pengajuan_edit as $edit)
                                                        @if($data->kode_unik == $edit-> kriteria and $edit->kode_pengajuan == $model->kode_unik)
                                                            <option value="{{$data_sub->kode_unik.':'.$edit->id}}" {{$data_sub -> kode_unik == $edit->jawaban?'selected':''}}>{{$data_sub->nama_sub_kriteria}}</option>
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
            <a href="javascript:void(0)" class="btn btn-outline-primary btn-sm detail mr-2" title='Input Data' data-toggle="modal" data-target="{{__("#insertpengguna".$model->id)}}"><i class="fa fa-pencil-square-o"></i></a>
            <div class="modal fade" id="{{__('insertpengguna'.$model->id)}}" tabindex="-1" role="dialog" aria-labelledby="defaultModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Input Data Penerima</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" enctype="multipart/form-data" action="{{auth()->user()->role == 'Super Admin' ? route("create_user_hasil", $model->kode_unik) : (auth()->user()->role == 'Kadus' ? route("create_user_hasil-kadus", $model->kode_unik) : route("create_user_hasil-kades", $model->kode_unik))}}">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="customername-field" class="form-label">Nama Penerima</label>
                                    <input type="text" value="{{$model->nama}}" name="nama_kriteria" id="customername-field" class="form-control" placeholder="Masukkan Kriteria" disabled/>
                                </div>
                                <div class="mb-3">
                                    <label for="customername-field" class="form-label">NO KK</label>
                                    <input type="text" value="{{$model->kode_penerima}}" name="nama_kode" id="customername-field" class="form-control" placeholder="Masukkan Kode" disabled/>
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
        <a href="javascript:void(0)" class="btn btn-outline-danger btn-sm delete mr-2" title='Delete Data' data-toggle="modal" data-target="{{__("#deletepengguna".$model->id)}}"><i class="fa fa-trash" ></i></a>
        <div class="modal fade" id="{{__('deletepengguna'.$model->id)}}" tabindex="-1" role="dialog" aria-labelledby="defaultModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">PERINGATAN</h5>
                        <a href="javascript:void(0);" class="btn-close" data-bs-dismiss="modal"></a>
                    </div>
                    <div class="modal-body" style="text-align: center;">
                        <i class="fa fa-warning"
                           style="font-size: 100px; color: orange"></i>
                        <p>Semua data <strong>{{$model->nama}}</strong> akan dihapus!!
                        </p>
                    </div>
                    <div class="modal-footer">
                        @if(auth()->user()->role == 'Super Admin')
                            <a href="{{route("delete_user_penerima", $model->id)}}">
                                <button type="button" class="btn btn-danger">Hapus Data</button>
                            </a>
                        @elseif(auth()->user()->role == 'Kades')
                            <a href="{{route("delete_user_penerima-kades", $model->id)}}">
                                <button type="button" class="btn btn-danger">Hapus Data</button>
                            </a>
                        @elseif(auth()->user()->role == 'Kadus')
                            <a href="{{route("delete_user_penerima-kadus", $model->id)}}">
                                <button type="button" class="btn btn-danger">Hapus Data</button>
                            </a>
                        @endif

                    </div>
                </div>
            </div>
        </div>
</div>
