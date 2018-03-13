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
        Model::unguard();

        $siswas = (object) [
            (object) [
                'pendaftaran_id' => '1',
                'label' => 'Siswa 1',
                'description' => 'Siswa satu'
            ],
            (object) [
                'pendaftaran_id' => '2',
                'label' => 'Siswa 2',
                'description' => 'Siswa dua',
            ]
        ];

        foreach ($siswas as $siswa) {
            $model = Siswa::updateOrCreate(
                [
                    'pendaftaran_id' => $siswa->pendaftaran_id,
                ],
                [
                    'label' => $siswa->label,
                ],
                [
                    'description' => $siswa->description,
                ]
            );
            $model->save();
        }
	}
}
