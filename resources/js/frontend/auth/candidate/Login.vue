<script setup>
import { ref } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import { FwbInput, FwbCheckbox, FwbButton, FwbA } from 'flowbite-vue'
const $router = useRouter();

const loginForm = ref({})
const errors = ref([])
const login = async () => { 
    try {        
        await axios.post(`/candidate/login`, loginForm.value); 
        $router.push('/front/admin/dashboard'); // Change URL to /admin/dashboard
        // Reload the page after navigation is complete        
        $router.afterEach((to) => {
            if (to.path === '/front/admin/dashboard') {
                window.location.reload();
            }
        });        
        localStorage.setItem('isAuthenticated', 'true');
        authStore.isAuthenticated = true;
        Toast.fire({icon: 'success', title: 'Login success !'});        
        
    } catch (error) {            
        errors.value = error.response.data.errors;
    } 
};
</script>
<template>
    <section class="bg-gray-200 dark:bg-gray-900">
  <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      <router-link to="/" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
          <img class="w-8 h-8 mr-2" src="@/images/icon.png" alt="logo">
          Jobpuls    
      </router-link>
      <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
              <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                  Sign in as candidate
              </h1>
              <form class="space-y-4 md:space-y-6" @submit.prevent="login">
                  <div>
                    <fwb-input v-model="loginForm.email" label="E-mail" placeholder="Enter your email" size="md" />
                      <span class="text-red-500" v-if="errors.email">
                        {{ errors.email[0] }}
                      </span>
                  </div>
                  <div>
                    <fwb-input v-model="loginForm.password" label="Password" placeholder="Enter your password" size="md" type="password"/>
                      <span class="text-red-500" v-if="errors.password">
                        {{ errors.password[0] }}
                      </span>
                  </div>
                  
                  <div class="flex items-center justify-between">
                      <div class="flex items-start">
                        <fwb-checkbox>
                            <fwb-a href="#">
                            Remember Me
                            </fwb-a>
                        </fwb-checkbox>
                      </div>
                      <router-link to="/forget-password" class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">
                        Forgot password?
                      </router-link>
                    </div>
                 
                  <fwb-button class="w-full">
                    Sign in
                  </fwb-button>
                  <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                      Don’t have an account yet? 
                    <router-link to="/candidate-signup" class="font-medium text-primary-600 hover:underline dark:text-primary-500">
                        Sign up
                    </router-link>
                  </p>
              </form>
          </div>
      </div>
  </div>
</section>
</template>