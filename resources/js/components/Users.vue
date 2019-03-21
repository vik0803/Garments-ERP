<template>
  <div class="container">

    <div class="row justify-content-center mt-3">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title text-center">Users Table</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-success" @click="OpenModal"> Add New <i class="fas fa-user-plus"></i></button>
            </div>
          </div>
          <div class="card-body table-responsive p-0">
            <table class="table table-hover">
              <thead class="thead-dark">
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Type</th>
                  <th>Created At</th>
                  <th>Modify</th>
                </tr>
              </thead>

              <tbody>
                <tr v-for="user,key in users">
                  <td>{{ user.id }}</td>
                  <td>{{ user.name }}</td>
                  <td>{{ user.email }}</td>
                  <td>{{ user.type | upText }}</td>
                  <td>{{ user.created_at | myDate }}</td>
                  <td>
                    <a href="#" @click="editModal(key)"><i class="fas fa-edit blue"></i></a>
                    <a href="#" @click="deleteUser(key,user.id)" class="text-danger"><i class="fas fa-trash red"></i></a>
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
          <form @submit.prevent="editmode ? updateUser() : createUser()">
            <div class="modal-body">
              <div class="form-group">
                <input type="text" name="name" class="form-control" :class="{'is-invalid':errors.name}" placeholder="Name" v-model="form.name">
                <div v-if="errors.name" class="invalid-feedback">{{ errors.name[0] }}</div>
              </div>
              <div class="form-group">
                <input type="email" name="email" class="form-control" :class="{'is-invalid':errors.email}" placeholder="Email Address" v-model="form.email">
                <div v-if="errors.email" class="invalid-feedback">{{ errors.email[0] }}</div>
              </div>
              <div class="form-group">
                <select class="form-control" :class="{'is-invalid':errors.type}" name="type" v-model="form.type">
                  <option value="">Select User Role</option>
                  <option value="admin">Admin</option>
                  <option value="user">Standard User</option>
                  <option value="author">Author</option>
                </select>
                <div v-if="errors.type" class="invalid-feedback">{{ errors.type[0] }}</div>
              </div>
              <div class="form-group">
                <input type="password" autocomplete="off" name="password" class="form-control" :class="{'is-invalid':errors.password}" placeholder="Password" v-model="form.password">
                <div v-if="errors.password" class="invalid-feedback">{{ errors.password[0] }}</div>
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
          users:{},
          form:{
            name:'',
            email:'',
            type:'',
            password:''
          },
          title:'',
          errors:{},
          editmode:false
        }
      },
      mounted() {
        this.loadUsers();
        setInterval(() => this.loadUsers(),3000);
        // Fire.$on('AfterCreated',() => {
        //   this.loadUsers();
        // });
      },
      methods:{

        loadUsers(){
          axios.get('api/user')
            .then((response)=> this.users = response.data.data)
            .catch((error) => this.errors = error.response.data.errors);
        },

        OpenModal(){
          this.form.name='';
          this.form.email='';
          this.form.type='';
          this.form.password='';
          this.title='Add New';
          this.editmode=false;
          $('#AddNew').modal('show');
        },

        createUser(){
          this.$Progress.start()
          axios.post('api/user',this.$data.form)
            .then((response)=>{
              this.errors= ""
              this.form= ''
              this.$Progress.finish()
              // Fire.$emit('AfterCreated');
              $('#AddNew').modal('hide');
              Toast.fire({
                type: 'success',
                title: 'User Created in successfully'
              });
              this.loadUsers();
            })
            .catch((error) => {
              this.errors = error.response.data.errors
              this.$Progress.fail()
            });
        },

        updateUser(){
          this.$Progress.start()
          axios.patch(`api/user/${this.form.id}`,this.$data.form)
            .then((response) => {
              this.errors=""
              this.$Progress.finish()
              $('#AddNew').modal('hide');
              Toast.fire({
                type: 'success',
                title: 'Information has been updated'
              });
              this.loadUsers();
              this.form.name='';
              this.form.email='';
              this.form.type='';
              this.form.password='';
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
          this.title='Update User Info'
          this.form=this.users[key];
        },

        deleteUser(key,id){
          // console.log(key,id);
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
              axios.delete(`api/user/${id}`)
              this.errors= "";
              Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              );
              this.loadUsers();
            }
          })
        }

      }
    }
</script>
