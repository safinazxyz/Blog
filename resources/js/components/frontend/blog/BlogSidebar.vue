<template>
    <span id="sidebar">
        <div class="span4">
                    <aside class="right-sidebar">
                        <div class="widget">
                            <form class="form-search">
                                <input @keyup="RealSearch" placeholder="Birşeyler yaz" v-model="keyword" type="text"
                                       class="input-medium search-query">
                                <button type="submit" @click.prevent="RealSearch"
                                        class="btn btn-square btn-theme">Ara</button>
                            </form>
                        </div>
                        <div class="widget">
                            <h5 class="widgetheading">Kategoriler</h5>
                           <div id="accordion" class="panel-group">
	                            <div class="accordion-item"
                                     v-for="(category,index) in allCategories"
                                     v-bind:class="{ 'accordion-active': active }">
	                            	<div class="accordion-header">
	                            		<a href="#accordion" v-on:click="expand($event, index)">
                                            <span style="color:#F03C02; padding-right: 5px;">
                                                <i class="fas fa-chevron-circle-right"
                                                   v-bind:ref="'fas fa-chevron-circle-right-'+index"></i></span>
                                            <span
                                                style="font-weight: bold;">{{ category.cat_name | capitalize(1) }}</span>
	                            		</a>
	                            	</div>
	                            	<div class="accordion-body panel-collapse collapse"
                                         v-bind:ref="'accordion-body-'+index">
                                        <div class="accordion-content" v-for="sub in category.categories">
                                            <router-link :to="`/categories/${sub.url}/${sub.id}`" v-if="sub.status==1">
                                                <span style="padding-left:25px; color:#d57b29; font-weight: bold;">{{ sub.cat_name | capitalize(1)}}</span>
                                            </router-link>
                                        </div>
	                            	</div>
	                            </div>
                            </div>
                        </div>
                        <div class="widget">
                            <h5 class="widgetheading">Son Gönderiler</h5>
                            <ul class="recent">
                                <li v-for="(post,index) in blogPost" v-if="index < 5">
                                     <img :src="`/images/blog/post/small/${post.photo}`" class="pull-left" alt=""
                                          width="100px" height="100px"/>
                                    <h6><router-link :to="`/blog/${post.id}`">{{ post.title }}</router-link></h6>
                                    <p :inner-html.prop="post.description | sortlenght2(40,200,'...')"></p>
                                </li>
                            </ul>
                        </div>
                    </aside>
                </div>
    </span>
</template>

<script>
    import _ from 'lodash'
    import {TweenLite, Elastic, Bounce, scrollHeight, TweenMax} from 'gsap/all.js';

    export default {
        name: "BlogSidebar",
        data() {
            return {
                keyword: '',
                active: false,
            }
        },
        computed: {
            allCategories() {
                return this.$store.getters.allCategories
            },
            blogPost() {
                return this.$store.getters.getlatestpost
            },

        },
        mounted() {
            this.$store.dispatch('latestPost');
            this.$store.dispatch('allCategories');
        },
        methods: {
            RealSearch: _.debounce(function () {
                this.$store.dispatch('SearchPost', this.keyword)
            }, 1000),
            expand(e, i) {
                e.preventDefault();

                let el = this.$refs['accordion-body-' + i][0];
                let el2 = this.$refs['fas fa-chevron-circle-right-' + i][0];

                if (this.active === false) {
                    this.active = true;

                    TweenLite.to(el, 0.1, {
                        height: el.scrollHeight,
                        ease: Elastic.easeOut.config(1, 0.1)
                    });
                    TweenLite.to(el2, 1, {
                        rotation: 90
                    });
                } else {
                    this.active = false;

                    TweenLite.to(el, 0, {
                        height: 0,
                        ease: Bounce.easeOut
                    });
                    TweenLite.to(el2, 1, {
                        rotation: 0
                    });
                }
            },
        },
    }
</script>

<style scoped>

</style>
