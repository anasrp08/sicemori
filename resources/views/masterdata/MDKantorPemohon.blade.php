@extends('layouts.app')
@section('dashboard')
Master Data Kantor Pemohon
<small>{!! auth()->user()->name !!}</small>
@endsection

@section('breadcrumb')
<li><a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Master Data Kantor Pemohon</li>
@endsection

@section('content')
<section class="content-header">
    <h1>
        List Master Data Kantor Pemohon Uji Pita Cukai
        <!-- <small>Monitor Pengujian Pita Cukai</small> -->
    </h1>

</section>

<!-- Main content -->
<section class="content">


    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <button type="button" name="tambahkanwil" id="tambahkanwil" class="btn btn-success ">Tambah Kanwil</button>
            <button type="button" name="uploadFile" id="uploadFile" class="btn btn-info ">Import File</button>

        </div>
        <div class="box-body">
            <table id="mdkanwil" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Nama Kantor</th>
                        <th>Wilayah Kantor</th>
                        <th>Provinsi</th>
                        <th width="30%">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>


    <!-- modal -->
    <div id="formModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Tambah Master Data Kanwil</h4>
                </div>
                <div class="modal-body">
                    {{-- <span id="form_result"></span> --}}
                    <div class="alert alert-success" id="success-alert">
                            <button type="button" class="close" data-dismiss="alert">x</button>
                            <strong>Success! </strong> Product have added to your wishlist.
                          </div>
                    <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="control-label col-md-4">Nama Kanwil : </label>
                            <div class="col-md-8">
                                <input type="text" name="nama_kanwil" id="nama_kanwil" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">Wilayah Kanwil : </label>
                            <div class="col-md-8">
                                <input type="text" name="wilayah" id="wilayah" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">Provinsi : </label>
                            <div class="col-md-8">
                                <input type="text" name="provinsi" id="provinsi" class="form-control" />
                            </div>
                        </div>

                        <br />
                        <div class="form-group" align="center">
                            <input type="hidden" name="action" id="action" />
                            <input type="hidden" name="hidden_id" id="hidden_id" />
                            <input type="submit" name="action_button" id="action_button" class="btn btn-warning"
                                value="Add" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="confirmModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2 class="modal-title">Confirmation</h2>
                </div>
                <div class="modal-body">
                    <h4 align="center" style="margin:0;">Are you sure you want to remove this data?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <div id="importData" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h2 class="modal-title">Import Data Excell</h2>
                    </div>
                    <div class="modal-body">
                            <form action="{{route('import.kantor')}}" method="post" enctype="multipart/form-data">
                                @csrf

                            @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-success">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="">File (.xls, .xlsx)</label>
                                <input type="file" class="form-control" name="file">
                                <p class="text-danger">{{ $errors->first('file') }}</p>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-sm">Upload</button>
                            </div>
                    </div>
                    {{-- <div class="modal-footer">
                        <button type="button" name="ok_button" id="ok_button" class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div> --}}
                </div>
            </div>
        </div>

    

</section>

@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        // var SITEURL = '{{URL::to('')}}';
        $('#mdkanwil').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('mdkantor.index') }}",
            },
            columns: [{
                    data: 'nama_kanwil',
                    name: 'nama_kanwil'
                },
                {
                    data: 'wilayah',
                    name: 'wilayah'
                },
                {
                    data: 'provinsi',
                    name: 'provinsi'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                }
            ]
        });


        $('#tambahkanwil').click(function () {
            $('.modal-title').text("Tambah Master Data Kanwil");
            $('#action_button').val("Simpan");
            $('#action').val("Add");
            $("#success-alert").hide();
            $('#formModal').modal('show');
        }); 

        $('#uploadFile').click(function () {
          
          $('#importData').modal('show');
      }); 
        


        $('#sample_form').on('submit', function (event) {
            event.preventDefault();
            if ($('#action').val() == 'Add') {
                $.ajax({
                    url: "{{ route('mdkantor.store') }}",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    beforeSend: function () {
                        $('#action_button').val('menyimpan...');
                    },
                    success: function (data) {
                        var html = '';
                        if (data.errors) {
                            html = '<div class="alert alert-danger">';
                            for (var count = 0; count < data.errors.length; count++) {
                                html += '<p>' + data.errors[count] + '</p>';
                            }
                            html += '</div>';
                        }
                        if (data.success) {
                            toastr.success('Data Berhasil Di Simpan', 'Success Alert', {timeOut: 5000});
                            $('#sample_form')[0].reset();
                            $('#mdkanwil').DataTable().ajax.reload();
                            $('#action_button').val('Simpan');
                            // showAlert()
                            
                        }
                       

                        // $('#form_result').html(html);
                    }
                })
            }

            if ($('#action').val() == "Edit") {
                $.ajax({
                    url: "{{ route('mdkantor.update') }}",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    beforeSend: function () {
                        $('#action_button').val('menyimpan...');
                    },
                    success: function (data) {
                        var html = '';
                        if (data.errors) {
                            html = '<div id=error class="alert alert-danger">';
                            for (var count = 0; count < data.errors.length; count++) {
                                html += '<p>' + data.errors[count] + '</p>';
                            }
                            html += '</div>';
                            $('#action_button').val('Edit');
                            $('#action_button').val('Edit');
                        }
                        if (data.success) {
                            toastr.success('Data Berhasil Di Simpan', 'Success Alert', {timeOut: 5000});
                            $('#sample_form')[0].reset(); 
                            $('#action_button').val('Edit');
                            $('#mdkanwil').DataTable().ajax.reload();
                           
                            setTimeout(function () {
                                $('#formModal').modal('toggle');
                                
                            }, 1000);  
                        } 
                    }
                });
            }
        }) 
        $('body').on('click', '.edit', function () {
            $("#success-alert").hide();
            var id = $(this).data('id');
            $.get('mdkantor/' + id + '/edit', function (data) {
                //  $('#name-error').hide();
                //  $('#email-error').hide();
                $('#userCrudModal').html("Edit User");
                $('#action').val("Edit");
                $('#action_button').val("Edit");
                $('#formModal').modal('show');
                $('#nama_kanwil').val(data.nama_kanwil);
                $('#wilayah').val(data.wilayah);
                $('#provinsi').val(data.provinsi);
                $('#hidden_id').val(data.id); 
            })
        });


        //delete
        var user_id;

        $(document).on('click', '.delete', function () {
            user_id = $(this).data('id');
            $("#success-alert").hide();
            $('#confirmModal').modal('show');
        });

        $('#ok_button').click(function () {
            $.ajax({
                url: "mdkantor/destroy/" + user_id,
                beforeSend: function () {
                    $('#ok_button').text('Deleting...');
                },
                success: function (data) {
                    toastr.success('Data Berhasil Di Hapus', 'Success Alert', {timeOut: 5000});
                    setTimeout(function () {
                        $('#ok_button').text('OK');
                        $('#confirmModal').modal('hide');
                        $('#mdkanwil').DataTable().ajax.reload();
                    }, 2000);
                }
            })
        });


    })


    // push('head') 
    // script src="{{ asset('/js/taskforce.js')}}">
    //script>
    //endpush 

</script>
@endsection
