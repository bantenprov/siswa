<template>
  <div class="card">
    <div class="card-header">
      <i class="fa fa-table" aria-hidden="true"></i> Add Siswa

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
              <input class="form-control" v-model="model.description" required autofocus name="description" type="text" placeholder="Description">

              <field-messages name="description" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
                <small class="form-text text-danger" slot="required">Label is a required field</small>
              </field-messages>
            </validate>
          </div>
        </div>
        
        <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
              <input class="form-control" v-model="model.nomor_un" required autofocus name="nomor_un" type="text" placeholder="Nomor UN">

              <field-messages name="description" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
                <small class="form-text text-danger" slot="required">Label is a required field</small>
              </field-messages>
            </validate>
          </div>
        </div>
        
        <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
              <input class="form-control" v-model="model.nik" required autofocus name="nik" type="text" placeholder="NIK">

              <field-messages name="nik" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
                <small class="form-text text-danger" slot="required">Label is a required field</small>
              </field-messages>
            </validate>
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
              <input class="form-control" v-model="model.nama_siswa" required autofocus name="nama_siswa" type="text" placeholder="Nama Siswa">

              <field-messages name="nama_siswa" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
                <small class="form-text text-danger" slot="required">Label is a required field</small>
              </field-messages>
            </validate>
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
              <input class="form-control" v-model="model.alamat_kk" required autofocus name="alamat_kk" type="text" placeholder="Alamat KK">

              <field-messages name="alamat_kk" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
                <small class="form-text text-danger" slot="required">Label is a required field</small>
              </field-messages>
            </validate>
          </div>
        </div>
        
        <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
              <input class="form-control" v-model="model.tempat_lahir" required autofocus name="tempat_lahir" type="text" placeholder="Tempat Lahir">

              <field-messages name="tempat_lahir" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
                <small class="form-text text-danger" slot="required">Label is a required field</small>
              </field-messages>
            </validate>
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
              <input class="form-control" v-model="model.tgl_lahir" required autofocus name="tgl_lahir" type="text" placeholder="Tanggal Lahir">

              <field-messages name="tgl_lahir" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
                <small class="form-text text-danger" slot="required">Label is a required field</small>
              </field-messages>
            </validate>
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
              <input class="form-control" v-model="model.jenis_kelamin" required autofocus name="jenis_kelamin" type="text" placeholder="Jenis Kelamin">

              <field-messages name="jenis_kelamin" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
                <small class="form-text text-danger" slot="required">Label is a required field</small>
              </field-messages>
            </validate>
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
              <input class="form-control" v-model="model.agama" required autofocus name="agama" type="text" placeholder="Agama">

              <field-messages name="agama" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
                <small class="form-text text-danger" slot="required">Label is a required field</small>
              </field-messages>
            </validate>
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
              <input class="form-control" v-model="model.nisn" required autofocus name="nisn" type="text" placeholder="NISN">

              <field-messages name="nisn" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
                <small class="form-text text-danger" slot="required">Label is a required field</small>
              </field-messages>
            </validate>
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
              <input class="form-control" v-model="model.tahun_lulus" required autofocus name="tahun_lulus" type="text" placeholder="Tahun Lulus">

              <field-messages name="tahun_lulus" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
                <small class="form-text text-danger" slot="required">Label is a required field</small>
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
							<small class="form-text text-danger" slot="required">Label is a required field</small>
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
  mounted(){
    axios.get('api/siswa/create')
    .then(response => {           
        response.data.user.forEach(element => {
          this.user.push(element);
        });
    })
    .catch(function(response) {
      alert('Break');
    });
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
        axios.post('api/siswa', {
            label: this.model.label,
            description: this.model.description,
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
            tahun_lulus: this.model.tahun_lulus

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
      this.model = {
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
      };
    },
    back() {
      window.location = '#/admin/siswa';
    }
  }
}
</script>
