<script setup>
import { FwbButton } from 'flowbite-vue'
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
                         
            <router-link to="/employer-login" class="font-medium text-primary-600 hover:underline dark:text-primary-500">
                <fwb-button outline size="xl" class="w-full mb-2">
                Login as employer
                </fwb-button>
            </router-link>

            <router-link to="/candidate-login" class="font-medium text-primary-600 hover:underline dark:text-primary-500">
                <fwb-button outline size="xl" class="w-full">
                Login as candidate
                </fwb-button>
            </router-link>            
            
          </div>
      </div>
  </div>
</section>
</template>