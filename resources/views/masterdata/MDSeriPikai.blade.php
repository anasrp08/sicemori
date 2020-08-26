@extends('layouts.app')
@section('dashboard')
Master Seri Pita Cukai
<small>{!! auth()->user()->name !!}</small>
@endsection

@section('breadcrumb')
<li><a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Master Seri Pita Cukai</li>
@endsection

@section('content')
<section class="content-header">
  

</section>

<!-- Main content -->
<section class="content">


    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            {{-- <button type="button" name="tambahpetugas" id="tambahpetugas" class="btn btn-success ">Tambah Nama Petugas</button>
            <button type="button" name="uploadFile" id="uploadFile" class="btn btn-info ">Import File</button> --}}

        </div>
        <div class="box-body">
            <table id="seripikai" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No. </th>
                        <th>Seri Pita Cukai</th>
                        <th>Keterangan</th>
                       
                        {{-- <th width="30%">Action</th> --}}
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
                    <h4 class="modal-title">Tambah Master Data Petugas Task Force Beacukai</h4>
                </div>
                <div class="modal-body">
                        <span id="form_result"></span>
                    <form method="post" id="formnamapetugas" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="control-label col-md-4">Nama Petugas : </label>
                            <div class="col-md-8">
                                <input type="text" name="nama_petugas" id="nama_petugas" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">Nomor Pegawai : </label>
                            <div class="col-md-8">
                                <input type="text" name="np" id="np" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">Unit Kerja : </label>
                            <div class="col-md-8">
                                <input type="text" name="unit_kerja" id="unit_kerja" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                                <label class="control-label col-md-4">Instansi : </label>
                                <div class="col-md-8">
                                    <input type="text" name="instansi" id="instansi" class="form-control" />
                                </div>
                            </div>

                        <br />
                        <div class="form-group" align="center">
                            <input type="hidden" name="action" id="action" />
                            <input type="hidden" name="hidden_id" id="hidden_id" />
                            <input type="submit" name="action_button1" id="action_button1" class="btn btn-warning"
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
                            <form action="{{route('import.petugas')}}" method="post" enctype="multipart/form-data">
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
        $('#seripikai').DataTable({
            processing: true,
            serverSide: true,
            // scrollX: true,
            ajax: {
                url: "{{ route('mdseripikai.index') }}",
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'seri_gol',
                    name: 'seri_gol'
                },
                {
                    data: 'keterangan',
                    name: 'keterangan'
                },
                
                // {
                //     data: 'action',
                //     name: 'action',
                //     orderable: false
                // }
            ]
        });


        $('#tambahpetugas').click(function () {
            $('.modal-title').text("Tambah Master Data Nama Petugas Task Force");
            $('#action_button1').val("Simpan");
            $('#action').val("Add"); 
            $('#formModal').modal('show');
        }); 
        $('#uploadFile').click(function () {
          
            $('#importData').modal('show');
        }); 
       

        $('#formnamapetugas').on('submit', function (event) {
            event.preventDefault();
            if ($('#action').val() == 'Add') {
                $.ajax({
                    url: "{{ route('mdpetugas.store') }}",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    beforeSend: function () {
                        $('#action_button1').val('menyimpan...');
                    },
                    success: function (data) {
                        var html = '';
                        if (data.errors) {
                            html = '<div class="alert alert-danger">';
                            for (var count = 0; count < data.errors.length; count++) {
                                html += '<p>' + data.errors[count] + '</p>';
                            }
                            html += '</div>';
                            $('#form_result').html(html);
                        }
                        if (data.success) {
                            toastr.success('Successfully added Post!', 'Success Alert', {timeOut: 5000});
                            $('#formnamapetugas')[0].reset();
                            $('#mdpetugas').DataTable().ajax.reload();
                            $('#action_button1').val('Simpan'); 
                            
                        } 

                        $('#form_result').html(html);
                    }
                })
            }

            if ($('#action').val() == "Edit") {
                $.ajax({
                    url: "{{ route('mdpetugas.update') }}",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    beforeSend: function () {
                        $('#action_button1').val('menyimpan...');
                    },
                    success: function (data) {
                        var html = '';
                        if (data.errors) {
                            html = '<div id=error class="alert alert-danger">';
                            for (var count = 0; count < data.errors.length; count++) {
                                html += '<p>' + data.errors[count] + '</p>';
                            }
                            html += '</div>';
                            $('#action_button1').val('Edit'); 
                        }
                        if (data.success) {
                            toastr.success('Successfully added Post!', 'Success Alert', {timeOut: 5000});
                            $('#formnamapetugas')[0].reset(); 
                            $('#action_button1').val('Edit');
                            $('#mdpetugas').DataTable().ajax.reload();
                            
                            setTimeout(function () {
                                $('#formModal').modal('toggle');
                                
                            }, 1000);  
                        } 
                    }
                });
            }
        }) 
        $('body').on('click', '.edit', function () {
            
            var id = $(this).data('id');
            $.get('mdpetugas/' + id + '/edit', function (data) {
                //  $('#name-error').hide();
                //  $('#email-error').hide(); 
                $('#action').val("Edit");
                $('#action_button1').val("Edit");
                $('#formModal').modal('show');
                $('#nama_petugas').val(data.nama_petugas);
                $('#np').val(data.np); 
                $('#unit_kerja').val(data.unit_kerja);
                $('#instansi').val(data.instansi);
                $('#hidden_id').val(data.id); 
            })
        });


        //delete
        var iddel;

        $(document).on('click', '.delete', function () {

            iddel = $(this).data('id'); 
            $('#confirmModal').modal('show');
        });

        $('#ok_button').click(function () {
            $.ajax({
                url: "mdpetugas/destroy/" + iddel,
                beforeSend: function () {
                    $('#ok_button').text('Deleting...');
                },
                success: function (data) {
                    toastr.success('Successfully added Post!', 'Success Alert', {timeOut: 5000});
                    setTimeout(function () {
                        $('#ok_button').text('OK');
                        $('#confirmModal').modal('hide');
                        $('#mdpetugas').DataTable().ajax.reload();
                    }, 2000);
                }
            })
        });


    })

 

</script>
@endsection
