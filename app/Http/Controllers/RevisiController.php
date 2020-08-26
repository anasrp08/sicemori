<?php

namespace App\Http\Controllers;

use App\Jadwal;
use App\MdKantor;
use App\TahunAnggaran;
use App\LampiranOrder;
use App\Revisi;
use App\MdPetugas;
use App\TransacBA;
use DateTime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Helpers\AuthHelper;
use Redirect;
use Validator;
use Response;
use DB;
use PDF;

class RevisiController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function view()
    { 
         
        return view('lampirankerja.lapor');
    }
    public function laporlpk()
    { 
        $tahun_anggaran = TahunAnggaran::all()->toArray();
        $pecahan =  DB::table('tbl_pecahan')->get();
        $tahun_emisi = DB::table('tbl_thn_emisi')->get();
        return view('lampirankerja.lapor',[
            'tahun'=>$tahun_anggaran,
            'pecahan'=>$pecahan, 
            'te'=>$tahun_emisi, 
        ]);
    }
    public function viewindex()
    {
        return view('revisi.index_revisi');
    }
    
    public function index()
    {
     
        if (request()->ajax()) {
            $lampiran=Revisi::orderBy('nomor_order','desc')->whereIn('status',['1','2','3'])->get();
            //  dd($lampiran);
            return datatables()->of($lampiran)
                    ->addColumn('action', 'action_butt_revisi')
                    ->rawColumns(['action'])
                    ->addIndexColumn()
                    ->make(true);
        }
        // return view('lampirankerja.index_perintah');
        
    }
    public function indexLapor()
    {
     
        if (request()->ajax()) {
            // $lampiran=LampiranOrder::orderBy('nomor_order','desc')->whereIn('status',['1','3'])->groupBy('nomor_order')->get();
            $lampiran=Revisi::orderBy('nomor_order','desc')->whereIn('status',['3'])->get();
            //  dd($lampiran);
            return datatables()->of($lampiran)
                    ->addColumn('action', 'action_butt_revisi')
                    ->rawColumns(['action'])
                    ->addIndexColumn()
                    ->make(true);
        } 
        
    }
    public function show(){

    }
    public function create(){

    }
    public function cetakupdate_pdf($id,$idpesanan,$no_lampiran,$order,$pecahan,$ta)
    {
        // dd($id);
            $dataOrder=LampiranOrder::join('tbl_pecahan','tbl_pecahan.kode_pecahan','=','pecahan')
            ->where('nomor_order',$order)
            ->where('pecahan',$pecahan)
            ->where('ta',$ta) 
            ->get()->toArray();

              
            $splitSeri=explode(" || ",$dataOrder[0]['seri']);
            //dari sini belum untuk generate lpk
            // $seriA=$dataOrder[0]['seri'];
            // $seriB=$dataOrder[1]['seri'];
            $seriA=$splitSeri[0] ;
            $seriB=$splitSeri[1] ;
         
            //HEREEEEE
            $splitA=explode(" - ",$seriA);
            $splitB=explode(" - ",$seriB);
// dd($splitB);
            $splitA0= explode(" ",$splitA[0]);
            $splitB0= explode(" ",$splitB[0]);
            // dd($splitA0[0]++);
            $arr1=[];
            $arr2=[];
            $arr3=[];
            $arr4=[];
            $arr5=[];
            $arrCollect=[];
            $lengthpembagi=null;
            $pembagi45=45;
            $pembagi50=50;
            $length45=array("V","W","X","Y");
            $length50=array("S","T","U");
            $counter=1;
            if(in_array($pecahan,$length50)){
                for($i=1;$i<=$pembagi50;$i++){
                    // echo  $splitA0[0].$splitA0[1].$splitA0++;
    
                    if($i<10){
                        if($counter==1){
                            $combinefirst=$splitA0[0].$splitA0[1].$splitA0[2]++;
                            array_push( $arr1,$combinefirst."-".$combinefirst);
                        }
                        array_push( $arr1,$splitA0[0].$splitA0[1].$splitA0[2]++);
                        $counter++;
                        if($counter >= 10){
                            $counter=1;
                        }
                    }
                    if($i > 10 && $i < 20){
                        // echo $i;
                        if($counter==1){
                            $combinefirst2=$splitA0[0].$splitA0[1].$splitA0[2]++;
                            array_push( $arr2,$combinefirst2."-".$combinefirst2);
                        }
                        array_push( $arr2,$splitA0[0].$splitA0[1].$splitA0[2]++);
                        $counter++;
                        if($counter >= 10){
                            $counter=1;
                        }
                    }
    
                    if($i > 20 && $i < 29){
                        $combinefirst3=null;
    
                        if ($splitA0[2] == "Z") {
                            $counter=1;
                            $combinefirst3=$splitA0[0].$splitA0[1].$splitA0[2];
                            //untuk increment Z++
                            $splitA0[2]++;
                            array_push($arr3, $combinefirst3);
                            //untuk double print pake format -
                            if ($counter==1) {
                                $combinefirst31=$splitB0[0].$splitB0[1].$splitB0[2]++;
                           
                                array_push($arr3, $combinefirst31."-".$combinefirst31);
                               
                            }
                            
                        }  if ($splitA0[2] == "AA" || $splitA0[2] == "AA") {
                            // dd($counter);
                            $combinefirst31=$splitB0[0].$splitB0[1].$splitB0[2]++; 
                            array_push($arr3, $combinefirst31);
                            $counter=1;
                            
                            continue;
                        } else{
                         
                            if ($counter==1) {
                                $combinefirst3=$splitA0[0].$splitA0[1].$splitA0[2]++;
                                array_push($arr3, $combinefirst3."-".$combinefirst3);
                            } else {
                                array_push($arr3, $splitA0[0].$splitA0[1].$splitA0[2]++);
                                if($splitA0[2]=="X"){
                                    $splitA0[2]++;
                                }
                        
                            }
                        }
                        $counter++;
                        if($counter > 10){
                            $counter=1;
                        }
                       
    
              
                    }
                    if ($i > 30 && $i <40) {
                      
                        if ($counter==1) {
                            $combinefirst41=$splitB0[0].$splitB0[1].$splitB0[2]++;
                       
                            array_push($arr4, $combinefirst41."-".$combinefirst41);
                           
                        }
                        array_push( $arr4,$splitB0[0].$splitB0[1].$splitB0[2]++);
                        $counter++;
                        if($counter >= 10){
                            $counter=1;
                        }
                    }
                    
                        if ($i > 40 && $i < 50) {
                            if ($counter==1) {
                                $combinefirst51=$splitB0[0].$splitB0[1].$splitB0[2]++;
                       
                                array_push($arr5, $combinefirst51."-".$combinefirst51);
                            }
                            array_push($arr5, $splitB0[0].$splitB0[1].$splitB0[2]++);
                            if ($splitB0[2]=="X") {
                                $splitB0[2]++;
                            }
                            $counter++;
                            if ($counter >= 10) {
                                $counter=1;
                            }
                        }
                    
                    
                }
            }else{
                //pembagi 45
                for($i=0;$i<$pembagi45;$i++){
                    // echo  $splitA0[0].$splitA0[1].$splitA0++;
    
                    if($i<9){
                        if($splitA0[2]=="I"){
                            $splitA0[2]++;
                            continue;
                        }else{
                            if($counter==1){
                                $combinefirst=$splitA0[0].$splitA0[1].$splitA0[2]++;
                                array_push( $arr1,$combinefirst."-".$combinefirst);
                            }
                            array_push( $arr1,$splitA0[0].$splitA0[1].$splitA0[2]++);
                            $counter++;
                            if($counter >= 9){
                                $counter=1;
                            }
                        }
                        
                    }
                    if($i > 9 && $i < 18){
                        // echo $i;
                        if($counter==1){
                            $combinefirst2=$splitA0[0].$splitA0[1].$splitA0[2]++;
                            array_push( $arr2,$combinefirst2."-".$combinefirst2);
                        }
                        array_push( $arr2,$splitA0[0].$splitA0[1].$splitA0[2]++);
                        $counter++;
                        if($counter >= 9){
                            $counter=1;
                        }
                    }
    
                    if($i > 18 && $i < 26){
                        $combinefirst3=null;
    
                        if ($splitA0[2] == "Z") {
                            $counter=1;
                            $combinefirst3=$splitA0[0].$splitA0[1].$splitA0[2];
                            //untuk increment Z++
                            $splitA0[2]++;
                            array_push($arr3, $combinefirst3);
                            //untuk double print pake format -
                            if ($counter==1) {
                                $combinefirst31=$splitB0[0].$splitB0[1].$splitB0[2]++;
                           
                                array_push($arr3, $combinefirst31."-".$combinefirst31);
                               
                            }
                            
                        }  if ($splitA0[2] == "AA" || $splitA0[2] == "AA") {
                            // dd($counter);
                            $combinefirst31=$splitB0[0].$splitB0[1].$splitB0[2]++; 
                            array_push($arr3, $combinefirst31);
                            $counter=1;
                            
                            continue;
                        } else{
                         
                            if ($counter==1) {
                                $combinefirst3=$splitA0[0].$splitA0[1].$splitA0[2]++;
                                array_push($arr3, $combinefirst3."-".$combinefirst3);
                            } else {
                                array_push($arr3, $splitA0[0].$splitA0[1].$splitA0[2]++);
                                if($splitA0[2]=="X"){
                                    $splitA0[2]++;
                                }
                        
                            }
                        }
                        $counter++;
                        if($counter > 9){
                            $counter=1;
                        }
                       
    
              
                    }
                    if ($i > 26 && $i <36) {
                        if($splitB0[2]=="I"){
                            $splitB0[2]++;
                            continue;
                        }else{
                            if ($counter==1) {
                                $combinefirst41=$splitB0[0].$splitB0[1].$splitB0[2]++;
                       
                                array_push($arr4, $combinefirst41."-".$combinefirst41);
                            }
                            array_push($arr4, $splitB0[0].$splitB0[1].$splitB0[2]++);
                            $counter++;
                            if ($counter >= 9) {
                                $counter=1;
                            }
                        }
                    }
                    
                        if ($i > 36 && $i < 46) {
                            if ($counter==1) {
                                $combinefirst51=$splitB0[0].$splitB0[1].$splitB0[2]++;
                       
                                array_push($arr5, $combinefirst51."-".$combinefirst51);
                            }
                            array_push($arr5, $splitB0[0].$splitB0[1].$splitB0[2]++);
                            if ($splitB0[2]=="X") {
                                $splitB0[2]++;
                            }
                            $counter++;
                            if ($counter >= 9) {
                                $counter=1;
                            }
                        }
                    
                    
                }
            }
           
            // dd($arr5);
            
            $jumlah_bilyet;
            if(in_array($pecahan,$length45)){
                $jumlah_bilyet=$pembagi45;
                for($k=0;$k<9;$k++){
                    array_push( $arrCollect,(object)[
                            'column1' =>$arr1[$k],
                            'column2' =>$arr2[$k],
                            'column3' =>$arr3[$k],
                            'column4' =>$arr4[$k],
                            'column5' =>$arr5[$k],
                            
                            ]);
               
                }
            }else{
                $jumlah_bilyet=$pembagi50;
                for($k=0;$k<10;$k++){
                    array_push( $arrCollect,(object)[
                            'column1' =>$arr1[$k],
                            'column2' =>$arr2[$k],
                            'column3' =>$arr3[$k],
                            'column4' =>$arr4[$k],
                            'column5' =>$arr5[$k],
                            
                            ]);
               
                }
            }
           
           

            $pecahan=$dataOrder[0]['pecahan'];
            $nomor_order=substr($dataOrder[0]['nomor_order'],0,4).".  ".substr($dataOrder[0]['nomor_order'],-3);
            $keterangan=$dataOrder[0]['keterangan'];  
            $nomor=explode("-",$dataOrder[0]['nomor']);
            $concatNomor= $nomor[0]." s/d ". $nomor[1];
            $formatPecahan=$dataOrder[0]['nama_pecahan']." ".$dataOrder[0]['tahun_emisi'];
            $form_data=array(
                'status'=>'2'
            );
            LampiranOrder::whereId($id)->update($form_data);

            $pdf = PDF::loadview('lampirankerja.lampiran_pdf',[
                'arrCollect'=>$arrCollect,
                'pecahan1'=>$pecahan,
                'pecahan'=> $formatPecahan,
                'jumlah_bilyet'=>$jumlah_bilyet,
                'nomor_order'=>$nomor_order,
                'keterangan'=>$keterangan,
                'nomor'=>$concatNomor,
            ])->setPaper('a4','portrait');
            // return $pdf->download('laporan-pegawai-pdf');
            return $pdf->stream($dataOrder[0]['nomor_order']."_".$pecahan.".pdf");
      
     
    }
    public function cetak_pdf($id,$idpesanan,$no_lampiran,$order,$pecahan,$ta)
    {
        // dd($id);
            $dataOrder=LampiranOrder::join('tbl_pecahan','tbl_pecahan.kode_pecahan','=','pecahan')
            ->where('nomor_order',$order)
            ->where('pecahan',$pecahan)
            ->where('ta',$ta) 
            ->get()->toArray();

              
            $splitSeri=explode(" || ",$dataOrder[0]['seri']);
            //dari sini belum untuk generate lpk
            // $seriA=$dataOrder[0]['seri'];
            // $seriB=$dataOrder[1]['seri'];
            $seriA=$splitSeri[0] ;
            $seriB=$splitSeri[1] ;
         
            //HEREEEEE
            $splitA=explode(" - ",$seriA);
            $splitB=explode(" - ",$seriB);
// dd($splitB);
            $splitA0= explode(" ",$splitA[0]);
            $splitB0= explode(" ",$splitB[0]);
            // dd($splitA0[0]++);
            $arr1=[];
            $arr2=[];
            $arr3=[];
            $arr4=[];
            $arr5=[];
            $arrCollect=[];
            $lengthpembagi=null;
            $pembagi45=45;
            $pembagi50=50;
            $length45=array("V","W","X","Y");
            $length50=array("S","T","U");
            $counter=1;
            if(in_array($pecahan,$length50)){
                for($i=1;$i<=$pembagi50;$i++){
                    // echo  $splitA0[0].$splitA0[1].$splitA0++;
    
                    if($i<10){
                        if($counter==1){
                            $combinefirst=$splitA0[0].$splitA0[1].$splitA0[2]++;
                            array_push( $arr1,$combinefirst."-".$combinefirst);
                        }
                        array_push( $arr1,$splitA0[0].$splitA0[1].$splitA0[2]++);
                        $counter++;
                        if($counter >= 10){
                            $counter=1;
                        }
                    }
                    if($i > 10 && $i < 20){
                        // echo $i;
                        if($counter==1){
                            $combinefirst2=$splitA0[0].$splitA0[1].$splitA0[2]++;
                            array_push( $arr2,$combinefirst2."-".$combinefirst2);
                        }
                        array_push( $arr2,$splitA0[0].$splitA0[1].$splitA0[2]++);
                        $counter++;
                        if($counter >= 10){
                            $counter=1;
                        }
                    }
    
                    if($i > 20 && $i < 29){
                        $combinefirst3=null;
    
                        if ($splitA0[2] == "Z") {
                            $counter=1;
                            $combinefirst3=$splitA0[0].$splitA0[1].$splitA0[2];
                            //untuk increment Z++
                            $splitA0[2]++;
                            array_push($arr3, $combinefirst3);
                            //untuk double print pake format -
                            if ($counter==1) {
                                $combinefirst31=$splitB0[0].$splitB0[1].$splitB0[2]++;
                           
                                array_push($arr3, $combinefirst31."-".$combinefirst31);
                               
                            }
                            
                        }  if ($splitA0[2] == "AA" || $splitA0[2] == "AA") {
                            // dd($counter);
                            $combinefirst31=$splitB0[0].$splitB0[1].$splitB0[2]++; 
                            array_push($arr3, $combinefirst31);
                            $counter=1;
                            
                            continue;
                        } else{
                         
                            if ($counter==1) {
                                $combinefirst3=$splitA0[0].$splitA0[1].$splitA0[2]++;
                                array_push($arr3, $combinefirst3."-".$combinefirst3);
                            } else {
                                array_push($arr3, $splitA0[0].$splitA0[1].$splitA0[2]++);
                                if($splitA0[2]=="X"){
                                    $splitA0[2]++;
                                }
                        
                            }
                        }
                        $counter++;
                        if($counter > 10){
                            $counter=1;
                        }
                       
    
              
                    }
                    if ($i > 30 && $i <40) {
                      
                        if ($counter==1) {
                            $combinefirst41=$splitB0[0].$splitB0[1].$splitB0[2]++;
                       
                            array_push($arr4, $combinefirst41."-".$combinefirst41);
                           
                        }
                        array_push( $arr4,$splitB0[0].$splitB0[1].$splitB0[2]++);
                        $counter++;
                        if($counter >= 10){
                            $counter=1;
                        }
                    }
                    
                        if ($i > 40 && $i < 50) {
                            if ($counter==1) {
                                $combinefirst51=$splitB0[0].$splitB0[1].$splitB0[2]++;
                       
                                array_push($arr5, $combinefirst51."-".$combinefirst51);
                            }
                            array_push($arr5, $splitB0[0].$splitB0[1].$splitB0[2]++);
                            if ($splitB0[2]=="X") {
                                $splitB0[2]++;
                            }
                            $counter++;
                            if ($counter >= 10) {
                                $counter=1;
                            }
                        }
                    
                    
                }
            }else{
                //pembagi 45
                for($i=0;$i<$pembagi45;$i++){
                    // echo  $splitA0[0].$splitA0[1].$splitA0++;
    
                    if($i<9){
                        if($splitA0[2]=="I"){
                            $splitA0[2]++;
                            continue;
                        }else{
                            if($counter==1){
                                $combinefirst=$splitA0[0].$splitA0[1].$splitA0[2]++;
                                array_push( $arr1,$combinefirst."-".$combinefirst);
                            }
                            array_push( $arr1,$splitA0[0].$splitA0[1].$splitA0[2]++);
                            $counter++;
                            if($counter >= 9){
                                $counter=1;
                            }
                        }
                        
                    }
                    if($i > 9 && $i < 18){
                        // echo $i;
                        if($counter==1){
                            $combinefirst2=$splitA0[0].$splitA0[1].$splitA0[2]++;
                            array_push( $arr2,$combinefirst2."-".$combinefirst2);
                        }
                        array_push( $arr2,$splitA0[0].$splitA0[1].$splitA0[2]++);
                        $counter++;
                        if($counter >= 9){
                            $counter=1;
                        }
                    }
    
                    if($i > 18 && $i < 26){
                        $combinefirst3=null;
    
                        if ($splitA0[2] == "Z") {
                            $counter=1;
                            $combinefirst3=$splitA0[0].$splitA0[1].$splitA0[2];
                            //untuk increment Z++
                            $splitA0[2]++;
                            array_push($arr3, $combinefirst3);
                            //untuk double print pake format -
                            if ($counter==1) {
                                $combinefirst31=$splitB0[0].$splitB0[1].$splitB0[2]++;
                           
                                array_push($arr3, $combinefirst31."-".$combinefirst31);
                               
                            }
                            
                        }  if ($splitA0[2] == "AA" || $splitA0[2] == "AA") {
                            // dd($counter);
                            $combinefirst31=$splitB0[0].$splitB0[1].$splitB0[2]++; 
                            array_push($arr3, $combinefirst31);
                            $counter=1;
                            
                            continue;
                        } else{
                         
                            if ($counter==1) {
                                $combinefirst3=$splitA0[0].$splitA0[1].$splitA0[2]++;
                                array_push($arr3, $combinefirst3."-".$combinefirst3);
                            } else {
                                array_push($arr3, $splitA0[0].$splitA0[1].$splitA0[2]++);
                                if($splitA0[2]=="X"){
                                    $splitA0[2]++;
                                }
                        
                            }
                        }
                        $counter++;
                        if($counter > 9){
                            $counter=1;
                        }
                       
    
              
                    }
                    if ($i > 26 && $i <36) {
                        if($splitB0[2]=="I"){
                            $splitB0[2]++;
                            continue;
                        }else{
                            if ($counter==1) {
                                $combinefirst41=$splitB0[0].$splitB0[1].$splitB0[2]++;
                       
                                array_push($arr4, $combinefirst41."-".$combinefirst41);
                            }
                            array_push($arr4, $splitB0[0].$splitB0[1].$splitB0[2]++);
                            $counter++;
                            if ($counter >= 9) {
                                $counter=1;
                            }
                        }
                    }
                    
                        if ($i > 36 && $i < 46) {
                            if ($counter==1) {
                                $combinefirst51=$splitB0[0].$splitB0[1].$splitB0[2]++;
                       
                                array_push($arr5, $combinefirst51."-".$combinefirst51);
                            }
                            array_push($arr5, $splitB0[0].$splitB0[1].$splitB0[2]++);
                            if ($splitB0[2]=="X") {
                                $splitB0[2]++;
                            }
                            $counter++;
                            if ($counter >= 9) {
                                $counter=1;
                            }
                        }
                    
                    
                }
            }
           
            // dd($arr5);
            
            $jumlah_bilyet;
            if(in_array($pecahan,$length45)){
                $jumlah_bilyet=$pembagi45;
                for($k=0;$k<9;$k++){
                    array_push( $arrCollect,(object)[
                            'column1' =>$arr1[$k],
                            'column2' =>$arr2[$k],
                            'column3' =>$arr3[$k],
                            'column4' =>$arr4[$k],
                            'column5' =>$arr5[$k],
                            
                            ]);
               
                }
            }else{
                $jumlah_bilyet=$pembagi50;
                for($k=0;$k<10;$k++){
                    array_push( $arrCollect,(object)[
                            'column1' =>$arr1[$k],
                            'column2' =>$arr2[$k],
                            'column3' =>$arr3[$k],
                            'column4' =>$arr4[$k],
                            'column5' =>$arr5[$k],
                            
                            ]);
               
                }
            }
           
           

            $pecahan=$dataOrder[0]['pecahan'];
            $nomor_order=substr($dataOrder[0]['nomor_order'],0,4).".  ".substr($dataOrder[0]['nomor_order'],-3);
            $keterangan=$dataOrder[0]['keterangan'];  
            $nomor=explode("-",$dataOrder[0]['nomor']);
            $concatNomor= $nomor[0]." s/d ". $nomor[1];
            $formatPecahan=$dataOrder[0]['nama_pecahan']." ".$dataOrder[0]['tahun_emisi'];
            

            $pdf = PDF::loadview('lampirankerja.lampiran_pdf',[
                'arrCollect'=>$arrCollect,
                'pecahan1'=>$pecahan,
                'pecahan'=> $formatPecahan,
                'jumlah_bilyet'=>$jumlah_bilyet,
                'nomor_order'=>$nomor_order,
                'keterangan'=>$keterangan,
                'nomor'=>$concatNomor,
            ])->setPaper('a4','portrait');
            // return $pdf->download('laporan-pegawai-pdf');
            return $pdf->stream($dataOrder[0]['nomor_order']."_".$pecahan.".pdf");
      
     
    }
    // public function cetakUpdateStatus($id,$idpesanan,$no_lampiran,$order,$pecahan,$ta){
       
    //     $this->cetak_pdf($id,$idpesanan,$no_lampiran,$order,$pecahan,$ta);
    //     $form_data=array(
    //         'status'=>'2'
    //     );
    //     LampiranOrder::whereId($id)->update($form_data);
    // }
    // public function cetakOnly($id,$idpesanan,$no_lampiran,$order,$pecahan,$ta){

    //     // dd($order);
    //     $this->cetak_pdf($id,$idpesanan,$no_lampiran,$order,$pecahan,$ta);
    // }
 
    public function store(Request $request)
    {
        // var_dump($request);
        $username = AuthHelper::getAuthUser()[0]->email;
        $error =null;
        $rules = array(
        'nomor_order'			=>  'required',
        'pecahan'			=>  'required',
        'tahun'			=>  'required'
        
        );
        $messages = array(
            'required' => 'form :attribute harus diisi.',
            'same'    => 'The :attribute and :other must match.',
            'max'    => 'file :attribute terlalu besar max :max Kb.',
            'between' => 'The :attribute must be between :min - :max.',
            'in'      => 'The :attribute must be one of the following types: :values',
            
        ); 
        
         
        $form_data = array(
            'status'			=>  "4"	,
            'changed_by'=>$username
            

            
        );
        $idUpdate=LampiranOrder::where('nomor_order',$request->nomor_order)
        ->where('pecahan',$request->pecahan)
        ->where('ta',$request->tahun)->first();
        if($idUpdate==null){
            // dd($idUpdate);
            return response()->json(['errors' => 'No. Order '.$request->nomor_order." Pecahan: ".$request->pecahan.' tidak ada']);
        }else{
            // dd($idUpdate);

        $insertId=LampiranOrder::where('nomor_order',$request->nomor_order)
        ->where('pecahan',$request->pecahan)
        ->where('ta',$request->tahun)
        ->where('id',$idUpdate)
        ->update($form_data);
            return response()->json(['success' => 'No. Order '.$request->nomor_order." Pecahan: ".$request->pecahan.' berhasil di update']);
        }
        
        

  
    }

    public function update(Request $request)
    {
    }
    public function destroy($id)
    {
        
    }

    public function edit($id)
    {
     
    }

     
}
