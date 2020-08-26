@extends('layouts.app')
{{-- @section('dashboard')
Catat Jumlah Pesanan Pecahan
<small>{!! auth()->user()->name !!}</small>
@endsection --}}
@section('title')
<a class="h1 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">Daftar Lot Order</a>
@endsection
{{-- <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs/dt-1.10.18/b-1.5.6/fc-3.2.5/fh-3.1.4/r-2.2.2/sc-2.0.0/sl-1.3.0/datatables.min.css" /> --}}

        <style type="text/css">
        div.container {
            width: 80%;
        }
        </style>
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
                    <h3 class="mb-0">Daftar Lot </h3>
                </div>
                <div class="col text-right">
                    <button type="button" name="refresh" id="refresh" class="btn btn-success "><i class="fa  fa-refresh"></i>
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
                        <th class="select-filter" >No. Lampiran</th>
                        <th class="select-filter">Pecahan</th> 
                        <th class="select-filter" >TA</th>
                        <th width="30%">Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
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
        $("#lampiranorder").css("width","100%")
        $('#refresh').click(function () {

            $('#lampiranorder').DataTable().ajax.reload();

        })


        var table = $('#lampiranorder').DataTable({
            processing: true,
            serverSide: true,
            order: [],
            // scrollCollapse: true,
            // scrollX: true,
            

            language: {
                emptyTable: "Tidak Ada Lampiran Order"
            },
            ajax: {
                url: "{{ route('lampiranorder.index') }}",
            },
            columns: [{
                    data: 'no_lampiran',
                    name: 'no_lampiran'
                },
                {
                    data: 'pecahan',
                    name: 'pecahan'
                },
                {
                    data: 'ta',
                    name: 'ta'
                },


                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                }
            ],
            initComplete: function () {
            this.api().columns('.select-filter').every( function () {
                var column = this;
                var select = $('<select style="width:30%"><option value="">all</option></select>')
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
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
        });

        $('#lampiranorder tbody').on('click', '.view', function () {
            var data1 = table.row($(this).parents('tr')).data();
            console.log(data1)
            var dataParam = {
                'idpesanan': data1.idpesanan,
                'no_lampiran': data1.no_lampiran,
                'pecahan': data1.pecahan,
                'ta': data1.ta
            }
            var url = '{{ route("lampiranorder.view",[":idpesanan",":no_lampiran",":pecahan",":ta"])}}';
                        url = url.replace(":idpesanan",data1.idpesanan);
                        url=url.replace(":no_lampiran",data1.no_lampiran);
                        url=url.replace(":pecahan",data1.pecahan);
                        url=url.replace(":ta", data1.ta);
                        document.location.href = url;
        });
 



    })
</script>
@endsection