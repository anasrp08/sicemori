<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laratrust\LaratrustFacade as Laratrust;
use App\Http\Requests;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use App\Http\Controllers\stdClass;
use App\Jadwal; 
use App\Role; 
use DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // if (Laratrust::hasRole('candal')) {

        //     // $borrowLogs = Auth::user()->borrowLogs()->borrowed()->get();

        //     return view('dashboard.candal'[

        //     ]);
        // }

        // if (Laratrust::hasRole('cemor')) {

        //     // $borrowLogs = Auth::user()->borrowLogs()->borrowed()->get();

        //     return view('dashboard.cemor',[]);
        // }

        if (Laratrust::hasRole('admin') || Laratrust::hasRole('cemor') || Laratrust::hasRole('candal') ) {

          
        $formatTahun=substr(date("Y"),2);
        $combineString="TA-".$formatTahun;
         
         //jmlh order seluruh pesanan pecahan b
        // $this->jumlhOrder($combineString,'Y').' '.'Order',
        //lku cetak nomor lembar yg sudah dicetak nomor b
        // dd($this->jumlhLKUCetak($combineString,'Y','4').' '.'Lbr',);
        // no order terbit no order rilis b
        // dd($this->jumlhOrderStatus($combineString,'Y','1').' '.'order',);
        //lpk terbit lpk yg sedang dikerjakan 
        // dd($this->jumlhOrderStatus($combineString,'Y','2').' '.'order',);
        //lpk selesai lpk lpk yg sudah selesai
        // dd($this->jumlhLPK($combineString,'Y','4');
        //lku cetak lini A lku dicetak liniA 
        // dd($this->jumlhLKULini($combineString,'Y','A','2').' '.'Lbr');
        //lku cetak lini B lku 
        // dd($this->jumlhLKULini($combineString,'Y','B','2').' '.'Lbr');
        $dataDashboard=[];
        $dataDashboard['pecahanY']=$this->perPecahan('Y',$combineString);
        $dataDashboard['pecahanX']=$this->perPecahan('X',$combineString);
        $dataDashboard['pecahanW']=$this->perPecahan('W',$combineString);
        $dataDashboard['pecahanV']=$this->perPecahan('V',$combineString);
        $dataDashboard['pecahanU']=$this->perPecahan('U',$combineString);
        $dataDashboard['pecahanT']=$this->perPecahan('T',$combineString);
        $dataDashboard['pecahanS']=$this->perPecahan('S',$combineString);
  
        } 
         
        // dd($dataDashboard);
            return view('dashboard.admin',[
                'dataDashboard'=>$dataDashboard
                // 'tab_pecahan'=>'ásd', 
                // 'jumlah_order'=>$jmlhOrder,
                // 'pecahany'=>$collectiony1,
                // 'daftar_pecahan'=>$this->pecahan()
            ]);
         

        return view('login1'); 
    }
    public static function formatDataObject($paramData){

        $pecahan = new \stdClass();
        $pecahan->title_order = $paramData[0];
        $pecahan->jmlOrder = $paramData[1];
        $pecahan->title_lku_tercetak = $paramData[2];
        $pecahan->lku_tercetak = $paramData[3];
        $pecahan->title_order_terbit = $paramData[4];
        $pecahan->order_terbit = $paramData[5];
        $pecahan->title_lpk_terbit = $paramData[6];
        $pecahan->lpk_terbit = $paramData[7];
        $pecahan->title_lpk_selesai = $paramData[8];
        $pecahan->lpk_selesai = $paramData[9];
        $pecahan->title_lku_linia = $paramData[10];
        $pecahan->lku_linia = $paramData[11];
        $pecahan->title_lku_linib = $paramData[12];
        $pecahan->lku_linib = $paramData[13];

        return $pecahan;
    }

    public static function perPecahan($pecahan,$ta){
        $perPecahan=HomeController::formatDataObject([
            'Jumlah Order NKRI',
            HomeController::jumlhOrder($ta,$pecahan).' '.'Order',
            'LKU Tercetak Nomor',
            HomeController::jumlhLKUCetak($ta,$pecahan,'4').' '.'Lbr',
            'Jumlah No. Order Terbit',
            HomeController::jumlhOrderStatus($ta,$pecahan,'1').' '.'Order',
            'Jumlah LPK Terbit',
            HomeController::jumlhOrderStatus($ta,$pecahan,'2').' '.'LPK',
            'Jumlah LPK Selesai',
            HomeController::jumlhLPK($ta,$pecahan,'4').' '.'LPK',
            'LKU Tercetak Nomor Lini A',
            HomeController::jumlhLKULini($ta,$pecahan,'A','2').' '.'Lbr',
            'LKU Tercetak Nomor Lini B',
            HomeController::jumlhLKULini($ta,$pecahan,'B','2').' '.'Lbr']);

            return $perPecahan;
     
    }


    public static function pecahan(){
        return DB::table('tbl_pecahan')->get();
    }
     
    public static function jumlhOrder($ta,$pecahan){
        $jmlhOrder=DB::table('tbl_pesanan')
        ->select('pecahan','total_order')
        ->where('tahun',$ta)
        ->where('pecahan',$pecahan) 
        ->get();
        if(count($jmlhOrder)==0){
            return 0;
        }else{
            return $jmlhOrder[0]->total_order;
        }
        
    } 
    public static function jumlhOrderStatus($ta,$pecahan,$status){
        $jmlhOrderStatus=DB::table('tbl_lampiran_order')
        ->select('pecahan',DB::raw('count(nomor_order) as jumlah'))
        ->where('ta',$ta)
        ->where('pecahan',$pecahan) 
        ->where('status',$status) 
        ->get();
        if(count($jmlhOrderStatus)==0){
            return 0;
        }else{
            return $jmlhOrderStatus[0]->jumlah;
        }
        
    } 
    public static function jumlhLKUCetak($ta,$pecahan,$status){
        $jmlhLKU= DB::table('tbl_lampiran_order')
        ->select('pecahan',DB::raw('sum(jmlh_kertas) as jumlah'))
        ->where('ta',$ta)
        ->where('pecahan',$pecahan)
        ->where('status',$status)
        ->groupBy('pecahan')
        ->orderBy('pecahan','desc')
        ->get();
        // dd(count($jmlhLKU));
        if(count($jmlhLKU)==0){
            return 0;
        }else{
            return $jmlhLKU[0]->jumlah;
        }
    } 
    public static function jumlhLPK($ta,$pecahan,$status){
        $jmlhLPK=DB::table('tbl_lampiran_order')
        ->select('pecahan',DB::raw('count(nomor_order) as jumlah'))
        ->where('ta',$ta)
        ->where('pecahan',$pecahan)
        ->where('status',$status)
        ->groupBy('pecahan') 
        ->get(); 
        if(count($jmlhLPK)==0){
            return 0;
        }else{
            return $jmlhLPK[0]->jumlah;
        }
       
    }
    public static function jumlhLKULini($ta,$pecahan,$lini,$status){
        $jumlhLKUlini=DB::table('tbl_lampiran_order')
        ->select('pecahan',DB::raw('sum(jmlh_kertas) as jumlah'))
        ->where('ta',$ta)
        ->where('pecahan',$pecahan)
        ->where('lini',$lini)
        ->where('status',$status)
        ->groupBy('pecahan') 
        ->get();
        if(count($jumlhLKUlini)==0){
            return 0;
        }else{
            return $jumlhLKUlini[0]->jumlah;
        }
        
    }
    
     
}
