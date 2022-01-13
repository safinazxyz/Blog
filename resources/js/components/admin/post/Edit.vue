<template>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Edit Post</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard#/dashboard">Home</a></li>
                            <li class="breadcrumb-item">
                                <router-link to="/admin/post-list">Post List</router-link>
                            </li>
                            <li class="breadcrumb-item active">Edit Post</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
                <div class="row justify-content-center">
                    <div class="card card-primary col-md-10">
                        <div class="card-header">
                            <h3 class="card-title">Edit Post</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" enctype="multipart/form-data" @submit.prevent="updatePost()">
                            <div class="form-group">
                                <label for="postId">Edit Post Title</label>
                                <input type="text" class="form-control" id="postId" placeholder="Update title"
                                       v-model="form.title" name="title"
                                       :class="{ 'is-invalid':form.errors.has('title')} ">
                                <has-error :form="form" field="title"></has-error>
                            </div>
                            <div class="form-group">
                                <label for="descriptionId">Edit Post Description</label>
                                <vue-editor v-model="form.description"
                                            :class="{ 'is-invalid':form.errors.has('description')} "/>
                                <has-error :form="form" field="description"></has-error>
                            </div>

                            <div class="form-group">
                                <label for="categoryId">Select Category</label>
                                <select class="form-control" :class="{ 'is-invalid':form.errors.has('cat_id')} "
                                        v-model="form.cat_id">
                                    <option disabled value="">Select One</option>
                                    <option :value="category.id" v-for="category in getAllCategories"
                                            v-if="category.status==1 && category.parent_id>0">
                                        <span style="color:green;font-weight:bold" v-if="category.status==1">{{ category.cat_name }}</span>
                                    </option>
                                </select>
                                <has-error :form="form" field="cat_id"></has-error>
                            </div>
                            <div class="form-group">
                                <input @change="changePhoto($event)" name="photo" type="file"
                                       :class="{ 'is-invalid': form.errors.has('photo') }">
                                <img :src="updateImage()" alt="" width="80" height="80">
                                <has-error :form="form" field="photo"></has-error>
                            </div>
                            <div class="form-group">
                                <input @change="changeVideo($event)" name="video" type="file"
                                       :class="{ 'is-invalid': form.errors.has('video') }">
                                <video :src="updateVideo()" alt="" width="80" height="80"></video>
                                  <a href=""
                                       @click.prevent="deleteVideo"
                                       class="btn btn-warning btn-mini btn-sm">Delete Video</a>
                                    <has-error :form="form" field="video"></has-error>

                            </div>
                            <div class="form-group">
                                <label for="statusId">Enable</label>
                                <input type="checkbox" id="status" @click="checkStatus" v-model="form.status"
                                       name="status">
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
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
        name: "Edit",
        data() {
            return {
                form: new Form({
                    cat_id: '',
                    title: '',
                    description: '',
                    photo: '',
                    video: '',
                    status: ''
                }),
            }
        },
        mounted() {
            this.$store.dispatch("enabledCategory");
            this.$store.dispatch("allPosts");
        },
        created() {
            axios.get(`/admin/edit-post/${this.$route.params.postid}`)
                .then((response) => {
                    console.log(response.data)
                    this.form.fill(response.data.posts)
                })
        },
        computed: {
            getAllCategories() {
                return this.$store.getters.getEnabledCategory
            },
            getAllPost() {
                return this.$store.getters.getPosts
            }
        },

        methods: {
            changePhoto(event) {
                let file = event.target.files[0];
                if (file.size > 1024 * 1024) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Choose smaller than ' + file.size + ' size.',
                        footer: '',
                    })
                } else {
                    let reader = new FileReader();
                    reader.onload = event => {
                        this.form.photo = event.target.result
                    };
                    reader.readAsDataURL(file);
                }
            },
            changeVideo(event) {
                let file = event.target.files[0];
                if (file.size > 50000000000) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Choose smaller than ' + file.size + ' size.',
                        footer: '',
                    })
                } else {
                    let reader = new FileReader();
                    reader.onload = event => {
                        this.form.video = event.target.result
                    };
                    reader.readAsDataURL(file);
                }
            },
            updatePost() {
                this.form.post(`/admin/update-post/${this.$route.params.postid}`)
                    .then((response) => {
                        this.$router.push('/admin/post-list')
                        Toast.fire({
                            icon: 'success',
                            title: 'Post Has Been Updated Successfully!'
                        })
                    })
                    .catch(() => {
                    })
            },
            updateImage() {
                let img = this.form.photo;
                console.log(img)

                if (img.length > 100) {
                    return this.form.photo
                } else {
                    return `/images/blog/post/small/${this.form.photo}`;
                }
            },
            updateVideo() {
                let video = this.form.video;
                console.log(video)

                if (video.length > 100) {
                    return this.form.video
                } else {
                    return `/storage/videos/blog/post/${this.form.video}`;
                }
            },
            checkStatus() {
                if (this.form.status == true) {
                    this.form.status = false
                } else {
                    this.form.status = true
                }
            },
            deleteVideo() {
                axios.get(`/admin/postVideo-delete/${this.$route.params.postid}`)
                    .then(() => {
                        this.$router.push(`/admin/edit-post/${this.$route.params.postid}`)

                        Toast.fire({
                            icon: 'success',
                            title: 'Video Has Been Deleted Successfully!'
                        });
                    })
                    .catch(() => {
                    })
            }
        },
    }
</script>

<style scoped>

</style>
