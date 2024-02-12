<template>
  <div>
    
    <!-- Sidebar backdrop (mobile only) -->
    <div class="sidebar-class-mobile" :class="sidebarOpen ? 'opacity-100' : 'opacity-0 pointer-events-none'" aria-hidden="true"></div>

    <!-- Sidebar -->
    <div id="sidebar" ref="sidebar" class="sidebar-class" :class="sidebarOpen ? 'translate-x-0' : '-translate-x-64'">

    
      <!-- Sidebar header -->
      <div class="flex justify-between mb-10 pr-3 sm:px-2">
                
        <!-- Logo -->
        <router-link class="flex" to="/">
          <img src=".././images/icon.png" alt="" width="30" height="30">
            <div class="text-slate-200 font-semibold ml-4 mt-1 lg:hidden lg:sidebar-expanded:block 2xl:block">
            Inventory
          </div>
        </router-link>

        <!-- Close button -->
        <button ref="trigger" class="lg:hidden text-slate-500 hover:text-slate-400" @click.stop="$emit('close-sidebar')" aria-controls="sidebar" :aria-expanded="sidebarOpen">          
          <i class="lni lni-angle-double-left"></i>
        </button>

      </div>
 
      <!-- Links -->
      <div class="space-y-8">
        <!-- Pages group -->
        <div>
          <h3 class="text-xs uppercase text-slate-500 font-semibold pl-3">
            <span class="hidden lg:block lg:sidebar-expanded:hidden 2xl:hidden text-center w-6" aria-hidden="true">•••</span>
            <span class="lg:hidden lg:sidebar-expanded:block 2xl:block">Menus</span>
          </h3>
          <ul class="mt-3">
            <!-- Dashboard -->
                         
              <router-link to="/admin/dashboard" custom v-slot="{ href, navigate, isExactActive }">
              <li class="px-3 py-2 rounded-sm mb-0.5 last:mb-0" :class="isExactActive && 'bg-slate-900'">
                <a class="block text-slate-200 truncate transition duration-150" :class="isExactActive ? 'hover:text-slate-200' : 'hover:text-white'" :href="href" @click="navigate">
                  
                  <div class="grow flex items-center">
                    <i class="lni lni-grid-alt text-2xl"></i>
                    <span class="sidebar-menu">Dashboard</span>
                  </div>                  
                 
                </a>
              </li>
            </router-link>
           
            
            <!-- Academic  -->
            <SidebarLinkGroup v-slot="parentLink" :activeCondition="currentRoute.fullPath.includes('academics')">
              <a class="block text-slate-200 truncate transition duration-150" :class="currentRoute.fullPath.includes('ecommerce') ? 'hover:text-slate-200' : 'hover:text-white'" href="#0" @click.prevent="sidebarExpanded ? parentLink.handleClick() : sidebarExpanded = true">               
                
                <div class="flex items-center justify-between">
                  <div class="flex items-center" >
                    <i @click.prevent="toggleSidebarMini()" class="lni lni-graduation text-2xl"></i>
                    <span class="sidebar-menu">Academics </span>
                  </div>
                  <!-- Icon -->
                  <div class="flex shrink-0 ml-2">                    
                    <AngleIcon :class="parentLink.expanded && 'rotate-180'" />
                  </div>
                </div>
              </a>
              <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                <ul class="pl-9 mt-1" :class="!parentLink.expanded && 'hidden'">
                  <router-link to="/admin/shifts" custom v-slot="{ href, navigate, isExactActive }">
                    <li class="mb-1 last:mb-0">
                      <a class="block transition duration-150 truncate" :class="isExactActive ? 'text-indigo-500' : 'text-slate-400 hover:text-slate-200'" :href="href" @click="navigate">
                        <span class="sidebar-submenu">Shifts</span>
                      </a>
                    </li>
                  </router-link>
                  <router-link to="/admin/sessions" custom v-slot="{ href, navigate, isExactActive }">
                    <li class="mb-1 last:mb-0">
                      <a class="block transition duration-150 truncate" :class="isExactActive ? 'text-indigo-500' : 'text-slate-400 hover:text-slate-200'" :href="href" @click="navigate">
                        <span class="sidebar-submenu">Sessions</span>
                      </a>
                    </li>
                  </router-link>
                  <router-link to="/admin/sections" custom v-slot="{ href, navigate, isExactActive }">
                    <li class="mb-1 last:mb-0">
                      <a class="block transition duration-150 truncate" :class="isExactActive ? 'text-indigo-500' : 'text-slate-400 hover:text-slate-200'" :href="href" @click="navigate">
                        <span class="sidebar-submenu">Sections</span>
                      </a>
                    </li>
                  </router-link>
                  <router-link to="/admin/student-class" custom v-slot="{ href, navigate, isExactActive }">
                    <li class="mb-1 last:mb-0">
                      <a class="block transition duration-150 truncate" :class="isExactActive ? 'text-indigo-500' : 'text-slate-400 hover:text-slate-200'" :href="href" @click="navigate">
                        <span class="sidebar-submenu">Class</span>
                      </a>
                    </li>
                  </router-link>
                  <router-link to="/admin/student-subject" custom v-slot="{ href, navigate, isExactActive }">
                    <li class="mb-1 last:mb-0">
                      <a class="block transition duration-150 truncate" :class="isExactActive ? 'text-indigo-500' : 'text-slate-400 hover:text-slate-200'" :href="href" @click="navigate">
                        <span class="sidebar-submenu">Subject</span>
                      </a>
                    </li>
                  </router-link>
                 
                </ul>
              </div>
            </SidebarLinkGroup>
            <!-- Students  -->
            <SidebarLinkGroup v-slot="parentLink" :activeCondition="currentRoute.fullPath.includes('students')">
              <a class="block text-slate-200 truncate transition duration-150" :class="currentRoute.fullPath.includes('ecommerce') ? 'hover:text-slate-200' : 'hover:text-white'" href="#0" @click.prevent="sidebarExpanded ? parentLink.handleClick() : sidebarExpanded = true">
                <div class="flex items-center justify-between">
                  <div class="flex items-center">
                    <i @click.prevent="toggleSidebarMini()" class="lni lni-users text-2xl"></i>
                    <span class="sidebar-menu">Students Info</span>
                  </div>
                  <!-- Icon -->
                  <div class="flex shrink-0 ml-2">                    
                  <AngleIcon :class="parentLink.expanded && 'rotate-180'" />
                  </div>
                  
                </div>
              </a>
              <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                <ul class="pl-9 mt-1" :class="!parentLink.expanded && 'hidden'">
                  <router-link to="/admin/student-category" custom v-slot="{ href, navigate, isExactActive }">
                    <li class="mb-1 last:mb-0">
                      <a class="block transition duration-150 truncate" :class="isExactActive ? 'text-indigo-500' : 'text-slate-400 hover:text-slate-200'" :href="href" @click="navigate">
                        <span class="sidebar-submenu">Student Category</span>
                      </a>
                    </li>
                  </router-link>
                  <router-link to="/admin/student-group" custom v-slot="{ href, navigate, isExactActive }">
                    <li class="mb-1 last:mb-0">
                      <a class="block transition duration-150 truncate" :class="isExactActive ? 'text-indigo-500' : 'text-slate-400 hover:text-slate-200'" :href="href" @click="navigate">
                        <span class="sidebar-submenu">Student Group</span>
                      </a>
                    </li>
                  </router-link>
                 
                  <router-link to="/admin/student-list" custom v-slot="{ href, navigate, isExactActive }">
                    <li class="mb-1 last:mb-0">
                      <a class="block transition duration-150 truncate" :class="isExactActive ? 'text-indigo-500' : 'text-slate-400 hover:text-slate-200'" :href="href" @click="navigate">
                        <span class="sidebar-submenu">Student List</span>
                      </a>
                    </li>
                  </router-link>
                  <router-link to="/admin/student-create" custom v-slot="{ href, navigate, isExactActive }">
                    <li class="mb-1 last:mb-0">
                      <a class="block transition duration-150 truncate" :class="isExactActive ? 'text-indigo-500' : 'text-slate-400 hover:text-slate-200'" :href="href" @click="navigate">
                        <span class="sidebar-submenu">Student Admission</span>
                      </a>
                    </li>
                  </router-link>
                 
                </ul>
              </div>
            </SidebarLinkGroup>
            <!-- Fees Management  -->
            <SidebarLinkGroup v-slot="parentLink" :activeCondition="currentRoute.fullPath.includes('users')">
              <a class="block text-slate-200 truncate transition duration-150" :class="currentRoute.fullPath.includes('ecommerce') ? 'hover:text-slate-200' : 'hover:text-white'" href="#0" @click.prevent="sidebarExpanded ? parentLink.handleClick() : sidebarExpanded = true">
                <div class="flex items-center justify-between">
                  <div class="flex items-center">
                    <i @click.prevent="toggleSidebarMini()" class="lni lni-coin text-2xl"></i>
                    <span class="sidebar-menu">Fees Managements </span>
                  </div>
                  <!-- Icon -->
                  <div class="flex shrink-0 ml-2">                    
                  <AngleIcon :class="parentLink.expanded && 'rotate-180'" />
                  </div>
                  
                </div>
              </a>
              <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                <ul class="pl-9 mt-1" :class="!parentLink.expanded && 'hidden'">
                  <router-link to="/admin/users" custom v-slot="{ href, navigate, isExactActive }">
                    <li class="mb-1 last:mb-0">
                      <a class="block transition duration-150 truncate" :class="isExactActive ? 'text-indigo-500' : 'text-slate-400 hover:text-slate-200'" :href="href" @click="navigate">
                        <span class="sidebar-submenu">Fees Type</span>
                      </a>
                    </li>
                  </router-link>
                  <router-link to="/admin/roles" custom v-slot="{ href, navigate, isExactActive }">
                    <li class="mb-1 last:mb-0">
                      <a class="block transition duration-150 truncate" :class="isExactActive ? 'text-indigo-500' : 'text-slate-400 hover:text-slate-200'" :href="href" @click="navigate">
                        <span class="sidebar-submenu">Fees Type Amount</span>
                      </a>
                    </li>
                  </router-link>
                  <router-link to="/admin/roles" custom v-slot="{ href, navigate, isExactActive }">
                    <li class="mb-1 last:mb-0">
                      <a class="block transition duration-150 truncate" :class="isExactActive ? 'text-indigo-500' : 'text-slate-400 hover:text-slate-200'" :href="href" @click="navigate">
                        <span class="sidebar-submenu">Fees Discount</span>
                      </a>
                    </li>
                  </router-link>
                 
                  <router-link to="/admin/roles" custom v-slot="{ href, navigate, isExactActive }">
                    <li class="mb-1 last:mb-0">
                      <a class="block transition duration-150 truncate" :class="isExactActive ? 'text-indigo-500' : 'text-slate-400 hover:text-slate-200'" :href="href" @click="navigate">
                        <span class="sidebar-submenu">Collect Fees</span>
                      </a>
                    </li>
                  </router-link>
                 
                </ul>
              </div>
            </SidebarLinkGroup>
            <!-- Users  -->
            <SidebarLinkGroup v-slot="parentLink" :activeCondition="currentRoute.fullPath.includes('users')">
              <a class="block text-slate-200 truncate transition duration-150" :class="currentRoute.fullPath.includes('ecommerce') ? 'hover:text-slate-200' : 'hover:text-white'" href="#0" @click.prevent="sidebarExpanded ? parentLink.handleClick() : sidebarExpanded = true">
                <div class="flex items-center justify-between">
                  <div class="flex items-center">
                    <i @click.prevent="toggleSidebarMini()" class="lni lni-users text-2xl"></i>
                    <span class="sidebar-menu">Users </span>
                  </div>
                  <!-- Icon -->
                  <div class="flex shrink-0 ml-2">                    
                  <AngleIcon :class="parentLink.expanded && 'rotate-180'" />
                  </div>
                  
                </div>
              </a>
              <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                <ul class="pl-9 mt-1" :class="!parentLink.expanded && 'hidden'">
                  <router-link to="/admin/users" custom v-slot="{ href, navigate, isExactActive }">
                    <li class="mb-1 last:mb-0">
                      <a class="block transition duration-150 truncate" :class="isExactActive ? 'text-indigo-500' : 'text-slate-400 hover:text-slate-200'" :href="href" @click="navigate">
                        <span class="sidebar-submenu">User List</span>
                      </a>
                    </li>
                  </router-link>
                  <router-link to="/admin/roles" custom v-slot="{ href, navigate, isExactActive }">
                    <li class="mb-1 last:mb-0">
                      <a class="block transition duration-150 truncate" :class="isExactActive ? 'text-indigo-500' : 'text-slate-400 hover:text-slate-200'" :href="href" @click="navigate">
                        <span class="sidebar-submenu">User Roles</span>
                      </a>
                    </li>
                  </router-link>
                 
                </ul>
              </div>
            </SidebarLinkGroup>
                    
            <!-- Settings  -->
            <SidebarLinkGroup v-slot="parentLink" :activeCondition="currentRoute.fullPath.includes('setting')">
              <a class="block text-slate-200 truncate transition duration-150" :class="currentRoute.fullPath.includes('ecommerce') ? 'hover:text-slate-200' : 'hover:text-white'" href="#0" @click.prevent="sidebarExpanded ? parentLink.handleClick() : sidebarExpanded = true">
                <div class="flex items-center justify-between">
                  <div class="flex items-center">
                    <i class="lni lni-cog text-2xl" @click.prevent="toggleSidebarMini()"></i>
                    <span class="sidebar-menu">Settings </span>
                  </div>
                  <!-- Icon -->
                  <div class="flex shrink-0 ml-2">                    
                  <AngleIcon :class="parentLink.expanded && 'rotate-180'" />
                  </div>
                </div>
              </a>
              <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                <ul class="pl-9 mt-1" :class="!parentLink.expanded && 'hidden'">
                  <router-link to="/" custom v-slot="{ href, navigate, isExactActive }">
                    <li class="mb-1 last:mb-0">
                      <a class="block transition duration-150 truncate" :class="isExactActive ? 'text-indigo-500' : 'text-slate-400 hover:text-slate-200'" :href="href" @click="navigate">
                        <span class="sidebar-submenu">Customers</span>
                      </a>
                    </li>
                  </router-link>
                  <router-link to="/" custom v-slot="{ href, navigate, isExactActive }">
                    <li class="mb-1 last:mb-0">
                      <a class="block transition duration-150 truncate" :class="isExactActive ? 'text-indigo-500' : 'text-slate-400 hover:text-slate-200'" :href="href" @click="navigate">
                        <span class="sidebar-submenu">Orders</span>
                      </a>
                    </li>
                  </router-link>
                 
                </ul>
              </div>
            </SidebarLinkGroup>
            <!-- E-Commerce  -->
            <SidebarLinkGroup v-slot="parentLink" :activeCondition="currentRoute.fullPath.includes('ecommerce')" >
              <a class="block text-slate-200 truncate transition duration-150" :class="currentRoute.fullPath.includes('ecommerce') ? 'hover:text-slate-200' : 'hover:text-white'" href="#0" @click.prevent="sidebarExpanded ? parentLink.handleClick() : sidebarExpanded = true">
                <div class="flex items-center justify-between">
                  <div class="flex items-center">
                    <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                      <path class="fill-current" :class="currentRoute.fullPath.includes('ecommerce') ? 'text-indigo-300' : 'text-slate-400'" d="M13 15l11-7L11.504.136a1 1 0 00-1.019.007L0 7l13 8z" />
                      <path class="fill-current" :class="currentRoute.fullPath.includes('ecommerce') ? 'text-indigo-600' : 'text-slate-700'" d="M13 15L0 7v9c0 .355.189.685.496.864L13 24v-9z" />
                      <path class="fill-current" :class="currentRoute.fullPath.includes('ecommerce') ? 'text-indigo-500' : 'text-slate-600'" d="M13 15.047V24l10.573-7.181A.999.999 0 0024 16V8l-11 7.047z" />
                    </svg>
                    <span class="sidebar-menu">E-Commerce </span>
                  </div>
                  <!-- Icon -->
                  <div class="flex shrink-0 ml-2">                    
                  <AngleIcon :class="parentLink.expanded && 'rotate-180'" />
                  </div>
                </div>
              </a>
              <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                <ul class="pl-9 mt-1" :class="!parentLink.expanded && 'hidden'">
                  <router-link to="/" custom v-slot="{ href, navigate, isExactActive }">
                    <li class="mb-1 last:mb-0">
                      <a class="block transition duration-150 truncate" :class="isExactActive ? 'text-indigo-500' : 'text-slate-400 hover:text-slate-200'" :href="href" @click="navigate">
                        <span class="sidebar-submenu">Customers</span>
                      </a>
                    </li>
                  </router-link>
                  <router-link to="/" custom v-slot="{ href, navigate, isExactActive }">
                    <li class="mb-1 last:mb-0">
                      <a class="block transition duration-150 truncate" :class="isExactActive ? 'text-indigo-500' : 'text-slate-400 hover:text-slate-200'" :href="href" @click="navigate">
                        <span class="sidebar-submenu">Orders</span>
                      </a>
                    </li>
                  </router-link>
                 
                </ul>
              </div>
            </SidebarLinkGroup>
          
           
            <!-- Messages --> 
            <router-link to="/" custom v-slot="{ href, navigate, isExactActive }">
              <li class="px-3 py-2 rounded-sm mb-0.5 last:mb-0" :class="isExactActive && 'bg-slate-900'">
                <a class="block text-slate-200 truncate transition duration-150" :class="isExactActive ? 'hover:text-slate-200' : 'hover:text-white'" :href="href" @click="navigate">
                  <div class="flex items-center justify-between">
                    <div class="grow flex items-center">
                      <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                        <path class="fill-current" :class="isExactActive ? 'text-indigo-500' : 'text-slate-600'" d="M14.5 7c4.695 0 8.5 3.184 8.5 7.111 0 1.597-.638 3.067-1.7 4.253V23l-4.108-2.148a10 10 0 01-2.692.37c-4.695 0-8.5-3.184-8.5-7.11C6 10.183 9.805 7 14.5 7z" />
                        <path class="fill-current" :class="isExactActive ? 'text-indigo-300' : 'text-slate-400'" d="M11 1C5.477 1 1 4.582 1 9c0 1.797.75 3.45 2 4.785V19l4.833-2.416C8.829 16.85 9.892 17 11 17c5.523 0 10-3.582 10-8s-4.477-8-10-8z" />
                      </svg>
                      <span class="sidebar-menu">Messages</span>
                    </div>
                    <!-- Badge -->
                    <div class="flex flex-shrink-0 ml-2">
                      <span class="inline-flex items-center justify-center h-5 text-xs font-medium text-white bg-indigo-500 px-2 rounded">4</span>
                    </div>
                  </div>
                </a>
              </li>
            </router-link>
            
          </ul>
        </div>
        <!-- More group -->       
      </div>    
    </div>
  </div>
</template>

<script setup>
  import { ref } from 'vue'
  import { useRouter, RouterLink } from 'vue-router'
  
  import SidebarLinkGroup from '@/partials/SidebarLinkGroup.vue'
  import AngleIcon from '@/components/AngleIcon.vue';

  import { useSidebarStore } from '@/stores/sidebarStore';
  const { sidebarExpanded, toggleSidebarMini } = useSidebarStore();
    
  
  const props = defineProps(['sidebarOpen'])
 
  const emit = defineEmits(['close-sidebar'])

  const trigger = ref(null)
  const sidebar = ref(null)  
    
  const currentRoute = useRouter().currentRoute.value

    
    
</script>
