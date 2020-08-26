@extends('layouts.app')
@section('dashboard')
Master Data User
<small>{!! auth()->user()->name !!}</small>
@endsection

@section('breadcrumb')
<li><a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Master Data User</li>
@endsection

@section('content')
<section class="content-header">
    {{-- <h1>
        List Master Data User
        <!-- <small>Monitor Pengujian Pita Cukai</small> -->
    </h1> --}}

</section>

<!-- Main content -->
<section class="content">


    <!-- Default box -->
    <div class="box box-primary box-solid">
        <div class="box-header with-border">
            <button type="button" name="tambahuser" id="tambahuser" class="btn btn-success"><i class="fa  fa-plus-circle"></i> Tambah User</button>
            {{-- <button type="button" name="uploadFile" id="uploadFile" class="btn btn-info ">Import File User</button> --}}

        </div>
        <div class="box-body">
            <table id="tbluser" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Avatar</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Instansi</th>
                        <th>Role</th>
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
                    <h4 class="modal-title">Tambah User</h4>
                </div>
                <div class="modal-body">
                    <span id="form_result"></span>

                    <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="control-label col-md-4">Nama User : </label>
                            <div class="col-md-8">
                                <input type="text" name="name" id="name" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">Email : </label>
                            <div class="col-md-8">
                                <input type="text" name="email" id="email" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">Password : </label>

                            <div class="col-md-8">
                                    <div class="input-group" id="show_hide_password">
                                            <input class="form-control" type="password" name="password" id="password">
                                            <div class="input-group-btn">
                                              <button  class="btn btn-default" type="button"><i class="fa fa-eye-slash" aria-hidden="true"></i></button>
                                            </div>
                                          </div>
                                    {{-- <div class="input-group">
                                            <input type="password"  name="password" id="password" class="form-control pwd">
                                            <span class="input-group-btn">
                                              <button class="btn btn-default reveal" type="button"><i class="glyphicon glyphicon-eye-open"></i></button>
                                            </span>          
                                          </div> --}}
                                {{-- <input type="text" name="password" id="password" class="form-control" /> --}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">Instansi : </label>
                            <div class="col-md-8">
                                    <select name="instansi" id="instansi" class="form-control select2" style="width: 100%;">
                                            <option selected="selected">Pilih Salah Satu</option>
                                            <option value="Peruri">Peruri</option>
                                            <option value="PT. Pura Nusapersada">PT. Pura Nusapersada</option>
                                            <option value="PT. Kertas Padalarang">PT. Kertas Padalarang</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Beacukai">Beacukai</option>
                                    </select>
                             
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">Role : </label>
                            <div class="col-md-8">
                            <select name="roles" id="roles" class="form-control select2" style="width: 100%;">
                                    <option selected>-Pilih Role-</option>
                                    @foreach($roles as $data)
                                    <option value="{{$data->display_name}}">{{$data->display_name}}</option>
                                    @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="form-group"> 
                            <label class="control-label col-md-4">Upload Foto : </label> 
                                <div class="col-md-8">
                                <input type="file" name="avatar" id="avatar" class="form-control" />
                            </div>
                                {{-- <p class="help-block">file surat perintah</p> --}}
                             
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
        $("#show_hide_password button").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password input').attr("type") == "text"){
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass( "fa-eye-slash" );
            $('#show_hide_password i').removeClass( "fa-eye" );
        }else if($('#show_hide_password input').attr("type") == "password"){
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass( "fa-eye-slash" );
            $('#show_hide_password i').addClass( "fa-eye" );
        }
    });
 
