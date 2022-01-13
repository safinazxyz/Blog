import AdminHome from './components/admin/AdminHome.vue'
import CategoryList from './components/admin/category/List.vue'
import AddCategory from './components/admin/category/New.vue'
import EditCategory from './components/admin/category/Edit.vue'
import PostList from './components/admin/post/List.vue'
import AddPost from './components/admin/post/New.vue'
import EditPost from './components/admin/post/Edit.vue'
import Enquiries from './components/admin/enquiries/List.vue'
//Frontend Routes
import FrontendHome from './components/frontend/FrontendHome.vue'
import BlogPost from './components/frontend/blog/BlogPost.vue'
import SingleBlog from './components/frontend/blog/SingleBlog.vue'
import BlogSidebar from './components/frontend/blog/BlogSidebar.vue'
import SendEnquiry from './components/frontend/contact/SendEnquiry.vue'
export const routes=[
   {
       path:'/dashboard',
       component:AdminHome
   },
    ///Category
    {
        path:'/admin/category-list',
        component:CategoryList
    },
    {
        path:'/admin/add-category',
        component:AddCategory
    },
    {
        path:'/admin/edit-category/:categoryid',
        component:EditCategory
    },
    ///Post
    {
        path:'/admin/post-list',
        component:PostList
    },
    {
        path:'/admin/add-post',
        component:AddPost
    },
    {
        path:'/admin/edit-post/:postid',
        component:EditPost
    },
    //Enquiries
    {
        path:'/admin/get-enquiries',
        component:Enquiries
    },
    ///Frontend Routes
    {
        path:'/',
        component:FrontendHome
    },
    {
        path:'/blog-post',
        component:BlogPost
    },
    {
        path:'/blog/:id',
        component:SingleBlog
    },
    {
        path:'/categories/:id',
        component:BlogPost
    },
    {
        path:'/categories/:url/:id',
        component:BlogPost
    },
    {
        path:'/blog-contact',
        component:SendEnquiry
    }
];
