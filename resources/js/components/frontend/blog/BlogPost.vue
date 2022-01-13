<template>
    <section id="content">
        <div class="container">
            <div class="row">
                <div class="span8" style=" min-height: 100vh !important;">
                    <article class="span8" v-for="post in blogPost"  style=" min-height: 100vh !important;">
                        <div class="row">
                            <div class="post-image">
                                <div class="post-heading" style="text-align:center;">
                                    <h3><a href="#" >{{post.title}}</a></h3>
                                </div>
                                <img :src="`/images/blog/post/large/${post.photo}`" alt="" width="800px" height="800px"/>
                            </div>
                            <p :inner-html.prop="post.description | sortlenght(500,'...')"></p>
                            <div class="bottom-article" >
                                <ul class="meta-post">
                                    <li><i class="icon-calendar"></i><a href="#">{{post.updated_at | timeformat()}}</a>
                                    </li>
                                    <li v-if="post.user"><i class="icon-user"></i><a href="#">{{post.user.name | capitalize(1)}}</a>
                                    </li>
                                    <li v-if="post.category"><i class="icon-folder-open"></i>
                                        <router-link :to="`/categories/${post.category.id}`">
                                            {{post.category.cat_name | capitalize(1)}}
                                        </router-link>
                                    </li>
                                    <li><i class="icon-comments"></i><a href="#">Yorumlar</a></li>
                                </ul>
                                <router-link :to="`/blog/${post.id}`" class="pull-right">Devamını oku <i
                                    class="icon-angle-right"></i></router-link>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="span4" style=" min-height: 100vh !important;">
                    <BlogSidebar></BlogSidebar>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import BlogSidebar from "./BlogSidebar";

    export default {
        name: "BlogPost",
        components: {
            BlogSidebar
        },
        mounted() {
            this.$store.dispatch('getblogPost');
        },
        computed: {
            blogPost() {
                return this.$store.getters.getblogPost
            },
        },
        methods: {
            getAllCategoryPost() {
                if (this.$route.params.id != null) {
                    this.$store.dispatch('getPostByCatId', this.$route.params.id);
                } else {
                    this.$store.dispatch('getblogPost')
                }
            },
        },
        watch: {
            $route(to, from) {
                this.getAllCategoryPost();
            }
        }
    }
</script>

<style scoped>

</style>
