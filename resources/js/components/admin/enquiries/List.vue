<template>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Enquiries List</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard#/dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Enquiries List</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
                <div class="row justify-content-center">
                    <div class="col-10">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Enquiries List</h3>
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
                                            <input style="margin-top: 10px;margin-left: 5px;" class="text" v-model="search"
                                                   placeholder="Search Name">
                                            <table id="example2" class="table table-bordered table-hover dataTable"
                                                   role="grid" aria-describedby="example2_info">
                                                <thead>
                                                <tr role="row">
<!--                                                    <th>-->
<!--                                                        <select name="" id="" v-model="select" @change="deleteSelected">-->
<!--                                                            <option value="">Select</option>-->
<!--                                                            <option value="">Delete all</option>-->
<!--                                                        </select><br>-->
<!--                                                        <input type="checkbox" @click.prevent="selectAll" v-model="all_select">-->
<!--                                                        <span v-if="all_select==false">Check All</span>-->
<!--                                                        <span v-else>Uncheck All</span>-->
<!--                                                    </th>-->
                                                    <th class="sorting_asc" tabindex="0" aria-controls="example2"
                                                        rowspan="1" colspan="1" aria-sort="ascending"
                                                        aria-label="Rendering engine: activate to sort column descending">
                                                        Sl
                                                    </th>
                                                    <th class="sorting_asc" tabindex="0" aria-controls="example2"
                                                        rowspan="1" colspan="1" aria-sort="ascending"
                                                        aria-label="Rendering engine: activate to sort column descending">
                                                        Name
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        Email
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        Subject
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        Message
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        Created on
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Platform(s): activate to sort column ascending">
                                                        Actions
                                                    </th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr v-for="(enquiry,index) in filteredEnquiries" :key="enquiry.id">
                                                    <td>{{index + 1}}</td>
                                                    <td>{{enquiry.name}}</td>
                                                    <td>{{enquiry.email}}</td>
                                                    <td>{{ enquiry.subject}}</td>
                                                    <td>{{enquiry.message.substring(0,500)}}</td>
                                                    <td>{{enquiry.created_at | timeformat}}</td>
                                                    <td style=" text-align:center;">
                                                        <a href="" class="btn btn-warning btn-mini ">Delete</a>
                                                    </td>
                                                </tr>
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>Sl</th>
                                                    <th rowspan="1" colspan="1">Name</th>
                                                    <th rowspan="1" colspan="1">Email</th>
                                                    <th rowspan="1" colspan="1">Subject</th>
                                                    <th rowspan="1" colspan="1">Message</th>
                                                    <th rowspan="1" colspan="1">Created on</th>
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
        data() {
            return{
                 search: '',
            }
        },
        mounted() {
            this.$store.dispatch("allEnquiries")
        },
        computed: {
            filteredEnquiries() {
                return this.$store.getters.getEnquiries.filter(enquiry => {
                    return enquiry.name.toLowerCase().includes(this.search.toLowerCase());
                })
            }
        },
    }
</script>

<style scoped>

</style>
