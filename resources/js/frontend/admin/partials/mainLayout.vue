<template>
    <!-- component -->
    <div class="w-full h-dvh flex">
        <!-- Sidebar starts -->
        <div  
            class="w-64 bg-gray-800 shadow md:h-full flex-col justify-between h-screen "
            :class="{ 'hidden': !isSidebarOpen }"
        >
            <!-- Sidebar content -->
            <LeftSidebar></LeftSidebar>
        </div>

        <!-- Right content starts -->
        <div class="flex-grow flex flex-col">
            <!-- Right content header -->
            <div class="h-16 bg-gray-800 text-white flex items-center justify-between px-4 sticky top-0">
                <fwb-button color="dark" @click="toggleSidebar">
                    <i class="lni lni-angle-double-left" v-if="isSidebarOpen"></i>
                <i class="lni lni-angle-double-right" v-else></i>
                </fwb-button>
               <div class="flex items-center justify-between px-4">
                    <h3 class="mr-2">{{currentUser?.name}}</h3>
                    <button @click="logout">
                        <i class="lni lni-exit"></i>
                    </button> 
               </div>
            </div>
            <!-- Right content -->
            <div class="flex-grow bg-gray-100 p-4">
                <!-- Your content goes here -->
                <router-view ></router-view>                
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { FwbButton } from 'flowbite-vue'
import LeftSidebar from '@/frontend/admin/partials/leftSidebar.vue'
import { useRouter } from 'vue-router'
import {authStore} from '@/stores/auth';
    const $router = useRouter();

    const isSidebarOpen = ref(true);
    const currentUser = window.user
    const toggleSidebar = () => {
        isSidebarOpen.value = !isSidebarOpen.value;
    };

    const logout = async () => {
        try {
            await axios.post('/employer/candidate/logout');
            localStorage.removeItem('isAuthenticated');
            authStore.isAuthenticated = false;
            Toast.fire({icon: 'success',title: 'Logout success !'}) 
            $router.push('/');
        } catch (error) {
            console.log(error)
        }
    };
</script>
