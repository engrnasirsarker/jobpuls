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
            JobPuls
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
            <!-- componies  -->            
            <router-link to="/admin/company-list" v-if="can('company-manage')" custom v-slot="{ href, navigate, isExactActive }">
              <li class="px-3 py-2 rounded-sm mb-0.5 last:mb-0" :class="isExactActive && 'bg-slate-900'">
                <a class="block text-slate-200 truncate transition duration-150" :class="isExactActive ? 'hover:text-slate-200' : 'hover:text-white'" :href="href" @click="navigate">
                  <div class="flex items-center justify-between">
                    <div class="grow flex items-center">
                      <i class="lni lni-package"></i>
                      <span class="sidebar-menu">Companies</span>
                    </div>
                  
                  </div>
                </a>
              </li>
            </router-link>
            <!-- jobs -->
            <router-link to="/admin/job-list" v-if="can('job-manage')" custom v-slot="{ href, navigate, isExactActive }">
              <li class="px-3 py-2 rounded-sm mb-0.5 last:mb-0" :class="isExactActive && 'bg-slate-900'">
                <a class="block text-slate-200 truncate transition duration-150" :class="isExactActive ? 'hover:text-slate-200' : 'hover:text-white'" :href="href" @click="navigate">
                  <div class="flex items-center justify-between">
                    <div class="grow flex items-center">
                      <i class="lni lni-network"></i>
                      <span class="sidebar-menu">Jobs</span>
                    </div>                   
                  </div>
                </a>
              </li>
            </router-link>
            <!-- employes -->
            <router-link v-if="isActive['employee'] == 1 && can('employee-manage')" to="/admin/candidate-list" custom v-slot="{ href, navigate, isExactActive }">
              <li class="px-3 py-2 rounded-sm mb-0.5 last:mb-0" :class="isExactActive && 'bg-slate-900'">
                <a class="block text-slate-200 truncate transition duration-150" :class="isExactActive ? 'hover:text-slate-200' : 'hover:text-white'" :href="href" @click="navigate">
                  <div class="flex items-center justify-between">
                    <div class="grow flex items-center">
                      <i class="lni lni-consulting"></i>
                      <span class="sidebar-menu">Employes</span>
                    </div>                  
                  </div>
                </a>
              </li>
            </router-link>
            <!-- blog -->
            <router-link v-if="isActive['blogs'] == 1 && can('blog-read')" to="/admin/blog-list" custom v-slot="{ href, navigate, isExactActive }">
              <li class="px-3 py-2 rounded-sm mb-0.5 last:mb-0" :class="isExactActive && 'bg-slate-900'">
                <a class="block text-slate-200 truncate transition duration-150" :class="isExactActive ? 'hover:text-slate-200' : 'hover:text-white'" :href="href" @click="navigate">
                  <div class="flex items-center justify-between">
                    <div class="grow flex items-center">
                      <i class="lni lni-blogger"></i>
                      <span class="sidebar-menu">Blogs</span>
                    </div>
                   
                  </div>
                </a>
              </li>
            </router-link>
            <!-- pages -->
            <SidebarLinkGroup v-if="isActive['pages'] == 1 && can('page-read')" v-slot="parentLink" :activeCondition="currentRoute.fullPath.includes('users')">
              <a class="block text-slate-200 truncate transition duration-150" :class="currentRoute.fullPath.includes('ecommerce') ? 'hover:text-slate-200' : 'hover:text-white'" href="#0" @click.prevent="sidebarExpanded ? parentLink.handleClick() : sidebarExpanded = true">
                <div class="flex items-center justify-between">
                  <div class="flex items-center"> 
                    <i @click.prevent="toggleSidebarMini()" class="lni lni-layout"></i>
                    <span class="sidebar-menu">Pages</span>
                  </div>
                  <!-- Icon -->
                  <div class="flex shrink-0 ml-2">                    
                  <AngleIcon :class="parentLink.expanded && 'rotate-180'" />
                  </div>
                  
                </div>
              </a>
              <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                <ul class="pl-9 mt-1" :class="!parentLink.expanded && 'hidden'">
                  <router-link to="/admin/about" custom v-slot="{ href, navigate, isExactActive }">
                    <li class="mb-1 last:mb-0">
                      <a class="block transition duration-150 truncate" :class="isExactActive ? 'text-indigo-500' : 'text-slate-400 hover:text-slate-200'" :href="href" @click="navigate">
                        <span class="sidebar-submenu">About</span>
                      </a>
                    </li>
                  </router-link>
                  <router-link to="/admin/contact" custom v-slot="{ href, navigate, isExactActive }">
                    <li class="mb-1 last:mb-0">
                      <a class="block transition duration-150 truncate" :class="isExactActive ? 'text-indigo-500' : 'text-slate-400 hover:text-slate-200'" :href="href" @click="navigate">
                        <span class="sidebar-submenu">Contact</span>
                      </a>
                    </li>
                  </router-link>
                 
                </ul>
              </div>
            </SidebarLinkGroup>
            <!-- plugins -->
            <router-link to="/admin/plugins" custom v-slot="{ href, navigate, isExactActive }">
              <li class="px-3 py-2 rounded-sm mb-0.5 last:mb-0" :class="isExactActive && 'bg-slate-900'">
                <a class="block text-slate-200 truncate transition duration-150" :class="isExactActive ? 'hover:text-slate-200' : 'hover:text-white'" :href="href" @click="navigate">
                  <div class="flex items-center justify-between">
                    <div class="grow flex items-center">
                      <i class="lni lni-plug"></i>
                      <span class="sidebar-menu">Plugins </span>
                    </div>
                   
                  </div>
                </a>
              </li>
            </router-link>

            <!-- Users  -->
            <SidebarLinkGroup v-slot="parentLink"  v-if="can('user-read')" :activeCondition="currentRoute.fullPath.includes('users')">
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
            
          </ul>
        </div>
        <!-- More group -->       
      </div>    
    </div>
  </div>
</template>

<script setup>
  import { ref, onMounted } from 'vue'
  import { useRouter, RouterLink } from 'vue-router'
  import SidebarLinkGroup from '@/partials/SidebarLinkGroup.vue'
  import AngleIcon from '@/components/AngleIcon.vue';
  
  import { useSidebarStore } from '@/stores/sidebarStore';
  const { sidebarExpanded, toggleSidebarMini } = useSidebarStore();    
  
  
  onMounted(()=>{
    fetchInitialStatus();
  })

  const props = defineProps(['sidebarOpen'])
  const emit = defineEmits(['close-sidebar'])
  const trigger = ref(null)
  const sidebar = ref(null)      
  const currentRoute = useRouter().currentRoute.value    
    
  const isActive = ref({});

  const fetchInitialStatus = async () => {
      try {
          const response = await axios.get('/api/plugins/status');
          isActive.value = response.data.isActive;
      } catch (error) {
          console.error(error);
      }
  };

</script>
