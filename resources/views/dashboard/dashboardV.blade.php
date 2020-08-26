<div class="tab-pane fade show" id="tabsv" role="tabpanel" aria-labelledby="v">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Pecahan V (Rp. 10.000)</h3>
            </div>
             
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                    {{-- {{$data->nama_pecahan}} --}}
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Jumlah Order NKRI</h5>
                            <span class="h2 font-weight-bold mb-0"
                                id="jmlh_ordery">{{$dataDashboard['pecahanV']->jmlOrder}}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                <i class="fas fa-chart-bar"></i>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        {{-- @endforeach --}}
        <div class="card card-stats mb-3 mb-xl-6">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">LKU Tercetak Nomor</h5>
                        <span class="h2 font-weight-bold mb-0"
                            id='lku_tercetaky'>{{$dataDashboard['pecahanV']->lku_tercetak}}</span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                            <i class="fas fa-percent"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Jumlah Order Terbit</h5>
                            <span class="h2 font-weight-bold mb-0"
                                id='order_terbity'>{{$dataDashboard['pecahanV']->order_terbit}}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                <i class="fas fa-chart-bar"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Jumlah LPK Terbit</h5>
                            <span class="h2 font-weight-bold mb-0"
                                id='lpk_terbity'>{{$dataDashboard['pecahanV']->lpk_terbit}}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                <i class="fas fa-chart-bar"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-3 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Jumlah LPK Selesai</h5>
                            <span class="h2 font-weight-bold mb-0"
                                id='lpk_selesaiy'>{{$dataDashboard['pecahanV']->lpk_selesai}}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                <i class="fas fa-chart-bar"></i>
                            </div>
                        </div>
                    </div>
                    {{-- <p class="mt-3 mb-0 text-muted text-sm">
                            <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                            <span class="text-nowrap">Since last month</span>
                        </p> --}}
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h6 class="card-title text-uppercase text-muted mb-0">LKU Tercetak Nomor Lini A
                            </h6>
                            <span class="h2 font-weight-bold mb-0"
                                id="lku_tercetak_liniay">{{$dataDashboard['pecahanV']->lku_linia}}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                <i class="fas fa-chart-bar"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h6 class="card-title text-uppercase text-muted mb-0">LKU Tercetak Nomor Lini B
                            </h6>
                            <span class="h2 font-weight-bold mb-0"
                                id="lku_tercetak_liniby">{{$dataDashboard['pecahanV']->lku_linib}}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                <i class="fas fa-chart-bar"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>




</div>