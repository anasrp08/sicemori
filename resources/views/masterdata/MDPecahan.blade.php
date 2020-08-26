@extends('layouts.app')
{{-- @section('dashboard')
Catat Jumlah daftar_pecahan Pecahan
<small>{!! auth()->user()->name !!}</small>
@endsection --}}
<style type="text/css">
    div.container {
        width: 80%;
    }
    </style>
@section('title')
<a class="h1 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="./index.html">Master Data Pecahan</a>
@endsection
{{-- <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs/dt-1.10.18/b-1.5.6/fc-3.2.5/fh-3.1.4/r-2.2.2/sc-2.0.0/sl-1.3.0/datatables.min.css" /> --}}


@section('header')

@endsection

@include('layouts.src_datatable')

@section('content')
{{-- <div class="container-fluid mt--7"> --}}
    {{-- <div class="row"> --}}
        <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                     
                    <div class="col text-left">
                        <button type="button" name="add" id="add" class="btn btn-success "><i
                                class="fa  fa-refresh"></i>
                            Tambah Data</button>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <!-- Projects table -->
                {{-- table align-items-center table-flush --}}
                <table id="daftar_pecahan" class="table table align-items-center table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>No. </th>
                            <th>Kode Pecahan</th>
                            <th>Nama Pecahan</th>
                            <th>Max Kemas</th>  
                            <th>Action</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
        {{-- @include('daftar_pecahan.f_daftar_pecahan') --}}




    {{-- </div>  --}}
    <div class="modal fade" id="modalform" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('masterdata.f_pecahan')
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" id='deletebaris'>Delete</button>
            </div> --}}
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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

@endsection


@section('scripts')
{{-- <script type="text/javascript"
src="https://cdn.datatables.net/v/bs/dt-1.10.18/b-1.5.6/fc-3.2.5/fh-3.1.4/r-2.2.2/sc-2.0.0/sl-1.3.0/datatables.min.js">
</script> --}}
@include('layouts.srcjs_datatable')

<script>
    $(document).ready(function () {

        $('#refresh').click(function () {


            $('#daftar_pecahan').DataTable().ajax.reload();

        })
        $('#add').click(function () {
            $('#hiddentype').val('add')
            $('#modalform').modal('show')
        // $('#daftar_pecahan').DataTable().ajax.reload();

        })

        $('#daftar_pecahan').on('click', '.delete', function () {
            $('#exampleModal').modal()
            delSelectedRow($(this))
        });
        $('#daftar_pecahan').on('click', '.edit', function () {
            var idx = $(this).closest('tr').index()
            var data=table.row(idx).data()
// saveDelSelectedRow(table.row(idx).data())
            $('#hiddentype').val('edit')
            $('#id').val(data.id)
            $('#kode').val(data.kode_pecahan)
            $('#nama').val(data.nama_pecahan)
            $('#maxkemas').val(data.max_kemas)
            $('#keterangan').val(data.keterangan)
            $('#modalform').modal('show')
            // delSelectedRow($(this))
        });
        // function delSelectedRow(thisTable) {
        //     $('#deletebaris').on('click', function () {
        //         var idx = thisTable.closest('tr').index()

        //         saveDelSelectedRow(table.row(idx).data())
        //         $('#daftar_pecahan').DataTable().ajax.reload();
        //         $('#exampleModal').modal('toggle')
        //     })

        // }
       

        function delSelectedRow(thisTable) {
            $('#deletebaris').on('click', function () {
                alert('tes')
                var idx = thisTable.closest('tr').index()

                saveDelSelectedRow(table.row(idx).data())
                $('#daftar_pecahan').DataTable().ajax.reload();
                $('#exampleModal').modal('toggle')
            })

        }


        function saveDelSelectedRow(idxRowData) {
            $.ajax({
                url: "{{ route('pecahan.deletepesanan') }}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content')
                },
                data: idxRowData,
                // contentType: "json",
                // cache: false,
                // processData: false,
                // dataType: "json",
                beforeSend: function () {
                    // $('#saveentri').text('proses menyimpan...');
                },
                success: function (data) {
                    console.log(data)
                    if (data.errors) {
                        toastr.error(data.errors, 'Gagal Menghapus', {
                            timeOut: 5000
                        });
                    }
                    if (data.success) {
                        toastr.success(data.success, 'Berhasil', {
                            timeOut: 5000
                        });


                    }

                }
            })
        }
        $('#f_pecahan').on('submit', function (event) {
            event.preventDefault();
            var form = new FormData(this) 
           
            if($('#hiddentype').val()=='edit'){
                $.ajax({
                url: "{{ route('pecahan.updatedata') }}",
                method: "POST",
                data: form,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                beforeSend: function () {
                    // $('#simpan').val('menyimpan...');
                },
                success: function (data) {
                    var html = '';
                    console.log(data)
                    if (data.errors) {
                        toastr.error(data.errors, 'Gagal Disimpan', {
                            timeOut: 5000
                        });
                    }
                    if (data.success) {
                        toastr.success(data.success, 'Berhasil Di Simpan', {
                            timeOut: 5000
                        });
                        $('#daftar_pecahan').DataTable().ajax.reload();
                        // setTimeout(window.location.reload(), 3000)
                        
                        $('#f_pecahan')[0].reset();
                        $('#modalform').modal('toggle')
                        
                        // $('#form_result').html('');
                    }

                }
            }) 
            }else{
               $.ajax({
                url: "{{ route('pecahan.save') }}",
                method: "POST",
                data: form,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                beforeSend: function () {
                    // $('#simpan').val('menyimpan...');
                },
                success: function (data) {
                    var html = '';
                    console.log(data)
                    if (data.errors) {
                        toastr.error(data.errors, 'Gagal Disimpan', {
                            timeOut: 5000
                        });
                    }
                    if (data.success) {
                        toastr.success(data.success, 'Berhasil Di Simpan', {
                            timeOut: 5000
                        });
                        $('#daftar_pecahan').DataTable().ajax.reload();
                        // setTimeout(window.location.reload(), 3000)
                        
                        $('#f_pecahan')[0].reset();
                        $('#modalform').modal('toggle')
                        
                        // $('#form_result').html('');
                    }

                }
            }) 
            }
            
        }) 
        var table = $('#daftar_pecahan').DataTable({
            processing: true,
            serverSide: true,
            order: [],
            // scrollY: "300px",
            // scrollCollapse: true,
            // scrollX: true,
            // dom: 'Bfrtip',
            columnDefs: [
                // { className: 'text-right', targets: [7, 10, 11, 14, 16] },
                {
                    className: 'text-center',
                    // targets: [0, 2,3,5,6,8,9,10,11,12,13,15]
                },
                {
                    className: 'dt-body-nowrap',
                    targets: -1
                }
            ],
            buttons: [

                {
                    extend: "excelHtml5",
                    text: 'Download Excel',
                    className: 'btn btn-info',
                }


                // 'pdfHtml5'
            ],
            language: {
                emptyTable: "Tidak Ada Data daftar_pecahan"
            },
            
            ajax: {

                url: "{{ route('pecahan.daftar') }}",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: function (d) {

                    // d.val_idjadwal = idjadwal;
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'kode_pecahan',
                    name: 'kode_pecahan'
                },
                {
                    data: 'nama_pecahan',
                    name: 'nama_pecahan'
                },


                {
                    data: 'max_kemas',
                    name: 'max_kemas',

                },
                
                {
                    data: 'action',
                    name: 'action',
                    orderable: false

                },

            ],
            
        });

    })

</script>
@endsection
