@extends('layouts.app')
@section('title')
<a class="h1 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">Lapor LPK</a>
@endsection
@section('header')

@endsection
@include('layouts.src_datatable')
@section('content')

<div class="container-fluid mt--7">
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
                            <th  class="select-filter" >SERI</th>
                            <th  class="select-filter">NOMOR</th>
                            <th  class="select-filter" >TANGGAL</th>
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
    </div>
    </div> 
</div> 
</div>




{{-- <!-- Main content -->
<section class="content">
    <div class="callout callout-info">
        <h4>Info!</h4>

        <p>Masukkan Nomor Order Untuk Melaporkan Hasil Cetak Perintah Kerja</p>
         
    </div>
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Input Lapor Hasil LPK</h3>
                </div>
                <!-- Date dd/mm/yyyy -->
                <form method="post" id="create_jadwal" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                        <!-- jenis Uji -->
                        <span id="form_result"></span>
                       
                        <!-- no surat -->
                        <div id="formnosurat" class="form-group">
                            <label for="nomor_order">No. Order </label>
                            <input type="text" name="nomor_order" id="nomor_order" class="form-control"
                                placeholder="masukkan nomor order">
                        </div>
                      
                        
                            <div  class="form-group">
                                    <label>Pecahan</label>
        
                                    <select name="pecahan" id="pecahan" class="form-control select2"
                                        style="width: 100%;">
                                        <option disabled selected>-Pilih Pecahan-</option>
                                        @foreach($pecahan as $data)
                                        <option value="{{$data->kode_pecahan}}">{{$data->kode_pecahan}}
                                            ({{$data->nama_pecahan}}) </option>
                                        @endforeach
                                    </select>
                                </div>
                        <div  class="form-group">
                            <label>Tahun Anggaran</label>
                            <select name="tahun" id="tahun" class="form-control select2" style="width: 100%;">
                                <option disabled selected>-Pilih Tahun-</option>
                                @foreach($tahun as $data)
                                <option value="{{$data['ta']}}">{{$data['tahun']}} ({{$data['ta']}}) </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- tanggal kanwil -->
                        <div id="formtglkanwil" class="form-group">
                            <label>Tanggal Lapor</label>

                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="tgllapor" id="tgllapor"
                                    class="form-control pull-right">
                            </div>
                        </div>

 
                        
                    </div>


                    <div class="box-footer">
                        <button id="submit" type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>


    </div>
    </div>
    </div>

</section> --}}
@endsection

@section('scripts')
@include('layouts.srcjs_datatable')
<script>
    $(document).ready(function () {
        var table = $('#lampiranorder').DataTable({
            processing: true,
            serverSide: true,
            // lengthMenu: [ [10, 25, 50, "All"]],
            iDisplayLength: 10,
            dom: '<"right">lrtip<"clear">',
            buttons: [{ 
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

                url: "{{ route('lampirankerja.daftarall') }}",
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
             rowCallback: function (row, data, index) {
// console.log(data)
                // if (data.status == 3) { //highlights the row
                //     // $('').addClass('insiet');
                // }
            },
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
                        //  console.log(data)
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
                                
                                return '<h5><span class="badge badge-success">Order Selesai</span></h5>'
                                break;
                            case "4":

                                return '<h5><span class="badge badge-danger">Order Revisi</span></h5>'
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
                    // console.log(j)
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
         
            }
        });
        $('#refresh').on('click', function () {
            $('#lampiranorder').DataTable().ajax.reload();
        })

        $('body').on('click', '.selesai', function () {
            var id = $(this).data('id');
            // var idx = thisTable.closest('tr').index() 
                
            //     saveDelSelectedRow(table.row(idx).data())
            var data = table.row($(this).closest('tr')).data();
            console.log(JSON.stringify(data))
            // var data
            $.ajax({
                    url: "{{ route('lampirankerja.selesai') }}",
                    method: "POST",
                    data: data,
                    // contentType: false,
                    // cache: false,
                    headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                    // processData: false,
                    // dataType: "json",
                    beforeSend: function () {
                        // $('#simpan').val('menyimpan...');
                    },
                    success: function (data) {
                        var html = '';
                        console.log(data)
                        if (data.errors) {
                            toastr.error(data.errors, 'Error', {
                                timeOut: 5000
                            }); 
                        }
                        if (data.success) {
                            toastr.success(data.success, 'Success', {
                                timeOut: 5000
                            });
                            $('#lampiranorder').DataTable().ajax.reload();
                             
                        }

                    }
                })
        
        })
        



        $('body').on('click', '.print', function () {

            var id = $(this).data('id');
            var data = table.row($(this).closest('tr')).data();
            
            var url =
                '{{ route("lampirankerja.cetakonly",[":id",":idpesanan",":no_lampiran",":nomor_order",":pecahan",":ta"])}}';
            url = url.replace(":id", data.id);
            url = url.replace(":idpesanan", data.idpesanan);
            url = url.replace(":no_lampiran", data.no_lampiran);
            url = url.replace(":nomor_order", data.nomor_order);
            url = url.replace(":pecahan", data.pecahan);
            url = url.replace(":ta", data.ta);

            document.location.href = url;

            // window.print();



        });
 

        $('#tgllapor').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true,
            todayHighlight: true,
            
        })

        $('#tgllapor').datepicker('setDate', new Date());
       

        $('#create_jadwal').on('submit', function (event) {
            event.preventDefault();
           
                sentData(this)
               

            function sentData(tes) {
                $.ajax({
                    url: "{{ route('lampirankerja.store') }}",
                    method: "POST",
                    data: new FormData(tes),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    beforeSend: function () {
                        $('#simpan').val('menyimpan...');
                    },
                    success: function (data) {
                        var html = '';
                        console.log(data)
                        if (data.errors) {
                            toastr.error(data.errors, 'Error', {
                                timeOut: 5000
                            });
                            $('#form_result').html(html);
                        }
                        if (data.success) {
                            toastr.success(data.success, 'Success', {
                                timeOut: 5000
                            });
                            $('#create_jadwal')[0].reset();

                            $('#pecahan').get(0).selectedIndex = 0;
                            $('#tahun').get(0).selectedIndex = 0; 
                            window.location.reload()
                            $('#action_button').val('Simpan');
                            $('#form_result').html('');
                        }

                    }
                })
            }






        })
    })
</script>
@endsection