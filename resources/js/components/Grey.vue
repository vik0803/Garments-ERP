<template>
  <div class="container" v-if="$gate.isAdmin() || $gate.isGreyFabric()">
    <div class="row justify-content-center mt-3">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title text-center">Grey Fabric Store</h3>
            <div class="row">
              <button type="button" class="btn btn-success col-md-2" @click="OpenModal"> Add Grey Fabric <i class="fas fa-store darkslategray"></i> <i class="fas fa-plus-circle"></i></button>
              <div class="col-md-6"></div>
              <div class="form-inline col-md-4 ">
                <input class=" searchbox" @keyup="searchit" v-model="search" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-info sboxbtn" @click="searchit"><i class="fas fa-search white"></i></button>
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
                  <td>{{ info.content }}</td>
                  <td>{{ info.quantity }}</td>
                  <td>{{ info.width }}"</td>
                  <td>{{ info.care }}</td>
                  <td>{{ info.created_at | |mlDate }}</td>
                  <td>
                    <a href="#" @click="viewModal(key,info.id)"><i class="fas fa-view info"></i></a>
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
                <input type="text" class="form-control" :class="{'is-invalid':errors.content}" placeholder="Content" v-model="form.content">
                <div v-if="errors.content" class="invalid-feedback">{{ errors.content[0] }}</div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" :class="{'is-invalid':errors.material}" placeholder="Material" v-model="form.material">
                <div v-if="errors.material" class="invalid-feedback">{{ errors.material[0] }}</div>
              </div>
              <div class="form-group">
                <div class="form-row">
                  <div class="col">
                    <input type="number" class="form-control" :class="{'is-invalid':errors.quantity}" placeholder="Quantity" v-model="form.quantity">
                    <div v-if="errors.quantity" class="invalid-feedback">{{ errors.quantity[0] }}</div>
                  </div>
                  <div class="col">
                    <input type="text" class="form-control" :class="{'is-invalid':errors.width}" placeholder="Width" v-model="form.width">
                    <div v-if="errors.width" class="invalid-feedback">{{ errors.width[0] }}</div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="form-row">
                  <div class="col">
                    <input type="text" class="form-control" :class="{'is-invalid':errors.weight}" placeholder="Weight" v-model="form.weight">
                    <div v-if="errors.weight" class="invalid-feedback">{{ errors.weight[0] }}</div>
                  </div>
                  <div class="col">
                    <input type="text" class="form-control" :class="{'is-invalid':errors.finish}" placeholder="Finish" v-model="form.finish">
                    <div v-if="errors.finish" class="invalid-feedback">{{ errors.finish[0] }}</div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="form-row">
                  <div class="col">
                    <input type="text" class="form-control" :class="{'is-invalid':errors.transparency}" placeholder="Transparency" v-model="form.transparency">
                    <div v-if="errors.transparency" class="invalid-feedback">{{ errors.transparency[0] }}</div>
                  </div>
                  <div class="col">
                    <input type="text" class="form-control" :class="{'is-invalid':errors.fire_rating}" placeholder="Fire Rating" v-model="form.fire_rating">
                    <div v-if="errors.fire_rating" class="invalid-feedback">{{ errors.fire_rating[0] }}</div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <textarea class="form-control" :class="{'is-invalid':errors.use}" placeholder="Use" v-model="form.use" rows="3" ></textarea>
                <div v-if="errors.use" class="invalid-feedback">{{ errors.use[0] }}</div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" :class="{'is-invalid':errors.care}" placeholder="Care" v-model="form.care">
                <div v-if="errors.care" class="invalid-feedback">{{ errors.care[0] }}</div>
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
            content:'',
            material:'',
            quantity:'',
            width:'',
            weight:'',
            finish:'',
            transparency:'',
            fire_rating:'',
            use:'',
            care:''
          },
          title:'',
          errors:{},
          search: '',
          editmode:false
        }
      },

      mounted() {
        let searchit = true;
        if (searchit) {
          Fire.$on('searching',() => {
            let query = this.search;
            axios.get('/findGreyFabric?query=' + query)
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
          axios.get('getGreyFabric')
          .then((response)=> this.infos = response.data.data)
          .catch((error) => this.errors = error.response.data.errors);
        },

        searchit() {
          Fire.$emit('searching');
        },

        OpenModal(){
          this.form.content='';
          this.form.material='';
          this.form.quantity='';
          this.form.width='';
          this.form.weight='';
          this.form.finish='';
          this.form.transparency='';
          this.form.fire_rating='';
          this.form.use='';
          this.form.care='';
          this.title='Add New Grey Fabric';
          this.editmode=false;
          $('#AddNew').modal('show');
        },

        createInfo(){
          this.$Progress.start()
          axios.post('grey-Fabric',this.$data.form)
          .then((response)=>{
            this.errors= ""
            this.form.content='';
            this.form.material='';
            this.form.quantity='';
            this.form.width='';
            this.form.weight='';
            this.form.finish='';
            this.form.transparency='';
            this.form.fire_rating='';
            this.form.use='';
            this.form.care='';
            this.title='';
            this.$Progress.finish()
            $('#AddNew').modal('hide');
            Toast.fire({
              type: 'success',
              title: 'Grey Fabric Info Created in successfully'
            });
            this.loadInfos();
          })
          .catch((error) => {
            this.errors = error.response.data.errors
            this.$Progress.fail()
          });
        },

        updateInfo(){
          this.$Progress.start()
          axios.patch(`grey-Fabric/${this.form.id}`,this.$data.form)
          .then((response) => {
            this.errors=""
            this.$Progress.finish()
            $('#AddNew').modal('hide');
            Toast.fire({
              type: 'success',
              title: 'Grey Fabric Information has been updated'
            });
            this.loadInfos();
            this.form.content='';
            this.form.material='';
            this.form.quantity='';
            this.form.width='';
            this.form.weight='';
            this.form.finish='';
            this.form.transparency='';
            this.form.fire_rating='';
            this.form.use='';
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
          this.title='Update Grey Fabric Info'
          this.form=this.infos[key];
        },

        viewModal(key,id){
          $('#AddNew').modal('show');
          this.errors= "";
          this.editmode=false;
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
              axios.delete(`grey-Fabric/${id}`)
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
