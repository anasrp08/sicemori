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
                <h3 class="mb-0">Master Order</h3>
            </div>
            <div class="col text-right">
                <button type="button" name="refresh" id="refresh" class="btn btn-success "><i
                        class="fa  fa-refresh"></i>Refresh</button>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <!-- Projects table -->
        {{-- table align-items-center table-flush --}}
        <table id="pesanan" class="table table align-items-center table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>No. </th>
                    <th class="select-filter">Pecahan</th>

                    <th class="select-filter" style="width:5%;">TA</th>
                    <th class="select-filter">Tahun Emisi</th>
                    <th>Nomor Order</th>
                    <th class="select-filter">Seri</th>

                    <th>Nomor</th>

                    {{-- <th>Action</th> --}}


                </tr>
            </thead>

        </table>
    </div>
</div>
{{-- @include('pesanan.f_pesanan') --}}



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
        var idpesanan = '<?php echo $idpesanan ?>'

        console.log(idpesanan)

        $('#refresh').click(function () {


            $('#pesanan').DataTable().ajax.reload();

        })

        $('#pesanan').on('click', '.delete', function () {
            $('#exampleModal').modal()
            delSelectedRow($(this))
        });

        function delSelectedRow(thisTable) {
            $('#deletebaris').on('click', function () {
                var idx = thisTable.closest('tr').index()

                saveDelSelectedRow(table.row(idx).data())
                $('#pesanan').DataTable().ajax.reload();
                $('#exampleModal').modal('toggle')
            })

        }

        function saveDelSelectedRow(idxRowData) {
            $.ajax({
                url: "{{ route('pesanan.deletepesanan') }}",
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
        var table = $('#pesanan').DataTable({
            processing: true,
            serverSide: false,
            order: [],
            // scrollY: "300px",

            dom: 'Bfrtip',
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
                    exportOptions: {
                        modifier: {
                            // DataTables core
                            order: 'current', // 'current', 'applied', 'index',  'original'
                            page: 'all', // 'all',     'current'
                            search: 'applied' // 'none',    'applied', 'removed'
                        }
                    }
                }


                // 'pdfHtml5'
            ],
            language: {
                emptyTable: "Tidak Ada Data Pesanan"
            },
            // ajax: {
            //     url: "{{ route('pesanan.index') }}",
            // },
            ajax: {

                url: "{{ route('pesanan.master') }}",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: function (d) {
                    //
                    d.val_idpesanan = idpesanan;
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
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
                    data: 'tahun_emisi',
                    name: 'tahun_emisi',

                },
                {
                    data: 'nomor_order',
                    name: 'nomor_order',

                },
                {
                    data: 'seri',
                    name: 'seri',

                },
                {
                    data: 'nomor',
                    name: 'nomor',

                },

                // {
                //     data: 'action',
                //     name: 'action',
                //     orderable: false

                // },

            ],
            initComplete: function () {
                this.api().columns('.select-filter').every(function () {
                    var column = this;
                    var select = $(
                            '<select  style="width:100%;" ><option value="">all</option></select>'
                        )
                        .appendTo($(column.footer()).empty())
                        .on('change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );

                            column
                                .search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                        });

                    column.data().unique().sort().each(function (d, j) {
                        select.append('<option value="' + d + '">' + d +
                            '</option>')
                    });
                });
            }
        });

    })

</script>
@endsection
