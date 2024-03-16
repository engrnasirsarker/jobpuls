<script setup>
  import { ref, onMounted } from 'vue';
  const activeTab = ref('first')
  import {FwbTab, FwbTabs, FwbHeading, FwbButton} from 'flowbite-vue'
  import TabComponent from '@/frontend/components/TabComponent.vue'
  const marketings = ref({});
  const projectManagements = ref({});
  const businessManagements = ref({});
  const educations = ref({});
  const programming_ITs = ref({});
  
  const marketingsCount = ref(0);
  const projectManagementsCount = ref(0);
  const businessManagementsCount = ref(0);

  onMounted(() => {
      getData()
  })
  const getData = async () => {
        try {
          const response = await axios.get('/api/recent/published/jobs');
            marketings.value = response.data.marketings;
            projectManagements.value = response.data.projectManagements;
            businessManagements.value = response.data.businessManagements;
            marketingsCount.value = response.data.marketingsCount;
            projectManagementsCount.value = response.data.projectManagementsCount;
            businessManagementsCount.value = response.data.businessManagementsCount;
            educations.value = response.data.educations;
            programming_ITs.value = response.data.programming_ITs;
        } catch (error) {
            console.error('Error fetching data:', error);
        }
  }
</script> 
<template>
  <section class="container mx-auto py-20">    
    <fwb-heading tag="h2" class="text-center py-2 mb-4">
      Recent Published Jobs
    </fwb-heading>
    <fwb-tabs v-model="activeTab" variant="underline" class="py-5"> 
      <fwb-tab name="first" :title="'Marketing (' + marketingsCount + ')'">
          <TabComponent :data="marketings"/>
      </fwb-tab>

      <fwb-tab name="second" :title="'Project Managements (' + projectManagementsCount + ')'">
          <TabComponent :data="projectManagements"/>
      </fwb-tab>

      <fwb-tab name="third" :title="'Business Managements (' + businessManagementsCount + ')'">
          <TabComponent :data="businessManagements"/>
      </fwb-tab>

      <fwb-tab name="fourth" :title="'Educations (' + educations.length + ')'">
          <TabComponent :data="educations"/>
      </fwb-tab>

      <!-- Programming & IT tab -->
      <fwb-tab name="fifth" :title="'Programming & IT (' + programming_ITs.length + ')'">
        <TabComponent :data="programming_ITs"/>
      </fwb-tab> 

    </fwb-tabs>

   <div class="text-center">
      <router-link to="/jobs">
        <fwb-button outline>Load More</fwb-button>
      </router-link>
   </div>
   
  </section>
</template>