// });
        // var SITEURL = '{{URL::to('')}}';
       var tableUser= $('#tbluser').DataTable({
            processing: true,
            serverSide: true,
            scrollCollapse: true,
            scrollX: true,
            ajax: {
                url: "{{ route('user.index') }}",
            },
           
            columns: [{
                    data: 'avatar',
                    name: 'avatar',
                    render: function (data, type, row) {
                        // console.log(data) 
                        // console.log(row.filekantor)
                        if (row.avatar == null || row.avatar == "") {
                            // return '<span class="label label-info">Lihat File</span>'
                            return '<span class="label bg-maroon"> Tidak Ada foto</span>'
                            // 12333.pdf
                        } else {
                            return '<img class="profile-user-img img-responsive img-circle" src ="{{ asset("/img")}}' + '/' + row.avatar +
                                '" style="width:128px; height:129;">'
                            // {{ asset('/img/avatar.pdf') }}data-target="#pdfModal" /file/123123/123123.pdf
                        }
                    }
                },

                {
                    data: 'name',
                    name: 'name'
                    
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'instansi',
                    name: 'instansi'
                },
                {
                    data: 'roles',
                    name: 'roles'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                }
            ]
        });


        $('#tambahuser').click(function () {
            $('.modal-title').text("Tambah User");
            $('#action_button').val("Simpan");
            $('#action').val("Add");
            $("#success-alert").hide();
            $('#formModal').modal('show');
        });

        $('#formModal').on('hidden.bs.modal', function () { 
            $('#sample_form')[0].reset();
        })

        $('body').on('click', '.edit', function () {
            $("#success-alert").hide();
            var id = $(this).data('id');
            var data = tableUser.row($(this).closest('tr')).data();
            console.log(data)
            $('#userCrudModal').html("Edit User");
            $('#action').val("Edit");
            $('#action_button').val("Edit");
                $('#formModal').modal('show');
                $('#name').val(data.name);
                $('#email').val(data.email); 
                $('#instansi').val(data.instansi).change() 
                // $('.roles').find('option[value='+data.roles+']').prop('selected',true).trigger('change');
                // $('#instansi').attr('value',  data.instansi);
              
                $('#roles').val(data.roles).trigger('change')
                // .attr('disabled', true);
                // $("#roles").selectmenu("refresh");   
                // $('#role').val(data.roles);

                $('#hidden_id').val(data.id);
            
        });

        $('#uploadFile').click(function () {

            $('#importData').modal('show');
        });



        $('#sample_form').on('submit', function (event) {
            event.preventDefault();
            console.log(new FormData(this))
            if ($('#action').val() == 'Add') {
                $.ajax({
                    url: "{{ route('user.store') }}",
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
                            toastr.success('Data Berhasil Di Simpan', 'Success Alert', {
                                timeOut: 5000
                            });
                            $('#sample_form')[0].reset();
                            $('#tbluser').DataTable().ajax.reload();
                            $('#action_button').val('Simpan');
                            // showAlert()

                        }


                        // $('#form_result').html(html);
                    }
                })
            }

            if ($('#action').val() == "Edit") {
                $.ajax({
                    url: "{{ route('user.update') }}",
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
                            toastr.success('Data Berhasil Di Simpan', 'Success Alert', {
                                timeOut: 5000
                            });
                            $('#sample_form')[0].reset();
                            $('#action_button').val('Edit');
                            $('#tbluser').DataTable().ajax.reload();

                            setTimeout(function () {
                                $('#formModal').modal('toggle');

                            }, 1000);
                        }
                    }
                });
            }
        })



        //delete
        var user_id;

        $(document).on('click', '.delete', function () {
            user_id = $(this).data('id');
            $("#success-alert").hide();
            $('#confirmModal').modal('show');
        });

        $('#ok_button').click(function () {
            $.ajax({
                url: "user/destroy/" + user_id,
                beforeSend: function () {
                    $('#ok_button').text('Deleting...');
                },
                success: function (data) {
                    toastr.success('Data Berhasil Di Hapus', 'Success Alert', {
                        timeOut: 5000
                    });
                    setTimeout(function () {
                        $('#ok_button').text('OK');
                        $('#confirmModal').modal('hide');
                        $('#tbluser').DataTable().ajax.reload();
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