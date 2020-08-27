@extends('layouts.app')
{{-- @section('dashboard')
Catat Jumlah Pesanan Pecahan
<small>{!! auth()->user()->name !!}</small>
@endsection --}}
@section('title')
<a class="h1 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="./index.html">Lihat Pesanan</a>
@endsection
{{-- <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs/dt-1.10.18/b-1.5.6/fc-3.2.5/fh-3.1.4/r-2.2.2/sc-2.0.0/sl-1.3.0/datatables.min.css" /> --}}


@section('header')

@endsection

@include('layouts.src_datatable')

@section('content')
<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <button type="button" name="tambahuser" id="tambahuser" class="btn btn-success "><i
                        class="fa  fa-refresh"></i>
                    Tambah User</button>

            </div>
            <div class="col text-right">
                <button type="button" name="refresh" id="refresh" class="btn btn-success "><i
                        class="fa  fa-refresh"></i>
                    Refresh</button>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <!-- Projects table -->
        {{-- table align-items-center table-flush --}}
        <table id="tbluser" class="table table-bordered table-striped" style="widht:100%;">
            <thead>
                <tr>
                    <th>Avatar</th>
                    <th>Nama</th>
                    <th>NP</th>
                    <th>Email</th>
                    <th>Instansi</th>
                    <th>Role</th>
                    <th width="30%">Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Baris</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda Yakin Menghapus Baris Ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" id='deletebaris'>Delete</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="control-label">Nama User : </label>
                        <div>
                            <input type="text" name="name" id="name" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Email : </label>
                        <div>
                            <input type="text" name="email" id="email" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">NP : </label>
                        <div>
                            <input type="text" name="np" id="np" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Password : </label>

                        <div>
                            <div class="input-group" id="show_hide_password">
                                <input class="form-control" type="password" name="password" id="password">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="button"><i class="fa fa-eye-slash"
                                            aria-hidden="true"></i></button>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Role : </label>
                        <div>

                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline1" name="customRadioInline1"
                                    class="custom-control-input" value="{{$roles[0]->display_name}}">
                                <label class="custom-control-label" for="customRadioInline1"
                                    value="{{$roles[0]->display_name}}">{{$roles[0]->display_name}}</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline2" name="customRadioInline1"
                                    class="custom-control-input" value="{{$roles[1]->display_name}}">
                                <label class="custom-control-label" for="customRadioInline2"
                                    value="{{$roles[1]->display_name}}">{{$roles[1]->display_name}}</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline3" name="customRadioInline1"
                                    class="custom-control-input" value="{{$roles[2]->display_name}}">
                                <label class="custom-control-label"
                                    for="customRadioInline3">{{$roles[2]->display_name}}</label>
                            </div>

                            {{-- <select name="roles" id="roles" class="select2 form-control"  >
                                <option selected>-Pilih Role-</option>
                               
                                @foreach($roles as $data) 
                                <option value="{{$data->display_name}}">{{$data->display_name}}</option>
                            @endforeach
                            </select> --}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label ">Upload Foto : </label>
                        <div>
                            <input type="file" name="avatar" id="avatar" class="form-control" />
                        </div>
                        {{-- <p class="help-block">file surat perintah</p> --}}

                    </div>

                    <br />
                    <div class="form-group" align="center">
                        <input type="hidden" name="action" id="action" />
                        <input type="hidden" name="hidden_id" id="hidden_id" />
                        {{-- <button id="submit" type="submit" class="btn btn-success">Simpan</button> --}}
                        <input type="submit" name="action_button" id="action_button" class="btn btn-warning"
                            value="Add" />
                    </div>
                </form>

            </div>

        </div>
        {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" id='deletebaris'>Delete</button>
            </div> --}}
    </div>
</div>


@endsection



@section('scripts')
@include('layouts.srcjs_datatable')
<script>
    $(document).ready(function () {
        $('.select2').select2()
        $("#show_hide_password button").on('click', function (event) {
            event.preventDefault();
            if ($('#show_hide_password input').attr("type") == "text") {
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass("fa-eye-slash");
                $('#show_hide_password i').removeClass("fa-eye");
            } else if ($('#show_hide_password input').attr("type") == "password") {
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass("fa-eye-slash");
                $('#show_hide_password i').addClass("fa-eye");
            }
        });



        var valRadio = null;
        $("input[name='customRadioInline1']").change(function () {
            valRadio = $(this).val()
            console.log(valRadio)

        });

        // });
        // var SITEURL = '{{URL::to('')}}';
        var tableUser = $('#tbluser').DataTable({
            processing: true,
            serverSide: true,
            // scrollCollapse: true,
            // scrollX: true,
            ajax: {

                url: "{{ route('mduser.daftar') }}",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: function (d) {

                    // d.val_idjadwal = idjadwal;
                }
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
                            return '<img class="profile-user-img img-responsive img-circle" src ="{{ asset("/img")}}' +
                                '/' + row.avatar +
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
                    data: 'np',
                    name: 'np'

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
            $('#np').val(data.np);
            $('#instansi').val(data.instansi).change()
            if(data.roles=='Admin'){
                $("#customRadioInline1").prop('checked', true);
                $("input[name='gender']:checked"). val();
            }else if(data.roles=='Candal'){
                $("#customRadioInline2").prop('checked', true);

            }else{
                $("#customRadioInline3").prop('checked', true);

            }
            
            $('#roles').val(data.roles).trigger('change')
            
            $('#hidden_id').val(data.id);

        });

        $('#uploadFile').click(function () {

            $('#importData').modal('show');
        });



        $('#sample_form').on('submit', function (event) {
            event.preventDefault();
            // console.log(valRadio)
            var formdata = new FormData(this)
            formdata.append('roles', valRadio)

            if ($('#action').val() == 'Add') {
                $.ajax({
                    url: "{{ route('mduser.save') }}",
                    method: "POST",
                    data: formdata,
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
                    url: "{{ route('mduser.updatedata') }}",
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

        $('#deletebaris').click(function () {
            $.ajax({
                url: "/mduser/destroy/" + user_id,
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
