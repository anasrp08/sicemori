<div class="row">
    <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
        <div class="card card-profile shadow">
            <div class="row justify-content-center">
                <div class="col-lg-3 order-lg-2">
                    <div class="card-profile-image">
                        {{-- <p class="rounded-circle"> T</p> --}}
                        <a href="#">
                            <img id="pecahangambar" src="" class="rounded-circle">
                        </a>
                    </div>
                    {{-- <div class="text-center">
                      <h3>
                          Jessica Jones<span class="font-weight-light">, 27</span>
                      </h3>
                  </div> --}}
                </div>
            </div>
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                <div class="d-flex justify-content-between">
                    {{-- <a href="#" class="btn btn-sm btn-info mr-4">Connect</a>
                  <a href="#" class="btn btn-sm btn-default float-right">Message</a> --}}
                </div>
            </div>
            <div class="card-body pt-0 pt-md-4">
                <div class="text-center" style="margin-top: 5rem;">
                    <h3>
                        
                        <span class="font-weight-light">Total Pesanan</span> <h1><span class="heading badge badge-primary" id='total_pesanan'>xxxxxxx</span></h1>
                    </h3>
                </div>
                <div class="row">

                    <div class="col">

                        <div class="card-profile-stats d-flex justify-content-center mt-md-0">

                            <div>
                                <h1><span class="heading badge badge-primary" id='total_order'>xxx</span></h1>
                                {{-- <span class="heading" id='total_order'>xxx</span> --}}
                                <span class="description">Total Seluruh Order</span>
                            </div>
                            <div>
                                <h1><span class="heading badge badge-primary" id='order_insit'>xxx</span></h1>
                                {{-- <span class="heading" id="order_insit">xxx</span> --}}
                                <span class="description">Order Insit</span>
                            </div>
                            <div>
                                <h1><span class="heading badge badge-primary" id='order_tnpinsit'>xxx</span></h1>
                                {{-- <span class="heading" id="order_tnpinsit">xxx</span> --}}
                                <span class="description">Order Tanpa Insit</span>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-4" />
                <div class="row">

                    <div class="col">

                        <div class="card-profile-stats d-flex justify-content-center mt-md-0">

                            <div>
                                <h1><span class="heading badge badge-primary" id='jumlah_insit'>xxxxxxx</span></h1>
                                {{-- <span class="heading" id='jumlah_insit'>xxxxxxx</span> --}}
                                <span class="description">Jumlah Insit (bilyet)</span>
                            </div>
                            <div>
                                <h1><span class="heading badge badge-primary" id='lembar_insit'>xxxxxxx</span></h1>
                                {{-- <span class="heading" id="lembar_insit">xxxxxxx</span> --}}
                                <span class="description">Jumlah Insit (Lbr)</span>
                            </div>
                            {{-- <div>
                              <span class="heading">89</span>
                              <span class="description">Order Tanpa Insit</span>
                          </div> --}}
                        </div>
                    </div>
                </div>


                <div class="text-center">
                    {{-- <h3>
                      <span class="font-weight-light">Jumlah Insit (Bilyet)</span> Jessica Jones<span>Jessica Jones</span>
                  </h3>
                  <h3>
                      <span class="font-weight-light">Jumlah Insit (Lbr)</span> Jessica Jones<span>Jessica Jones</span>
                  </h3> --}}
                    {{-- <div class="h5 mt-4">
                      <i class="ni business_briefcase-24 mr-2"></i>Solution Manager - Creative Tim Officer
                  </div>
                  <div>
                      <i class="ni education_hat mr-2"></i>University of Computer Science
                  </div>
                  <hr class="my-4" />
                  <p>Ryan — the name taken by Melbourne-raised, Brooklyn-based Nick Murphy — writes, performs and
                      records all of his own music.</p>
                  <a href="#">Show more</a> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-8 order-xl-1">
        <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">Buat Pesanan</h3>
                    </div>
                    <div class="col-4 text-right">
                        {{-- <a href="#!" class="btn btn-sm btn-primary" id="pecahan_title">Pecahan X</a> --}}
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form method="post" id="create_pesanan" enctype="multipart/form-data">
                    @csrf
                    <h6 class="heading-small text-muted mb-4">Detail Pesanan</h6>
                    <input type="hidden" name="total_pesanan1" id="total_pesanan1" />
                    <input type="hidden" name="total_order1" id="total_order1" />
                    <input type="hidden" name="order_insit1" id="order_insit1" />
                    <input type="hidden" name="order_tnpinsit1" id="order_tnpinsit1" />
                    <input type="hidden" name="jumlah_insit1" id="jumlah_insit1" />
                    <input type="hidden" name="lembar_insit1" id="lembar_insit1" />
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">

                                    <label class="form-control-label" for="input-username">Pecahan</label>
                                    <select name="pecahan" id="pecahan" class="form-control select2"
                                        style="width: 100%;">
                                        <option value="" disabled selected>-Pilih Pecahan-</option>
                                        @foreach($pecahan as $data)
                                        <option value="{{$data->kode_pecahan}}">{{$data->kode_pecahan}}
                                            ({{$data->nama_pecahan}}) </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">Jumlah Pesanan</label>
                                    <div class="input-group">

                                        <input type="text" class="form-control" name="jumlah_pesanan"
                                            id="jumlah_pesanan" placeholder="Jumlah Pesanan"
                                            aria-label="Recipient's username" aria-describedby="basic-addon2" />
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">Bilyet</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">

                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">Tahun Anggaran</label>
                                    <select name="tahun" id="tahun" class="form-control select2" style="width: 100%;">
                                        <option value="" disabled selected>-Pilih Tahun-</option>
                                        @foreach($tahun as $data)
                                        <option value="{{$data['ta']}}">{{$data['tahun']}} ({{$data['ta']}})
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">Tahun Emisi</label>
                                    <select name="tahun_emisi" id="tahun_emisi" class="form-control select2"
                                        style="width: 100%;">
                                        <option value="" disabled selected>-Pilih Tahun-</option>
                                        @foreach($te as $data)
                                        <option value="{{$data->te}}">{{$data->tahun}} ({{$data->te}}) </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">Insit (%) </label>
                                    {{-- <label for="insitpersen">Insit (%) </label> --}}
                                    <input type="text" name="insit_persen" placeholder="Target Insit" id="insit_persen"
                                        class="form-control" data-inputmask='"mask": "9.99"' data-mask>

                                </div>

                            </div>


                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <button id="refresh" class="btn btn-success">Cek Data</button>

                            </div>
                        </div>




                    </div>

                    <hr class="my-4" />
                    <!-- Address -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group text-center">
                                <label class="form-control-label" for="input-city">Seri Huruf Terakhir Di
                                    Sistem</label><br>
                                    <h1><span class="badge badge-primary" id='lastseri'>xxx-xxx || xxx-xxx</span></h1>
                                {{-- <label class="form-control-label" for="input-city" id='lastseri'></label> --}}

                            </div>
                        </div>


                        <div class="col-lg-6">
                            <div class="form-group text-center">
                                <label class="form-control-label" for="input-city">Seri Nomor Terakhir</label><br>
                                <h1><span class="badge badge-primary" id='lastno'>xxxxxx xxxxxx</span></h1> 
                            </div>
                        </div>
                    </div>
                    <hr class="my-4" />
                    <h6 class="heading-small text-muted mb-4">Seri Huruf Uang Dimulai</h6>
                    <div class="pl-lg-4">

                        <div class="row">

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-city">Seri Huruf Awal</label>
                                    {{-- <label for="seriterakhir">Seri Terakhir</label> --}}
                                    <input type="text" name="seri_terakhir" id="seri_terakhir" class="form-control"
                                        placeholder="seri terakhir pecahan" value=""
                                        data-inputmask='"mask": "A A A  A A A"' >

                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-city">Seri Huruf Akhir</label>
                                    <label for="seriterakhir"> </label>
                                    <input type="text" name="seri_terakhir2" id="seri_terakhir2" class="form-control"
                                        placeholder="seri terakhir pecahan" value=""
                                        data-inputmask='"mask": "A A A  A A A"' >
                                </div>


                            </div>

                            <div class="col-lg-6">

                                <div class="form-group">
                                    <label class="form-control-label" for="input-city">Seri Nomor Dimulai</label>
                                    {{-- <label for="seriterakhir">Seri Terakhir</label> --}}
                                    <input type="text" name="nomor_terakhir" id="nomor_terakhir" class="form-control"
                                        placeholder="nomor terakhir" value="" data-inputmask='"mask": "999999-999999"'
                                        >
                                </div>
                            </div>

                        </div>
                    </div>

                    <hr class="my-4" />
                    <h6 class="heading-small text-muted mb-4">Nomor Order Dimulai</h6>
                    <div class="pl-lg-4">

                        <div class="row">
                            <div class="form-group text-center">
                                <label class="form-control-label" for="input-city">Nomor Order Terakhir</label><br>
                                <h1><span class="badge badge-primary" id="lastorder">xxxxxx</span></h1> 
                                {{-- <label class="form-control-label " for="input-city" id="lastorder" >xxxxxx</label> --}}
                                {{-- <input type="text" name="lastorder" id="lastorder" class="form-control" readonly> --}}
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-city">Nomor Order Dimulai</label>
                                    {{-- <label for="seriterakhir">Seri Terakhir</label> --}}
                                    <input type="text" name="order_terakhir" id="order_terakhir" class="form-control"
                                        placeholder=" order terakhir" value=""  data-inputmask-regex=" \d{2}"
                                        data-mask>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">Nomor Pegawai</label>
                                    <select name="np" id="np" class="form-control select2"
                                        style="width: 100%;">
                                        <option value="" disabled selected>-</option>
                                        @foreach($np as $data)
                                        <option value="{{$data->np}}">{{$data->np}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="box-footer">
                            <button id="submit" type="submit" class="btn btn-success">Simpan</button>

                            {{-- <button id="edit" class="btn btn-warning">Edit No. Order & Seri Terakhir </button> --}}

                        </div>
                </form>
            </div>
        </div>

    </div>

</div>
