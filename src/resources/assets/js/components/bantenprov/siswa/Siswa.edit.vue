<template>
  <div class="card">
    <div class="card-header">
      <i class="fa fa-table" aria-hidden="true"></i> Edit Data Siswa

      <ul class="nav nav-pills card-header-pills pull-right">
        <li class="nav-item">
          <button class="btn btn-primary btn-sm" role="button" @click="back">
            <i class="fa fa-arrow-left" aria-hidden="true"></i>
          </button>
        </li>
      </ul>
    </div>

    <div class="card-body">
      <vue-form class="form-horizontal form-validation" :state="state" @submit.prevent="onSubmit">
        <div class="form-row">
          <div class="col-md">
            <validate tag="div">
              <label for="nomor_un">Nomor UN</label>
              <input class="form-control" v-model="model.nomor_un" name="nomor_un" type="text" placeholder="Nomor UN">

              <field-messages name="nomor_un" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
              </field-messages>
            </validate>
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
              <label for="nik">NIK</label>
              <input class="form-control" v-model="model.nik" name="nik" type="text" placeholder="NIK">

              <field-messages name="nik" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
              </field-messages>
            </validate>
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
              <label for="nama_siswa">Nama Siswa</label>
              <input class="form-control" v-model="model.nama_siswa" name="nama_siswa" type="text" placeholder="Nama Siswa">

              <field-messages name="nama_siswa" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
              </field-messages>
            </validate>
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
              <label for="no_kk">No KK</label>
              <input class="form-control" v-model="model.no_kk" name="no_kk" type="text" placeholder="Alamat KK">

              <field-messages name="no_kk" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
              </field-messages>
            </validate>
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
              <label for="alamat_kk">Alamat KK</label>
              <input class="form-control" v-model="model.alamat_kk" name="alamat_kk" type="text" placeholder="Alamat KK">

              <field-messages name="alamat_kk" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
              </field-messages>
            </validate>
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
              <label for="tempat_lahir">Tempat Lahir</label>
              <input class="form-control" v-model="model.tempat_lahir" name="tempat_lahir" type="text" placeholder="Tempat Lahir">

              <field-messages name="tempat_lahir" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
              </field-messages>
            </validate>
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
              <label for="tgl_lahir">Tanggal Lahir</label>
              <input class="form-control" v-model="model.tgl_lahir" name="tgl_lahir" type="text" placeholder="Tanggal Lahir">

              <field-messages name="tgl_lahir" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
              </field-messages>
            </validate>
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <v-select v-model="model.jenis_kelamin" :options="jenis_kelamin" class="mb-4"></v-select>

            <field-messages name="jenis_kelamin" show="$invalid && $submitted" class="text-danger">
              <small class="form-text text-success">Looks good!</small>
              <small class="form-text text-danger" slot="required">Jenis Kelamin is a required field</small>
            </field-messages>
            </validate>
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
            <label for="agama">Agama</label>
            <v-select v-model="model.agama" :options="agama" class="mb-4"></v-select>

            <field-messages name="agama" show="$invalid && $submitted" class="text-danger">
              <small class="form-text text-success">Looks good!</small>
              <small class="form-text text-danger" slot="required">Agama is a required field</small>
            </field-messages>
            </validate>
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
              <label for="nisn">NISN</label>
              <input class="form-control" v-model="model.nisn" name="nisn" type="text" placeholder="NISN">

              <field-messages name="nisn" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
              </field-messages>
            </validate>
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
              <label for="tahun_lulus">Tahun Lulus</label>
              <input class="form-control" v-model="model.tahun_lulus" name="tahun_lulus" type="text" placeholder="Tahun Lulus">

              <field-messages name="tahun_lulus" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
              </field-messages>
            </validate>
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
              <label for="sekolah_id">Sekolah Tujuan</label>
              <v-select name="sekolah_id" v-model="model.sekolah" :options="sekolah" @input="changeSekolah" placeholder="Sekolah Tujuan" required></v-select>

              <field-messages name="sekolah_id" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
                <small class="form-text text-danger" slot="required">Sekolah tujuan is a required field</small>
              </field-messages>
            </validate>
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
              <label for="prodi_sekolah_id">Prodi Sekolah</label>
              <v-select name="prodi_sekolah_id" v-model="model.prodi_sekolah" :options="prodi_sekolah" placeholder="Prodi Sekolah" required></v-select>

              <field-messages name="prodi_sekolah_id" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
                <small class="form-text text-danger" slot="required">Sekolah tujuan is a required field</small>
              </field-messages>
            </validate>
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
              <label for="province_id">Provinsi</label>
              <v-select name="province_id" v-model="model.province" :options="province" @input="changeProvince" placeholder="Provinsi" required></v-select>

              <field-messages name="province_id" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
                <small class="form-text text-danger" slot="required">provinsi is a required field</small>
              </field-messages>
            </validate>
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
              <label for="city_id">Kabupaten/Kota</label>
              <v-select name="city_id" v-model="model.city" :options="city" @input="changeCity" placeholder="Kabupaten/Kota" required></v-select>

              <field-messages name="city_id" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
                <small class="form-text text-danger" slot="required">Kabupaten is a required field</small>
              </field-messages>
            </validate>
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
              <label for="district_id">Kecamatan</label>
              <v-select name="district_id" v-model="model.district" :options="district" @input="changeDistrict" placeholder="Kecamatan" required></v-select>

                <field-messages name="district_id" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
                <small class="form-text text-danger" slot="required">Kota is a required field</small>
              </field-messages>
            </validate>
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
              <label for="village_id">Kelurahan/Desa</label>
              <v-select name="village_id" v-model="model.village" :options="village" placeholder="Kelurahan/Desa" required></v-select>

              <field-messages name="village_id" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
                <small class="form-text text-danger" slot="required">Desa is a required field</small>
              </field-messages>
            </validate>
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
            <label for="user_id">Username</label>
            <v-select name="user_id" v-model="model.user" :options="user" class="mb-4"></v-select>

            <field-messages name="user_id" show="$invalid && $submitted" class="text-danger">
              <small class="form-text text-success">Looks good!</small>
              <small class="form-text text-danger" slot="required">Username is a required field</small>
            </field-messages>
            </validate>
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <button type="submit" class="btn btn-primary">Submit</button>

            <button type="reset" class="btn btn-secondary" @click="reset">Reset</button>
          </div>
        </div>

      </vue-form>
    </div>
  </div>
