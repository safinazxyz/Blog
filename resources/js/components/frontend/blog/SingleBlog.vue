<template>
    <section id="content">
        <div class="container">
            <div class="row">
                <div class="span8">
                    <article class="span8" style=" min-height: 100vh !important;">
                        <div class="row">
                            <div class="span8">
                                <div class="post-image" >
                                    <div class="post-heading" style="text-align:center;">
                                        <h3><a href="#">{{ singlePost.title }}</a></h3>
                                    </div>
                                    <div  style="text-align:center;">
                                    <img :src="`/images/blog/post/small/${singlePost.photo}`" alt="">
                                    </div>
                                </div>
                                <p :inner-html.prop="singlePost.description | nl2br"></p>
                                <div class="bottom-article">
                                    <ul class="meta-post">
                                        <li v-if="singlePost.admin"><i class="icon-user"></i>{{singlePost.admin.name | capitalize(1)}}</li>
                                        <li v-if="singlePost.category"><i class="icon-folder-open"></i><router-link :to="`/categories/${singlePost.category.id}`">{{singlePost.category.cat_name | capitalize(1)}}</router-link></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div v-if="singlePost.video" style="width:100%;height:250px;text-align:center;">
                             <video controls :src="`/storage/videos/blog/post/${singlePost.video}`" style="width:350px;height:250px;background-color:black;">
                             </video>
                        </div>
                    </article>
                </div>
                <BlogSidebar></BlogSidebar>
            </div>
        </div>
    </section>
</template>

<script>
    import BlogSidebar from "./BlogSidebar";
    import Nl2br from 'vue-nl2br';
    export default {
        name: "SingleBlog",
        components:{
            BlogSidebar,
            Nl2br,
        },
        data(){
            return {
            }
        },
        computed:{
            singlePost(){
                return this.$store.getters.singlePost
            },
        },
        methods:{
            singlepost(){
                this.$store.dispatch('getPostById',this.$route.params.id)
            }

        },
        mounted(){
            this.singlepost()
        },
        watch:{
            $route(to,from){
                this.singlepost()
            }
        }
    }
</script>

<style scoped>

</style>
