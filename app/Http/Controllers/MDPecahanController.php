<?php

namespace App\Http\Controllers;
// use App\MdJenisPikai;
use Illuminate\Http\Request;
use Redirect;
use Validator;
use Response;
use DB;
use App\Helpers\AuthHelper;

class MDPecahanController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (request()->ajax()) {
            $queryPecahan = DB::table('tbl_pecahan')->get();
            return datatables()->of($queryPecahan)
                ->addColumn('action', 'action_butt_pesanan')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('masterdata.MDPecahan');
    }
    public function view()

    {
        return view('masterdata.MDPecahan');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $username = AuthHelper::getAuthUser()[0]->email;
        $error = null;
        $rules = array(
            'kode'     =>  'required',
            'nama'            =>  'required',
            'maxkemas'            =>  'required',
            // 'keterangan'    =>  'required',


        );
        $messages = array(
            'kode.required' => 'form jumlah pesanan harus diisi.',
            'nama.required' => 'form seri terakhir harus diisi.',
            'maxkemas.required' => 'form pecahan harus diisi.',

        );


        $error = Validator::make($request->all(), $rules, $messages);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        // dd($request->np);

        $form_data = array(
            'kode_pecahan'            =>  $request->kode,
            'nama_pecahan'            =>  $request->nama,
            'max_kemas'                =>  $request->maxkemas,
            'keterangan_pecahan'                 =>  $request->keterangan,
            'created_by'                 =>   $username,
            'created_at'            => date('Y-m-d')
        );

        $insertQuery = DB::table('tbl_pecahan')->insert($form_data);
        return response()->json(['success' => 'Data Berhasil Disimpan.']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function updatedata(Request $request)
    {


       
    }
    public function update(Request $request)
    { 
         
        $username = AuthHelper::getAuthUser()[0]->email;
        $form_data = array(
            'kode_pecahan'            =>  $request->kode,
            'nama_pecahan'            =>  $request->nama,
            'max_kemas'                =>  $request->maxkemas,
            'keterangan_pecahan'                 =>  $request->keterangan,
            'changed_by'                 =>   $username,
            'updated_at'            => date('Y-m-d')

        );
        // dd($request->all());
        $queryUpdate=DB::table('tbl_pecahan')->where('id', $request->id)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deletePesanan(Request $request)
    {
        $queryDelete=DB::table('tbl_pecahan')->where('id', $request->id)->delete();
        return response()->json(['success' => 'Data Berhasil Di  Hapus']);
    }
    public function destroy($id)
    {
    }
}
