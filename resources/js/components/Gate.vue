<template>
    <div class="container">
      <div class="row justify-content-center mt-3">
        <div class="col-12">
          <div class="card" v-if="$gate.isAdmin()">
            <div class="card-header">
              <h3 class="card-title text-center">Gate Entry</h3>
            </div>
            <div class="card text-white mb-3" style="background-color:cadetblue">
              <div class="card-body">
                <!-- <form action="#"> -->
                  <div class="form-row">
                    <div class="form-group col-md-2">
                      <label for="category">Category</label>
                      <select id="category" class="form-control" :class="{'is-invalid':errors.category}" v-model="form.category">
                        <option value="">Choose...</option>
                        <option value="yarn">Yarn</option>
                        <option value="grey fabric">Grey Fabric</option>
                        <option value="finish fabric">Finish Fabric</option>
                        <option value="dyes and chemical">Dyes and Chemical</option>
                        <option value="trims">Trims</option>
                      </select>
                      <div v-if="errors.category" class="invalid-feedback">{{ errors.category[0] }}</div>
                    </div>
                    <div class="form-group col-md-2">
                      <label for="gatein">Gate In</label>
                      <input type="text" class="form-control" :class="{'is-invalid':errors.gateIn}" id="gatein" v-model="form.gateIn">
                      <div v-if="errors.gateIn" class="invalid-feedback">{{ errors.gateIn[0] }}</div>
                    </div>
                    <div class="form-group col-md-2">
                      <label for="gateout">Gate Out</label>
                      <input type="text" class="form-control" :class="{'is-invalid':errors.gateOut}" id="gateout" v-model="form.gateOut">
                      <div v-if="errors.gateOut" class="invalid-feedback">{{ errors.gateOut[0] }}</div>
                    </div>
                    <div class="form-group col-md-2">
                      <label for="gatepass">Gate Pass</label>
                      <input type="text" class="form-control" :class="{'is-invalid':errors.gatePass}" id="gatepass" v-model="form.gatePass">
                      <div v-if="errors.gatePass" class="invalid-feedback">{{ errors.gatePass[0] }}</div>
                    </div>
                    <div class="form-group col-md-3">
                      <button type="submit" v-if="store" @click="storeGateEntry" class="btn btn-dark btn-lg btn-block" style="margin-top: 27px;">Gate Entry</button>
                      <button type="submit" v-if="editmode" class="btn btn-dark btn-lg btn-block" style="margin-top: 27px;">Update Gate Entry</button>
                    </div>
                  </div>
                <!-- </form> -->
              </div>
            </div>
            <div class="card-body table-responsive p-0">
              <table class="table table-hover">
                <thead class="thead-dark">
                  <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Gate In</th>
                    <th>Gate Out</th>
                    <th>Gate Pass</th>
                    <th>Created At</th>
                    <th>Modify</th>
                  </tr>
                </thead>

                <tbody>
                  <tr v-for="info,key in infos">
                    <td>{{ info.id }}</td>
                    <td>{{ info.category }}</td>
                    <td>{{ info.gateIn }}</td>
                    <td>{{ info.gateOut }}</td>
                    <td>{{ info.gatePass }}</td>
                    <td>{{ info.created_at }}</td>
                    <td>
                      <a href="#" @click="editModal(key)"><i class="fas fa-edit blue"></i></a>
                      <a href="#" @click="deleteEntry(key,info.id)" class="text-danger"><i class="fas fa-trash red"></i></a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
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
              category:'',
              gateIn:'',
              gateOut:'',
              gatePass:''
            },
            store:true,
            editmode:false,
            errors:{}
          }
        },
        mounted() {
            this.loadInfo();
            setInterval(() => this.loadInfo(),3000);
        },
        methods:{
          loadInfo(){
            axios.get('/getGateEntry')
              .then((response)=> this.infos = response.data.data)
              .catch((error) => this.errors = error.response.data.errors);
          },

          storeGateEntry(){
            this.$Progress.start()
            axios.post('gate-Entry',this.$data.form)
              .then((response) => {
                this.errors='';
                this.$Progress.finish();
                Toast.fire({
                  type: 'success',
                  title: 'Gate Entry Created in successfully'
                });
                this.loadInfo();
                this.form.category='';
                this.form.gateIn='';
                this.form.gateOut='';
                this.form.gatePass='';
              })
              .catch((error) =>{
                this.errors =error.response.data.errors
                this.$Progress.fail();
              })
          },

          deleteEntry(key,id){
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
                axios.delete(`gate-Entry/${id}`)
                this.errors= "";
                Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                );
                this.loadInfo();
              }
            })
          }

        }
    }
</script>
