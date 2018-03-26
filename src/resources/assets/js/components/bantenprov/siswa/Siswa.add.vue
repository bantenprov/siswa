<template>
  <div class="card">
    <div class="card-header">
      <i class="fa fa-table" aria-hidden="true"></i> siswa : {{ model.label }}

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
            <b>Label :</b> {{ model.label }}
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <b>Description :</b> {{ model.description}}
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <b>Nomor UN :</b> {{ model.nomor_un}}
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <b>Username :</b> {{ model.user.name}}
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <b>Nik :</b> {{ model.nik}}
          </div>
        </div>
        
        <div class="form-row mt-4">
          <div class="col-md">
            <b>Nama Siswa :</b> {{ model.nama_siswa}}
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <b>Alamat KK :</b> {{ model.alamat_kk}}
          </div>
        </div>
        
        <div class="form-row mt-4">
          <div class="col-md">
            <b>Tempat Lahir :</b> {{ model.tempat_lahir}}
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <b>Tanggal Lahir :</b> {{ model.tgl_lahir}}
          </div>
        </div>
        
        <div class="form-row mt-4">
          <div class="col-md">
            <b>Jenis Kelamin :</b> {{ model.jenis_kelamin}}
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <b>Agama :</b> {{ model.agama}}
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <b>NISN :</b> {{ model.nisn}}
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <b>Tahun Lulus :</b> {{ model.tahun_lulus}}
          </div>
        </div>


      </vue-form>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    axios.get('api/siswa/' + this.$route.params.id)
      .then(response => {
        if (response.data.status == true) {
          this.model.label = response.data.siswa.label;
          this.model.old_label = response.data.siswa.label;
          this.model.description = response.data.siswa.description;
          this.model.user = response.data.siswa.user;
          this.model.nomor_un = response.data.siswa.nomor_un;
          this.model.nik = response.data.siswa.nik;
          this.model.nama_siswa = response.data.siswa.nama_siswa;
          this.model.alamat_kk = response.data.siswa.alamat_kk;
          this.model.tempat_lahir = response.data.siswa.tempat_lahir;
          this.model.tgl_lahir = response.data.siswa.tgl_lahir;
          this.model.jenis_kelamin = response.data.siswa.jenis_kelamin;
          this.model.agama = response.data.siswa.agama;
          this.model.nisn = response.data.siswa.nisn;
          this.model.tahun_lulus = response.data.siswa.tahun_lulus;
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
          response.data.user.forEach(element => {
            this.user.push(element);
          });
      })
      .catch(function(response) {
        alert('Break');
      })
  },
  data() {
    return {
      state: {},
      model: {
        label: "",
        description: "",
        user_id: "",
        nomor_un: "",
        nik: "",
        nama_siswa: "",
        alamat_kk: "",
        tempat_lahir: "",
        tgl_lahir: "",
        jenis_kelamin: "",
        agama: "",
        nisn: "",
        tahun_lulus: ""

      },
      user: []
    }
  },
  methods: {
    onSubmit: function() {
      let app = this;

      if (this.state.$invalid) {
        return;
      } else {
        axios.put('api/siswa/' + this.$route.params.id, {
            label: this.model.label,
            description: this.model.description,
            old_label: this.model.old_label,
            user_id: this.model.user.id,
            nomor_un: this.model.nomor_un,
            nik: this.model.nik,
            nama_siswa: this.model.nama_siswa,
            alamat_kk: this.model.alamat_kk,
            tempat_lahir: this.model.tempat_lahir,
            tgl_lahir: this.model.tgl_lahir,
            jenis_kelamin: this.model.jenis_kelamin,
            agama: this.model.agama,
            nisn: this.model.nisn,
            tahun_lulus: this.model.tahun_lulus,


          })
          .then(response => {
            if (response.data.status == true) {
              if(response.data.message == 'success'){
                alert(response.data.message);
                app.back();
              }else{
                alert(response.data.message);
              }
            } else {
              alert(response.data.message);
            }
          })
          .catch(function(response) {
            alert('Break ' + response.data.message);
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
