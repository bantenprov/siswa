<template>
  <div class="card">
    <div class="card-header">
      <i class="fa fa-table" aria-hidden="true"></i> {{ title }}

      <ul class="nav nav-pills card-header-pills pull-right">
        <li class="nav-item">
          <button class="btn btn-primary btn-sm" role="button" @click="back">
            <i class="fa fa-arrow-left" aria-hidden="true"></i>
          </button>
        </li>
      </ul>
    </div>

    <div class="card-body">
      <dl class="row">
          <dt class="col-4">Nomor UN</dt>
          <dd class="col-8">{{ model.nomor_un }}</dd>

          <dt class="col-4">NIK</dt>
          <dd class="col-8">{{ model.nik }}</dd>

          <dt class="col-4">Nama Siswa</dt>
          <dd class="col-8">{{ model.nama_siswa }}</dd>

          <dt class="col-4">Nomor KK</dt>
          <dd class="col-8">{{ model.no_kk }}</dd>

          <dt class="col-4">Alamat KK</dt>
          <dd class="col-8">{{ model.alamat_kk }}</dd>

          <dt class="col-4">Provinsi</dt>
          <dd class="col-8">{{ model.province.name }}</dd>

          <dt class="col-4">Kabupaten/Kota</dt>
          <dd class="col-8">{{ model.city.name }}</dd>

          <dt class="col-4">Kecamatan</dt>
          <dd class="col-8">{{ model.district.name }}</dd>

          <dt class="col-4">Kelurahan/Desa</dt>
          <dd class="col-8">{{ model.village.name }}</dd>

          <dt class="col-4">Tempat Lahir</dt>
          <dd class="col-8">{{ model.tempat_lahir }}</dd>

          <dt class="col-4">Tanggal Lahir</dt>
          <dd class="col-8">{{ model.tgl_lahir }}</dd>

          <dt class="col-4">Jenis Kelamin</dt>
          <dd class="col-8">{{ model.jenis_kelamin }}</dd>

          <dt class="col-4">Agama</dt>
          <dd class="col-8">{{ model.agama }}</dd>

          <dt class="col-4">NISN</dt>
          <dd class="col-8">{{ model.nisn }}</dd>

          <dt class="col-4">Tahun Lulus</dt>
          <dd class="col-8">{{ model.tahun_lulus }}</dd>

          <dt class="col-4">Sekolah Tujuan:</dt>
          <dd class="col-8">{{ model.sekolah.nama }}</dd>
      </dl>
    </div>

    <div class="card-footer text-muted">
      <div class="row">
        <div class="col-md">
          <b>Username :</b> {{ model.user.name }}
        </div>
        <div class="col-md">
          <div class="col-md text-right">Dibuat : {{ model.created_at }}</div>
          <div class="col-md text-right">Diperbarui : {{ model.updated_at }}</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import swal from 'sweetalert2';

export default {
  data() {
    return {
      state: {},
      title: 'View Siswa',
      model: {
        nomor_un      : "",
        nik           : "",
        nama_siswa    : "",
        alamat_kk     : "",
        province_id   : "",
        city_id       : "",
        district_id   : "",
        village_id    : "",
        tempat_lahir  : "",
        tgl_lahir     : "",
        jenis_kelamin : "",
        agama         : "",
        nisn          : "",
        tahun_lulus   : "",
        sekolah_id    : "",
        user_id       : "",
        created_at    : "",
        updated_at    : "",

        province      : [],
        city          : [],
        district      : [],
        village       : [],
        sekolah       : [],
        user          : [],
      },
    }
  },
  mounted() {
    let app = this;

    axios.get('api/siswa/'+this.$route.params.id)
      .then(response => {
        if (response.data.status == true && response.data.error == false) {
          this.model.nomor_un       = response.data.siswa.nomor_un;
          this.model.nik            = response.data.siswa.nik;
          this.model.nama_siswa     = response.data.siswa.nama_siswa;
          this.model.no_kk          = response.data.siswa.no_kk;
          this.model.alamat_kk      = response.data.siswa.alamat_kk;
          this.model.province_id    = response.data.siswa.province_id;
          this.model.city_id        = response.data.siswa.city_id;
          this.model.district_id    = response.data.siswa.district_id;
          this.model.village_id     = response.data.siswa.village_id;
          this.model.tempat_lahir   = response.data.siswa.tempat_lahir;
          this.model.tgl_lahir      = response.data.siswa.tgl_lahir;
          this.model.jenis_kelamin  = response.data.siswa.jenis_kelamin;
          this.model.agama          = response.data.siswa.agama;
          this.model.nisn           = response.data.siswa.nisn;
          this.model.tahun_lulus    = response.data.siswa.tahun_lulus;
          this.model.sekolah_id     = response.data.siswa.sekolah_id;
          this.model.user_id        = response.data.siswa.user_id;
          this.model.created_at     = response.data.siswa.created_at;
          this.model.updated_at     = response.data.siswa.updated_at;

          this.model.province       = response.data.siswa.province;
          this.model.city           = response.data.siswa.city;
          this.model.district       = response.data.siswa.district;
          this.model.village        = response.data.siswa.village;
          this.model.sekolah        = response.data.siswa.sekolah;
          this.model.user           = response.data.siswa.user;

          if (this.model.province === null) {
            this.model.province = {"id": this.model.province_id,"name":""};
          }

          if (this.model.city === null) {
            this.model.city = {"id": this.model.city_id,"name":""};
          }

          if (this.model.district === null) {
            this.model.district = {"id": this.model.district_id,"name":""};
          }

          if (this.model.village === null) {
            this.model.village = {"id": this.model.village_id,"name":""};
          }

          if (this.model.sekolah === null) {
            this.model.sekolah = {"id": this.model.sekolah_id,"nama":""};
          }

          if (this.model.user === null) {
            this.model.user = {"id": this.model.user_id,"name":""};
          }
        } else {
          swal(
            'Failed',
            'Oops... '+response.data.message,
            'error'
          );

          app.back();
        }
      })
      .catch(function(response) {
        swal(
          'Not Found',
          'Oops... Your page is not found.',
          'error'
        );

        app.back();
      });
  },
  methods: {
    back() {
      window.location = '#/admin/siswa';
    }
  }
}
</script>
