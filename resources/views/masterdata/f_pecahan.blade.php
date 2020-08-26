 {{-- <div class="card-body"> --}}
     <form method="post" id="f_pecahan" enctype="multipart/form-data">
         @csrf
         {{-- <h6 class="heading-small text-muted mb-4">Detail Pesanan</h6> --}}
         <input type="hidden" name="hiddentype" id="hiddentype" />
         <input type="hidden" name="id" id="id" />
         <div class="form-group">
            <label class="form-control-label" for="input-first-name">Kode Pecahan </label>
            {{-- <label for="insitpersen">Insit (%) </label> --}}
            <input type="text" name="kode"  id="kode"
                class="form-control">

        </div>
        <div class="form-group">
            <label class="form-control-label" for="input-first-name">Nama Pecahan </label>
            {{-- <label for="insitpersen">Insit (%) </label> --}}
            <input type="text" name="nama"  id="nama"
                class="form-control"  >

        </div>
        <div class="form-group">
            <label class="form-control-label" for="input-first-name">Max Kemas</label>
            {{-- <label for="insitpersen">Insit (%) </label> --}}
            <input type="text" name="maxkemas" id="maxkemas"
                class="form-control"  >

        </div>
        <div class="form-group">
            <label class="form-control-label" for="input-first-name">Keterangan</label>
            {{-- <label for="insitpersen">Insit (%) </label> --}}
            <input type="text" name="keterangan" id="keterangan"
                class="form-control"  >

        </div>
                
                 <div class="box-footer">
                     <button id="submit" type="submit" class="btn btn-success">Simpan</button>

                     {{-- <button id="edit" class="btn btn-warning">Edit No. Order & Seri Terakhir </button> --}}

                 </div>
     </form>
 {{-- </div> --}}
