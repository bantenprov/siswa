<?php
use Illuminate\Database\Seeder;
/**
 * Usage :
 * [1] $ composer dump-autoload -o
 * [2] $ php artisan db:seed --class=BantenprovSiswaSeder
 */
class BantenprovSiswaSeeder extends Seeder
{
    /* text color */
    protected $RED     ="\033[0;31m";
    protected $CYAN    ="\033[0;36m";
    protected $YELLOW  ="\033[1;33m";
    protected $ORANGE  ="\033[0;33m";
    protected $PUR     ="\033[0;35m";
    protected $GRN     ="\e[32m";
    protected $WHI     ="\e[37m";
    protected $NC      ="\033[0m";
    /* File name */
    /* location : /databse/seeds/file_name.csv */
    protected $fileName = "BantenprovSiswaSeeder.csv";
    /* text info : default (true) */
    protected $textInfo = true;
    /* model class */
    protected $model;
    /* __construct */
    public function __construct(){
        $this->model = new Bantenprov\Siswa\Models\Bantenprov\Siswa\Siswa;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->insertData();
    }
    /* function insert data */
    protected function insertData()
    {
        /* silahkan di rubah sesuai kebutuhan */
        foreach($this->readCSV() as $data){


        	$this->model->create([
            	'nomor_un' 	=> $data['nomor_un'],
				'nik' 		=> $data['nik'],
				'nama_siswa' => $data['nama_siswa'],
				'no_kk' => $data['no_kk'],
				'alamat_kk' => $data['alamat_kk'],
				'province_id' => $data['province_id'],
				'city_id' => $data['city_id'],
				'district_id' => $data['district_id'],
				'village_id' => $data['village_id'],
				'tempat_lahir' => $data['tempat_lahir'],
				'tgl_lahir' => $data['tgl_lahir'],
				'jenis_kelamin' => $data['jenis_kelamin'],
				'agama' => $data['agama'],
				'nisn' => $data['nisn'],
				'tahun_lulus' => $data['tahun_lulus'],
				'sekolah_id' => $data['sekolah_id'],
				'kegiatan_id' => $data['kegiatan_id'],
				'user_id' => $data['user_id'],

        	]);


        }
        $this->greenText('[ SEEDER DONE ]');
        echo"\n\n";
    }
    /* text color: orange */
    protected function orangeText($text)
    {
        printf($this->ORANGE.$text.$this->NC);
    }
    /* text color: green */
    protected function greenText($text)
    {
        printf($this->GRN.$text.$this->NC);
    }
    /* function read CSV file */
    protected function readCSV()
    {
        $file = fopen(database_path("seeds/".$this->fileName), "r");
        $all_data = array();
        $row = 1;
        while(($data = fgetcsv($file, 1000, ",")) !== FALSE){
            $all_data[] = ['nomor_un' => $data[0],
                    'nik' => $data[1],
                    'nama_siswa' => $data[2],
                    'no_kk' => $data[3],
                    'alamat_kk' => $data[4],
                    'province_id' => $data[5],
                    'city_id' => $data[6],
                    'district_id' => $data[7],
                    'village_id' => $data[8],
                    'tempat_lahir' => $data[9],
                    'tgl_lahir' => $data[10],
                    'jenis_kelamin' => $data[11],
                    'agama' => $data[12],
                    'nisn' => $data[13],
                    'tahun_lulus' => $data[14],
                    'sekolah_id' => $data[15],
                    'kegiatan_id' => $data[16],
                    'user_id' => $data[17],

                ];
        }
        fclose($file);
        return  $all_data;
    }
}