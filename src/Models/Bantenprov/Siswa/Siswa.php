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
        'label',
        'description',        
        'pendaftaran_id'
    ];

    public function pendaftaran()
    {
        return $this->belongsTo('Bantenprov\Pendaftaran\Models\Bantenprov\Pendaftaran\Pendaftaran','pendaftaran_id');
    }
       public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

}
