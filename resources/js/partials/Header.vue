<template>
  <header class="sticky top-0 bg-white dark:bg-[#182235] border-b border-slate-200 dark:border-slate-700 z-30">
    <div class="px-4 sm:px-6 lg:px-4">
      <div class="flex items-center justify-between h-16 -mb-px">
        <!-- Expand / collapse button -->
        <div class=" hidden lg:inline-flex 2xl:hidden justify-end mt-auto">
          <div class="py-2">
            <button class="text-slate-900
                   hover:text-slate-600 bg-slate-400   
                    rounded" @click.prevent="toggleSidebar()">
              <span class="sr-only">Expand / collapse sidebar</span>
              <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <rect x="4" y="5" width="16" height="2" />
                  <rect x="4" y="11" width="16" height="2" />
                  <rect x="4" y="17" width="16" height="2" />
              </svg>
            </button>
          </div>
        </div>
      
        <!-- Header: Left side -->
        <div class="flex">
          <!-- Hamburger button for mobile use-->          
          <button class="text-slate-900 hover:text-slate-600
                bg-slate-400 rounded lg:hidden" 
                @click.stop="$emit('toggle-sidebar', sidebarOpen)" aria-controls="sidebar" :aria-expanded="sidebarOpen">
              <span class="sr-only">Open sidebar</span>
              <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <rect x="4" y="5" width="16" height="2" />
                <rect x="4" y="11" width="16" height="2" />
                <rect x="4" y="17" width="16" height="2" />
              </svg>
          </button>
        </div>    
            
        <!-- Header: Right side -->
        <div class="flex items-center space-x-3">
                    
          <ThemeToggle />
          <!-- Divider -->
          <hr class="w-px h-6 bg-slate-200 dark:bg-slate-700 border-none" />
          <UserMenu align="right" />

        </div>

      </div>
    </div>
  </header>
</template>

<script setup>
import { ref } from 'vue'

import ThemeToggle from '@/components/ThemeToggle.vue'
import UserMenu from '@/components/DropdownProfile.vue'

import { useSidebarStore } from '@/stores/sidebarStore';

// Use the sidebar store
const { toggleSidebar } = useSidebarStore(); 

defineProps(['sidebarOpen'])
const searchModalOpen = ref(false)  
    

</script>



