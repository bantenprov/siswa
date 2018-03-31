<?php
namespace Bantenprov\Siswa\Http\Controllers;
/* Require */
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Bantenprov\Siswa\Facades\SiswaFacade;
/* Models */
use Bantenprov\Siswa\Models\Bantenprov\Siswa\Siswa;
use Bantenprov\Pendaftaran\Models\Bantenprov\Pendaftaran\Pendaftaran;
use App\User;
/* Etc */
use Validator;
/**
 * The SiswaController class.
 *
 * @package Bantenprov\Siswa
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class SiswaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $user;
    public function __construct(Siswa $siswa, User $user)
    {
        $this->siswa = $siswa;
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (request()->has('sort')) {
            list($sortCol, $sortDir) = explode('|', request()->sort);
            $query = $this->siswa->orderBy($sortCol, $sortDir);
        } else {
            $query = $this->siswa->orderBy('id', 'asc');
        }
        if ($request->exists('filter')) {
            $query->where(function($q) use($request) {
                $value = "%{$request->filter}%";
                $q->where('nik', 'like', $value)
                    ->orWhere('nama_siswa', 'like', $value);
            });
        }
        $perPage = request()->has('per_page') ? (int) request()->per_page : null;
        $response = $query->with('user')->paginate($perPage);
        
        /*foreach($response as $user){
            array_set($response->data, 'user', $user->user->name);
        }*/
        
        return response()->json($response)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        $users = $this->user->all();

        foreach($users as $user){
            array_set($user, 'label', $user->name);
        }
        
        $response['user'] = $users;
        $response['status'] = true;
        return response()->json($response);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $siswa = $this->siswa;
        $validator = Validator::make($request->all(), [
            'user_id'       => 'required|unique:siswas,user_id',
            'label'         => 'required',
            'description'   => 'required',
            'nomor_un'      => 'required|unique:siswas,nomor_un',
            'nik'           => 'required|unique:siswas,nik',
            'nama_siswa'    => 'required',
            'alamat_kk'     => 'required',
            'tempat_lahir'  => 'required',
            'tgl_lahir'     => 'required',
            'jenis_kelamin' => 'required',
            'agama'         => 'required',
            'nisn'          => 'required',
            'tahun_lulus'   => 'required',  
        ]);
        if($validator->fails()){
            $check = $siswa->where('user_id',$request->user_id)->orWhere('nomor_un', $request->nomor_un)->orWhere('nik', $request->nik)->whereNull('deleted_at')->count();
            if ($check > 0) {
                $response['message'] = 'Failed, Username, nomor un, nik,  already exists';
            } else {
                $siswa->user_id         = $request->input('user_id');
                $siswa->label           = $request->input('label');
                $siswa->description     = $request->input('description');
                $siswa->nomor_un        = $request->input('nomor_un');
                $siswa->nik             = $request->input('nik');
                $siswa->nama_siswa      = $request->input('nama_siswa');
                $siswa->alamat_kk       = $request->input('alamat_kk');
                $siswa->tempat_lahir    = $request->input('tempat_lahir');
                $siswa->tgl_lahir       = $request->input('tgl_lahir');
                $siswa->jenis_kelamin   = $request->input('jenis_kelamin');
                $siswa->agama           = $request->input('agama');
                $siswa->nisn            = $request->input('nisn');
                $siswa->tahun_lulus     = $request->input('tahun_lulus');
                $siswa->save();
                $response['message'] = 'success';
            }
        } else {
                $siswa->user_id         = $request->input('user_id');
                $siswa->label           = $request->input('label');
                $siswa->description     = $request->input('description');
                $siswa->nomor_un        = $request->input('nomor_un');
                $siswa->nik             = $request->input('nik');
                $siswa->nama_siswa      = $request->input('nama_siswa');
                $siswa->alamat_kk       = $request->input('alamat_kk');
                $siswa->tempat_lahir    = $request->input('tempat_lahir');
                $siswa->tgl_lahir       = $request->input('tgl_lahir');
                $siswa->jenis_kelamin   = $request->input('jenis_kelamin');
                $siswa->agama           = $request->input('agama');
                $siswa->nisn            = $request->input('nisn');
                $siswa->tahun_lulus     = $request->input('tahun_lulus');
                $siswa->save();
                $response['message'] = 'success';
        }
        $response['status'] = true;
        return response()->json($response);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $siswa = $this->siswa->findOrFail($id);
                    
        array_set($siswa, 'user', $siswa->user->name);           
        
        $response['siswa'] = $siswa;
        $response['status'] = true;

        

        return response()->json($response);

        
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $siswa = $this->siswa->findOrFail($id);
        array_set($siswa->user, 'label', $siswa->user->name);
        //dd($siswa->user);
        $response['siswa'] = $siswa;
        $response['user'] = $siswa->user;
        $response['status'] = true;
        return response()->json($response);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $response = array();
        $message  = array();
        $siswa = $this->siswa->findOrFail($id);
            
            $validator = Validator::make($request->all(), [
                'user_id'       => 'required|unique:siswas,user_id,'.$id,
                'label'         => 'required',
                'description'   => 'required',
                'nomor_un'      => 'required|unique:siswas,nomor_un,'.$id,
                'nik'           => 'required|unique:siswas,nik,'.$id,
                'nama_siswa'    => 'required',
                'alamat_kk'     => 'required',
                'tempat_lahir'  => 'required',
                'tgl_lahir'     => 'required',
                'jenis_kelamin' => 'required',
                'agama'         => 'required',
                'nisn'          => 'required',
                'tahun_lulus'   => 'required',

                ]);

                if($validator->fails()){

                    foreach($validator->messages()->getMessages() as $key => $error){
                        foreach($error AS $error_get) {
                            array_push($message, $error_get);
                        }                
                    } 
                
                   
                    $check_user     = $this->siswa->where('id','!=', $id)->where('user_id', $request->user_id);
                    $check_nomor_un = $this->siswa->where('id','!=', $id)->where('nomor_un', $request->nomor_un);
                    $check_nik      = $this->siswa->where('id','!=', $id)->where('nik', $request->nik);

                    if($check_nomor_un->count() > 0 || $check_user->count() > 0 || $check_nik->count() > 0){
                        $response['message'] = implode("\n",$message);

                    }else{
                         $siswa->user_id = $request->input('user_id');
                        $siswa->label = $request->input('label');
                        $siswa->description = $request->input('description');
                        $siswa->nomor_un = $request->input('nomor_un');
                        $siswa->nik = $request->input('nik');
                        $siswa->nama_siswa = $request->input('nama_siswa');
                        $siswa->alamat_kk = $request->input('alamat_kk');
                        $siswa->tempat_lahir = $request->input('tempat_lahir');
                        $siswa->tgl_lahir = $request->input('tgl_lahir');
                        $siswa->jenis_kelamin = $request->input('jenis_kelamin');
                        $siswa->agama = $request->input('agama');
                        $siswa->nisn = $request->input('nisn');
                        $siswa->tahun_lulus = $request->input('tahun_lulus');
                        $siswa->save();
                        $response['message'] = 'success';
                    }
             }else{
                    $siswa->user_id = $request->input('user_id');
                    $siswa->label = $request->input('label');
                    $siswa->description = $request->input('description');
                    $siswa->nomor_un = $request->input('nomor_un');
                    $siswa->nik = $request->input('nik');
                    $siswa->nama_siswa = $request->input('nama_siswa');
                    $siswa->alamat_kk = $request->input('alamat_kk');
                    $siswa->tempat_lahir = $request->input('tempat_lahir');
                    $siswa->tgl_lahir = $request->input('tgl_lahir');
                    $siswa->jenis_kelamin = $request->input('jenis_kelamin');
                    $siswa->agama = $request->input('agama');
                    $siswa->nisn = $request->input('nisn');
                    $siswa->tahun_lulus = $request->input('tahun_lulus');
                    $siswa->save();
                    $response['message'] = 'success';
        }

        $response['status'] = true;
        return response()->json($response);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siswa = $this->siswa->findOrFail($id);
        if ($siswa->delete()) {
            $response['status'] = true;
        } else {
            $response['status'] = false;
        }
        return json_encode($response);
    }
}
