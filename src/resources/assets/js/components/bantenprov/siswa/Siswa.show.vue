<template>
  <div class="card">
    <div class="card-header">
      <i class="fa fa-table" aria-hidden="true"></i> Show siswa {{ model.label }}

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
            <b>Description :</b> {{ model.description }}
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
          this.model.pendaftaran = response.data.pendaftaran;
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
          response.data.pendaftaran.forEach(element => {
            this.pendaftaran.push(element);
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
        pendaftaran: "",
      },
      pendaftaran: []
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
            pendaftaran_id: this.model.pendaftaran.id
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
