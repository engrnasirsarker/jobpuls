<template>
    <div class="flex h-screen overflow-hidden sidebar-expanded" id="body">
  
      <!-- Sidebar -->
      <Sidebar :sidebarOpen="sidebarOpen" @close-sidebar="sidebarOpen = false" />
  
      <!-- Content area -->
      <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden">
        
        <!-- Site header -->
        <Header :sidebarOpen="sidebarOpen" @toggle-sidebar="sidebarOpen = !sidebarOpen" />
        <main>
          <div class="px-4 sm:px-6 lg:px-4 py-4 w-full max-w-9xl mx-auto">
            <router-view></router-view>
          </div>
        </main>      
        
        
        <footer class="dark:border-slate-700 bg-white border-t border-slate-200 dark:bg-[#182235] bottom-0 fixed w-full">
              <div class="mx-auto text-center">
                  <p>&copy; 2023 Your Company</p>
              </div>
          </footer>
      </div> 
  
    </div>
  </template>
  
  <script setup>
  import '@/charts/ChartjsConfig';
  import { ref } from 'vue'
  import Sidebar from '@/partials/Sidebar.vue'
  import Header from '@/partials/Header.vue'
  
  const sidebarOpen = ref(false)
  
  </script>
    
    