<?php

namespace Bantenprov\Siswa\Models\Bantenprov\Siswa;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siswa extends Model
{
    use SoftDeletes;

    public $timestamps = true;

    protected $table = 'siswas';
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
        'user_id',
    ];
    protected $hidden = [
    ];
    protected $appends = [
        'label',
    ];
    protected $dates = [
        'deleted_at',
    ];

    public function getLabelAttribute()
    {
        return $this->nomor_un.' - '.$this->nama_siswa;
    }

    public function province()
    {
        return $this->belongsTo('Laravolt\Indonesia\Models\Province','province_id');
    }

    public function city()
    {
        return $this->belongsTo('Laravolt\Indonesia\Models\City','city_id');
    }

    public function district()
    {
        return $this->belongsTo('Laravolt\Indonesia\Models\District','district_id');
    }

    public function village()
    {
        return $this->belongsTo('Laravolt\Indonesia\Models\Village','village_id');
    }

    public function sekolah()
    {
        return $this->belongsTo('Bantenprov\Sekolah\Models\Bantenprov\Sekolah\Sekolah','sekolah_id');
    }

    public function prodi_sekolah()
    {
        return $this->belongsTo('Bantenprov\Sekolah\Models\Bantenprov\Sekolah\ProdiSekolah','prodi_sekolah_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
