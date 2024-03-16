<script setup>
import { ref } from 'vue'
import {   
    FwbButton, 
    FwbNavbar,
    FwbNavbarCollapse,
    FwbNavbarLink,
    FwbNavbarLogo,
    FwbDropdown,
    FwbListGroup, 
    FwbListGroupItem
} from 'flowbite-vue'
import { authStore } from '@/stores/auth';
const isAuthenticated = ref(authStore.isAuthenticated);
const currentUser = window.user

</script> 
<template>
   <fwb-navbar>
    <template #logo>
      <router-link to="/">
        <fwb-navbar-logo alt="Jobpuls logo" image-url="/images/icon.png">
          JobPuls
        </fwb-navbar-logo>
      </router-link>

    </template>
    <template #default="{isShowMenu}">
      <fwb-navbar-collapse :is-show-menu="isShowMenu">
        <router-link to="/">
          <fwb-navbar-link is-active link="#">
            Home
          </fwb-navbar-link>
        </router-link>     

        <router-link to="/about-us">        
          <fwb-navbar-link link="#">
            About
          </fwb-navbar-link>
        </router-link>
        <router-link to="/jobs">        
          <fwb-navbar-link link="#">
            Jobs
          </fwb-navbar-link>
        </router-link>

        <router-link to="/blogs">        
          <fwb-navbar-link link="#">
            Blog
          </fwb-navbar-link>
        </router-link>
        <router-link to="/contact-us">        
          <fwb-navbar-link link="#">
            Contact
          </fwb-navbar-link>
        </router-link>
      </fwb-navbar-collapse>
    </template>
    <template #right-side>
      <router-link to="/login-index" v-if="!isAuthenticated">
        <fwb-button class="me-2">
          Login
        </fwb-button> 
      </router-link>
      
      <fwb-dropdown :text="currentUser?.name" v-if="isAuthenticated">
        <fwb-list-group>
          <fwb-list-group-item>
            <router-link to="/front/admin/dashboard">
              Profile
            </router-link>
          </fwb-list-group-item>
        </fwb-list-group>
      </fwb-dropdown>

      <router-link to="/signup-index" v-if="!isAuthenticated">
        <fwb-button>
          Sign Up
        </fwb-button>
      </router-link>
    </template>
  </fwb-navbar> 
</template>