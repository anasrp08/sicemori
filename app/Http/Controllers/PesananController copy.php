<?php

namespace App\Http\Controllers;

use App\TahunAnggaran;
use App\Pesanan;
use App\LampiranOrder;
use App\TransacBA;
use DateTime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Redirect;
use Validator;
use Response;
use DB;
use PDF;
// B B A  B B Z
// C B A  C B Z

// 700001-800000
class PesananController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function view()
    { 
        
        $tahun_anggaran = TahunAnggaran::all()->toArray();
       $pecahan =  DB::table('tbl_pecahan')->get();
       $tahun_emisi = DB::table('tbl_thn_emisi')->get();
  
        return view('pesanan.create', [
            'tahun'=>$tahun_anggaran,
            'pecahan'=>$pecahan, 
            'te'=>$tahun_emisi, 
        ]);
    }
    public function create()
    { 
    }
    public function viewIndex()
    { 
         
         return view('pesanan.index', [
        
        ]);
    }
    public function show()
    {
    }
    public function getDataPesanan(Request $request)
    { 
         
       $pecahan =  DB::table('tbl_lampiran_order')->where('pecahan',$request->pecahan)->latest('nomor_order')->limit(2)->get();
    //    dd($pecahan);
       $tahun_emisi = DB::table('tbl_thn_emisi')->get();;
  
       return response()->json(['data' =>  $pecahan]);
    }
    public function index()
    {
 
        if (request()->ajax()) {
            return datatables()->of(Pesanan::latest()->first()->get())
            
                    ->addColumn('action', 'action_button_pesanan')
                    ->rawColumns(['action'])
                    ->addIndexColumn()
                    ->make(true);
        }
 
        // return view('pesanan.index', [
        
        // ]);

    }

     

    public function store(Request $request)
    {
    
        $error =null;
        $rules = array(
        'jumlah_pesanan'     =>  'required'	,
        'seri_terakhir'			=>  'required'	, 
        'pecahan'			=>  'required'	,
        'tahun'	=>  'required'	,
        'order_terakhir'=> 'required',
        'insit_persen'	=>  'nullable'	, 
      
        );
        $messages = array(
            'jumlah_pesanan.required' => 'form jumlah pesanan harus diisi.',
            'seri_terakhir.required' => 'form seri terakhir harus diisi.',
            'pecahan.required' => 'form pecahan harus diisi.',
            'tahun.required' => 'form tahun harus diisi.', 
            'order_terakhir.required'=> 'form order harus diisi'
            
        );
      
 
        $error = Validator::make($request->all(), $rules, $messages);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        

        $form_data = array(
            'jumlah_pesanan'		    =>  $request->jumlah_pesanan,
            'seri_terakhir'		    =>  $request->seri_terakhir2." || ".$request->seri_terakhir2,
            'pecahan'			    =>  $request->pecahan,
            'tahun'                 =>  $request->tahun	, 
            'tahun_emisi'           =>  $request->tahun_emisi	, 
            'insit_persen'	        =>  $request->insit_persen,
            'order_terakhir'	    =>  $request->order_terakhir,
            'nomor_terakhir'	    =>  $request->nomor_terakhir,
            'jumlah_insit'	        =>   $request->jumlah_insit1,
            'lembar_insit'  	    =>   $request->lembar_insit1,
            'order_tnpinsit'	    =>  $request->order_tnpinsit1,
            'order_insit'	        =>  $request->order_insit1,
            'total_order'	        =>  $request->total_order1,
            'total_pesanan'         => $request->total_pesanan1,
        );

        $insertId=Pesanan::create($form_data)->id;
        
        $alpha1=substr(str_replace(' ','',$request->seri_terakhir), 0, 3);
        $alpha2=substr(str_replace(' ','',$request->seri_terakhir), -3);
        $alpha3=substr(str_replace(' ','',$request->seri_terakhir2), 0, 3);
        $alpha4=substr(str_replace(' ','',$request->seri_terakhir2), -3);
        $splitnomor=explode("-",$request->nomor_terakhir);
        // $numb1=$splitnomor[0];
        // $numb2=$splitnomor[1];
        $lastNoOrder=$request->order_terakhir;
        $order=$request->total_order;

        $number1=substr((int)$splitnomor[0],0,1);
        $number2=substr((int)$splitnomor[1],0,1);
        
        $lastNo=(int) substr($lastNoOrder,-3);
        $splitNo=(int) substr($lastNoOrder,0,4);
        
        //first letter
        $huruf1= $alpha1[0];
        $huruf2=$alpha1[1];
        $huruf3=$alpha1[2];
        //sceond letter
        $huruf7= $alpha2[0];
        $huruf8= $alpha2[1];
        $huruf9= $alpha2[2];

        // {Down}
        $huruf4= $alpha3[0];
        $huruf5=$alpha3[1];
        $huruf6=$alpha3[2];
        //second
        $huruf10= $alpha4[0];
        $huruf11=$alpha4[1];
        $huruf12=$alpha4[2];

        // $huruf4++;
        // dd($numb1[0]);
        $collectNumber1=array(); 
        $concatNumb1=null;
        $concatNumb2=null; 
        $padNumber1="00000";
        $padNumber2="00001";

        for($i=1;$i<=$order;$i++){
            $number1++;
            $number2++;
            $lastNo++;
            
            if($number1 > 9){
                $number1=0;
                $concatNumb1=$number1. $padNumber2;
            }else {
                $concatNumb1=$number1. $padNumber2;
            }

            if($number1 == 9){
                $concatNumb1= $number1. $padNumber2;
            
            }

            if($number2 > 9){
                $number2--;
                $concatNumb2=$number2."99999";
                $number2=0;
            }else {
                $concatNumb2=$number2. $padNumber1;
            }


            if( $concatNumb2=="100000"){
                //looping abjad
                $huruf1=$this->increment($huruf1,$request->pecahan,2);
                $huruf4=$this->increment($huruf4,$request->pecahan,2);

                $huruf7=$this->increment($huruf7,$request->pecahan,2);
                $huruf10=$this->increment($huruf10,$request->pecahan,2);
                if( $huruf1=="A"){
                    $huruf2++;
                }
                $letterFirstUp=$huruf1." ".$huruf2." ".$huruf3;
                $letterFirstDown=  $huruf4." ".$huruf2." ".$huruf6;

                $letterSecondUp= $huruf7." ".$huruf2." ".$huruf9;
                $letterSecondDown= $huruf10." ".$huruf2." ".$huruf12;
                 
            }else{

                $letterFirstUp= $huruf1." ".$huruf2." ".$huruf3;
                $letterFirstDown= $huruf4." ".$huruf2." ".$huruf6;

                $letterSecondUp= $huruf7." ".$huruf2." ".$huruf9;
                $letterSecondDown= $huruf10." ".$huruf2." ".$huruf12;

            }

            $concatAllNumber=$concatNumb1."-".$concatNumb2;
              
                array_push($collectNumber1, array(
                'nomor_order'=>$splitNo.$lastNo, 
                'pecahan'=> $request->pecahan,
                'ta'=>$request->tahun,
                'tahun_emisi'=>$request->tahun_emisi,
                'seri'=> $letterFirstUp." - ".$letterSecondUp." || ". $letterFirstDown." - ".$letterSecondDown,
                'nomor'=>$concatAllNumber
                 
            ));
            
  
        }  
        $count=1;
        $nolampiran=1;
        
        for($i=0;$i<=count($collectNumber1)-1;$i++){ 
            $data_lampiran = array(
                'idpesanan'  =>$insertId,
                'pecahan'    => $collectNumber1[$i]['pecahan'],    
                'ta'         => $collectNumber1[$i]['ta'],    
                'tahun_emisi'         => $collectNumber1[$i]['tahun_emisi'],    
                'nomor_order'=> $collectNumber1[$i]['nomor_order'],
                'seri'       => $collectNumber1[$i]['seri'],       
                'nomor'      => $collectNumber1[$i]['nomor'],  
                'no_lampiran'=> $nolampiran,
                'status'=>"0"
                 
            );
            LampiranOrder::create($data_lampiran);
            if($count == 12){
                $nolampiran++;
                $count=1;
            }else{
                $count++;
            }
            
        }
     
        return response()->json(['success' => 'Pesanan Berhasil Di Simpan']);
    }

    public function increment($val,$pecahan, $increment = 2)
    {
        // $val="W";
    for ($i = 1; $i <= $increment; $i++) {
        $val++;
        //huruf I tidak ada di pecahan VWXY
        if($pecahan=="V" || $pecahan=="W" ||$pecahan=="X" || $pecahan=="Y"){
            if($val=="I"){
                $val++;
            }
        } 
        //huruf X di skip
        if($val=="X"){
            $val++;
        }
         
        if($val=="AA"){
            $val="A";
            $val++;
        }
    }

    return $val;
    }

    public function update(Request $request)
    {
        $error =null;
        $rules = array(
        'pilihuji'			=>  'required'	,
        'nosurat'			=>  'required'	,
        'kantor'			=>  'required'	,
       
        'tglsuratkantor'	=>  'required'	,
        'tglsuratperintah'	=>  'nullable'	,
        'filekantor'		=>  'nullable|mimes:pdf|max:2048',
        'filesuratperintah'	=>  'nullable|mimes:pdf|max:2048'
            // 'image'         =>  'required|image|max:2048'
        );
        
        $pathname1=explode("/", $request->nosurat);
 
        // dd($tes2[0]);
 
        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $tglsuratkantor = DateTime::createFromFormat("d/m/Y", $request->tglsuratkantor);
        $tglsuratkantor = $tglsuratkantor->format('Y/m/d');
 
        $tglsuratperintah=null;
        if ($request->tglsuratperintah) {
            $tglsuratperintah = DateTime::createFromFormat("d/m/Y", $request->tglsuratperintah);
            $tglsuratperintah = $tglsuratperintah->format('Y/m/d');
        }
        
        $filename_srtkantor=null;
        $filename_srtperintah=null;
        $savepath_srtkantor=null;
        $savepath_srtperintah=null;
        $filepathpdf=null;
        $path_srtkantor = public_path(). DIRECTORY_SEPARATOR .'file'. DIRECTORY_SEPARATOR .'SURAT KANTOR'. DIRECTORY_SEPARATOR .$pathname1[0];
        $path_srtperintah = public_path(). DIRECTORY_SEPARATOR .'file'. DIRECTORY_SEPARATOR .'SURAT PERINTAH'. DIRECTORY_SEPARATOR .$pathname1[0];
 
      
        if ($request->hasFile('filekantor')) {
            if (!File::exists($path_srtkantor)) {
                // path does not exist
                File::makeDirectory($path_srtkantor, $mode = 0777, true, true);
            }
            $upload_file=$request->file('filekantor');
            $extension=$upload_file->getClientOriginalExtension();
            // $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'file';
            $filename_srtkantor='SURATKANTOR'.'_'.$pathname1[0].'.'.$extension;
            $upload_file->move($path_srtkantor, $filename_srtkantor);
        }

        if ($request->hasFile('filesuratperintah')) {
            if (!File::exists($path_srtperintah)) {
                // path does not exist
                File::makeDirectory($path_srtperintah, $mode = 0777, true, true);
            }
            
            $upload_file=$request->file('filesuratperintah');
            $extension=$upload_file->getClientOriginalExtension();
            // $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'file';
            $filename_srtperintah='SURATPERINTAH'.'_'.$pathname1[0].'.'.$extension;
            $upload_file->move($path_srtperintah, $filename_srtperintah);
        }


        $savepath_srtkantor='file/'.'SURAT KANTOR'. '/' .$pathname1[0].'/'.$filename_srtkantor;

        if ($request->hasFile('filesuratperintah')) {
            $savepath_srtperintah='file/'.'SURAT PERINTAH'. '/' .$pathname1[0].'/'.$filename_srtperintah;
        }

        $form_data = array(
            'pilihuji'			=>  $request->pilihuji	,
            'nosurat'			=>  $request->nosurat	,
            'kantor'			=>  $request->kantor	,
           
            'tglsuratkantor'	=>  $tglsuratkantor	,

            'tglsuratperintah'	=>  $tglsuratperintah	,

            'filekantor'		=>  $savepath_srtkantor,
            'filesuratperintah'	=>  $savepath_srtperintah
        );

        Jadwal::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Data Berhasil Di Update']);
    }

    public function updateStatus(Request $request)
    {
        $form_data = array(
                    'status'          =>  "Pengujian Selesai",
                    
                );

        Jadwal::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Status Berhasil Di Update', 'id' => $request->hidden_id]);
    }
    public function getGenerateBA()
    {
        $section2="TTF";
        $currMonth=date("m");
        
        $currYear=date("Y");
        $resultNo=DB::table('format_noba')->select('*')->get()->toArray();
        $nomor=(int)$resultNo[0]->nomor;
        // dd( $resultNo[0]->nomor);
        function numberToRomanRepresentation($number)
        {
            $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
            $returnValue = '';
            while ($number > 0) {
                foreach ($map as $roman => $int) {
                    if ($number >= $int) {
                        $number -= $int;
                        $returnValue .= $roman;
                        break;
                    }
                }
            }
            return $returnValue;
        }
        $no=sprintf('%04d', $nomor);
        $concatFormat=$no."/".$section2."/".numberToRomanRepresentation($currMonth)."/". $currYear;
        $nomor++;
        DB::table('format_noba')
        ->update(['nomor' => $nomor]);
       
        return  $concatFormat;
        // $tglsuratperintah = DateTime::createFromFormat("m/Y", $request->tglsuratperintah);
    }

    public function updateBA(Request $request)
    {
        $error =null;
        $rules = array(
         
        'tgl_ba'	=>  'nullable'	,
        'fileba'	=>  'nullable|mimes:pdf|max:2048'
            // 'image'         =>  'required|image|max:2048'
        );
        // dd($request);
        
        $pathname1=explode("/", $request->no_surat);
 
        // dd($tes2[0]);
 
        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }
         
        $tgl_ba = DateTime::createFromFormat("d/m/Y", $request->tgl_ba);
        $tgl_ba = $tgl_ba->format('Y/m/d');

        $filename_srtba=null;
        $savepath_srtba=null;
        
        $filepathpdf=null;
        $path_srtba = public_path(). DIRECTORY_SEPARATOR .'file'. DIRECTORY_SEPARATOR .'SURAT BA'. DIRECTORY_SEPARATOR .$pathname1[0];
        
 
      
        if ($request->hasFile('fileba')) {
            if (!File::exists($path_srtba)) {
                // path does not exist
                File::makeDirectory($path_srtba, $mode = 0777, true, true);
            }
            $upload_file=$request->file('fileba');
            $extension=$upload_file->getClientOriginalExtension();
            // $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'file';
            $filename_srtba='SURAT BA'.'_'.$pathname1[0].'.'.$extension;
            $upload_file->move($path_srtba, $filename_srtba);
        }
        $savepath_srtba='file/'.'SURAT BA'. '/' .$pathname1[0].'/'.$filename_srtba;
  
        $data_ba=array(
            'idjadwal'=>$request->hidden_id,
            'noba'	=>  $this->getGenerateBA(),
            'tglba'	=>  $tgl_ba	,
            'fileba'	=>  $savepath_srtba
        );
        $form_data = array(
            'status'	=>  "Pengujian Selesai"	,
            //kurang generate
            
        );
        // Jadwal::whereId($request->hidden_id)->update($form_data);

        // TransacBA::create($data_ba);
        Jadwal::where('id', $request->hidden_id)->update($form_data);
        TransacBA::where('id', $request->hidden_id)->update($data_ba);

        return response()->json(['success' => 'Data Berita Acara Berhasil Di Simpan']);
    }
    public function updateBalasan(Request $request)
    {
        $error =null;
        $rules = array(
        'no_srtbalasan'=>'required',
        'tgl_balasan'	=>  'required'	,
        'filebalasan'	=>  'required|mimes:pdf|max:2048'
        );
        $pathname1=explode("/", $request->no_surat);
  
        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }
         
        $tgl_balasan = DateTime::createFromFormat("d/m/Y", $request->tgl_balasan);
        $tgl_balasan = $tgl_balasan->format('Y/m/d');

        $filename_srtbalasan=null;
        $savepath_srtbalasan=null;
        
        $filepathpdf=null;
        $path_srtbalasan = public_path(). DIRECTORY_SEPARATOR .'file'. DIRECTORY_SEPARATOR .'SURAT BALASAN'. DIRECTORY_SEPARATOR .$pathname1[0];
        
 
      
        if ($request->hasFile('filebalasan')) {
            if (!File::exists($path_srtbalasan)) {
                // path does not exist
                File::makeDirectory($path_srtbalasan, $mode = 0777, true, true);
            }
            $upload_file=$request->file('filebalasan');
            $extension=$upload_file->getClientOriginalExtension();
            // $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'file';
            $filename_srtbalasan='SURAT BALASAN'.'_'.$pathname1[0].'.'.$extension;
            $upload_file->move($path_srtbalasan, $filename_srtbalasan);
        }
        $savepath_srtbalasan='file/'.'SURAT BALASAN'. '/' .$pathname1[0].'/'.$filename_srtbalasan;
 
 
        $form_data = array(
            'status'	=>  "Ada Surat Balasan"	,
            //kurang generate
            
        );
 
        $data_babalasan=array(
            'idjadwal'=>$request->hidden_id,
            'nobalasan'	    =>  $request->no_srtbalasan,
            'tglbalasan'	=>  $tgl_balasan,
            'filebalasan'	=>  $savepath_srtbalasan
        );

        Jadwal::where('id', $request->hidden_id)->update($form_data);
        TransacBA::where('id', $request->hidden_id)->update($data_babalasan);

        return response()->json(['success' => 'Data Balasan Berhasil Di Simpan']);
    }
    //kurang di front end panggil ajax
    public function updateTindak(Request $request)
    {
        $error =null;
        $rules = array(
        'no_srtindak'=>'required',
        'tgl_tindak'	=>  'required'	,
        'filetindak'	=>  'required|mimes:pdf|max:2048'
        );
        $pathname1=explode("/", $request->no_surat);
  
        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }
         
        $tgl_tindak = DateTime::createFromFormat("d/m/Y", $request->tgl_tindak);
        $tgl_tindak = $tgl_tindak->format('Y/m/d');

        $filename_srtbalasan=null;
        $savepath_srtbalasan=null;
        
        $filepathpdf=null;
        $path_srtbalasan = public_path(). DIRECTORY_SEPARATOR .'file'. DIRECTORY_SEPARATOR .'SURAT TINDAK'. DIRECTORY_SEPARATOR .$pathname1[0];
        
 
      
        if ($request->hasFile('filetindak')) {
            if (!File::exists($path_srtbalasan)) {
                // path does not exist
                File::makeDirectory($path_srtbalasan, $mode = 0777, true, true);
            }
            $upload_file=$request->file('filetindak');
            $extension=$upload_file->getClientOriginalExtension();
            // $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'file';
            $filename_srtbalasan='SURAT TINDAK'.'_'.$pathname1[0].'.'.$extension;
            $upload_file->move($path_srtbalasan, $filename_srtbalasan);
        }
        $savepath_srtbalasan='file/'.'SURAT TINDAK'. '/' .$pathname1[0].'/'.$filename_srtbalasan;
 
 
        $form_data = array(
            'status'	=>  "Ada Surat Tindak Lanjut"	,
            //kurang generate
            
        );
 
        $data_tindak=array(
            'idjadwal'=>$request->hidden_id,
            'notindak'	    =>  $request->no_srtindak,
            'tgltindak'	=>  $tgl_tindak,
            'filetindak'	=>  $savepath_srtbalasan
        );

        Jadwal::where('id', $request->hidden_id)->update($form_data);
        TransacBA::where('idjadwal', $request->hidden_id)->update($data_tindak);

        return response()->json(['success' => 'Data Tindak Lanjut Berhasil Di Simpan']);
    }
    public function updateSelesai(Request $request)
    {
        $error =null;
        
         
      
        $form_data = array(
            'status'	=>  "Jadwal Selesai"	,
            //kurang generate
            
        ); 

        Jadwal::where('id', $request->id)->update($form_data);
        

        return response()->json(['success' => 'Update Status Berhasil']);
    }

    public function destroy($id)
    {
        //
        // dd($id);
        $data = Jadwal::findOrFail($id);
        $datatransacBa = TransacBA::findOrFail($id);
        $data->delete();
        $datatransacBa->delete();
        return response()->json(['success' => 'Jadwal Berhasil Di Di Hapus']);
    }

    public function edit($id)
    {
        //
        $where = array('id' => $id);
        $user  = Jadwal::where($where)->first();
 
        return Response::json($user);
    }
}
