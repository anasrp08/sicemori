@extends('layouts.app')
<style type="text/css">
    td {
        white-space: nowrap;
    }

    td.wrapok {
        white-space: normal
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
</style>
@section('title')
<a class="h1 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">Daftar Lampiran Kerja</a>
@endsection 
@section('header') 

@endsection  
@include('layouts.src_datatable')
@section('content')

<div class="container-fluid mt--7">
    <div class="row"> 
    <div class="card shadow" style="width: 100%;">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0"style="margin-right: 20rem;" >Daftar Lampiran Kerja (LPK) </h3>
                </div>
                <div class="col text-right">
                    <button type="button" name="refresh" id="refresh" class="btn btn-success "><i class="fas fa-sync-alt"></i>
                        Refresh</button>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <!-- Projects table -->
            {{-- table align-items-center table-flush --}}
            <table id="lampiranorder" class="table table align-items-center table-striped" style="width:100%;">
                <thead>
                    <tr>
                        <th>NO.</th>
                        <th  class="select-filter" >NO. ORDER</th>
                        <th  class="select-filter" >PECAHAN</th>
                        <th class="select-filter" >SERI</th>
                        <th  class="select-filter">NOMOR</th>
                        <th class="select-filter" >TANGGAL</th>
                        <th class="select-filter" >JUMLAH KERTAS (LBR)</th>
                        <th  class="select-filter">KET.</th>
                        <th  class="select-filter">REVISI</th>
                            <th  class="select-filter">CATATAN</th>
                        <th  class="select-filter">STATUS</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th></th>
                        <th> </th>
                        <th> </th>
                        <th> </th>
                        <th>  </th>
                        <th> </th>
                        <th> </th>
                        <th> </th>
                        <th> </th>
                        <th> </th>


                    </tr>
                </tfoot>
            </table>
            
        </div>
    </div> 
    {{-- @include('pesanan.f_pesanan') --}}
    
    
    

</div>
</div>


@endsection
@section('scripts')
@include('layouts.srcjs_datatable')
<script>
    $(document).ready(function () {

        // var url = '{{ route("lampirankerja.index")}}';


        var table = $('#lampiranorder').DataTable({
            processing: true,
            serverSide: true,
            // lengthMenu: [ [10, 25, 50, "All"]],
            iDisplayLength: 10,
            dom: '<"right">lrtip<"clear">',
            buttons: [{
                // text: '<h4 style="color:white"><i class="fa fa-refresh bg-white"></i>  Refresh</h4>',
                // className: 'btn-info btn-sm',
                // action: function (e, dt, node, config) {
                    
                // }


            }],
            order: [
                [1, "desc"]
            ],
            language: {
                emptyTable: "Tidak Ada Data Lampiran Perintah Kerja"
            },
            scrollCollapse: true,
            scrollX: true,
            autoFill: {
                keys: true,
                horizontal: false
            },
            ajax: {

                url: "{{ route('revisi.daftar') }}",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: function (d) {

                    // d.val_idjadwal = idjadwal;
                }
                },
            // ajax: {
            //     url: url,
            // },
            columnDefs: [{

                    className: "text-center",
                    targets: [1, 2, 3, 4, 5, 6, 7]

                },


            ],
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',

                },
                {
                    data: 'nomor_order',
                    name: 'nomor_order',

                },
                {
                    data: 'pecahan',
                    name: 'pecahan',
                    render: function (data, type, row) {

                        // console.log(row.filesuratperintah)
                        switch (data) {
                            case 'S':
                                return '<h4><span class="label label-default"> ' + data + "(" +
                                    row.ta + ")" + '</span></h4>'
                                break;
                            case 'T':
                                return '<span class="label label-success"> ' + data + "(" + row
                                    .ta + ")" + '</span>'
                                break;
                            case 'U':
                                return '<span class="label label-info"> ' + data + "(" + row
                                    .ta + ")" + '</span>'
                                break;
                            case 'V':
                                return '<span class="label label-primary"> ' + data + "(" + row
                                    .ta + ")" + '</span>'
                                break;
                            case 'W':
                                return '<h3><span class="label label-warning">  ' + data + "(" +
                                    row.ta + ")" + '</span></h3>'
                                break;
                            case 'X':
                                return '<span class="label bg-maroon">  ' + data + "(" + row
                                    .ta + ")" + '</span>'
                                break;
                            case 'Y':
                                return '<span class="label label-danger">  ' + data + "(" + row
                                    .ta + ")" + '</span>'
                                break;

                            default:
                                break;
                        }
                    }


                },
                {
                    data: 'seri',
                    name: 'seri',

                },



                {
                    data: 'nomor',
                    name: 'nomor',

                },

                {
                    data: 'tanggal',
                    name: 'tanggal',
                    render: function (data) {
                         console.log(data)
                        return moment(data, "YYYY/MM/DD").format('DD/MM/YYYY');
                    }

                },
                {
                    data: 'jmlh_kertas',
                    name: 'jmlh_kertas'
                    // render: function (data) {
                    //      console.log(data)
                    //     return moment(data, "YYYY/MM/DD").format('DD/MM/YYYY');
                    // }

                },


                {
                    data: 'keterangan',
                    name: 'keterangan',

                },
                {
                    data: 'revisi',
                    name: 'revisi',
                     render: function (data) {
                          if(data==0){
                            return '-'
                          }else{
                            return 'Revisi ke- '+data
                          }
                        
                    }

                },
                {
                    data: 'catatan',
                    name: 'catatan',

                },
                {
                    data: 'status',
                    name: 'status',
                    render: function (data, type, row) {

                        switch (data) {
                            case "0":
                                return '<h5><span class="badge badge-default">Belum Rilis</span></h5>'
                                break;
                            case "1":
                                return '<h5><span class="badge badge-info">Order Rilis</span></h5>'
                                break;
                            case "2":
                                return '<h5><span class="badge badge-warning">Order Proses Cetak</span></h5>'
                                break;
                            case "3":
                                return '<h5><span class="badge badge-danger">Order Revisi</span></h5>'
                                break;
                            case "4":

                                return '<h5><span class="badge badge-success">Order Selesai</span></h5>'
                                break;
                            default:
                                return '<h5><span class="badge badge-default"></span></h5>'


                        }


                    }
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                }




            ],
            initComplete: function (settings, json) {
                $('.date').datepicker({
                    format: 'dd/mm/yyyy',
                    autoclose: true,
                    todayHighlight: true
                })

                
            this.api().columns('.select-filter').every( function () {
                var column = this;
                var select = $('<select style="width:100%"><option value="">all</option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    console.log(j)
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
         
            }
        });
        $('#refresh').on('click', function () {
            $('#lampiranorder').DataTable().ajax.reload();
        })
        



        $('body').on('click', '.print', function () {

            var id = $(this).data('id');
            var data = table.row($(this).closest('tr')).data();
            
            var url =
                '{{ route("lampirankerja.cetak",[":id",":idpesanan",":no_lampiran",":nomor_order",":pecahan",":ta"])}}';
            url = url.replace(":id", data.id);
            url = url.replace(":idpesanan", data.idpesanan);
            url = url.replace(":no_lampiran", data.no_lampiran);
            url = url.replace(":nomor_order", data.nomor_order);
            url = url.replace(":pecahan", data.pecahan);
            url = url.replace(":ta", data.ta);

            document.location.href = url;

            // window.print();



        });


    })
</script>
@endsection