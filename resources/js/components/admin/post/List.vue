<template>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Posts List</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard#/dashboard"">Home</a></li>
                            <li class="breadcrumb-item active">Posts List</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-tools">
                                    <router-link to="add-post">
                                        <button class="btn btn-primary">
                                            Add Post
                                        </button>
                                    </router-link>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Posts Table</h3>

                                            <div class="card-tools">
                                                <div class="input-group input-group-sm" style="width: 150px;">
                                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                                    <div class="input-group-append">
                                                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-6"></div>
                                                    <div class="col-sm-12 col-md-6"></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <table id="example2" class="table table-bordered table-hover dataTable"
                                                               role="grid" aria-describedby="example2_info">
                                                            <thead>
                                                            <tr role="row">
                                                                <th class="sorting_asc" tabindex="0" aria-controls="example2"
                                                                    rowspan="1" colspan="1" aria-sort="ascending"
                                                                    aria-label="Rendering engine: activate to sort column descending">
                                                                    Sl
                                                                </th>
                                                                <th class="sorting" tabindex="0" aria-controls="example2"
                                                                    rowspan="1" colspan="1"
                                                                    aria-label="Browser: activate to sort column ascending">
                                                                    Admin/SubAdmin Name
                                                                </th>
                                                                <th class="sorting" tabindex="0" aria-controls="example2"
                                                                    rowspan="1" colspan="1"
                                                                    aria-label="Browser: activate to sort column ascending">
                                                                    Category Name
                                                                </th>
                                                                <th class="sorting" tabindex="0" aria-controls="example2"
                                                                    rowspan="1" colspan="1"
                                                                    aria-label="Platform(s): activate to sort column ascending">
                                                                    Post Title
                                                                </th>
                                                                <th class="sorting" tabindex="0" aria-controls="example2"
                                                                    rowspan="1" colspan="1"
                                                                    aria-label="Platform(s): activate to sort column ascending">
                                                                    Post Description
                                                                </th>
                                                                <th class="sorting" tabindex="0" aria-controls="example2"
                                                                    rowspan="1" colspan="1"
                                                                    aria-label="Platform(s): activate to sort column ascending">
                                                                    Created at
                                                                </th>
                                                                <th class="sorting" tabindex="0" aria-controls="example2"
                                                                    rowspan="1" colspan="1"
                                                                    aria-label="Platform(s): activate to sort column ascending">
                                                                    Photo
                                                                </th>
                                                                <th class="sorting" tabindex="0" aria-controls="example2"
                                                                    rowspan="1" colspan="1"
                                                                    aria-label="Platform(s): activate to sort column ascending">
                                                                    Video
                                                                </th>
                                                                <th class="sorting" tabindex="0" aria-controls="example2"
                                                                    rowspan="1" colspan="1"
                                                                    aria-label="Platform(s): activate to sort column ascending">
                                                                    Enable
                                                                </th>
                                                                <th class="sorting" tabindex="0" aria-controls="example2"
                                                                    rowspan="1" colspan="1"
                                                                    aria-label="Platform(s): activate to sort column ascending" style=" text-align:center;">
                                                                    Actions
                                                                </th>

                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr v-for="(post,index) in getAllPosts" :key="post.id">
                                                                <td>{{ index+1 }}</td>
                                                                <td v-if="post.admin">{{ post.admin.name }}</td>
                                                                <td v-else-if="post.admin==null || post.admin==''"></td>
                                                                <td v-if="post.category">{{post.category.cat_name}}</td>
                                                                <td v-else-if="post.category==null || post.category==''"></td>
                                                                <td v-if="post.title">{{ post.title | sortlenght(20,"---")}}</td>
                                                                <td v-else-if="post.title==null || post.title==''"></td>
                                                                <td v-if="post.description" :inner-html.prop="post.description | sortlenght(100,'---')">{{ post.description | sortlenght(40,"---") }}</td>
                                                                <td v-else-if="post.description==null || post.description==''"></td>
                                                                <td>{{post.created_at | timeformat}}</td>
                                                                <td v-if="post.photo"><img :src="postImage(post.photo)" style="width: 40px;height: 40px;"></td>
                                                                <td v-else-if="post.photo==null || post.photo==''"></td>
                                                                <td v-if="post.video"><video :src="postVideo(post.video)" style="width: 40px;height: 40px;"></video></td>
                                                                <td v-else-if="post.video=='' || post.video==null"></td>
                                                                <td v-if="post.status==true" ><span style="color: #00cc00;font-weight: bold">Active</span></td>
                                                                <td v-else-if="post.status==false" ><span style="color: #cc0607;font-weight: bold">Disabled</span></td>
                                                                <td style=" text-align:center;">
                                                                    <router-link :to="`/admin/edit-post/${post.id}`" class="btn btn-success btn-mini btn-sm">Edit</router-link>

                                                                    <a href=""
                                                                       @click.prevent ="deletePost(post.id)"
                                                                       class="btn btn-warning btn-mini btn-sm">Delete</a>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                            <tfoot>
                                                            <tr>
                                                                <th rowspan="1" colspan="1">Sl</th>
                                                                <th rowspan="1" colspan="1">Admin/SubAdmin Name</th>
                                                                <th rowspan="1" colspan="1">Category Name</th>
                                                                <th rowspan="1" colspan="1">Post Title</th>
                                                                <th rowspan="1" colspan="1">Post Description</th>
                                                                <th rowspan="1" colspan="1">Created at</th>
                                                                <th rowspan="1" colspan="1">Photo</th>
                                                                <th rowspan="1" colspan="1">Video</th>
                                                                <th rowspan="1" colspan="1">Enable</th>
                                                                <th rowspan="1" colspan="1" style=" text-align:center;">Actions</th>
                                                            </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-5">
                                                        <div class="dataTables_info" id="example2_info" role="status"
                                                             aria-live="polite">Showing 1 to 10 of 57 entries
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-7">
                                                        <div class="dataTables_paginate paging_simple_numbers"
                                                             id="example2_paginate">
                                                            <ul class="pagination">
                                                                <li class="paginate_button page-item previous disabled"
                                                                    id="example2_previous">
                                                                    <a href="#" aria-controls="example2" data-dt-idx="0"
                                                                       tabindex="0" class="page-link">Previous</a>
                                                                </li>
                                                                <li class="paginate_button page-item active">
                                                                    <a href="#" aria-controls="example2" data-dt-idx="1"
                                                                       tabindex="0" class="page-link">1</a>
                                                                </li>
                                                                <li class="paginate_button page-item ">
                                                                    <a href="#" aria-controls="example2" data-dt-idx="2"
                                                                       tabindex="0" class="page-link">2</a>
                                                                </li>
                                                                <li class="paginate_button page-item next" id="example2_next">
                                                                    <a href="#" aria-controls="example2" data-dt-idx="7"
                                                                       tabindex="0" class="page-link">Next</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card -->
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
            </div><!-- /.container-fluid -->
        </div>
    </div>
</template>

<script>
    export default {
        name: "List",
        mounted() {
           this.$store.dispatch("allPosts");
        },
        computed:{
            getAllPosts() {
                return this.$store.getters.getPosts
            },
        },
        methods:{
            postImage(img){
                return "/images/blog/post/small/"+img;
            },
            postVideo(video){
                return "/storage/videos/blog/post/"+video;
            },
            deletePost(id) {
                axios.get('/admin/post-delete/' + id)
                    .then(() => {
                        this.$store.dispatch("allPosts")
                        Toast.fire({
                            icon: 'success',
                            title: 'Post Has Been Deleted Successfully!'
                        })
                    })
                    .catch(() => {
                    })
            }
        },
    }
</script>

<style scoped>

</style>
