<script setup>
import { FwbButton } from 'flowbite-vue';
const currentUser = window.user
</script>
<template>
    <div class="px-8 sticky top-0">
        <div class="h-16 w-full flex items-center">
            <router-link to="/" class="text-white text-xl font-semibold">
                JobPuls
            </router-link>
        </div>
        <!-- Sidebar menu items -->
        <ul class="mt-4">
            <li class="flex w-full justify-between text-gray-300 cursor-pointer items-center mb-6">
                <router-link to="/front/admin/dashboard" class="flex items-center focus:outline-none focus:ring-2 focus:ring-white">
                    <i class="lni lni-grid-alt"></i>
                    <span class="text-sm ml-2">Dashboard</span>
                </router-link>
            </li>
            <li class="flex w-full justify-between text-gray-400 hover:text-gray-300 cursor-pointer items-center mb-6"  v-if="currentUser?.user_type == 'employer'" >
                <router-link to="/front/admin/job-posts" class="flex items-center focus:outline-none focus:ring-2 focus:ring-white">
                    <i class="fa-brands fa-hire-a-helper"></i>
                    <span class="text-sm ml-2">Jobs Post</span>
                </router-link>
            </li>
           
            <li class="flex w-full justify-between text-gray-400 hover:text-gray-300 cursor-pointer items-center mb-6" v-if="currentUser?.user_type == 'candidate'">
                <router-link to="/front/admin/candidate-applied-jobs"  class="flex items-center focus:outline-none focus:ring-2 focus:ring-white">
                    <i class="fa-brands fa-hire-a-helper"></i>
                    <span class="text-sm ml-2">Applied Job</span>
                </router-link>
            </li>
            
            <li class="flex w-full justify-between text-gray-400 hover:text-gray-300 cursor-pointer items-center mb-6" v-if="currentUser?.user_type == 'candidate'" >
                <router-link to="/front/admin/candidate-profile" class="flex items-center focus:outline-none focus:ring-2 focus:ring-white">
                    <i class="lni lni-user"></i>
                    <span class="text-sm ml-2">Profile</span>
                </router-link>
                
            </li>
            <li class="flex w-full justify-between text-gray-400 hover:text-gray-300 cursor-pointer items-center mb-6" v-if="currentUser?.user_type == 'employer'">
                <router-link to="/front/admin/dashboard" class="flex items-center focus:outline-none focus:ring-2 focus:ring-white">
                    <i class="lni lni-cog"></i>
                    <span class="text-sm ml-2">Blogs</span>
                </router-link>
            </li>
            <li class="flex w-full justify-between text-gray-400 hover:text-gray-300 cursor-pointer items-center mb-6" v-if="currentUser?.user_type == 'employer'">
                <router-link to="/front/admin/dashboard" class="flex items-center focus:outline-none focus:ring-2 focus:ring-white">
                    <i class="lni lni-cog"></i>
                    <span class="text-sm ml-2">Plugins</span>
                </router-link>
            </li>
            <li class="flex w-full justify-between text-gray-400 hover:text-gray-300 cursor-pointer items-center mb-6">
                <router-link to="/front/admin/account" class="flex items-center focus:outline-none focus:ring-2 focus:ring-white">
                    <i class="lni lni-cog"></i>
                    <span class="text-sm ml-2">Account</span>
                </router-link>
            </li>
            
        </ul>
    </div>
</template>