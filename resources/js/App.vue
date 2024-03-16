<template>
  <component :is="currentLayout">
    <router-view/>      
  </component>
</template> 
 
<script setup>
import {computed} from 'vue'
import {useRoute} from 'vue-router'
import FrontendLayout from '@/frontend/layouts/FrontMaster.vue';
import BackendLayout from '@/layouts/BackendMaster.vue';


const route = useRoute();
const currentLayout = computed(() => {   
    if (route.meta.backend) {
      return BackendLayout;
    } else if(route.meta.frontend) {
      return FrontendLayout;
    }
})
 
</script>

