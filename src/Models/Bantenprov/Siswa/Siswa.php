<?php

namespace Bantenprov\Siswa\Models\Bantenprov\Siswa;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siswa extends Model
{
    use SoftDeletes;

    public $timestamps = true;

    protected $table = 'siswas';
    protected $dates = [
        'deleted_at'
    ];
    protected $fillable = [
        'nomor_un',
        'nik',
        'nama_siswa',
        'no_kk',
        'alamat_kk',
        'province_id',
        'city_id',
        'district_id',
        'village_id',
        'tempat_lahir',
        'tgl_lahir',
        'jenis_kelamin',
        'agama',
        'nisn',
        'tahun_lulus',
        'sekolah_id',
        'user_id'  
        
    ];

       public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function sekolah()
    {
        return $this->belongsTo('Bantenprov\Sekolah\Models\Bantenprov\Sekolah\Sekolah','sekolah_id');
    }

}
