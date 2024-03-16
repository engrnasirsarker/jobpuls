<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { FwbInput, FwbCheckbox, FwbButton, FwbA  } from 'flowbite-vue'
const $router = useRouter();
const signupForm = ref({
    type:'candidate'
})
const errors = ref([])
const createItem = async () => { 
    try {
        await axios.post(`/api/signup`, signupForm.value)            
        signupForm.value = { };  
        Toast.fire({icon: 'success',title: 'Insert success !'})  
        $router.push('/candidate-login')
    } catch (error) {            
        errors.value = error.response.data.errors;
    } 
};
</script>
<template>
    <section class="bg-gray-200 dark:bg-gray-900 h-full py-8">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto h-full">
        <router-link to="/" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
            <img class="w-8 h-8 mr-2" src="@/images/icon.png" alt="logo">
            Jobpuls    
        </router-link>
        <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Sign up as candidate
                </h1>
                <form class="space-y-4 md:space-y-6" @submit.prevent="createItem">
                    <div class="grid md:grid-cols-2 md:gap-6">
                        <div class="relative z-0 w-full group">
                            <fwb-input v-model="signupForm.first_name" label="First Name" 
                            placeholder="Enter your first name" size="md" />
                            <span class="text-red-500" v-if="errors.first_name">
                                {{ errors.first_name[0] }}
                            </span>
                        </div>
                        <div class="relative z-0 w-full group">
                            <fwb-input v-model="signupForm.last_name" label="Last Name" 
                            placeholder="Enter your last name" size="md" />
                            <span class="text-red-500" v-if="errors.last_name">
                                {{ errors.last_name[0] }}
                            </span>
                        </div>
                    </div>
                
                    <fwb-input v-model="signupForm.email" label="E-mail" 
                        placeholder="Enter your email" size="md" />
                        <span class="text-red-500" v-if="errors.email">
                            {{ errors.email[0] }}
                        </span>
                
                    <fwb-input v-model="signupForm.password" label="Password" 
                        placeholder="Enter your password" size="md" 
                        type="password"/>
                        <span class="text-red-500" v-if="errors.email">
                            {{ errors.email[0] }}
                        </span>

                    <fwb-input v-model="signupForm.cpassword" label="Confirm Password" 
                        placeholder="Enter your password" size="md" 
                        type="password"/>
                        
                    <div class="flex items-center justify-between">
                        <div class="flex items-start">
                            <fwb-checkbox >
                                <fwb-a href="#">
                                Remember Me
                                </fwb-a>
                            </fwb-checkbox>
                        </div>
                       
                    </div>
                    
                    <fwb-button class="w-full">
                            Sign Up
                    </fwb-button>
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            Do you have account? .
                        <router-link to="/candidate-login" class="font-medium text-primary-600 hover:underline dark:text-primary-500">
                            Login
                        </router-link>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>
</template>