<template>
  <div class="container" v-if="$gate.isAdmin() || $gate.isDyesAndChemical()">
    <div class="row justify-content-center mt-3">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title text-center">Dyes and Chemical Store</h3>
            <div class="row">
              <button type="button" class="btn btn-success col-md-3" @click="OpenModal"> Add Dyes Chemical <i class="far fa-object-group "></i><i class="fas fa-plus-circle"></i></button>
              <div class="col-md-5"></div>
              <div class="form-inline col-md-4 ">
                <input class=" searchbox" @keyup="dyesearchit" v-model="search" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-info sboxbtn" @click="dyesearchit"><i class="fas fa-search white"></i></button>
              </div>
            </div>
          </div>
          <div class="card-body table-responsive p-0">
            <table class="table table-hover">
              <thead class="thead-dark">
                <tr>
                  <th>ID</th>
                  <th>Color</th>
                  <th>Classification</th>
                  <th>Dyes</th>
                  <th>Concentration(%)</th>
                  <th>Bulk Density(kg/m3)</th>
                  <th>Modify</th>
                </tr>
              </thead>

              <tbody>
                <tr v-for="info,key in infos">
                  <td>{{ info.id }}</td>
                  <td>{{ info.color }}</td>
                  <td>{{ info.classification }}</td>
                  <td>{{ info.dyes }}</td>
                  <td>{{ info.concentration }}</td>
                  <td>{{ info.bulk_density }}</td>
                  <td>
                    <a href="#" @click="editModal(key)"><i class="fas fa-edit blue"></i></a>
                    <a href="#" @click="deleteInfo(key,info.id)" class="text-danger"><i class="fas fa-trash red"></i></a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="AddNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{ title }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="editmode ? updateDyesInfo() : createDyesInfo()">
            <div class="modal-body">
              <div class="form-group">
                <select class="form-control" :class="{'is-invalid':errors.color}" v-model="form.color">
                  <option value="">Select Color</option>
                  <option value="Whale">Whale</option>
                  <option value="Medi-blue">Medi-Blue</option>
                  <option value="Fawn">Fawn</option>
                </select>
                <div v-if="errors.color" class="invalid-feedback">{{ errors.color[0] }}</div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" :class="{'is-invalid':errors.classification}" placeholder="Classification" v-model="form.classification">
                <div v-if="errors.classification" class="invalid-feedback">{{ errors.classification[0] }}</div>
              </div>
              <div class="form-group">
                <textarea class="form-control" :class="{'is-invalid':errors.dyes}" placeholder="Dyes" v-model="form.dyes" rows="3" ></textarea>
                <div v-if="errors.dyes" class="invalid-feedback">{{ errors.dyes[0] }}</div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" :class="{'is-invalid':errors.concentration}" placeholder="Concentration" v-model="form.concentration">
                <div v-if="errors.concentration" class="invalid-feedback">{{ errors.concentration[0] }}</div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" :class="{'is-invalid':errors.bulk_density}" placeholder="Bulk Density" v-model="form.bulk_density">
                <div v-if="errors.bulk_density" class="invalid-feedback">{{ errors.bulk_density[0] }}</div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
              <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data(){
    return{
      infos:{},
      form:{
        color:'',
        classification:'',
        dyes:'',
        concentration:'',
        bulk_density:''
      },
      title:'',
      errors:{},
      search:'',
      editmode:false,
    }
  },

  mounted() {
    let dyesearchit = true;
    if (dyesearchit) {
      Fire.$on('searchinginfo',() => {
        let query = this.search;
        axios.get('api/findDyesChemical?query=' + query)
        .then((response) => {
          this.infos = response.data.data
        })
        .catch(() => {
        })
      }),
      this.loadInfos();
      setInterval(() => this.loadInfos(),12000);
    }else {
      this.loadInfos();
      setInterval(() => this.loadInfos(),3000);
    }
  },

  methods:{

    loadInfos(){
      axios.get('api/dyes-Chemical')
      .then((response)=> this.infos = response.data.data)
      .catch((error) => this.errors = error.response.data.errors);
    },

    dyesearchit() {
      Fire.$emit('searchinginfo');
    },

    OpenModal(){
      this.form.color='';
      this.form.classification='';
      this.form.dyes='';
      this.form.concentration='';
      this.form.bulk_density='';
      this.title='Add New Dyes Chemical';
      this.editmode=false;
      $('#AddNew').modal('show');
    },

    createDyesInfo(){
      this.$Progress.start()
      axios.post('api/dyes-Chemical',this.$data.form)
      .then((response) => {
        this.errors= "";
        this.$Progress.finish()
        $('#AddNew').modal('hide');
        Toast.fire({
          type: 'success',
          title: 'Dyes Chemical Info Created in successfully'
        });
        this.loadInfos();
        this.form.color='';
        this.form.classification='';
        this.form.dyes='';
        this.form.concentration='';
        this.form.bulk_density='';
        this.title='';
      })
      .catch((error) => {
        this.errors = error.response.data.errors
        this.$Progress.fail()
      });
    },

    updateDyesInfo(){
      this.$Progress.start()
      axios.patch(`api/dyes-Chemical/${this.form.id}`,this.$data.form)
      .then((response) => {
        this.errors="";
        this.$Progress.finish();
        $('#AddNew').modal('hide');
        Toast.fire({
          type: 'success',
          title: 'Dyes Chemical Information has been updated'
        });
        this.loadInfos();
        this.form.color='';
        this.form.classification='';
        this.form.dyes='';
        this.form.concentration='';
        this.form.bulk_density='';
        this.title='';
      })
      .catch((error) => {
        this.errors = error.response.data.errors
        this.$Progress.fail()
      });
    },

    editModal(key){
      $('#AddNew').modal('show');
      this.errors= "";
      this.editmode=true;
      this.readonly=false;
      this.title='Edit Dyes Chemical Info'
      this.form=this.infos[key];
    },

    deleteInfo(key,id){
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {
          axios.delete(`api/dyes-Chemical/${id}`)
          this.errors= "";
          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          );
          this.loadInfos();
        }
      })
    }

  }
}
</script>
