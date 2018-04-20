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
              <label for="label">label</label>
              <input class="form-control" v-model="model.label" required autofocus name="label" type="text" placeholder="Label">

              <field-messages name="label" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
                <small class="form-text text-danger" slot="required">Label is a required field</small>
              </field-messages>
            </validate>
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
              <label for="description">description</label>
              <input class="form-control" v-model="model.description" name="description" type="text" placeholder="Description">

              <field-messages name="description" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
              </field-messages>
            </validate>
          </div>
        </div>

        <div class="form-row mt-4">
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
              <input class="form-control" v-model="model.jenis_kelamin" name="jenis_kelamin" type="text" placeholder="Jenis Kelamin">

              <field-messages name="jenis_kelamin" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
              </field-messages>
            </validate>
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
              <label for="agama">Agama</label>
              <input class="form-control" v-model="model.agama" name="agama" type="text" placeholder="Agama">

              <field-messages name="agama" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
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
export default {
  mounted() {
    axios.get('api/siswa/' + this.$route.params.id + '/edit')
      .then(response => {
        if (response.data.status == true) {
          this.model.label            = response.data.siswa.label;
          this.model.description      = response.data.siswa.description;
          this.model.old_user_id      = response.data.siswa.user_id;
          this.model.user             = response.data.user;
          this.model.nomor_un         = response.data.siswa.nomor_un;
          this.model.old_nomor_un     = response.data.siswa.nomor_un;
          this.model.nik              = response.data.siswa.nik;
          this.model.old_nik          = response.data.siswa.nik;
          this.model.nama_siswa       = response.data.siswa.nama_siswa;
          this.model.alamat_kk        = response.data.siswa.alamat_kk;
          this.model.tempat_lahir     = response.data.siswa.tempat_lahir;
          this.model.tgl_lahir        = response.data.siswa.tgl_lahir;
          this.model.jenis_kelamin    = response.data.siswa.jenis_kelamin;
          this.model.agama            = response.data.siswa.agama;
          this.model.nisn             = response.data.siswa.nisn;
          this.model.tahun_lulus      = response.data.siswa.tahun_lulus;
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
          if(response.data.user_special == true){
            response.data.user.forEach(user_element => {
              this.user.push(user_element);
            });
          }else{
            this.user.push(response.data.user);
          }
      })
      .catch(function(response) {
        alert('Break');
        window.location = '#/admin/siswa';
      })
  },
  data() {
    return {
      state: {},
      model: {
        label: "",
        description: "",
        user: "",
        nomor_un: "",
        nik: "",
        nama_siswa: "",
        alamat_kk: "",
        tempat_lahir: "",
        tgl_lahir: "",
        jenis_kelamin: "",
        agama: "",
        nisn: "",
        tahun_lulus: "",
        old_user_id: "",
        old_nomor_un: "",
        old_nik: "",
        old_nisn: "",
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
            label:          this.model.label,
            description:    this.model.description,
            user_id:        this.model.user.id,
            old_user_id:    this.model.old_user_id,
            nomor_un:       this.model.nomor_un,
            old_nomor_un:   this.model.old_nomor_un,
            nik:            this.model.nik,
            old_nik:        this.model.old_nik,
            nama_siswa:     this.model.nama_siswa,
            alamat_kk:      this.model.alamat_kk,
            tempat_lahir:   this.model.tempat_lahir,
            tgl_lahir:      this.model.tgl_lahir,
            jenis_kelamin:  this.model.jenis_kelamin,
            agama:          this.model.agama,
            nisn:           this.model.nisn,
            tahun_lulus:    this.model.tahun_lulus,


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
