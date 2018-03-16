<?php namespace Bantenprov\Siswa\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * The SiswaModel class.
 *
 * @package Bantenprov\Siswa
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class SiswaModel extends Model
{
    /**
    * Table name.
    *
    * @var string
    */
    protected $table = 'siswa';

    /**
    * The attributes that are mass assignable.
    *
    * @var mixed
    */
    protected $fillable = ['nomor_un','pendaftaran_id','nik','label','nama_siswa','alamat_kk','tempat_lahir','tgl_lahir','jenis_kelamin','agama','nisn','tahun_lulus','description','user_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
