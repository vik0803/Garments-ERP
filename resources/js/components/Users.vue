<template>
  <div class="container">

    <div class="row justify-content-center mt-3">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title text-center">Users Table</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#AddNew"> Add New <i class="fas fa-user-plus"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover">
              <tbody><tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Type</th>
                <th>Modify</th>
              </tr>
              <tr>
                <td>183</td>
                <td>John Doe</td>
                <td>11-7-2014</td>
                <td><span class="tag tag-success">Approved</span></td>
                <td>
                  <a href="#">
                    <i class="fas fa-edit blue"></i>
                  </a>
                  <a href=""><i class="fas fa-trash red"></i></a>
                </td>
              </tr>
            </tbody></table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="AddNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="createUser">
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
              <button type="submit" class="btn btn-primary">Create</button>
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
          form:{
            name:'',
            email:'',
            type:'',
            password:''
          },
          errors:{}
        }
      },
      mounted() {

      },
      methods:{
        createUser(){
          axios.post('api/user',this.$data.form)
          .then((response)=>{
            this.errors= ""
            this.form= ''
          })
          .catch((error) => this.errors = error.response.data.errors);
        }
      }
    }
</script>
