<template>
  <div class="container">

    <div class="row justify-content-center mt-3">
      <div class="col-12">
        <div class="card" v-if="$gate.isAdmin() || $gate.isYarnStore()">
          <div class="card-header">
            <h3 class="card-title text-center">Yarn Store</h3>
              <button type="button" class="btn btn-success" @click="OpenModal"> Add New Yarn <i class="fab fa-yarn"></i><i class="fas fa-plus-circle"></i></button>
          </div>
          <div class="card-body table-responsive p-0">
            <table class="table table-hover">
              <thead class="thead-dark">
                <tr>
                  <th>ID</th>
                  <th>Color</th>
                  <th>Fiber Content</th>
                  <th>Weight</th>
                  <th>Yardage/Ball</th>
                  <th>Gauge</th>
                  <th>Care</th>
                  <th>Modify</th>
                </tr>
              </thead>

              <tbody>
                <tr v-for="info,key in infos">
                  <td>{{ info.id }}</td>
                  <td>{{ info.color }}</td>
                  <td>{{ info.fiber_content }}</td>
                  <td>{{ info.weight }}</td>
                  <td>{{ info.yardageORball }}</td>
                  <td>{{ info.gauge }}</td>
                  <td>{{ info.care }}</td>
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
          <form @submit.prevent="editmode ? updateInfo() : createInfo()">
            <div class="modal-body">
              <div class="form-group">
                <select class="form-control" :class="{'is-invalid':errors.color}" v-model="form.color">
                  <option value="">Select Color</option>
                  <option value="1021 Rainbow's Beginning">1021 Rainbow's Beginning</option>
                  <option value="1025 Pastel Pop">1025 Pastel Pop</option>
                  <option value="9456 Harvest">9456 Harvest</option>
                  <option value="9001 Navy">9001 Navy</option>
                  <option value="9045 Fern">9045 Fern</option>
                  <option value="9217 Black">9217 Black</option>
                  <option value="9389 Grey">9389 Grey</option>
                  <option value="9598 Wedgewood">9598 Wedgewood</option>
                </select>
                <div v-if="errors.color" class="invalid-feedback">{{ errors.color[0] }}</div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" :class="{'is-invalid':errors.fiber_content}" placeholder="Fiber Content" v-model="form.fiber_content">
                <div v-if="errors.fiber_content" class="invalid-feedback">{{ errors.fiber_content[0] }}</div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" :class="{'is-invalid':errors.weight}" placeholder="Yarn weight" v-model="form.weight">
                <div v-if="errors.weight" class="invalid-feedback">{{ errors.weight[0] }}</div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" :class="{'is-invalid':errors.yardageORball}" placeholder="Yardage/Ball" v-model="form.yardageORball">
                <div v-if="errors.yardageORball" class="invalid-feedback">{{ errors.yardageORball[0] }}</div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" :class="{'is-invalid':errors.gauge}" placeholder="Gauge" v-model="form.gauge">
                <div v-if="errors.gauge" class="invalid-feedback">{{ errors.gauge[0] }}</div>
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
            color:'',
            fiber_content:'',
            weight:'',
            yardageORball:'',
            gauge:'',
            care:''
          },
          title:'',
          errors:{},
          editmode:false
        }
      },
      mounted() {
        this.loadInfos();
        setInterval(() => this.loadInfos(),3000);
      },
      methods:{

        loadInfos(){
          axios.get('getYarnStore')
            .then((response)=> this.infos = response.data.data)
            .catch((error) => this.errors = error.response.data.errors);
        },

        OpenModal(){
          this.form.color='';
          this.form.fiber_content='';
          this.form.weight='';
          this.form.yardageORball='';
          this.form.gauge='';
          this.form.care='';
          this.title='Add New Yarn';
          this.editmode=false;
          $('#AddNew').modal('show');
        },

        createInfo(){
          this.$Progress.start()
          axios.post('yarn-Store',this.$data.form)
            .then((response)=>{
              this.errors= ""
              this.form= ''
              this.$Progress.finish()
              $('#AddNew').modal('hide');
              Toast.fire({
                type: 'success',
                title: 'Yarn Info Created in successfully'
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
          axios.patch(`yarn-Store/${this.form.id}`,this.$data.form)
            .then((response) => {
              this.errors=""
              this.$Progress.finish()
              $('#AddNew').modal('hide');
              Toast.fire({
                type: 'success',
                title: 'Yarn Information has been updated'
              });
              this.loadInfos();
              this.form.color='';
              this.form.fiber_content='';
              this.form.weight='';
              this.form.yardageORball='';
              this.form.gauge='';
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
          this.title='Update Yarn Info'
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
              axios.delete(`yarn-Store/${id}`)
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
