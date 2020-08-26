<?php

namespace App\Http\Controllers;

use App\Pengujian;
use App\Jadwal;
use App\Update;
use App\Photo;
use App\LampiranOrder;
use App\Revisi;
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Helpers\AuthHelper;
use Redirect;
use Validator;
use Response;
use Image;
use PDF;
use Illuminate\Http\Request;

class LampiranOrderController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function index()
    { 

       
        if (request()->ajax()) {
            return datatables()->of(LampiranOrder::orderBy('no_lampiran','asc')->groupBy('no_lampiran','pecahan','ta')->get())
                    ->addColumn('action', 'action_butt_lampiran')
                    ->rawColumns(['action'])
                    ->addIndexColumn()
                    ->make(true);
        }
        // $tes=LampiranOrder::orderBy('no_lampiran','asc')->groupBy('no_lampiran','pecahan','ta')->get();
        // dd($tes);
        return view('lampiranorder.index_lampiran');

    }
    public function view($idpesanan,$no_lampiran,$pecahan,$ta)
    {
        $np = DB::table('tbl_pegawai')->get();
        if (request()->ajax()) {
            
            return datatables()->of(LampiranOrder::where('no_lampiran',$no_lampiran)
            ->where('idpesanan',$idpesanan)
            ->where('pecahan',$pecahan)
            ->where('ta',$ta)
            ->orderBy('nomor_order','asc')
                    ->get()) 
                   ->addColumn('action', 'action_butt_tmbah')
                   ->rawColumns(['action'])
                        ->addIndexColumn()
                        ->make(true);
        }
      
        return view('lampiranorder.view',[
            'idpesanan'=>$idpesanan,
            'nolampiran'=>$no_lampiran,
            'pecahan'=>$pecahan,
            'ta'=>$ta,
            'np'=>$np
        ]);
    }
  
    public function store(Request $request)
    {
        // dd("te");
        $username = AuthHelper::getAuthUser()[0]->email;
        $getRequest=json_decode($request->getContent(), true);
        $dataRequest=$getRequest['Order']; 
        $countDataReq=count($dataRequest);
        $status=1; 
        foreach ($dataRequest as $row) {
        //    if($row['id']==""){
        //     $lastRecordID++;
        //     $row['id']=$lastRecordID;
        //    }

            if($row['update']== "update"){
                // $status=3;
                $insertUpdate = array(
                    
                    'idLampiran'       	=>    $row['id'],
                    'keterangan'   	=>  $row['keterangan'],
                    'order'   	=>  $row['nomor_order'],
                    'pecahan'   	=>  $row['pecahan'],
                    'noseri'   	=>  $row['seri'],
                    'lini'   	=>  $row['lini'],
                    'catatan'   	=>  $row['catatan'],
                    'revisi'   	=>  $row['revisi'],
                    'np'                   => $row['np'],
                'created_by'            => $username,
                // 'created_at'            => date('Y-m-d')
                );
                Update::create($insertUpdate);
            } 
            if($row['status'] != "0"){
                $status=$row['status'];
            }else{
                $status=$status;
            } 
            if(LampiranOrder::where('id', '=', $row['id'])->exists()){
                $data_uji = array(
                    'pemasok'   	=>  $row['pemasok'],
                    'no_ba'   		=>  $row['no_ba'],
                    'tanggal'   	=>  $row['tanggal'],
                    'jmlh_kertas'  	=>  $row['jmlh_kertas'],
                    'invoice'     	=>  $row['invoice'],
                    'keterangan'   	=>  $row['keterangan'],
                    'lot_bi'       	=>  $row['lot_bi' ],
                    'lini'   	    =>  $row['lini'],
                    'catatan'   	=>  $row['catatan'],
                    'revisi'   	    =>  $row['revisi'],
                    'status'       	=>  $status,
                    'np'                   => $row['np'],
                'changed_by'            => $username,
                // 'created_at'            => date('Y-m-d')
                );
                LampiranOrder::where('id', '=', $row['id'])
                ->update($data_uji);
            }else{
                 
                $data_uji = array( 
                    'idpesanan'     =>  $row['idpesanan'],
                    'pecahan'       =>  $row['pecahan'],
                    'ta'            =>  $row['ta'],
                    'tahun_emisi'   =>  $row['tahun_emisi'],
                    'no_lampiran'   =>  $row['no_lampiran'],
                    'nomor'         =>  $row['nomor'],
                    'nomor_order'   =>  $row['nomor_order'],
                    'seri'   	    =>  $row['seri'],
                    'pemasok'   	=>  $row['pemasok'],
                    'no_ba'   		=>  $row['no_ba'],
                    'tanggal'   	=>  $row['tanggal'],
                    'jmlh_kertas'  	=>  $row['jmlh_kertas'],
                    'invoice'     	=>  $row['invoice'],
                    'keterangan'   	=>  $row['keterangan'],
                    'lot_bi'       	=>  $row['lot_bi' ],
                    'lini'   	    =>  $row['lini'],
                    'catatan'   	=>  $row['catatan'],
                    'revisi'   	    =>  $row['revisi'],
                    'level'   	    =>  $row['level'],
                    'status'       	=>  $status,
                    'np'                   => $row['np'],
                'created_by'            => $username,
                // 'created_at'            => date('Y-m-d')
                ); 

                LampiranOrder::create($data_uji);
            }
            $data_uji +=array(
            'pecahan'       =>  $row['pecahan'],
            'ta'            =>  $row['ta'],
            'tahun_emisi'   =>  $row['tahun_emisi'],
            'no_lampiran'   =>  $row['no_lampiran'],
            'nomor'         =>  $row['nomor'],
            'nomor_order'   =>  $row['nomor_order'],
            'seri'   	    =>  $row['seri'],
            'idlampiran'   =>  $row['id'],
            'idpesanan'     =>  $row['idpesanan'],
            'np'                   => $row['np'],
            'created_by'            => $username,
            // 'created_at'            => date('Y-m-d')
        
        );
        // dd( $data_uji);
            Revisi::create($data_uji);
            
            // \DB::table('countries')->whereIn('id', [1, 2])->update(['code' => 'AD']);
            
            // $itemTypes = [1, 2, 3, 4, 5];

// ItemTable::whereIn('item_type_id', $itemTypes)
//     ->update([
//         'colour' => 'black',
//         'size' => 'XL',
//         'price' => 10000 // Add as many as you need
//     ]);
            // HasilBeacukai::create($data_beacukai);
        }
        return response()->json(['success' => $countDataReq.' Entri Berhasil Di Simpan']);
    }

  

    public function edit($id)
    {
        $where = array('id' => $id);
        $user  = Pengujian::where($where)->first();
        return Response::json($user);
    }

    public function destroy($id)
    {
        $data = Pengujian::findOrFail($id);
        $hasilbeacukai = HasilBeacukai::findOrFail($id);
        $data->delete();
        $hasilbeacukai->delete();
        return response()->json(['success' => 'Item Uji Berhasil Di Di Hapus']);
    }
    public function saveNewRow(Request $request)
    {

        // dd($request->all());
        LampiranOrder::create($request->all());
        return response()->json(['success' => 'Baris Baru Di Tambahkan']);
        // $lastRecordID=LampiranOrder::latest()->first();

        // foreach ($dataRequest as $row) {
        // }
          
    }
    public function saveDeleteRow(Request $request)
    {
//  dd($request->all());
        LampiranOrder::whereId($request->id)->delete();
        return response()->json(['success' => 'Baris Terhapus']);
    }
    public function update(Request $request)
    {
          
    }

    public function getUpdate(Request $request)
    {
        
        $dataUpdate=Update::all();
        return response()->json([
            'dataUpdate'    => $dataUpdate, 
            
        ]);
    }
    public function delUpdate(Request $request)
    {
        
        $dataUpdate=Update::truncate();
        
    }
 
}
