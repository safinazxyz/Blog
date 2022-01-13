<template>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Add Category</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard#/dashboard">Home</a></li>
                            <li class="breadcrumb-item"><router-link to="category-list">Category List</router-link></li>
                            <li class="breadcrumb-item active">Add Category</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
                <div class="row">
                    <div class="card card-primary col-6">
                        <div class="card-header">
                            <h3 class="card-title">Add Category</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" @submit.prevent="addCategory()">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="categoryId">Add New Category</label>
                                    <input type="text" class="form-control" id="category_id" placeholder=""
                                           v-model="form.cat_name" name="cat_name"
                                           :class="{ 'is-invalid':form.errors.has('cat_name')} ">
                                    <has-error :form="form" field="cat_name"></has-error>
                                </div>
                                <div class="form-group">
                                    <label for="categoryLevelId">Select Category Level</label>
                                    <select class="form-control" v-model="form.parent_id" id="parent_id" placeholder="" name="parent_id"
                                            :class="{ 'is-invalid':form.errors.has('parent_id')} ">
                                        <option disabled value="">Select One</option>
                                        <option :value="0">Main Category</option>
                                        <option :value="category.id" v-for="category in getCategoryLevels">----{{ category.cat_name }} (Sub Category)</option>
                                    </select>
                                    <has-error :form="form" field="parent_id"></has-error>
                                </div>
                                <div class="form-group" >
                                    <label for="descriptionId">Add New Description</label>
                                    <vue-editor v-model="form.description"
                                                :class="{ 'is-invalid':form.errors.has('description')}" />
                                    <has-error :form="form" field="description"></has-error>
                                </div>
                                <div class="form-group">
                                    <label for="urlId">URL</label>
                                    <input type="text" class="form-control" id="url" placeholder=""
                                           v-model="form.url" name="url"
                                           :class="{ 'is-invalid':form.errors.has('url')} ">
                                    <has-error :form="form" field="url"></has-error>
                                </div>
                                <div class="form-group">
                                    <label for="metaTitleId">Meta Title</label>
                                    <input type="text" class="form-control" id="meta_title" placeholder=""
                                           v-model="form.meta_title" name="meta_title"
                                           :class="{ 'is-invalid':form.errors.has('meta_title')} ">
                                    <has-error :form="form" field="meta_title"></has-error>
                                </div>
                                <div class="form-group">
                                    <label for="metaDescriptionId">Meta Description</label>
                                    <input type="text" class="form-control" id="meta_description" placeholder=""
                                           v-model="form.meta_description" name="meta_description"
                                           :class="{ 'is-invalid':form.errors.has('meta_description')} ">
                                    <has-error :form="form" field="meta_description"></has-error>
                                </div>
                                <div class="form-group">
                                    <label for="metaKeywordsId">Meta Keywords</label>
                                    <input type="text" class="form-control"  placeholder=""
                                           v-model="form.meta_keywords" name="meta_keywords"
                                           :class="{ 'is-invalid':form.errors.has('meta_keywords')} ">
                                    <has-error :form="form" field="meta_keywords"></has-error>
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
        data() {
            return {
                form: new Form({
                    parent_id:'',
                    cat_name: '',
                    description:'',
                    url:'',
                    meta_title:'',
                    meta_description:'',
                    meta_keywords:'',
                    status:true,
                }),
            }
        },
        mounted() {
            this.$store.dispatch("allCategoryLevels")
        },
        computed:{
            getCategoryLevels(){
                return this.$store.getters.getCatLevels
            },
        },
        methods: {
            checkStatus(){
                if(this.form.status==true){
                  this.form.status=false
                }else{
                  this.form.status=true
                }
            },
            addCategory() {
                this.form.post('add-category')
                    .then((response) => {
                        this.$router.push('category-list')
                        Toast.fire({
                            icon: 'success',
                            title: 'New Category Added Successfully!'
                        })
                    })
                    .catch(() => {
                    })
            },

        }
    }
</script>
<style scoped>

</style>
