<template>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Category List</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard#/dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Category List</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Category List</h3>
                                <div class="card-tools">
                                    <router-link to="add-category">
                                        <button class="btn btn-primary">
                                            Add Category
                                        </button>
                                    </router-link>
                                </div>
                            </div>
                            <!-- /.card-header -->
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
                                                    <th>
                                                        <select name="" id="" v-model="select" @change="deleteSelected">
                                                            <option value="">Select</option>
                                                            <option value="">Delete all</option>
                                                        </select><br>
                                                        <input type="checkbox" @click.prevent="selectAll" v-model="all_select">
                                                        <span v-if="all_select==false">Check All</span>
                                                        <span v-else>Uncheck All</span>
                                                    </th>
                                                    <th class="sorting_asc" tabindex="0" aria-controls="example2"
                                                        rowspan="1" colspan="1" aria-sort="ascending"
                                                        aria-label="Rendering engine: activate to sort column descending">
                                                        Sl
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        Category Name
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        Description
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        Url
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        Meta Title
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        Meta Description
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        Meta Keywords
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Platform(s): activate to sort column ascending">
                                                        Enable
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        Date
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Platform(s): activate to sort column ascending">
                                                        Actions
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr v-for="(category,index) in getAllCategory" :key="category.id">
                                                    <td><input type="checkbox" v-model="categoryItem" :value="category.id"></td>
                                                    <td>{{index + 1}}</td>
                                                    <td v-if="category.cat_name!=null && category.parent_id==0" >{{category.cat_name}} <span style="color:#a20804;float:right;">Main</span></td>
                                                    <td v-if="category.cat_name!=null && category.parent_id!=0" >{{category.cat_name}} <span style="color:darkgreen;float:right;">Sub</span></td>
                                                    <td v-else-if="category.cat_name==null"></td>
                                                    <td v-if="category.description!=null" :inner-html.prop="category.description | sortlenght(40,'---')"></td>
                                                    <td v-else-if="category.description==null"></td>
                                                    <td v-if="category.url!=null" >{{category.url}}</td>
                                                    <td v-else-if="category.url==null"></td>
                                                    <td v-if="category.meta_title!=null" >{{category.meta_title}}</td>
                                                    <td v-else-if="category.meta_title==null"></td>
                                                    <td v-if="category.meta_description!=null" >{{category.meta_description}}</td>
                                                    <td v-else-if="category.meta_description==null"></td>
                                                    <td v-if="category.meta_keywords!=null" >{{category.meta_keywords}}</td>
                                                    <td v-else-if="category.meta_keywords==null"></td>
                                                    <td v-if="category.status==true" ><span style="color: #00cc00;font-weight: bold">Active</span></td>
                                                    <td v-else-if="category.status==false" ><span style="color: #cc0607;font-weight: bold">Disabled</span></td>
                                                    <td v-else-if="category.status==null"></td>
                                                    <td>{{category.created_at | timeformat}}</td>
                                                    <td style=" text-align:center;">
                                                        <router-link :to="`/admin/edit-category/${category.id}`" class="btn btn-success btn-mini">Edit</router-link>
                                                        <a href=""
                                                           @click.prevent ="deleteCategory(category.id)"
                                                        class="btn btn-warning btn-mini ">Delete</a>
                                                    </td>
                                                </tr>
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th> </th>
                                                    <th rowspan="1" colspan="1">SL</th>
                                                    <th rowspan="1" colspan="1">Category Name</th>
                                                    <th rowspan="1" colspan="1">Description</th>
                                                    <th rowspan="1" colspan="1">Url</th>
                                                    <th rowspan="1" colspan="1">Meta title</th>
                                                    <th rowspan="1" colspan="1">Meta Description</th>
                                                    <th rowspan="1" colspan="1">Meta Keywords</th>
                                                    <th rowspan="1" colspan="1">Enable</th>
                                                    <th rowspan="1" colspan="1">Date</th>
                                                    <th rowspan="1" colspan="1">Actions</th>
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
                            <!-- /.card-body -->
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
        data(){
          return{
              categoryItem:[],
              select:'',
              all_select:false
          }
        },
        mounted() {
            this.$store.dispatch("allCategory")
        },
        computed: {
            getAllCategory() {
                return this.$store.getters.getCategory
            },
        },
        methods: {
            deleteCategory(id) {
                axios.get('/admin/category/' + id)
                    .then(() => {
                        this.$store.dispatch("allCategory")
                        Toast.fire({
                            icon: 'success',
                            title: 'Category Has Been Deleted Successfully!'
                        })
                    })
                    .catch(() => {
                    })
            },
            deleteSelected(){
               axios.get('/admin/deleteCategory/'+this.categoryItem)
                   .then(() => {
                       this.categoryItem = []
                       this.$store.dispatch("allCategory")
                       Toast.fire({
                           icon: 'success',
                           title: 'Category Has Been Deleted Successfully!'
                       })
                   })
                   .catch(() => {
                   })
            },
            selectAll(){
                if(this.all_select==false){
                    this.all_select = true
                    for(var category in this.getAllCategory){
                        this.categoryItem.push(this.getAllCategory[category].id)
                    }
                }else{
                    this.all_select = false
                    this.categoryItem = []
                }
            }
        },
    }
</script>
<style scoped>

</style>
