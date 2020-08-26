<?php

namespace App\Http\Controllers;

use App\MdKantor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Redirect;
use Validator;
use Response;
use Excel;
use App\Jobs\ImportJobKantor;

class MDPegawaiController extends Controller
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
            return datatables()->of(MdKantor::latest()->get())
                    ->addColumn('action', 'action_button') 
                    ->rawColumns(['action'])
                    ->addIndexColumn()
                    ->make(true);
        }
        return view('masterdata.MDKantorPemohon');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        //
        $rules = array(
            'nama_kanwil'    =>  'required',
            'wilayah'     =>  'required',
            'provinsi'     =>  'required',
            // 'image'         =>  'required|image|max:2048'
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }
 
        $form_data = array(
            'nama_kanwil'        =>  $request->nama_kanwil,
            'wilayah'         =>  $request->wilayah,
            'provinsi'     =>  $request->provinsi
        );

        MdKantor::create($form_data);

        return response()->json(['success' => 'Data Added successfully.']);
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
        //
        $where = array('id' => $id);
    $user  = MdKantor::where($where)->first();
 
    return Response::json($user);
        // echo $id;
        // if (request()->ajax()) {
        //     $data = MdKantor::findOrFail($id);
        //     return response()->json(['data' => $data]);
        // }

        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request )
    {
        
            $rules = array(
                'nama_kanwil'        =>  'required',
            'wilayah'         =>  'required',
            'provinsi'     =>  'required'
            );

            $error = Validator::make($request->all(), $rules);

            if ($error->fails()) {
                return response()->json(['errors' => $error->errors()->all()]);
            } 

        $form_data = array(
            'nama_kanwil'        =>  $request->nama_kanwil,
            'wilayah'         =>  $request->wilayah,
            'provinsi'     =>  $request->provinsi 
        );
        MdKantor::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $data = MdKantor::findOrFail($id);
        $data->delete();
    }

    public function importExcel(Request $request)
    {
        // Validasi untuk memastikan file yang diupload adalah excel
        if ($request->hasFile('file')) {
            //UPLOAD FILE
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs(
                'public', $filename
            );
            
            //MEMBUAT JOBS DENGAN MENGIRIMKAN PARAMETER FILENAME
            ImportJobKantor::dispatch($filename);
            return redirect()->back()->with(['success' => 'Upload success']);
        }  
        return redirect()->back()->with(['error' => 'Please choose file before']);
    }
}