</template>

<script>
import swal from 'sweetalert2';
export default {
  mounted() {
    axios.get('api/siswa/' + this.$route.params.id + '/edit')
      .then(response => {
        if (response.data.status == true) {
          this.model.old_user_id      = response.data.siswa.user_id;
          this.model.user             = response.data.siswa.user.name;
          this.model.nomor_un         = response.data.siswa.nomor_un;
          this.model.nik              = response.data.siswa.nik;
          this.model.nama_siswa       = response.data.siswa.nama_siswa;
          this.model.no_kk            = response.data.siswa.no_kk;
          this.model.alamat_kk        = response.data.siswa.alamat_kk;
          this.model.tempat_lahir     = response.data.siswa.tempat_lahir;
          this.model.tgl_lahir        = response.data.siswa.tgl_lahir;
          this.model.nisn             = response.data.siswa.nisn;
          this.model.tahun_lulus      = response.data.siswa.tahun_lulus;
          this.model.prodi_sekolah    = response.data.siswa.prodi_sekolah;
          this.model.sekolah          = response.data.siswa.sekolah;
          this.model.province         = response.data.siswa.province;
          this.model.city             = response.data.siswa.city;
          this.model.district         = response.data.siswa.district;
          this.model.village          = response.data.siswa.village;
          this.model.jenis_kelamin    = response.data.siswa.jenis_kelamin;
          this.model.agama            = response.data.siswa.agama;

        } else {
          alert('Failed');
        }
      })
      .catch(function(response) {
        alert('Break');
        window.location.href = '#/admin/siswa';
      }),

      axios.get('api/siswa/create')
      .then(response => {
          if (response.data.status == true && response.data.error == false){
              this.model.user           = response.data.current_user;
              // this.model.prodi_sekolah    = response.data.prodi_sekolahs;
              
                this.prodi_sekolah.push(response.data.prodi_sekolahs);
            
                console.log(this.prodi_sekolah);

            if(response.data.user_special == true){
              this.user = response.data.users;
            }else{
              this.user.push(response.data.users);
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
       axios.get('api/wilayah-indonesia/province/get')
      .then(response => {
        if (response.data.status == true && response.data.error == false) {
          this.province = response.data.provinces;
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

       axios.get('api/sekolah/get')
      .then(response => {
        if (response.data.status == true && response.data.error == false) {
          this.sekolah = response.data.sekolahs;
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
  data() {
    return {
      state: {},
      model: {
        nomor_un          : "",
        nik               : "",
        nama_siswa        : "",
        alamat_kk         : "",
        province_id       : "",
        city_id           : "",
        district_id       : "",
        village_id        : "",
        tempat_lahir      : "",
        tgl_lahir         : "",
        jenis_kelamin     : "",
        agama             : "",
        nisn              : "",
        tahun_lulus       : "",
        sekolah_id        : "",
        prodi_sekolah_id  : "",
        user_id           : "",
        created_at        : "",
        updated_at        : "",

        province          : "",
        city              : "",
        district          : "",
        village           : "",
        sekolah           : "",
        prodi_sekolah     : "",
        user              : "",
      },
      province      : [],
      city          : [],
      district      : [],
      village       : [],
      sekolah       : [],
      prodi_sekolah : [],
      user          : [],

      jenis_kelamin: [
        {id: 1, label: 'Laki-laki'},
        {id: 2, label: 'Perempuan'}
      ],
      selectedJenisKelamin: {id: "-", label: 'Pilih Salah Satu'},

      agama: [
        {id: 1, label: 'Islam'},
        {id: 2, label: 'Kristen Protestan'},
        {id: 3, label: 'Kristen Katolik'},
        {id: 4, label: 'Hindu'},
        {id: 5, label: 'Buddha'},
        {id: 6, label: 'Khonghucu'}
      ],
      selectedAgama: {id: "-", label: 'Pilih Salah Satu'},
    }
  },
  methods: {
    onSubmit: function() {
      let app = this;
      let jenis_kelamin;
      let agama;

      console.log(this.model.jenis_kelamin);
      if(this.model.jenis_kelamin == "Laki-laki"){
        jenis_kelamin = "Laki-laki";
        
      }else if(this.model.jenis_kelamin == "Perempuan"){
        jenis_kelamin = "Perempuan";
      }else{
        jenis_kelamin = this.model.jenis_kelamin.label;
      }


      if(this.model.agama == "Islam"){
        agama = "Islam";
      }else if(this.model.agama == "Kristen Protestan"){
        agama = "Kristen Protestan";
      }else if(this.model.agama == "Kristen Katolik"){
        agama = "Kristen Katolik";
      }else if(this.model.agama == "Hindu"){
        agama = "Hindu";
      }else if(this.model.agama == "Buddha"){
        agama = "Buddha";
      }else if(this.model.agama == "Khonghucu"){
        agama = "Khonghucu";
      }else{
        agama = this.model.agama.label;
      }

      if (this.state.$invalid) {
        return;
      } else {
        axios.put('api/siswa/' + this.$route.params.id, {
            nomor_un          : this.model.nomor_un,
            nik               : this.model.nik,
            nama_siswa        : this.model.nama_siswa,
            no_kk             : this.model.no_kk,
            alamat_kk         : this.model.alamat_kk,
            province_id       : this.model.province.id,
            city_id           : this.model.city.id,
            district_id       : this.model.district.id,
            village_id        : this.model.village.id,
            tempat_lahir      : this.model.tempat_lahir,
            tgl_lahir         : this.model.tgl_lahir,
            jenis_kelamin     : jenis_kelamin,
            agama             : agama,
            nisn              : this.model.nisn,
            tahun_lulus       : this.model.tahun_lulus,
            sekolah_id        : this.model.sekolah.id,
            prodi_sekolah_id  : this.model.prodi_sekolah.id,
            user_id           : this.model.user.id,


          })
          .then(response => {
            if (response.data.status == true) {
              if(response.data.error == false){
                swal(
                  'Updated',
                  'Yeah!!! Your data has been updated.',
                  'success'
                );

                app.back();
              }else{
                swal(
                  'Failed',
                  'Oops... '+response.data.message,
                  'error'
                );
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
      }
    },

    changeSekolah() {
      // this.model.prodi_sekolah = '';
      if (typeof this.model.sekolah.id !== "undefined") {
        axios.get('api/prodi-sekolah/get/by-sekolah/'+this.model.sekolah.id)
          .then(response => {
            if (response.data.status == true && response.data.error == false) {
              this.prodi_sekolah = response.data.prodi_sekolahs;
            }
          });
      }
    },

    changeProvince() {
      if (typeof this.model.province.id === 'undefined') {
        this.model.city = "";
      } else {
        // this.model.city = "";

        axios.get('api/wilayah-indonesia/city/get/by-province/'+this.model.province.id)
          .then(response => {
            if (response.data.status == true && response.data.error == false) {
              this.city = response.data.cities;
            }
          });
      }
    },
    changeCity() {
      if (typeof this.model.city.id === 'undefined') {
        this.model.district = "";
      } else {
        // this.model.district = "";

        axios.get('api/wilayah-indonesia/district/get/by-city/'+this.model.city.id)
          .then(response => {
            if (response.data.status == true && response.data.error == false) {
              this.district = response.data.districts;
            }
          });
      }
    },
    changeDistrict() {
      if (typeof this.model.district.id === 'undefined') {
        this.model.village = "";
      } else {
        // this.model.village = "";

        axios.get('api/wilayah-indonesia/village/get/by-district/'+this.model.district.id)
          .then(response => {
            if (response.data.status == true && response.data.error == false) {
              this.village = response.data.villages;
            }
          });
      }
    },
    reset() {
      axios.get('api/siswa/' + this.$route.params.id + '/edit')
        .then(response => {
          if (response.data.status == true) {
            this.model.label = response.data.siswa.label;
            this.model.description = response.data.siswa.description;
          } else {
            alert('Failed');
          }
        })
        .catch(function(response) {
          alert('Break ');
        });
    },
    back() {
      window.location = '#/admin/siswa';
    }
  }
}
</script>
