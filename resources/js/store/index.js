export default {
    state:{
        category:[],
        posts:[],
        blogpost:[],
        singlepost:[],
        allcategories:[],
        latestposts:[],
        enquiries: [],
        categoryLevels:[],
        enabledCategory:[],
    },
    getters:{
        getCategory(state){
            return state.category
        },
        getPosts(state){
            return state.posts
        },
        getblogPost(state){
            return state.blogpost
        },
        singlePost(state){
            return state.singlepost
        },
        allCategories(state){
            return state.allcategories
        },
        getlatestpost(state){
            return state.latestposts
        },
        getEnquiries(state){
            return state.enquiries
        },
        getCatLevels(state){
            return state.categoryLevels
        },
        getEnabledCategory(state){
            return state.enabledCategory
        },
    },
    actions:{
        allCategory(context){
            axios.get('category')
                .then((response)=>{
                    context.commit('categories',response.data.categories)
                })
        },
        enabledCategory(context){
            axios.get('enabledCategory')
                .then((response)=>{
                    context.commit('enabledCategory',response.data.categories)
                })
        },
        allPosts(context){
            axios.get('posts')
                .then((response)=>{
                    context.commit('posts',response.data.posts)
            })
        },
        getblogPost(context){
            axios.get('/blogPost')
                .then((response)=>{
                    // console.log(response.data)
                    context.commit('getblogPost',response.data.posts)
                })
        },
        getPostById(context,payload){
            axios.get('/singlePost/'+payload)
                .then((response)=>{
                    context.commit('singlePost',response.data.posts)
                })
        },
        allCategories(context){
            axios.get('/categories')
                .then((response)=>{
                    context.commit('allcategories',response.data.categories)
                })
        },
        getPostByCatId(context,payload){
            axios.get('/categorypost/'+payload)
                .then((response)=>{
                    context.commit('getPostByCatId',response.data.posts)
                })
        },
        SearchPost(context,payload){
            axios.get('/search?s='+payload)
                .then((response)=>{
                    context.commit('getSearchPost',response.data.posts)
                })
        },
        latestPost(context){
            axios.get('/latestpost')
                .then((response)=>{
                    // console.log(response.data)
                    context.commit('getlatestpost',response.data.posts)
                })
        },
        allEnquiries(context){
            axios.get('get-enquiries')
                .then((response)=>{
                    // console.log(response.data)
                    context.commit('getenquiries',response.data.enquiries)
                })
        },
        allCategoryLevels(context){
            axios.get('add-category')
                .then((response)=>{
                    // console.log(response.data)
                    context.commit('getCategoryLevels',response.data.categoryLevels)
                })
        },
    },
    mutations:{
        categories(state,data){
            return state.category = data
        },
        posts(state,payload){
            return state.posts = payload
        },
        getblogPost(state,payload){
            return state.blogpost = payload
        },
        singlePost(state,payload){
            return state.singlepost = payload
        },
        allcategories(state,payload){
            return state.allcategories = payload
        },
        getPostByCatId(state,payload){
            return state.blogpost = payload
        },
        getSearchPost(state,payload){
            return state.blogpost = payload
        },
        getlatestpost(state,payload){
            return state.latestposts = payload
        },
        getenquiries(state,payload){
            return state.enquiries = payload
        },
        getCategoryLevels(state,payload){
            return state.categoryLevels = payload
        },
        enabledCategory(state,payload){
            return state.enabledCategory = payload
        },
        postCountForEachCat(state,payload){
            return state.postCountForEachCat = payload
        },
    },
}
