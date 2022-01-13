<template>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Add Post</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard#/dashboard">Home</a></li>
                            <li class="breadcrumb-item"><router-link to="post-list">Post List</router-link></li>
                            <li class="breadcrumb-item active">Add Category</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
                <div class="row justify-content-center">
                    <div class="card card-primary col-md-10">
                        <div class="card-header">
                            <h3 class="card-title">Add Post</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" enctype="multipart/form-data" @submit.prevent="addNewPost()">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="postId">Add New Post</label>
                                    <input type="text" class="form-control" id="postId" placeholder="Add New Post"
                                           v-model="form.title" name="title"
                                           :class="{ 'is-invalid':form.errors.has('title')} ">
                                    <has-error :form="form" field="title"></has-error>
                                </div>
                                <div class="form-group" >
                                    <label for="descriptionId">Add New Description</label>
                                    <vue-editor v-model="form.description" :options="options"
                                                        :class="{ 'is-invalid':form.errors.has('description')}" />
                                    <has-error :form="form" field="description"></has-error>
                                </div>
                                <div class="form-group">
                                    <label for="categoryId">Select Category</label>
                                    <select class="form-control" :class="{ 'is-invalid':form.errors.has('cat_id')} " v-model="form.cat_id">
                                        <option disabled value="">Select One</option>
                                        <option :value="category.id"  v-for="category in getAllCategories" v-if="category.status==1 && category.parent_id>0" >
                                            <span style="padding-left:30px;">Sub Category||</span>
                                            <span style="color:green;font-weight:bold" v-if="category.status==1" >{{ category.cat_name }}</span>
                                        </option>
                                    </select>
                                    <has-error :form="form" field="cat_id"></has-error>
                                </div>
                                <div class="form-group">
                                    <label for="photoId">Add New Photo</label><br>
                                    <input @change = "changePhoto($event)" name="photo" type="file"
                                           :class="{ 'is-invalid':form.errors.has('photo')} ">
                                    <img :src="form.photo" alt="" width="80" height="80">
                                    <has-error :form="form" field="photo"></has-error>
                                </div>
                                <div class="form-group">
                                    <label for="videoId">Add New Video</label><br>
                                    <input @change = "changeVideo($event)" name="video" type="file"
                                           :class="{ 'is-invalid':form.errors.has('video')} ">
                                    <video :src="form.video" alt="" width="80" height="80"></video>
                                    <has-error :form="form" field="video"></has-error>
                                </div>
                                <div class="form-group">
                                    <label for="statusId">Enable</label>
                                    <input type="checkbox" id="status" @click="checkStatus" v-model="form.status"
                                           name="status" >
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>
    </div>
</template>

<script>
    export default {
        name: "New",
        data(){
            return {
                form: new Form({
                    title: '',
                    description: '',
                    cat_id: '',
                    photo: '',
                    video:'',
                    status:'',

                }),
                options: {
                    lineNumbers: true,
                    styleActiveLine: true,
                    styleSelectedText: true,
                    lineWrapping: true,
                    indentWithTabs: true,
                    tabSize: 2,
                    indentUnit: 2
                }
            }
        },
        mounted() {
            this.$store.dispatch("enabledCategory");
        },
        computed:{
            getAllCategories(){
                return this.$store.getters.getEnabledCategory
            },
        },
        methods:{
            checkStatus(){
                if(this.form.status==true){
                    this.form.status=false
                }else{
                    this.form.status=true
                }
            },
            changePhoto(event){
                let file = event.target.files[0];
                if(file.size > 1024 * 1024){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Choose smaller than '+file.size+' size.',
                        footer: '',
                    })
                }
                else{
                    let reader = new FileReader();
                    reader.onload = event =>{
                        this.form.photo = event.target.result
                    };
                    reader.readAsDataURL(file);
                }
            },
            changeVideo(event){
                let file = event.target.files[0];
                if(file.size > 50000000000){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Choose smaller than '+file.size+' size.',
                        footer: '',
                    })
                }
                else{
                    let reader = new FileReader();
                    reader.onload = event =>{
                        this.form.video = event.target.result
                    };
                    reader.readAsDataURL(file);
                }
            },
            addNewPost(){
                this.form.post('add-post')
                .then(()=>{
                    this.$router.push('post-list')
                    Toast.fire({
                        icon: 'success',
                        title: 'New Post Added Successfully!'
                    })
                })
                .catch(()=>{

                })
            },

        },
    }
</script>

<style scoped>

</style>
