<?php

namespace Bantenprov\Siswa\Http\Controllers;

/* Require */
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Bantenprov\Siswa\Facades\SiswaFacade;

/* Models */
use Bantenprov\Siswa\Models\Bantenprov\Siswa\Siswa;
use Bantenprov\Pendaftaran\Models\Bantenprov\Pendaftaran\Pendaftaran;

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
    protected $pendaftaranModel;

    public function __construct(Siswa $siswa, Pendaftaran $pendaftaran)
    {
        $this->siswa = $siswa;
        $this->pendaftaranModel = $pendaftaran;
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
                $q->where('label', 'like', $value)
                    ->orWhere('description', 'like', $value);
            });
        }

        $perPage = request()->has('per_page') ? (int) request()->per_page : null;
        $response = $query->paginate($perPage);
        
        foreach($response as $pendaftaran){            
            array_set($response->data, 'pendaftaran_id', $pendaftaran->pendaftaran->label);           
        }
        
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
        $pendaftaran = $this->pendaftaranModel->all();
        
        $response['pendaftaran'] = $pendaftaran;
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
            'pendaftaran_id' => 'required',
            'label' => 'required|max:16|unique:siswas,label',
            'description' => 'max:255',
        ]);

        if($validator->fails()){
            $check = $siswa->where('label',$request->label)->whereNull('deleted_at')->count();

            if ($check > 0) {
                $response['message'] = 'Failed, label ' . $request->label . ' already exists';
            } else {
                $siswa->pendaftaran_id = $request->input('pendaftaran_id');
                $siswa->label = $request->input('label');
                $siswa->description = $request->input('description');
                $siswa->save();

                $response['message'] = 'success';
            }
        } else {
            $siswa->pendaftaran_id = $request->input('pendaftaran_id');
            $siswa->label = $request->input('label');
            $siswa->description = $request->input('description');
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

        $response['siswa'] = $siswa;
        $response['pendaftaran'] = $siswa->pendaftaran;
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
        $siswa = $this->siswa->findOrFail($id);

        if ($request->input('old_label') == $request->input('label'))
        {
            $validator = Validator::make($request->all(), [
                'label' => 'required|max:16',
                'description' => 'max:255',
                'pendaftaran_id' => 'required'
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'label' => 'required|max:16|unique:siswas,label',
                'description' => 'max:255',
                'pendaftaran_id' => 'required'
            ]);
        }

        if ($validator->fails()) {
            $check = $siswa->where('label',$request->label)->whereNull('deleted_at')->count();

            if ($check > 0) {
                $response['message'] = 'Failed, label ' . $request->label . ' already exists';
            } else {
                $siswa->label = $request->input('label');
                $siswa->description = $request->input('description');
                $siswa->pendaftaran_id = $request->input('pendaftaran_id');
                $siswa->save();

                $response['message'] = 'success';
            }
        } else {
            $siswa->label = $request->input('label');
            $siswa->description = $request->input('description');
            $siswa->pendaftaran_id = $request->input('pendaftaran_id');
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
