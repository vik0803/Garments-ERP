<template>
  <div class="container">
    <div class="row justify-content-center mt-3">
      <div class="col-12">
        <div class="card" v-if="$gate.isAdmin() || $gate.isGreyFabric()">
          <div class="card-header">
            <h3 class="card-title text-center">Grey Fabric Store</h3>
            <div class="row">
              <button type="button" class="btn btn-success col-md-2" @click="OpenModal"> Add Grey Fabric <i class="fas fa-store darkslategray"></i> <i class="fas fa-plus-circle"></i></button>
              <div class="col-md-6"></div>
              <div class="form-inline col-md-4 ">
                <input class=" searchbox" @keyup="infosearchit" v-model="search" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-info sboxbtn" @click="infosearchit"><i class="fas fa-search white"></i></button>
              </div>
            </div>
          </div>
          <div class="card-body table-responsive p-0">
            <table class="table table-hover">
              <thead class="thead-dark">
                <tr>
                  <th>ID</th>
                  <th>Content</th>
                  <th>Quantity</th>
                  <th>Width</th>
                  <th>Care</th>
                  <th>Created At</th>
                  <th>Modify</th>
                </tr>
              </thead>

              <tbody>
                <tr v-for="info,key in infos">
                  <td>{{ info.id }}</td>
                  <td>{{ info.fabric_content }}</td>
                  <td>{{ info.quantity }}</td>
                  <td>{{ info.width }}"</td>
                  <td>{{ info.care }}</td>
                  <td>{{ info.created_at | mlDate }}</td>
                  <td>
                    <a href="#" @click="viewModal(key)"><i class="fas fa-eye green"></i></a>
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
    <div class="modal fade" id="AddNew" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content ">
          <div class="modal-header">
            <h5 class="modal-title" id="ModalLabel">{{ title }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="editmode ? updateInfo() : createInfo()">
            <div class="modal-body">
              <div class="form-group">
                <input type="text" :readonly="readonly" class="form-control" :class="{'is-invalid':errors.fabric_content}" placeholder="Fiber Content" v-model="form.fabric_content">
                <div v-if="errors.fabric_content" class="invalid-feedback">{{ errors.fabric_content[0] }}</div>
              </div>
              <div class="form-group">
                <input type="text" :readonly="readonly" class="form-control" :class="{'is-invalid':errors.material}" placeholder="Material" v-model="form.material">
                <div v-if="errors.material" class="invalid-feedback">{{ errors.material[0] }}</div>
              </div>
              <div class="form-row mb-2">
                <div class="col">
                  <input type="number" :readonly="readonly" class="form-control" :class="{'is-invalid':errors.quantity}" placeholder="Quantity" v-model="form.quantity">
                  <div v-if="errors.quantity" class="invalid-feedback">{{ errors.quantity[0] }}</div>
                </div>
                <div class="col">
                  <input type="text" :readonly="readonly" class="form-control" :class="{'is-invalid':errors.width}" placeholder="Width" v-model="form.width">
                  <div v-if="errors.width" class="invalid-feedback">{{ errors.width[0] }}</div>
                </div>
              </div>
              <div class="form-row mb-2">
                <div class="col">
                  <input type="text" :readonly="readonly" class="form-control" :class="{'is-invalid':errors.weight}" placeholder="Weight" v-model="form.weight">
                  <div v-if="errors.weight" class="invalid-feedback">{{ errors.weight[0] }}</div>
                </div>
                <div class="col">
                  <input type="text" :readonly="readonly" class="form-control" :class="{'is-invalid':errors.finish}" placeholder="Finish" v-model="form.finish">
                  <div v-if="errors.finish" class="invalid-feedback">{{ errors.finish[0] }}</div>
                </div>
              </div>
              <div class="form-row mb-2">
                <div class="col">
                  <input type="text" :readonly="readonly" class="form-control" :class="{'is-invalid':errors.transparency}" placeholder="Transparency" v-model="form.transparency">
                  <div v-if="errors.transparency" class="invalid-feedback">{{ errors.transparency[0] }}</div>
                </div>
                <div class="col">
                  <input type="text" :readonly="readonly" class="form-control" :class="{'is-invalid':errors.fire_rating}" placeholder="Fire Rating" v-model="form.fire_rating">
                  <div v-if="errors.fire_rating" class="invalid-feedback">{{ errors.fire_rating[0] }}</div>
                </div>
              </div>
              <div class="form-group">
                <textarea :readonly="readonly" class="form-control" :class="{'is-invalid':errors.useinfo}" placeholder="Useinfo" v-model="form.useinfo" rows="3" ></textarea>
                <div v-if="errors.useinfo" class="invalid-feedback">{{ errors.useinfo[0] }}</div>
              </div>
              <div class="form-group">
                <input type="text" :readonly="readonly" class="form-control" :class="{'is-invalid':errors.care}" placeholder="Care" v-model="form.care">
                <div v-if="errors.care" class="invalid-feedback">{{ errors.care[0] }}</div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <button v-show="!editmode && !viewmode" type="submit" class="btn btn-primary">Create</button>
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
            fabric_content:'',
            material:'',
            quantity:'',
            width:'',
            weight:'',
            finish:'',
            transparency:'',
            fire_rating:'',
            useinfo:'',
            care:''
          },
          title:'',
          errors:{},
          search:'',
          editmode:false,
          readonly:false,
          viewmode:false
        }
      },

      mounted() {
          let infosearchit = true;
          if (infosearchit) {
            Fire.$on('searchinginfo',() => {
                let query = this.search;
                axios.get('api/findGreyFabric?query=' + query)
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
          axios.get('api/grey-Fabric')
          .then((response)=> this.infos = response.data.data)
          .catch((error) => this.errors = error.response.data.errors);
        },

        infosearchit() {
          Fire.$emit('searchinginfo');
        },

        OpenModal(){
          this.form.fabric_content='';
          this.form.material='';
          this.form.quantity='';
          this.form.width='';
          this.form.weight='';
          this.form.finish='';
          this.form.transparency='';
          this.form.fire_rating='';
          this.form.useinfo='';
          this.form.care='';
          this.title='Add New Grey Fabric';
          this.editmode=false;
          this.readonly=false;
          this.viewmode=false;
          $('#AddNew').modal('show');
        },

        createInfo(){
          this.$Progress.start()
          axios.post('api/grey-Fabric',this.$data.form)
          .then((response) => {
            this.errors= "";
            this.$Progress.finish()
            $('#AddNew').modal('hide');
            Toast.fire({
              type: 'success',
              title: 'Grey Fabric Info Created in successfully'
            });
            this.loadInfos();
            this.form.fabric_content='';
            this.form.material='';
            this.form.quantity='';
            this.form.width='';
            this.form.weight='';
            this.form.finish='';
            this.form.transparency='';
            this.form.fire_rating='';
            this.form.useinfo='';
            this.form.care='';
            this.title='';
          })
          .catch((error) => {
            this.errors = error.response.data.errors
            this.$Progress.fail()
          });
        },

        updateInfo(){
          this.$Progress.start()
          axios.patch(`api/grey-Fabric/${this.form.id}`,this.$data.form)
            .then((response) => {
              this.errors="";
              this.$Progress.finish();
              $('#AddNew').modal('hide');
              Toast.fire({
                type: 'success',
                title: 'Grey Fabric Information has been updated'
              });
              this.loadInfos();
              this.form.fabric_content='';
              this.form.material='';
              this.form.quantity='';
              this.form.width='';
              this.form.weight='';
              this.form.finish='';
              this.form.transparency='';
              this.form.fire_rating='';
              this.form.useinfo='';
              this.form.care='';
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
          this.title='Edit Grey Fabric Info'
          this.form=this.infos[key];
        },

        viewModal(key){
          $('#AddNew').modal('show');
          this.errors= "";
          this.editmode=false;
          this.readonly=true;
          this.viewmode=true;
          this.title='View Grey Fabric Info'
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
              axios.delete(`api/grey-Fabric/${id}`)
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
