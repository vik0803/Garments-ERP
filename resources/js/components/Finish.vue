<template>
    <div class="container" v-if="$gate.isAdmin() || $gate.isFinishFabric()">
      <div class="row justify-content-center mt-3">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title text-center">Finish Fabric Store</h3>
            </div>
            <div class="card text-white mb-3" style="background-color:darkcyan">
              <div class="card-body">
                <!-- <form action="#"> -->
                  <div class="form-row">
                    <div class="form-group col-md-3">
                      <label for="classification">Classification of Finish</label>
                      <select id="classification" class="form-control" :class="{'is-invalid':errors.classification}" v-model="form.classification">
                        <option value="">Choose...</option>
                        <option value="Pre–Shrinking">Pre–Shrinking</option>
                        <option value="Softening">Softening</option>
                        <option value="Brush and Sanding">Brush and Sanding</option>
                        <option value="Mercerizing and Singeing">Mercerizing and Singeing</option>
                        <option value="Resin">Resin</option>
                        <option value="Permanent Press">Permanent Press</option>
                        <option value="Skewing">Skewing</option>
                        <option value="Chintz">Chintz</option>
                        <option value="Water Repellent">Water Repellent</option>
                        <option value="Water Proof">Water Proof</option>
                        <option value="Peach Skin">Peach Skin</option>
                        <option value="Soil Release">Soil Release</option>
                        <option value="Fire Retardant">Fire Retardant</option>
                      </select>
                      <div v-if="errors.classification" class="invalid-feedback">{{ errors.classification[0] }}</div>
                    </div>
                    <div class="form-group col-md-2">
                      <label for="status">Status</label>
                      <select id="status" class="form-control" :class="{'is-invalid':errors.status}" v-model="form.status">
                        <option value="">Choose...</option>
                        <option value="In Process">In Process</option>
                        <option value="On Hold">On Hold</option>
                        <option value="Complete">Complete</option>
                        <option value="Not Started">Not Started</option>
                      </select>
                      <div v-if="errors.status" class="invalid-feedback">{{ errors.status[0] }}</div>
                    </div>
                    <div class="form-group col-md-3">
                      <button type="submit" v-if="store" @click="storeFinsiFabric" class="btn btn-dark btn-lg btn-block" style="margin-top: 27px;">Finish Fabric</button>
                      <button type="submit" v-if="editmode" @click="updateFinsiFabric" class="btn btn-dark btn-lg" style="margin-top: 27px;">Update Finish</button>
                      <button type="submit" v-if="editmode" @click="clear" class="btn btn-primary btn-lg" style="margin-top: 27px;">Clear</button>
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
                    <th>Classification</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Modify</th>
                  </tr>
                </thead>

                <tbody>
                  <tr v-for="info,key in infos">
                    <td>{{ info.id }}</td>
                    <td>{{ info.classification | upText }}</td>
                    <td>{{ info.status | upText }}</td>
                    <td>{{ info.created_at |mlDate }}</td>
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
          classification:'',
          status:''
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
        axios.get('api/finish-Fabric')
        .then((response)=> this.infos = response.data.data)
        .catch((error) => this.errors = error.response.data.errors);
      },

      storeFinsiFabric(){
        this.$Progress.start()
        axios.post('api/finish-Fabric',this.$data.form)
        .then((response) => {
          this.errors='';
          this.$Progress.finish();
          Toast.fire({
            type: 'success',
            title: 'Finish Fabric Created in successfully'
          });
          this.loadInfo();
          this.form.classification='';
          this.form.status='';
        })
        .catch((error) =>{
          this.errors =error.response.data.errors
          this.$Progress.fail();
        })
      },

      editModal(key){
        this.errors= "";
        this.editmode=true;
        this.store=false;
        this.form=this.infos[key];
      },

      clear(){
        this.errors= "";
        this.form.classification='';
        this.form.status='';
        this.editmode=false;
        this.store=true;
      },

      updateFinsiFabric(){
        this.$Progress.start()
        axios.patch(`api/finish-Fabric/${this.form.id}`,this.$data.form)
        .then((response) => {
          this.errors=""
          this.$Progress.finish();
          Toast.fire({
            type: 'success',
            title: 'Finish Fabric Information has been updated'
          });
          this.loadInfo();
          this.form.classification='';
          this.form.status='';
          this.editmode=false;
          this.store=true;
        })
        .catch((error) => {
          this.errors = error.response.data.errors
          this.$Progress.fail()
        });
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
            axios.delete(`api/finish-Fabric/${id}`)
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
