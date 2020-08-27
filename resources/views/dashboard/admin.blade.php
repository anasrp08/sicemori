@extends('layouts.app')
<title>Dashboard</title>
@section('title')
<h2 class="h1 mb-0 text-white text-uppercase text-center d-none d-lg-inline-block" href="#">Dashboard</h2>
@endsection
<style>
    .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link {
        /* color: #fff; */
        background-color: ##21a0db !important;
    }

</style>
@include('layouts.src_datatable')
@section('header')


<div class="container-fluid">
    <div class="header-body">
        <div class="nav-wrapper">
            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0 active" id="y" data-toggle="tab"
                        href="#tabsy" role="tab" aria-controls="y" aria-selected="true"><i
                            class="fas fa-money-bill-alt mr-2 text-red"></i>Y (Rp. 100.000)</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" id="x" data-toggle="tab" href="#tabsx" role="tab"
                        aria-controls="x" aria-selected="false"><i class="fas fa-money-bill-alt mr-2 text-blue"></i>X (Rp. 50000-,)</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" id="w" data-toggle="tab"
                        href="#tabsw" role="tab" aria-controls="w" aria-selected="false"><i
                            class="fas fa-money-bill-alt mr-2 text-green"></i>W (Rp. 20.000)</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" id="v" data-toggle="tab"
                        href="#tabsv" role="tab" aria-controls="v" aria-selected="false"><i
                            class="fas fa-money-bill-alt mr-2 text-maroon"></i>V (Rp. 10.000)</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" id="u" data-toggle="tab"
                        href="#tabsu" role="tab" aria-controls="u" aria-selected="false"><i
                            class="fas fa-money-bill-alt mr-2 text-warning"></i>U (Rp. 5.000)</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" id="t" data-toggle="tab"
                        href="#tabst" role="tab" aria-controls="t" aria-selected="false"><i
                            class="fas fa-money-bill-alt mr-2 text-olive"></i>T (Rp. 2.000)</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" id="s" data-toggle="tab"
                        href="#tabss" role="tab" aria-controls="s" aria-selected="false"><i
                            class="fas fa-money-bill-alt mr-2 text-info"></i>S (Rp. 1.000)</a>
                </li>
            </ul>
        </div>

    </div>
</div>
@endsection

   
{{-- {{ $author->count() }} --}}
@section('content')
<div class="card shadow">
    <div class="card-body">
        <div class="tab-content" id="myTabContent">
           @include('dashboard.dashboardY')
           @include('dashboard.dashboardX')
           @include('dashboard.dashboardW')
           @include('dashboard.dashboardV')
           @include('dashboard.dashboardU')
           @include('dashboard.dashboardT')
           @include('dashboard.dashboardS')


 
        </div>
    </div>
</div>
{{-- <div class="card shadow">
    <div class="card-body"> --}}
 <div class="row mt-5">
        <div class="col-xl-12 mb-5 mb-xl-0">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Daftar On Progress Cetak Nomor</h3>
                        </div>
                        <div class="col text-right">
                            <a href="{{ route('lampirankerja.laporlpk') }}" class="btn btn-sm btn-primary">Lihat Semua</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table id="dashboard" class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">NO.</th>
                                <th scope="col">NO. ORDER</th>
                                <th scope="col">PECAHAN</th>
                                <th scope="col">SERI</th>
                                <th scope="col">NOMOR</th>
                                <th scope="col">JMLH KERTAS</th>
                                <th scope="col">TANGGAL UPDATE</th>
                                <th scope="col">LINI</th>
                                <th scope="col">STATUS</th>

                            </tr>
                        </thead>
                       
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- </div>
</div> --}}


@endsection

@section('scripts')

{{-- <script src="{{ asset('/adminlte/bower_components/chart.js/Chart.min.js') }}"></script> --}}
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.bundle.min.js"></script>
{{-- <script src="{{ asset('/adminlte/js/pages/highmap.js') }}"></script>
<script src="{{ asset('/adminlte/highmaps/highmaps.js') }}"></script>
<script src="{{ asset('/adminlte/highmaps/exporting.js') }}"></script>
<script src="{{ asset('/adminlte/highmaps/id-all.js') }}"></script>
<script src="{{ asset('/adminlte/highmaps/proj4.js') }}"></script> --}}
@include('layouts.srcjs_datatable')
<script>
    $(document).ready(function () {
        getDashboard()
        $('#refresh').on('click', function () {
            console.log("tes")
            getDashboard()
        })
        // <td><i class="ni ni-delivery-fast text-warning mr-3"></i> On Progress</td>

        var table = $('#dashboard').DataTable({
            processing: true,
            serverSide: true,
            order: [],
            // scrollY: "300px",
            scrollCollapse: true,
            scrollX: true,
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
            language: {
                emptyTable: "Tidak Ada Data Pesanan"
            },
            // ajax: {
            //     url: "{{ route('pesanan.index') }}",
            // },
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
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'nomor_order',
                    name: 'nomor_order'
                },
                {
                    data: 'pecahan',
                    name: 'pecahan',
                    render: function (data, type, row) {

return data + ' ('+row.ta+')'

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
                    data: 'jmlh_kertas',
                    name: 'jmlh_kertas',
                    render: function (data, type, row) {

                        return data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                    }
                },
                {
                    data: 'updated_at',
                    name: 'updated_at',
                    render: function (data, type, row) {
                        return moment(data, "YYYY/MM/DD").format('DD/MM/YYYY');
                        // return data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                    }
                },
                {
                    data: 'lini',
                    name: 'lini',
                    render: function (data, type, row) {
                        return 'Lini '+data
                        // return data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                    }
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
                        // return data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                    }
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




 





    });

</script>

@endsection
