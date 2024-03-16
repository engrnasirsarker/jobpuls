<script setup>
    defineProps(['currentPage'])
    import { 
      FwbBreadcrumb, 
      FwbBreadcrumbItem
    } from 'flowbite-vue'
</script>
<template>
  <fwb-breadcrumb>
    <router-link to="/admin/dashboard">
      <fwb-breadcrumb-item home href="#">
        Home
      </fwb-breadcrumb-item>
    </router-link>
    <fwb-breadcrumb-item >
      {{currentPage}}
    </fwb-breadcrumb-item>
  </fwb-breadcrumb>
</template>