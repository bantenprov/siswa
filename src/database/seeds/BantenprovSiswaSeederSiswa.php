<?php

/* Require */
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

/* Models */
use Bantenprov\Siswa\Models\Bantenprov\Siswa\Siswa;

class BantenprovSiswaSeederSiswa extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
	public function run()
    {
        $faker = Faker::create();

        foreach (range(1,10) as $index) {
            DB::table('siswas')->insert([
                'nomor_un' => $faker->unique()->randomNumber($nbDigits = NULL, $strict = false),
                'pendaftaran_id' => $faker->unique()->randomNumber($nbDigits = NULL, $strict = false),
                'nik' => $faker->unique()->randomNumber($nbDigits = NULL, $strict = false),
                'label' => $faker->word,
                'nama_siswa' => $faker->name,
                'alamat_kk' => $faker->streetAddress,
                'tempat_lahir' => $faker->cityPrefix,
                'tgl_lahir' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'jenis_kelamin' => 'laki-laki',
                'agama' => 'agama',
                'nisn' => $faker->unique()->randomNumber($nbDigits = NULL, $strict = false),
                'tahun_lulus' => '2017',
                'description' => $faker->text($maxNbChars = 200),
                'user_id'     => $faker->unique()->randomNumber($nbDigits = NULL, $strict = false)                            

            ]); 
        }       
    }
}
