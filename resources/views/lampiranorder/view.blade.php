@extends('layouts.app')
@section('title')
<a class="h1 mb-0 text-white text-uppercase text-center d-none d-lg-inline-block" href="./index.html">Lihat Order 1
    Lot</a>
@endsection
<style type="text/css">
    td {
        white-space: nowrap;
    }

    td.wrapok {
        white-space: normal
    }

    .table th {
        text-align: center;
    }

    .dataTables_wrapper .dataTables_length {
        float: left;
        margin-top: 10px;
    }

    .dataTables_wrapper .dataTables_filter {
        float: right;
        text-align: left;
        margin-top: 10px;
    }

    .blue-square-container {
        text-align: center;
    }

    h3 {
        text-align: center;
    }

    .dt-buttons {
        margin-left: 2rem;
        margin-bottom: 1rem;
    }

    .insiet {
        background-color: #0040ff4f !important;
    }
    .orderrilis {
        background-color: #d80202a8 !important;
    }
    .insietslected {
        background-color: #0275d8 !important;
    }

    .select2-container--default .select2-selection--single {

        height: 3rem !important;
    }

</style>
@include('layouts.src_datatable')

@section('header')

<div class="container-fluid">
    <div class="header-body">
        <!-- Card stats -->
        <div class="card bg-secondary shadow">


            <div class="card-body">
                @include('lampiranorder.f_copy')
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container-fluid mt--7">
    <div class="row">
        <div class="card shadow" style="width: 100%;">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        {{-- <h3 class="mb-0">Lampiran Order 1 Lot</h3> --}}
                    </div>
                    {{-- <div class="col text-right">
                        @include('lampiranorder.f_copy')
                       
                    </div> --}}

                </div>

            </div>

            <div class="table-responsive">
                <table id="tblorder" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th></th>
                            <th>No.</th>
                            <th>No. Order</th>
                            <th>SERI</th>
                            <th>NOMOR</th>
                            <th>PEMASOK</th>
                            <th>NO. BA</th>
                            <th>TANGGAL</th>
                            <th>JUMLAH KERTAS (Lbr)</th>
                            <th>INVOICE</th>
                            <th>KET.</th>
                            <th>LOT - BI</th> 
                            <th>LINI</th> 
                            <th>REVISI KE-</th>
                            <th>NOMOR PEGAWAI</th>
                            <th>CATATAN</th>
                            <th>STATUS</th> 
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            {{-- <th></th> --}}
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th style="text-align:right">Total:</th>
                            <th id="sumrow"></th> 
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
@include('layouts.srcjs_datatable')
<script>
    $(document).ready(function () {
        var idpesanan = '<?php echo $idpesanan ?>'
        var nolampiran = '<?php echo $nolampiran ?>'
        var pecahan = '<?php echo $pecahan ?>'
        var ta = '<?php echo $ta?>'
        var url = '{{ route("lampiranorder.view",[":idpesanan",":no_lampiran",":pecahan",":ta"])}}';
        url = url.replace(":idpesanan", idpesanan);
        url = url.replace(":no_lampiran", nolampiran);
        url = url.replace(":pecahan", pecahan);
        url = url.replace(":ta", ta);
        $('#pemasok').show()
        $('[data-mask]').inputmask()

        $('#check').on('click', function () {
            var jmlh_kertas = parseFloat($('#maxkertas').val())
            var insit_persen = parseFloat($('#insit_persen').val())
            var jmlh_insit = (jmlh_kertas * insit_persen) / 100
            $('#jmlinsit').text(parseFloat(jmlh_insit).toString().replace(/\B(?=(\d{3})+(?!\d))/g,
                ",") + ' Lembar')
        })

        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true,
            todayHighlight: true
        })
        $('#pilihan').change(function () {
            var value = this.value;
            console.log(value)
            switch (value) {
                case 'pemasok':
                    $('#pemasok').show()
                    hideComponent(['nopemasok', 'tgl', 'tanggal', 'jmlh_kertas', 'invoice',
                        'keterangan', 'lot_bi','status','lini','np'
                    ])
                    break;
                case 'no_ba':
                    $('#no_ba').show()
                    hideComponent(['pemasok', 'tgl', 'tanggal', 'jmlh_kertas', 'invoice', 'keterangan',
                        'lot_bi','status','lini','np'
                    ])
                    break;
                case 'tanggal':
                    $('#tgl').show()
                    $('#tanggal').show()
                    hideComponent(['pemasok', 'no_ba', 'jmlh_kertas', 'invoice', 'keterangan',
                        'lot_bi','status','lini','np'
                    ])
                    break;
                case 'jmlh_kertas':
                    $('#jmlh_kertas').show()
                    hideComponent(['pemasok', 'no_ba', 'tanggal', 'tgl', 'invoice', 'keterangan',
                        'lot_bi','status','lini','np'
                    ])
                    break;
                case 'invoice':
                    $('#invoice').show()
                    hideComponent(['pemasok', 'no_ba', 'jmlh_kertas', 'tanggal', 'tgl', 'keterangan',
                        'lot_bi','status','lini','np'
                    ])
                    break;
                case 'keterangan':
                    $('#keterangan').show()
                    hideComponent(['pemasok', 'no_ba', 'invoice', 'tanggal', 'tgl', 'jmlh_kertas',
                        'lot_bi','status','lini','np'
                    ])
                    break;
                case 'lot_bi':
                    $('#lot_bi').show()
                    hideComponent(['pemasok', 'no_ba', 'keterangan', 'invoice', 'tanggal', 'tgl',
                        'jmlh_kertas','status','lini','np'
                    ])
                    break;
                    case 'status':
                        // consoel
                    $('#status').show()
                    // console.log('tes')
                    hideComponent(['pemasok', 'no_ba', 'keterangan', 'invoice', 'tanggal', 'tgl',
                        'jmlh_kertas','lini','np'
                    ])
                    break;
                    case 'lini':
                    $('#lini').show()
                    hideComponent(['pemasok', 'no_ba', 'keterangan', 'invoice', 'tanggal', 'tgl',
                        'jmlh_kertas','status','np'
                    ])
                    break;
                    case 'np':
                    $('#np').show()
                    hideComponent(['pemasok', 'no_ba', 'keterangan', 'invoice', 'tanggal', 'tgl',
                        'jmlh_kertas','status','lini'
                    ])
                    break;
                default:
            }

        })

       
        var table = $('#tblorder').DataTable({
            
            iDisplayLength: 100,
            ordering: false,
            // order: [
            //     [1, "desc"]
            // ],
            // select: true,
            searchable: false,
            dom: '<"right"B>rti<"clear">',
            buttons: [{
                    text: 'Simpan',
                    className: 'btn btn-success',
                    action: function (e, dt, node, config) {
                        var output = [];
                        var jsonData = {}
                        var id = []
                        var nomor_order = []
                        var status = []
                        var dataSelected = []
  
                        var data = table.rows('.selected').data()
                        // console.log(data.status)
                        for (i = 0; i < data.count(); i++) {
                            if(data[i].status == 2 || data[i].status == 4){
                                toastr.warning('Ada Order Yang Sudah Rilis / Selesai', 'Warning', {
                                        timeOut: 5000
                                    });
                                    
                                break;
                            }else{
                                dataSelected.push(data[i])
                            }
                            
                        }


                        $(".selected").each(function (value, index) {
                            var obj = {};

                            // obj.nomor_order = $(":input[name=nomor_order]", this).val();
                            // obj.seri = $(":input[name=seri]", this).val();
                            obj.pemasok = $(":input[name=pemasok]", this).val();
                            obj.no_ba = $(":input[name=no_ba]", this).val();
                            obj.tanggal = setFormat($(":input[name=tanggal]", this)
                                .val())
                            obj.jmlh_kertas = $(":input[name=jmlh_kertas]", this).val();
                            obj.invoice = $(":input[name=invoice]", this).val();
                            obj.keterangan = $(":input[name=keterangan]", this).val();
                            obj.lot_bi = $(":input[name=lot_bi]", this).val();
                            obj.status = $("select[name=status]", this).val();
                            obj.lini = $("select[name=lini]", this).val(); 
                            obj.np = $("select[name=np]", this).val(); 
                            obj.catatan = $(":input[name=catatan]", this).val();
                            obj.update = "";
                            output.push(obj);
                            jsonData["Order"] = output 

                        })


                        for (var i = 0; i < jsonData["Order"].length; i++) {
                            var obj = jsonData["Order"][i];
                            obj.id = dataSelected[i].id
                            obj.idpesanan = dataSelected[i].idpesanan
                            obj.pecahan = dataSelected[i].pecahan
                            obj.nomor = dataSelected[i].nomor
                            obj.ta = dataSelected[i].ta
                            obj.tahun_emisi = dataSelected[i].tahun_emisi
                            obj.no_lampiran = dataSelected[i].no_lampiran
                            obj.nomor_order = dataSelected[i].nomor_order
                            obj.seri = dataSelected[i].seri
                            obj.level = dataSelected[i].level
                            
                           
                                if (obj.status == '3') {
                                
                                obj.update = "update"
                                obj.revisi = parseInt(dataSelected[i].revisi) + 1
                            }else{
                                obj.revisi = dataSelected[i].revisi
                            }
                             


                           
                             
                        }
                        // console.log(jsonData)

                        $.ajax({
                            url: "{{ route('lampiranorder.store') }}",
                            method: "POST",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content')
                            },
                            data: JSON.stringify(jsonData),
                            contentType: "json",
                            cache: false,
                            processData: false,
                            dataType: "json",
                            beforeSend: function () {
                                $('#saveentri').text('proses menyimpan...');
                            },
                            success: function (data) {
                                console.log(data)
                                if (data.errors) {
                                    toastr.success(data.errors, 'Success', {
                                        timeOut: 5000
                                    });
                                }
                                if (data.success) {
                                    toastr.success(data.success, 'Success', {
                                        timeOut: 5000
                                    });
                                    $('#counterentries').text(data.count);

                                    $('#saveentri').text('Simpan');
                                    // $('#tblorder').DataTable().ajax.reload();
                                    renderTgl()

                                }

                            }
                        })

                    }


                },
                {
                    extend: "selectAll",
                    text: 'Pilih Semua',
                    className: 'btn btn-default',
                },
                {
                    extend: 'selectNone',
                    text: 'Batal Pilih Semua',
                    className: 'btn btn-default',
                },
                // {
                //     text: 'Reload Table',
                //     className: 'btn btn-secondary ',
                //     action: function (e, dt, node, config) {
                //         $('#tblorder').DataTable().ajax.reload();
                //     }
                // }
                // {

                //     text: '<h4 style="color:white"><i class="fa fa-save bg-white"></i>  get selected</h4>',
                //     className: 'btn-info btn-sm',
                //     action: function (e, dt, node, config) {
                //         var dataSelected = []
                //         var data = table.rows('.selected').data()
                //         for (i = 0; i < data.count(); i++) {
                //             dataSelected.push(data[i])
                //         } 
                //     }
                // },
            ],


            scrollCollapse: true,
            scrollX: true,
            autoFill: {
                keys: true,
                horizontal: false
            },
            //     fixedColumns:   {
            //     leftColumns: 3
            // },
            // select: true,
            ajax: {
                url: url,
            },
            createdRow: function (row, data, dataIndex, meta) {
                console.log(data.status)
                if (dataIndex == 0) {
                    $(row).addClass('insiet');
                }

                if(data.status == 2 || data.status == 4){
                    $(row).addClass('orderrilis');
                }


            },
            // rowCallback: function (row, data, index) {

            //     if (index == 1) { //highlights the row
            //         $(row).addClass('insiet');
            //     }
            // },
            columns: [{
                    data: 'action1',
                    name: 'action1',
                    orderable: false,
                    render: function (data, type, row) {
                        return ' <button href="javascript:void(0)" name="tambah" data-toggle="tooltip"   data-original-title="Tambah" class="tambah btn btn-info edit-user">' +
                            '<i class="ni ni-fat-add"></i>' +
                            '</button>' +
                            ' <button href="javascript:void(0)" name="delete" data-toggle="tooltip"   data-original-title="Delete" data-toggle="modal" data-target="#exampleModal" class="delete btn btn-danger edit-user">' +
                            '<i class="ni ni-fat-delete"></i>' +
                            '</button>'
                        // fat-add

                    }
                },

                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    // render: function (data, type, row, meta) {

                },
                {
                    data: 'nomor_order',
                    name: 'nomor_order',

                },
                {
                    data: 'seri',
                    name: 'seri',
                    // render: function (data, type, row) {

                    //     return '<input type="text"  style="width:100px;" name="seri" id="seri" class="form-control"   value="' +
                    //         data + '" readonly=true>'

                    // }
                },



                {
                    data: 'nomor',
                    name: 'nomor',

                },
                {
                    data: 'pemasok',
                    name: 'pemasok',
                    render: function (data, type, row, meta) {
                        // if (row.DT_RowIndex % 2 == 0) {
                        //     return '<input type="text"  style="width:120px;" name="pemasok" id="pemasok" class="form-control"  value="">'
                        // } else {
                        if (data == null) {
                            return '<input type="text"  style="width:120px;" name="pemasok" id="pemasok' +
                                meta.row + '" class="form-control"  value="" placeholder="-">'
                        } else {
                            return '<input type="text"  style="width:120px;" name="pemasok" id="pemasok' +
                                meta.row + '" class="form-control"  value="' +
                                data + '">'
                        }
                        // }



                    }
                },
                {
                    data: 'no_ba',
                    name: 'no_ba',
                    render: function (data, type, row, meta) {
                        // if (row.DT_RowIndex % 2 == 0) {
                        //     return '<input type="text"  style="width:120px;" name="no_ba" id="no_ba" class="form-control"  value="">'
                        // } else {
                        if (data == null) {
                            return '<input type="text"  style="width:120px;" name="no_ba" id="no_ba' +
                                meta.row + '" class="form-control"  value="" placeholder="-">'
                        } else {
                            return '<input type="text"  style="width:120px;" name="no_ba" id="no_ba' +
                                meta.row + '" class="form-control"  value="' +
                                data + '">'
                        }
                        // }



                    }
                },
                {
                    data: 'tanggal',
                    name: 'tanggal',
                    render: function (data, type, row, meta) {
                        renderTgl()
                        return '<div class="input-group" style="width: 10rem;">' +
                            '<div class="input-group-prepend">' +
                            '<span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>' +
                            '</div>' +
                            '<input class="form-control datepicker" style="width:7rem;" placeholder="Select date" type="text" name="tanggal" id="tanggal' +
                            meta.row + '" value="' +
                            setFormat2(data) + '" autocomplete=off>' +
                            '</div>'

                        // '<div class="input-group date">' +
                        //     '<div class="input-group-addon">' +
                        //     ' <i class="fa fa-calendar"></i>' +
                        //     '</div>' +
                        //     '<input type="text" style="width:100px;"class="form-control date" name="tanggal" id="tanggal" value="' +
                        //     setFormat2(data) + '">' +
                        //     '</div>'


                    }
                },
                {
                    data: 'jmlh_kertas',
                    name: 'jmlh_kertas',
                    render: function (data, type, row, meta) {
                        // return data
                        // if (row.DT_RowIndex % 2 == 0) {
                        //     return '<input type="text" style="width:7rem;" name="jmlh_kertas" id="jmlh_kertas" class="jmlhkertas form-control"  value="0">'
                        // } else {
                        if (data == null) {
                            return '<input type="number"  style="width:7rem;" name="jmlh_kertas" id="jmlh_kertas' +
                                meta.row + '" class="jmlhkertas form-control"  value="0">'
                        } else {
                            return '<input type="number"  style="width:7rem;" name="jmlh_kertas" id="jmlh_kertas' +
                                meta.row + '" class="jmlhkertas form-control"  value="' +
                                data + '">'
                        }
                        // }



                    }
                },
                {
                    data: 'invoice',
                    name: 'invoice',
                    render: function (data, type, row, meta) {
                        // if (row.DT_RowIndex % 2 == 0) {
                        //     return '<input type="text"  style="width:110px;" name="invoice" id="invoice" class="form-control"  value="">'
                        // } else {
                        if (data == null) {
                            return '<input type="text"    style="width:110px;" name="invoice" id="invoice' +
                                meta.row + '" class="form-control"  value="" placeholder="-">'
                        } else {
                            return '<input type="text"   style="width:110px;" name="invoice" id="invoice' +
                                meta.row + '" class="form-control"  value="' +
                                data + '">'
                        }
                        // }



                    }

                },
                {
                    data: 'keterangan',
                    name: 'keterangan',
                    render: function (data, type, row, meta) {
                        // if (row.DT_RowIndex % 2 == 0) {
                        //     return '<input type="text"  style="width:110px;" name="keterangan" id="keterangan" class="form-control"  value="">'
                        // } else {
                        //     if (data == null) {
                        //         return '<input type="text"  style="width:110px;" name="keterangan" id="keterangan" class="form-control"  value="">'
                        //     } else {
                        if (data == null) {
                            return '<input type="text"  style="width:110px;" name="keterangan" id="keterangan' +
                                meta.row + '" class="form-control"  value="" placeholder="-">'
                        } else {
                            return '<input type="text"  style="width:110px;" name="keterangan" id="keterangan' +
                                meta.row + '" class="form-control"  value="' +
                                data + '">'
                        }
                        // }

                        // }



                    }
                },
                {
                    data: 'lot_bi',
                    name: 'lot_bi',
                    render: function (data, type, row, meta) {
                        // if (row.DT_RowIndex % 2 == 0) {
                        //     return '<input type="text"  style="width:200px;" name="lot_bi" id="lot_bi" class="form-control"  value="">'
                        // } else {
                        if (data == null) {
                            return '<input type="text"  style="width:200px;" name="lot_bi" id="lot_bi' +
                                meta.row + '" class="form-control"  value="" placeholder="-">'
                        } else {
                            return '<input type="text"  style="width:200px;" name="lot_bi" id="lot_bi' +
                                meta.row + '" class="form-control"  value="' +
                                data + '">'
                        }
                        // }



                    }
                },
                {
                    data: 'lini',
                    name: 'lini',
                    render: function (data, type, row, meta) {
                        
                        var $select = $(
                            '<select name="lini" class="pilihan form-control" id="lini'+meta.row+'" style="width: 11rem;"><option value="">--Pilihan--</option><option value="A">Lini A</option><option value="B">Lini B</option></select>'
                        );
                        $select.find('option[value="' + data + '"]').attr('selected',
                            'selected');
                        //   console.log($select)
                        return $select[0].outerHTML
                        // }

                        // }



                    }
                },
                {
                    data: 'revisi',
                    name: 'revisi',
                    render: function (data, type, row, meta) {
                        if(data==0){
return '-'
                        }else{
                            return 'Revisi Ke - '+data
                        }
                        // if (row.DT_RowIndex % 2 == 0) {
                        //     return '<input type="text"  style="width:200px;" name="lot_bi" id="lot_bi" class="form-control"  value="">'
                        // } else {
                        // if (data == null) {
                        //     return '<input type="text"  style="width:200px;" name="revisi" id="catatan' +
                        //         meta.row + '" class="form-control"  value="" placeholder="-">'
                        // } else {
                        //     return '<input type="text"  style="width:200px;" name="catatan" id="catatan' +
                        //         meta.row + '" class="form-control"  value="' +
                        //         data + '">'
                        // }
                        // }



                    }
                },
                {
                    data: 'np',
                    name: 'np',
                    render: function (data, type, row, meta) {
                        
                        var $select = $(
                            '<select name="np" id="np" class="pilihan form-control select2" style="width: 100%;">'+
                         '<option value="" disabled selected>-</option>@foreach($np as $data)'+
                        '<option value="{{$data->np}}">{{$data->np}} </option>@endforeach</select>'
                            // '<select name="lini" class="pilihan form-control" id="np'+meta.row+'" style="width: 11rem;"><option value="">--Pilihan--</option><option value="A">Lini A</option><option value="B">Lini B</option></select>'
                        );
                        $select.find('option[value="' + data + '"]').attr('selected', 'selected');
                        //   console.log($select)
                        return $select[0].outerHTML
                        // }

                        // }



                    }
                },
                
                {
                    data: 'catatan',
                    name: 'catatan',
                    render: function (data, type, row, meta) {
                        // if (row.DT_RowIndex % 2 == 0) {
                        //     return '<input type="text"  style="width:200px;" name="lot_bi" id="lot_bi" class="form-control"  value="">'
                        // } else {
                        if (data == null) {
                            return '<input type="text"  style="width:200px;" name="catatan" id="catatan' +
                                meta.row + '" class="form-control"  value="" placeholder="-">'
                        } else {
                            return '<input type="text"  style="width:200px;" name="catatan" id="catatan' +
                                meta.row + '" class="form-control"  value="' +
                                data + '">'
                        }
                        // }



                    }
                },
                {
                    data: 'status',
                    name: 'status',
                    render: function (data, type, row, meta) {
                        var $select = $(
                            '<select name="status" class="pilihan form-control" id="status'+meta.row+'" style="width: 11rem;"><option value="">--Pilihan--</option><option value="0">Belum Rilis</option><option value="1">Order Rilis</option><option value="2">Order Proses Cetak</option><option value="3">Order Selesai</option><option value="4">Order Revisi</option></select>'
                        );
                        $select.find('option[value="' + data + '"]').attr('selected',
                            'selected');
                        //   console.log($select)
                        return $select[0].outerHTML




                    }
                },



            ],
            initComplete: function (settings, json, row) {
                $('.datepicker').datepicker({
                    format: 'dd/mm/yyyy',
                    autoclose: true,
                    todayHighlight: true
                })
                if (json.data[0].nomor_order == json.data[1].nomor_order) {
                    table.rows(1)
                        .nodes()
                        .to$()
                        .addClass('insiet');
                }



            },
            footerCallback: function (row, data, start, end, display) {
                var api = this.api(),
                    data;

                // Remove the formatting to get integer data for summation
                var intVal = function (i) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '') * 1 :
                        typeof i === 'number' ?
                        i : 0;
                };

                pageTotal = api
                    .column(7, {
                        page: 'current'
                    })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api.column(7).footer()).html(
                    pageTotal
                );
            },
        });


      
        $('#tblorder tbody').on('click', 'tr', function () {
            // console.log($(this).closest("tr").index())
            if ($(this).closest("tr").index() == 0) {
                // console.log($(this))
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                    $(this).addClass('insiet');
                    // table.row($(this).closest("tr").index()+1).node().deselect();
                    $(table.row($(this).closest("tr").index() + 1).node()).removeClass('selected')
                    $(table.row($(this).closest("tr").index() + 1).node()).addClass('insiet')
                } else {
                    $(this).removeClass('insiet');
                    $(this).addClass('selected');
                    $(table.row($(this).closest("tr").index() + 1).node()).click();
                }

 

            } else if ($(this).closest("tr").index() == 1) {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                    $(this).addClass('insiet');

                } else {
                    $(this).removeClass('insiet');
                    $(this).addClass('selected');
                }
            } else {
                $(this).toggleClass('selected');
            }




        });
        var count = 0;

        var isMax = false
        var isMaxJumlahKertas = false
        var net_value = parseInt(0);
        // var total = parseInt(0);
        $("#tblorder").on('change', '.jmlhkertas', function () {


            // console.log(table.row( this ).index())
            var theRow = $(this).closest("tr")


            $('[name="jmlh_kertas"]', theRow).each(function () {
                // console.log($(this).val())
                // net_value += parseInt($(this).val());
                // $('#sumrow').text(net_value)
                // var column = table.column(8); 
                // var sum = 0;
                // $.each(column.data(), function (index, value) { 
                //     var val = parseFloat(value); 
                //     sum += val;
                // });
                var idxEditedRow = theRow.index()

                if ($(this).val() == "") {
                    if (localStorage.getItem('nomor' + idxEditedRow) === null) {} else {
                        var getNomor = localStorage.getItem('nomor' + idxEditedRow)
                        $(this).val(0)
                        table.cell({
                            row: idxEditedRow,
                            column: 4
                        }).data(getNomor);
                    }
                    table.row(idxEditedRow + 1).remove().draw(false);
                } else {
                    if ($(this).val() < 100000) {


                        if (localStorage.getItem('nomor' + idxEditedRow) === null) {
                            var valCellNomor = table.cell({
                                row: idxEditedRow,
                                column: 4
                            }).data()
                            localStorage.setItem('nomor' + idxEditedRow, valCellNomor)
                        }
                        var getNomor = localStorage.getItem('nomor' + idxEditedRow)
                        changeNomorSerial(getNomor, idxEditedRow, this)
                        addRowBelow($(this), $(this).val())


                    }

                }

                if ($(this).val() > 100000) {
                    toastr.warning('Jumlah Kertas Melebihi Batas Max 1 Order', {
                        timeOut: 5000
                    });
                }
                if ($(this).val() == 100000) {
                    var getNomor = localStorage.getItem('nomor' + idxEditedRow)

                    table.cell({
                        row: idxEditedRow,
                        column: 4
                    }).data(getNomor);
                    // table.row(idxEditedRow + 1).remove().draw(false);
                    // delSelectedRow($(this))
                }
                // if (idxEditedRow == 0) {
                //     table.row(1).addClass('red');
                // } 
                // var idxRowData=
                // saveNewRow(idxRowData)
                updateSum()

            })
        })
        $('#copy').on('click', function () {

            var cpy_component = $('#formcopy').find('*').filter(':input:visible:first');
            var cpy_compselect = $('#formcopy').find('select').filter(':visible:first');
            console.log(cpy_compselect)
            if (cpy_component.length == 0) {
                alert("belum ada form yang dipilih")
            }else{
                copyValue(cpy_component,"input")
            }

            if(cpy_compselect != 0){
                copyValue(cpy_compselect,'select')
            }
           
            if (isMax) {
                toastr.warning('Jumlah Kertas Melebihi Batas Max 1 Lot', {
                    timeOut: 5000
                });
            }
        });

        $('#tblorder').on('click', '.delete', function () {
            $('#exampleModal').modal()
            delSelectedRow($(this)) 
           
           

            
        });
       
        function delSelectedRow(thisTable){
            $('#deletebaris').on('click', function () {
                var idx = thisTable.closest('tr').index() 
                
                // saveDelSelectedRow(table.row(idx).data())
                table.row(idx).remove().draw(false);
                updateSum()
                $('#exampleModal').modal('toggle')
        })
            
        }
        function saveDelSelectedRow(idxRowData){
            $.ajax({
                            url: "{{ route('lampiranorder.deleterow') }}",
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
        function saveNewRow(idxRowData){
            // console.log(idxRowData)
            $.ajax({
                            url: "{{ route('lampiranorder.saverow') }}",
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
                                $('#saveentri').text('proses menyimpan...');
                            },
                            success: function (data) {
                                console.log(data)
                                if (data.errors) {
                                    toastr.error(data.errors, 'Gagal Menyimpan', {
                                        timeOut: 5000
                                    });
                                }
                                if (data.success) {
                                    toastr.success(data.success, 'Berhasil', {
                                        timeOut: 5000
                                    });
                                    $('#counterentries').text(data.count);

                                    $('#saveentri').text('Simpan');

                                }

                            }
                        })

        }
        $("#tblorder").on('click', '.tambah', function () {

            addRowBelow($(this), "")


        });

        table.on('order.dt search.dt', function () {
            table.column(1, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();

        function changeCell(nomor, sisaKertas) {
            var splitnomor = nomor.split('-') 
            splitnomor[0] = parseInt(splitnomor[1]) + 1
            splitnomor[1] = splitnomor[0] + sisaKertas - 1
            splitnomor = splitnomor.join('-')
            return splitnomor

        }
        // debugger

        function hideComponent(arrID) {
            for (i = 0; i < arrID.length; i++) {
                $('#' + arrID[i]).hide()

            }

        }

        function addRowBelow(thisComp, jmlkertas) {

            var currentPage = table.page();
            var data1 = table.row(thisComp.parents('tr')).data();
            var data3 = table.rows().data();

            var idx = table.row(thisComp.parents('tr')).index();

            var CurTableIndexs = table.rows().indexes();
            // Get the array key for the current index we have
            var CurIndexArrayKey = CurTableIndexs.indexOf(idx);
            // Subtract 1 to the array key to get the prior index number
            //  var PrevItemIndex = CurTableIndexs[ CurIndexArrayKey - 1];
            // Add 1 to get the next index number
            var NextItemIndex = CurTableIndexs[CurIndexArrayKey];
            var PrevItemIndex2 = CurTableIndexs[CurIndexArrayKey - 1];
            var data2 = table.row(NextItemIndex).data();
            var dataprev = table.row(PrevItemIndex2).data();


            count++;
            var sisaKertas
            var finalNomor
            if(jmlkertas=="" || jmlkertas==0){
                sisaKertas=0
                finalNomor=data2.nomor
            }else{
                sisaKertas = parseInt(100000) - parseInt(jmlkertas)
 
                finalNomor= changeCell(data2.nomor, sisaKertas)
            }
           
            // table.row.add(data2).draw();
            table.row.add({
                "action": "",
                "DT_RowIndex": "",
                "id": "",
                "idpesanan": data2.idpesanan,
                "invoice": 'baris baru',
                "jmlh_kertas": sisaKertas,
                "keterangan": data2.keterangan,
                "lot_bi": data2.lot_bi,
                "no_ba": data2.no_ba,
                "no_lampiran": data2.no_lampiran,
                "nomor": finalNomor,
                "nomor_order": data2.nomor_order,
                "pecahan": data2.pecahan,
                "pemasok": data2.pemasok,
                "seri": data2.seri,

                "status": data2.status,
                "lini": data2.lini,
                "level": data2.level+1,
                "revisi": data2.revisi,
                "catatan": data2.catatan,
                "ta": data2.ta,
                "tahun_emisi": data2.tahun_emisi,
                "tanggal": data2.tanggal,
                "created_at": "",
                "update_at": ""
            }).draw();

            //move added row to desired index (here the row we clicked on)
            var index = thisComp.closest('tr').index(),
                rowCount = table.data().length - 1,
                insertedRow = table.row(rowCount).data(),
                
                tempRow;

                
            for (var i = rowCount; i > index + 1; i--) {

                tempRow = table.row(i - 1).data();
                table.row(i).data(tempRow);
                table.row(i - 1).data(insertedRow);

            }
            //refresh the page
            table.page(currentPage).draw(false);
            // saveNewRow(insertedRow)
             

        }
         

        function changeNomorSerial(getNomor, idxEditedRow, thisValue) {

            splitNomor = getNomor.split('-')
            splitNomor[1] = parseInt(splitNomor[0]) + parseInt($(thisValue).val()) - 1
            var finalNomor = splitNomor.join('-')
            table.cell({
                row: idxEditedRow,
                column: 4
            }).data(finalNomor);
        }

        function updateSum() {
            var total = parseInt(0);
            var data1 = table.$(':input[name=jmlh_kertas]').serializeArray();
            $.each(data1, function (index, value) {

                total += parseInt(value.value)
            });
            var column = table.column(7);
            $(column.footer()).html(
                column.data().reduce(function (a, b) {
                    if (total > $('#maxkertas').val()) {
                        isMax = true
                    }
                    return total;
                })
            )
        }

        function renderTgl() {
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true,
                todayHighlight: true
            })
        }

        function copyValue(value_cpy,inpuType) {

            var countData = table.rows().data().count()

            for (i = 0; i < countData; i++) {
                if(inpuType=='input'){
                    $(':input[name="' + value_cpy.attr('name') + '"]').val(value_cpy.val());
                }else{
                    console.log('das')
                    $('select[name="'+value_cpy.attr('name')+'"]').val(value_cpy.val()).change();
                }
                
                // if(){

                // }
            }


            if (value_cpy.attr('name') == 'jmlh_kertas') {
                updateSum()
            }

        }
 
        function setFormat(date) {
            if (date != "") {
                return moment(date, "DD/MM/YYYY").format('YYYY/MM/DD');
            } else {
                return ""
            }

        }

        function setFormat2(date) {

            if (date != "0000-00-00" && date != null) {

                return moment(date, "YYYY/MM/DD").format('DD/MM/YYYY');
            } else {
                return ""
            }

        }


    })

</script>
@endsection
