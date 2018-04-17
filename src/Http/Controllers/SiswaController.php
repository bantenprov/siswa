<?php

namespace Bantenprov\Siswa\Http\Controllers;

/* Require */
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Bantenprov\Siswa\Facades\SiswaFacade;

/* Models */
use Bantenprov\Siswa\Models\Bantenprov\Siswa\Siswa;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Village;
use Bantenprov\Sekolah\Models\Bantenprov\Sekolah\Sekolah;
use App\User;

/* Etc */
use Validator;
use Auth;

/**
 * The SiswaController class.
 *
 * @package Bantenprov\Siswa
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class SiswaController extends Controller
{
    protected $siswa;
    protected $province;
    protected $city;
    protected $district;
    protected $village;
    protected $sekolah;
    protected $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->siswa    = new Siswa;
        $this->province = new Province;
        $this->city     = new City;
        $this->district = new District;
        $this->village  = new Village;
        $this->sekolah  = new Sekolah;
        $this->user     = new User;
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

                $q->where('nomor_un', 'like', $value)
                    ->orWhere('nik', 'like', $value)
                    ->orWhere('nama_siswa', 'like', $value)
                    ->orWhere('no_kk', 'like', $value)
                    ->orWhere('nisn', 'like', $value);
            });
        }

        $perPage    = request()->has('per_page') ? (int) request()->per_page : null;

        $response   = $query->with(['province', 'city', 'district', 'village', 'sekolah', 'user'])->paginate($perPage);

        return response()->json($response)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $response = [];

        $sekolahs       = $this->sekolah->all();
        $provinces      = $this->province->getAttributes();
        $citys          = $this->city->getAttributes();
        $districts      = $this->district->getAttributes();
        $villages       = $this->village->getAttributes();
        $users_special  = $this->user->all();
        $users_standar  = $this->user->find(\Auth::User()->id);
        $current_user   = \Auth::User();

        if ($request->has('no_kk') && strlen($request->input('no_kk')) == 16) {
            $no_kk          = '3602142003170013';
            $province_id    = substr($no_kk, 0, 2);
            $city_id        = substr($no_kk, 2, 2);
            $district_id    = substr($no_kk, 4, 2);
            $village_id     = substr($no_kk, 6, 3);

            $provinces      = \Indonesia::findProvince($province_id);
            $citys          = \Indonesia::findCity($city_id);
            $districts      = \Indonesia::findDistrict($district_id);
            $villages       = \Indonesia::findVillage($village_id);
        }

        $role_check = \Auth::User()->hasRole(['superadministrator','administrator']);

        if($role_check){
            $response['user_special'] = true;
            foreach($users_special as $user){
                array_set($user, 'label', $user->name);
            }
            $response['user'] = $users_special;
        }else{
            $response['user_special'] = false;
            array_set($users_standar, 'label', $users_standar->name);
            $response['user'] = $users_standar;
        }

        array_set($current_user, 'label', $current_user->name);

        $response['current_user'] = $current_user;

        foreach($sekolahs as $sekolah){
            array_set($sekolah, 'sekolah', $sekolah->label);
        }

        foreach($provinces as $province){
            array_set($province, 'label', $province->name);
        }

        foreach($citys as $city){
            array_set($city, 'label', $city->name);
        }

        foreach($districts as $district){
            array_set($district, 'label', $district->name);
        }

        foreach($villages as $village){
            array_set($village, 'label', $village->name);
        }

        $response['sekolah']    = $sekolahs;
        $response['province']   = $provinces;
        $response['city']       = $citys;
        $response['district']   = $districts;
        $response['village']    = $villages;
        $response['status']     = true;
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
            'nomor_un'      => 'required|unique:siswas,nomor_un',
            'nik'           => 'required|unique:siswas,nik',
            'nama_siswa'    => 'required',
            'no_kk'         => 'required|unique:siswas,no_kk',
            'alamat_kk'     => 'required',
            'province_id'   => 'required',
            'city_id'       => 'required',
            'district_id'   => 'required',
            'village_id'    => 'required',
            'tempat_lahir'  => 'required',
            'tgl_lahir'     => 'required',
            'jenis_kelamin' => 'required',
            'agama'         => 'required',
            'nisn'          => 'required',
            'sekolah_id'    => 'required',
            'tahun_lulus'   => 'required',
        ]);
        if($validator->fails()){
            $check = $siswa->where('user_id',$request->user_id)->orWhere('nomor_un', $request->nomor_un)->orWhere('nik', $request->nik)->orWhere('no_kk', $request->no_kk)->whereNull('deleted_at')->count();
            if ($check > 0) {
                $response['message'] = 'Failed, Username, nomor un, nik, no kk  already exists';
            } else {
                $siswa->user_id         = $request->input('user_id');
                $siswa->nomor_un        = $request->input('nomor_un');
                $siswa->nik             = $request->input('nik');
                $siswa->nama_siswa      = $request->input('nama_siswa');
                $siswa->no_kk           = $request->input('no_kk');
                $siswa->alamat_kk       = $request->input('alamat_kk');
                $siswa->province_id     = $request->input('province_id');
                $siswa->city_id         = $request->input('city_id');
                $siswa->district_id     = $request->input('district_id');
                $siswa->village_id      = $request->input('village_id');
                $siswa->tempat_lahir    = $request->input('tempat_lahir');
                $siswa->tgl_lahir       = $request->input('tgl_lahir');
                $siswa->jenis_kelamin   = $request->input('jenis_kelamin');
                $siswa->agama           = $request->input('agama');
                $siswa->nisn            = $request->input('nisn');
                $siswa->sekolah_id      = $request->input('sekolah_id');
                $siswa->tahun_lulus     = $request->input('tahun_lulus');
                $siswa->save();
                $response['message'] = 'success';
            }
        } else {
                $siswa->user_id         = $request->input('user_id');
                $siswa->nomor_un        = $request->input('nomor_un');
                $siswa->nik             = $request->input('nik');
                $siswa->nama_siswa      = $request->input('nama_siswa');
                $siswa->no_kk           = $request->input('no_kk');
                $siswa->alamat_kk       = $request->input('alamat_kk');
                $siswa->province_id     = $request->input('province_id');
                $siswa->city_id         = $request->input('city_id');
                $siswa->district_id     = $request->input('district_id');
                $siswa->village_id      = $request->input('village_id');
                $siswa->tempat_lahir    = $request->input('tempat_lahir');
                $siswa->tgl_lahir       = $request->input('tgl_lahir');
                $siswa->jenis_kelamin   = $request->input('jenis_kelamin');
                $siswa->agama           = $request->input('agama');
                $siswa->nisn            = $request->input('nisn');
                $siswa->sekolah_id      = $request->input('sekolah_id');
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
        $siswa = $this->siswa->with(['province', 'city', 'district', 'village', 'sekolah', 'user'])->findOrFail($id);

        $response['siswa']      = $siswa;
        $response['message']    = 'Loaded';
        $response['status']     = true;

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
            $response['message']    = 'Success';
            $response['success']    = true;
            $response['status']     = true;
        } else {
            $response['success']    = false;
            $response['status']     = false;
        }

        return json_encode($response);
    }
}
