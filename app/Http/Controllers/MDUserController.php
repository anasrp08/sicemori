<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use App\RoleUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Redirect;
use Validator;
use Response;
use Image;
use Excel;
use DB;
use App\Jobs\ImportJobKantor;

class MDUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // public function __construct(
    //     User $user )
    // {
    //     $this->photo = $photo;
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        $roles = DB::table('roles')->get()->toArray();
        //   dd($roles);
        return view('masterdata.MDUser', [
            'roles' => $roles,
        ]);
    }
    public function index()
    {
        //
        if (request()->ajax()) {
            return datatables()->of(DB::table('users')
                ->join('role_user', 'role_user.user_id', '=', 'users.id')
                ->join('roles', 'roles.id', '=', 'role_user.role_id')
                ->select(
                    'users.id as id',
                    'users.avatar',
                    'users.name as name',
                    'users.np as np',
                    'users.email',
                    'users.instansi',
                    'roles.display_name as roles',
                    'users.created_at'
                )->latest()->get())
                ->addColumn('action', 'action_button')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        $roles = DB::table('roles')->get()->toArray();

        return view('masterdata.MDUser', [
            'roles' => $roles,
        ]);
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
        //  dd($request->all());
        $rolesAdmin = Role::where('name', 'admin')->first();
        $rolesCandal = Role::where('name', 'candal')->first();
        $rolesCemor = Role::where('name', 'cemor')->first();
        // dd($request);
        $rules = array(
            'name'      =>  'required',
            'email'     =>  'required',
            'np'  =>  'required',
            'roles'     =>  'required',
            'password'  =>  'nullable',
            'avatar'    =>  'nullable|image|max:2048'
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $defaultPhoto = 'default.jpg';
        $create = null;

        $form_datauser = array(
            'name'          =>  $request->name,
            'np'         =>  $request->np,
            'email'         =>  $request->email,
            'instansi'      =>  $request->roles,
            'password'      =>  bcrypt($request->password),
            'avatar'        =>  $defaultPhoto
        );

        if ($request->hasFile('avatar')) {
            $images = $request->file('avatar');
            //setting flag for condition
            $org_img = $thm_img = true;
            // dd($images->getClientOriginalName());
            // create new directory for uploading image if doesn't exist
            if (!File::exists('img/')) {
                $org_img = File::makeDirectory('img/', 0777, true);
            }
            //get file name of image  and concatenate with 4 random integer for unique
            // .'.'.$images->getClientOriginalExtension()
            $filename = $request->name . '_' . $images->getClientOriginalName();
            //path of image for upload
            $org_path = 'img/' . $filename;
            $form_datauser['avatar'] = $filename;
            $create = User::create($form_datauser);

            //don't upload file when unable to save name to database
            if (!$create) {
                return response()->json(['errors' => "Gagal Simpan ke Database"]);
                // return false;
            }
            // $create->attachRole($rolesBeacukai); 
            switch ($request->roles) {
                case "Admin":
                    $create->attachRole($rolesAdmin);
                    break;
                case "Candal":
                    $create->attachRole($rolesCandal);
                    break;
                default:
                    $create->attachRole($rolesCemor);
            }
            Image::make($images)->fit(300, 300, function ($constraint) {
                $constraint->upsize();
            })->save($org_path);
            return response()->json(['success' => 'Foto Berhasil Di Upload']);


            // return redirect()->action('PengujianController@view', $request->hidden_id);
        } else {
            $form_datauser['avatar'] = $defaultPhoto;
            $create = User::create($form_datauser);

            if (!$create) {
                return response()->json(['errors' => "Gagal Simpan ke Database"]);
            }
            switch ($request->roles) {
                case "Admin":
                    $create->attachRole($rolesAdmin);
                    break;
                case "Candal":
                    $create->attachRole($rolesCandal);
                    break;
                default:
                    $create->attachRole($rolesCemor);
            }

            return response()->json(['success' => 'Foto Berhasil Di Upload']);
        }
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
        $user = DB::table('users')
            ->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->select(
                'users.id as id',
                'users.avatar',
                'users.name as name',
                'users.email',
                'users.instansi',
                'roles.display_name as roles',
                'users.created_at'
            )
            ->where('users.id', $id)->first();

        return Response::json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $rolesAdmin = Role::where('name', 'admin')->first();
        $rolesCandal = Role::where('name', 'candal')->first();
        $rolesCemor = Role::where('name', 'cemor')->first();
        // dd($request);
        $rules = array(
            'name'      =>  'required',
            'email'     =>  'required',
            'np'  =>  'required',
            // 'roles'     =>  'required',
            'password'  =>  'nullable',
            'avatar'    =>  'nullable|image|max:2048'
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $defaultPhoto = 'default.jpg';
        $create = null;

        $form_datauser = array(
            'name'          =>  $request->name,
            'email'         =>  $request->email,
            'np'            =>  $request->np,
            'instansi'      =>  $request->roles,
            'password'      =>  bcrypt($request->password),
            'avatar'        =>  $defaultPhoto
        );

        $getUser = User::find($request->hidden_id);
        if ($request->hasFile('avatar')) {
            $images = $request->file('avatar');
            //setting flag for condition
            $org_img = $thm_img = true;

            // create new directory for uploading image if doesn't exist
            if (!File::exists('img/')) {
                $org_img = File::makeDirectory('img/', 0777, true);
            }
            //get file name of image  and concatenate with 4 random integer for unique
            $filename = $request->name . '_' . $images->getClientOriginalName();
            //path of image for upload
            $org_path = 'img/' . $filename;
            $form_datauser['avatar'] = $filename;

            //don't upload file when unable to save name to database
            if (!$getUser->update($form_datauser)) {
                return response()->json(['errors' => "Gagal Simpan ke Database"]);
                // return false;
            }


            switch ($request->roles) {
                case "Admin":
                    $getUser->detachRole($rolesAdmin);
                    break;
                case "Candal":
                    $getUser->detachRole($rolesCandal);
                    break;
                default:
                    $getUser->detachRole($rolesCemor);
            }
            // $getRoles= Role::where('user_id',$request->hidden_id);
            //    $idRole=null;
            $getRoles = RoleUser::where('user_id', $request->hidden_id)->first();
            // dd($request->roles);
            if ($getRoles) {
                switch ($request->roles) {
                    case "Admin":
                        $getRoles->role_id = '1';
                        break;
                    case "Candal":
                        $getRoles->role_id = '2';
                        break;
                    default:
                        $getRoles->role_id = '3';
                }
                $getRoles->save();
            }

            // $assignRole->attachRole($rolesBeacukai); 
            Image::make($images)->fit(128, 128, function ($constraint) {
                $constraint->upsize();
            })->save($org_path);
            return response()->json(['success' => 'Update Berhasil']);


            // return redirect()->action('PengujianController@view', $request->hidden_id);
        } else {
            $form_datauser['avatar'] = $defaultPhoto;

            if (!$getUser->update($form_datauser)) {
                return response()->json(['errors' => "Gagal Update ke Database"]);
                // return false;
            }
            switch ($request->roles) {
                case "Admin":
                    $getUser->detachRole($rolesAdmin);
                    break;
                case "Candal":
                    $getUser->detachRole($rolesCandal);
                    break;
                default:
                    $getUser->detachRole($rolesCemor);
            }
            $rolesId = null;
            $getRoles = RoleUser::where('user_id', '=', $request->hidden_id);

            // dd($request->roles);
            if ($getRoles) {
                switch ($request->roles) {
                    case "Admin":
                        $rolesId = '1';
                        break;
                    case "Candal":
                        $rolesId = '2';
                        break;
                    default:
                        $rolesId = '3';
                }


                $getRoles->update(
                    ['role_id'          =>  $rolesId]
                );
            }

            return response()->json(['success' => 'Update Data Berhasil']);
        }
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
        $data = User::findOrFail($id);
        $data->delete();
    }
}
