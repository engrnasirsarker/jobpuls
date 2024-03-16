import {ref} from 'vue'
import NProgress from 'nprogress';
import 'nprogress/nprogress.css';
import {createRouter, createWebHistory} from 'vue-router';
import FrontAdminLayouts from '@/frontend/admin/partials/mainLayout.vue'
import {authStore} from '@/stores/auth'
const isAuthenticated = ref(authStore.isAuthenticated2);
const currentUser = window.user
export const routes = [    
 
    /*------------------- 
      Frontend Routes
    ---------------------*/
    {
        path: '/',        
        component: () => import('@/frontend/pages/home.vue'),
        meta: { frontend: true, title: 'Home school' },          
    },   
   //--------  auth route --------
       
    {
        path: '/login-index',        
        component: () => import('@/frontend/auth/LoginIndex.vue'),
        meta: { frontend: true, title: 'Login Index' },          
    },   
    {
        path: '/signup-index',        
        component: () => import('@/frontend/auth/SignupIndex.vue'),
        meta: { frontend: true, title: 'Signup Index' },          
    },   
      
    //-------- employer auth route --------
    {
        path: '/employer-login',        
        component: () => import('@/frontend/auth/employer/Login.vue'),
        meta: { frontend: true, title: 'Login | Employer' },          
    },   
         
    {
        path: '/employer-signup',        
        component: () => import('@/frontend/auth/employer/Signup.vue'),
        meta: { frontend: true, title: 'Signup | Employer' },          
    },   
    //-------- candidate auth route --------
    {
        path: '/candidate-login',        
        component: () => import('@/frontend/auth/candidate/Login.vue'),
        meta: { frontend: true, title: 'Login | Candidate' },          
    }, 
    {
        path: '/candidate-signup',        
        component: () => import('@/frontend/auth/candidate/Signup.vue'),
        meta: { frontend: true, title: 'Signup | Candidate' },          
    },   
    //-------- forget password route --------
    {
        path: '/forget-password',        
        component: () => import('@/frontend/auth/ForgetPassword.vue'),
        meta: { frontend: true, title: 'Forget Password' },          
    }, 
    
    //-------- job page route --------
    {
        path: '/jobs',        
        component: () => import('@/frontend/pages/Jobs.vue'),
        meta: { frontend: true, title: 'Jobs' },          
    }, 
    {
        path: '/job-details/:id',        
        component: () => import('@/frontend/pages/JobDetails.vue'),
        meta: { frontend: true, title: 'Jobs Details' },          
    }, 
    //--------about page route --------
    {
        path: '/about-us',        
        component: () => import('@/frontend/pages/About.vue'),
        meta: { frontend: true, title: 'About Us' },          
    }, 
    //-------- contact page route --------
    {
        path: '/contact-us',        
        component: () => import('@/frontend/pages/Contact.vue'),
        meta: { frontend: true, title: 'Contact Us' },          
    }, 
    //-------- blog page route --------
    {
        path: '/blogs',        
        component: () => import('@/frontend/pages/Blogs.vue'),
        meta: { frontend: true, title: 'Blogs' },          
    }, 
    {
        path: '/blog-details/:id',        
        component: () => import('@/frontend/pages/BlogDetails.vue'),
        meta: { frontend: true, title: 'Blogs' },          
    }, 
    //-------- page route --------
    {          
        path: '/front/admin/', 
        component: FrontAdminLayouts,
        meta: { frontend:true, requiresAuth: true },
        children: [
            {
                path: 'dashboard',
                component: () => import('@/frontend/admin/dashboard.vue'),
                meta: { title: 'Dashboard' },
            },
            {
                path: 'job-posts',
                component: () => import('@/frontend/admin/jobs/ListView.vue'),
                meta: { title: 'Job Post' },
            },
            {
                path: 'view-job-post/:id',
                component: () => import('@/frontend/admin/jobs/DetailsView.vue'),
                meta: { title: 'Job Post Details' },
            },
            {
                path: 'applied-jobs/:id',
                component: () => import('@/frontend/admin/jobs/AppliedJobs.vue'),
                meta: { title: 'Applied Job Post' },
            },
            {
                path: 'candidate-applied-jobs',
                component: () => import('@/frontend/admin/jobs/CandidateAppliedJobs.vue'),
                meta: { title: 'Candidate Applied Job' },
            },
            {
                path: 'view-candidate-applied-job/:id',
                component: () => import('@/frontend/admin/jobs/ViewCandidateAppliedJob.vue'),
                meta: { title: 'View Candidate Applied Job' },
            },
            {
                path: 'create-job-post',
                component: () => import('@/frontend/admin/jobs/CreateView.vue'),
                meta: { title: 'Job Post' },
            },
            {
                path: 'edit-job-post/:id',
                component: () => import('@/frontend/admin/jobs/EditView.vue'),
                meta: { title: 'Edit Job Post' },
            },
            {
                path: 'applied-candidate-profile/:postId/:userId',
                component: () => import('@/frontend/admin/jobs/AppliedCandidateProfile.vue'),
                meta: { title: 'Applied Candidate Profile' },
            },
            {
                path: 'candidate-profile',
                component: () => import('@/frontend/admin/candidateProfile.vue'),
                meta: { title: 'Candidate Profile' },
            },
            {
                path: 'account',
                component: () => import('@/frontend/admin/account.vue'),
                meta: { title: 'Account' },
            },
        ] 
    },  
    
    /*-------------------
      Backend Routes
    ---------------------*/
    {
        path: '/admin',
        redirect: '/admin/dashboard',        
        meta: { backend: true, title: 'Admin', admin: true }, 
        children: [
            {
                path: 'dashboard',
                component: () => import('@/pages/Dashboard.vue'),
                meta: { title: 'Dashboard' },
            },           
            
            /* ---- Companies Route ---- */
            {
                path: 'company-list',
                component: () => import('@/pages/company/ListView.vue'),
                meta: { title: 'Company List' },
            },
            /* ---- Candidates Route ---- */
            {
                path: 'candidate-list',
                component: () => import('@/pages/candidate/ListView.vue'),
                meta: { title: 'Candidate List' },
            },
            /* ---- Jobs Route ---- */
            {
                path: 'job-list',
                component: () => import('@/pages/job/ListView.vue'),
                meta: { title: 'Job List' },
            },
            /* ---- About Route ---- */
            {
                path: 'about',
                component: () => import('@/pages/About.vue'),
                meta: { title: 'Abot Page' },
            },
            /* ---- Contact Route ---- */
            {
                path: 'contact',
                component: () => import('@/pages/Contact.vue'),
                meta: { title: 'Contact Page' },
            },
            /* ---- Subject Route ---- */
            {
                path: 'plugins',
                component: () => import('@/pages/plugins.vue'),
                meta: { title: 'plugins' },
            },
            /* ---- Blog Route ---- */
            {
                path: 'blog-list',
                component: () => import('@/pages/blog/ListView.vue'),
                meta: { title: 'Blogs List' },
            },
            {
                path: 'blog-create',
                component: () => import('@/pages/blog/CreateView.vue'),
                meta: { title: 'Blog Create' },
            },
            {
                path: 'blog-edit/:id',
                component: () => import('@/pages/blog/EditView.vue'),
                meta: { title: 'Blog Edit' },
            },
            /*---------------------------
                User Route
            -----------------------------*/
            {
                path: 'users',
                component: () => import('@/pages/users/ListView.vue'),
                meta: { title: 'Student Class' },
            },

            /*---------------------------
                User Role Route
            -----------------------------*/
            {
                path: 'roles',
                component: () => import('@/pages/roles/ListView.vue'),
                meta: { title: 'User Roles' },
            },
            {
                path: 'role-create',
                component: () => import('@/pages/roles/CreateView.vue'),
                meta: { title: 'User Role Create' },
            },
            {
                path: 'role-edit/:id',
                component: () => import('@/pages/roles/EditView.vue'),
                meta: { title: 'User Role Edit' },
            },
        ]
         
    },   
    

]

const router = createRouter({
    history: createWebHistory(),
    routes
})
router.beforeEach((to, from, next) => {
    if (to.path === '/home') {
      next('/login'); // Redirect to home or any other desired route
    } else {
      next();
    }
  });

router.beforeEach((to, from, next) => {
    document.title = to.meta.title || 'Home';
    next();
});
// for in progess bar
router.beforeEach((to, from, next) => {
    NProgress.start();
    next();
  });
router.beforeEach((to, from, next) => {
    if(to.meta.requiresAuth && !authStore.isAuthenticated){
        next('/login-index')
    }else{
        next()
    }
}) 
router.beforeEach((to, from, next) => {
    if(to.meta.admin && !authStore.user){
        next('/login-index')
    }else{
        next()
    }
}) 
router.afterEach(() => {
NProgress.done();
});
export default router