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
use App\Helpers\AuthHelper;
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
        $np = DB::table('tbl_pegawai')->get();

        return view('pesanan.create', [
            'tahun' => $tahun_anggaran,
            'pecahan' => $pecahan,
            'te' => $tahun_emisi,
            'np' => $np,
        ]);
    }
    public function create()
    {
    }
    public function viewIndex()
    {

        return view('pesanan.index', []);
    }
    public function show()
    {
    }
    public function getDataPesanan(Request $request)
    {


        $pecahan =  DB::table('tbl_lampiran_order')->where('pecahan', $request->pecahan)->latest('nomor_order')->limit(1)->get();
        //    dd($pecahan);
        $tahun_emisi = DB::table('tbl_thn_emisi')->get();
        // dd( $pecahan);

        return response()->json(['data' =>  $pecahan]);
    }
    public function index()
    {

        if (request()->ajax()) {
            return datatables()->of(Pesanan::latest()->get())

                ->addColumn('action', 'action_button_pesanan')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        $username = AuthHelper::getAuthUser()[0]->email;
        $error = null;
        $rules = array(
            'jumlah_pesanan'     =>  'required',
            'seri_terakhir'            =>  'required',
            'pecahan'            =>  'required',
            'tahun'    =>  'required',
            'np' => 'required',
            'order_terakhir' => 'required',
            'insit_persen'    =>  'nullable',

        );
        $messages = array(
            'jumlah_pesanan.required' => 'form jumlah pesanan harus diisi.',
            'seri_terakhir.required' => 'form seri terakhir harus diisi.',
            'pecahan.required' => 'form pecahan harus diisi.',
            'tahun.required' => 'form tahun harus diisi.',
            'order_terakhir.required' => 'form order harus diisi',
            'np.required' => 'form NP harus diisi'

        );


        $error = Validator::make($request->all(), $rules, $messages);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        // dd($request->np);

        $form_data = array(
            'jumlah_pesanan'            =>  $request->jumlah_pesanan,
            'seri_terakhir'            =>  $request->seri_terakhir2 . " || " . $request->seri_terakhir2,
            'pecahan'                =>  $request->pecahan,
            'tahun'                 =>  $request->tahun,
            'tahun_emisi'           =>  $request->tahun_emisi,
            'insit_persen'            =>  $request->insit_persen,
            'order_terakhir'        =>  $request->order_terakhir,
            'nomor_terakhir'        =>  $request->nomor_terakhir,
            'jumlah_insit'            =>   $request->jumlah_insit1,
            'lembar_insit'          =>   $request->lembar_insit1,
            'order_tnpinsit'        =>  $request->order_tnpinsit1,
            'order_insit'            =>  $request->order_insit1,
            'total_order'            =>  $request->total_order1,
            'total_pesanan'         => $request->total_pesanan1,
            'np'                   => $request->np,
            'created_by'            => $username,
            // 'created_at'            => date('Y-m-d')
        );

        $insertId = Pesanan::create($form_data)->id;

        $alpha1 = substr(str_replace(' ', '', $request->seri_terakhir), 0, 3);
        $alpha2 = substr(str_replace(' ', '', $request->seri_terakhir), -3);
        $alpha3 = substr(str_replace(' ', '', $request->seri_terakhir2), 0, 3);
        $alpha4 = substr(str_replace(' ', '', $request->seri_terakhir2), -3);
        $splitnomor = explode("-", $request->nomor_terakhir);
        // $numb1=$splitnomor[0];
        // $numb2=$splitnomor[1];
        $lastNoOrder = $request->order_terakhir;
        $order = $request->total_order;

        $number1 = null;
        $number2 = null; 

        $lastNo = (int) substr($lastNoOrder, -3);
        $splitNo = (int) substr($lastNoOrder, 0, 4);

        //first letter
        $huruf1 = $alpha1[0];
        $huruf2 = $alpha1[1];
        $huruf3 = $alpha1[2];
        //sceond letter
        $huruf7 = $alpha2[0];
        $huruf8 = $alpha2[1];
        $huruf9 = $alpha2[2];

        // {Down}
        $huruf4 = $alpha3[0];
        $huruf5 = $alpha3[1];
        $huruf6 = $alpha3[2];
        //second
        $huruf10 = $alpha4[0];
        $huruf11 = $alpha4[1];
        $huruf12 = $alpha4[2];

        // $huruf4++;
        // dd($numb1[0]);
        $collectNumber1 = array();
        $concatNumb1 = null;
        $concatNumb2 = null;
        $padNumber1 = "00000";
        $padNumber2 = "00001";
        $letterFirstUp = null;
        $letterFirstDown = null;

        $letterSecondUp = null;
        $letterSecondDown = null;
        for ($i = 1; $i <= $order; $i++) {

            if($i == 1){
                // dd($i);
                $concatNumb1=$splitnomor[0];
                $concatNumb2=$splitnomor[1];
                $number1 = substr((int)$splitnomor[0], 0, 1); 
                $number2 = substr((int)$splitnomor[1], 0, 1);

                $letterFirstUp = $huruf1 . " " . $huruf2 . " " . $huruf3;
                $letterFirstDown =  $huruf4 . " " . $huruf2 . " " . $huruf6;

                $letterSecondUp = $huruf7 . " " . $huruf2 . " " . $huruf9;
                $letterSecondDown = $huruf10 . " " . $huruf2 . " " . $huruf12;
                $concatAllNumber = $concatNumb1 . "-" . $concatNumb2;

                array_push($collectNumber1, array(
                    'nomor_order' => $splitNo . $lastNo,
                    'pecahan' => $request->pecahan,
                    'ta' => $request->tahun,
                    'tahun_emisi' => $request->tahun_emisi,
                    'seri' => $letterFirstUp . " - " . $letterSecondUp . " || " . $letterFirstDown . " - " . $letterSecondDown,
                    'nomor' => $concatAllNumber
    
                ));
    
            }else{
                if ($number1 > 9) {
                    $number1 = 0;
                    $concatNumb1 = $number1 . $padNumber2;
                } else {
                    $concatNumb1 = $number1 . $padNumber2;
                }
    
                if ($number1 == 9) {
                    $concatNumb1 = $number1 . $padNumber2;
                }
    
                if ($number2 > 9) {
                    $number2--;
                    $concatNumb2 = $number2 . "99999";
                    $number2 = 0;
                } else {
                    $concatNumb2 = $number2 . $padNumber1;
                }
                if ($concatNumb2 == "100000") {
                    //looping abjad
                    $huruf1 = $this->increment($huruf1, $request->pecahan, 2);
                    $huruf4 = $this->increment($huruf4, $request->pecahan, 2);
    
                    $huruf7 = $this->increment($huruf7, $request->pecahan, 2);
                    $huruf10 = $this->increment($huruf10, $request->pecahan, 2);
                    if ($huruf1 == "A") {
                        $huruf2++;
                    }
                    $letterFirstUp = $huruf1 . " " . $huruf2 . " " . $huruf3;
                    $letterFirstDown =  $huruf4 . " " . $huruf2 . " " . $huruf6;
    
                    $letterSecondUp = $huruf7 . " " . $huruf2 . " " . $huruf9;
                    $letterSecondDown = $huruf10 . " " . $huruf2 . " " . $huruf12;
                } else {
    
                    $letterFirstUp = $huruf1 . " " . $huruf2 . " " . $huruf3;
                    $letterFirstDown = $huruf4 . " " . $huruf2 . " " . $huruf6;
    
                    $letterSecondUp = $huruf7 . " " . $huruf2 . " " . $huruf9;
                    $letterSecondDown = $huruf10 . " " . $huruf2 . " " . $huruf12;
                }
                $concatAllNumber = $concatNumb1 . "-" . $concatNumb2;

            array_push($collectNumber1, array(
                'nomor_order' => $splitNo . $lastNo,
                'pecahan' => $request->pecahan,
                'ta' => $request->tahun,
                'tahun_emisi' => $request->tahun_emisi,
                'seri' => $letterFirstUp . " - " . $letterSecondUp . " || " . $letterFirstDown . " - " . $letterSecondDown,
                'nomor' => $concatAllNumber

            ));

            }
            
            $number1++;
            $number2++;
            $lastNo++;
        }
        // dd($concatNumb1);
        $count = 1;
        $nolampiran = 1;

        for ($i = 0; $i <= count($collectNumber1) - 1; $i++) {
            $data_lampiran = array(
                'idpesanan'  => $insertId,
                'pecahan'    => $collectNumber1[$i]['pecahan'],
                'ta'         => $collectNumber1[$i]['ta'],
                'tahun_emisi'         => $collectNumber1[$i]['tahun_emisi'],
                'nomor_order' => $collectNumber1[$i]['nomor_order'],
                'seri'       => $collectNumber1[$i]['seri'],
                'nomor'      => $collectNumber1[$i]['nomor'],
                'no_lampiran' => $nolampiran,
                'status' => "0",
                'np'                   => $request->np,
                'created_by'            => $username,
                // 'created_at'            => date('Y-m-d')

            );
            LampiranOrder::create($data_lampiran);
            if ($count == 12) {
                $nolampiran++;
                $count = 1;
            } else {
                $count++;
            }
        }

        return response()->json(['success' => 'Pesanan Berhasil Di Simpan']);
    }

    public function increment($val, $pecahan, $increment = 2)
    {
        // $val="W";
        for ($i = 1; $i <= $increment; $i++) {
            $val++;
            //huruf I tidak ada di pecahan VWXY
            if ($pecahan == "V" || $pecahan == "W" || $pecahan == "X" || $pecahan == "Y") {
                if ($val == "I") {
                    $val++;
                }
            }
            //huruf X di skip
            if ($val == "X") {
                $val++;
            }

            if ($val == "AA") {
                $val = "A";
                $val++;
            }
        }

        return $val;
    }

    public function update(Request $request)
    {
    }


    public function destroy($id)
    {
    }

    public function edit($id)
    {
        // //
        // $where = array('id' => $id);
        // $user  = Jadwal::where($where)->first();

        // return Response::json($user);
    }
    public function deletePesanan(Request $request)
    {
        // dd($request->all());
        Pesanan::where('id', $request->id)
            ->where('pecahan', $request->pecahan)
            ->where('tahun', $request->tahun)
            ->delete();
        LampiranOrder::where('idpesanan', $request->id)
            ->where('pecahan', $request->pecahan)
            ->where('tahun', $request->tahun)
            ->delete();
        return response()->json(['success' => 'Data Berhasil Di Hapus']);
    }
}
