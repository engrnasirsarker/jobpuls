import NProgress from 'nprogress';
import 'nprogress/nprogress.css';
import {createRouter, createWebHistory} from 'vue-router';
export const routes = [    

    /*-------------------
      Frontend Routes
    ---------------------*/
    {
        path: '/',        
        component: () => import('@/frontend/home.vue'),
        meta: { title: 'Home school' },          
    },   

    /*-------------------
      Backend Routes
    ---------------------*/
    {
        path: '/admin',
        redirect: '/admin/dashboard',        
        meta: { backend: true, title: 'Admin' }, 
        children: [
            {
                path: 'dashboard',
                component: () => import('@/pages/Dashboard.vue'),
                meta: { title: 'Dashboard' },
            },
            /* ---- Class Route ---- */
            {
                path: 'student-class',
                component: () => import('@/pages/class/ListView.vue'),
                meta: { title: 'Student Class' },
            },
            /* ---- Shift Route ---- */
            {
                path: 'shifts',
                component: () => import('@/pages/shifts/ListView.vue'),
                meta: { title: 'Student Shifts' },
            },
            /* ---- Sections Route ---- */
            {
                path: 'sections',
                component: () => import('@/pages/sections/ListView.vue'),
                meta: { title: 'Student Sections' },
            },
            /* ---- Session Route ---- */
            {
                path: 'sessions',
                component: () => import('@/pages/sessions/ListView.vue'),
                meta: { title: 'Student Sessions' },
            },
            /* ---- Subject Route ---- */
            {
                path: 'student-subject',
                component: () => import('@/pages/subject/ListView.vue'),
                meta: { title: 'Student Subject' },
            },

            /* ---- Student Category Route ---- */
            {
                path: 'student-category',
                component: () => import('@/pages/students/category/ListView.vue'),
                meta: { title: 'Student Category' },
            },
            
            /* ---- Student Group Route ---- */
            {
                path: 'student-group',
                component: () => import('@/pages/students/group/ListView.vue'),
                meta: { title: 'Student Group' },
            },

            /* ---- Student Route ---- */
            {
                path: 'student-list',
                component: () => import('@/pages/students/ListView.vue'),
                meta: { title: 'Student List' },
            },
            {
                path: 'student-create',
                component: () => import('@/pages/students/CreateView.vue'),
                meta: { title: 'Student Create' },
            },
            {
                path: 'student-edit/:id',
                component: () => import('@/pages/students/EditView.vue'),
                meta: { title: 'Student Edit' },
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
    document.title = to.meta.title || 'Home';
    next();
});
// for in progess bar
router.beforeEach((to, from, next) => {
    NProgress.start();
    next();
  });
  
router.afterEach(() => {
NProgress.done();
});
export default router