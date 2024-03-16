import { reactive } from 'vue'
const userAuthenticated = window.user?.user_type === 'user';
const authStore = reactive({
    isAuthenticated: window.requiresAuth == true,    
    isAuthenticated2: localStorage.getItem('isAuthenticated') === 'true',
    user: userAuthenticated 
});
export { authStore }


// auth.js
// import { reactive } from 'vue';

// const authStore = reactive({
//   isAuthenticated: localStorage.getItem('isAuthenticated') === 'true',
// });

// export {authStore};
