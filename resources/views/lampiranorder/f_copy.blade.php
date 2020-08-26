<style type="text/css">
    .copy {
        display: none;
    }

</style>

<div class="row">
    <div class="col-lg-2" >

        <div class="form-group">
        <input type="text" class="form-control" name="maxkertas" id="maxkertas" placeholder="Jumlah max kertas"
            aria-label="Recipient's username" aria-describedby="basic-addon2" />
        </div>
            <span class="badge-lg badge-pill badge-danger" id="jmlinsit">Insit</span>

    </div>
    {{-- <span class="badge-lg badge-pill badge-default">Default</span> --}}
    <div class="col-lg-2"  >


        <div class="form-group">
            {{-- <label class="form-control-label" for="input-first-name">Insit (%) </label> --}}
            {{-- <label for="insitpersen">Insit (%) </label> --}}
            <input type="text" name="insit_persen" placeholder="Insit Persen" id="insit_persen"
                class="form-control" data-inputmask='"mask": "9.99"' data-mask>

        </div>

    </div>
    <div class="col-lg-2"  >


        <button type="button" name="check" id="check" class="btn btn-info"><i class="fa  fa-refresh"></i>
            Check</button>

    </div>

    


    <div class="col-lg-2"  >


        <select name="pilihan" id="pilihan" class="form-control" style="width: 100%;">
            <option disabled selected>-Pilih Form-</option>

            <option value="pemasok">Pemasok</option>
            <option value="no_ba">No. BA</option>
            <option value="tanggal">Tanggal</option>
            <option value="jmlh_kertas">Jumlah Kertas</option>
            <option value="invoice">Invoice</option>
            <option value="keterangan">Keterangan</option>
            <option value="lot_bi">Lot BI</option>
            <option value="status">Status</option>
            <option value="lini">Lini</option>
            <option value="np">NP</option>

        </select>


    </div>
    <div class="col-lg-2" id="jumlah">
        <form id="formcopy">
            <input type="text" class="copy form-control" name="pemasok" id="pemasok" placeholder="pemasok"
                aria-label="Recipient's username" aria-describedby="basic-addon2" />
            <input type="text" class="copy form-control" name="no_ba" id="no_ba" placeholder="No. BA"
                aria-label="Recipient's username" aria-describedby="basic-addon2" />
            <div class="input-group" style="width: 10rem;">
                <div class="input-group-prepend">
                    <span class="copy input-group-text" id="tgl"><i class="ni ni-calendar-grid-58"></i></span>
                </div>
                <input class="copy form-control datepicker" placeholder="Select date" type="text" name="tanggal"
                    id="tanggal" value="" autocomplete=off>
            </div>
            <input type="text" class="copy form-control" name="tanggal" id="tanggal" placeholder="Tgl "
                aria-label="Recipient's username" aria-describedby="basic-addon2" />
            <input type="text" class="copy form-control" name="jmlh_kertas" id="jmlh_kertas" placeholder="Jumlah Kertas"
                aria-label="Recipient's username" aria-describedby="basic-addon2" />
            <input type="text" class="copy form-control" name="invoice" id="invoice" placeholder="Invoice"
                aria-label="Recipient's username" aria-describedby="basic-addon2" />
            <input type="text" class="copy form-control" name="keterangan" id="keterangan" placeholder="Keterangan"
                aria-label="Recipient's username" aria-describedby="basic-addon2" />
            <input type="text" class="copy form-control" name="lot_bi" id="lot_bi" placeholder="Lot BI"
                aria-label="Recipient's username" aria-describedby="basic-addon2" />
                <select name="status" id="status" class="copy form-control" style="width: 100%;">
                    <option disabled selected>-Pilih Status-</option> 
                    <option value="0">Belum Rilis</option>
                    <option value="1">Order Rilis</option>
                    <option value="2">Order Proses Cetak</option>
                    <option value="3">Order Revisi</option>
                    <option value="4">Order Selesai</option> 
        
                </select>
                <select name="lini" id="lini" class="copy form-control" style="width: 100%;">
                    <option disabled selected>-Pilih Lini-</option>
        
                    <option value="A">Lini A</option>
                    <option value="B">Lini B</option>
                    
        
                </select>
              
                    <select name="np" id="np" class="copy form-control"
                        style="width: 100%;">
                        <option value="" disabled selected>-</option>
                        @foreach($np as $data)
                        <option value="{{$data->np}}">{{$data->np}} </option>
                        @endforeach
                    </select>
               

        </form>

    </div>
    <div class="col-lg-2" id="jumlah">
        <button type="button" name="copy" id="copy" class="btn btn-info"><i class="fa  fa-refresh"></i>
            Copy</button>


    </div>


</div>
