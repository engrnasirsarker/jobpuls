<script setup>
import { ref, onMounted, computed } from 'vue';
  const activeTab = ref('first')
import Navbar from '@/frontend/components/Navbar.vue'
import RecentPublishedJobs from '@/frontend/components/RecentPublishedJobs.vue'
import FooterView from '@/frontend/components/FooterView.vue'
import TabComponent from '@/frontend/components/TabComponent.vue'
import {FwbTab, FwbTabs, FwbHeading, FwbButton} from 'flowbite-vue'
    const searchTerm = ref('');

    const marketings = ref([]);
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
        const response = await axios.get('/api/all/published/jobs', {
            params: { page: currentPage.value }
        });

        // Update marketings
        marketings.value = response.data.marketings.data;

        // Update projectManagements
        projectManagements.value = response.data.projectManagements.data;

        // Update businessManagements
        businessManagements.value = response.data.businessManagements.data;

        // Update educations
        educations.value = response.data.educations.data;

        // Update programming_ITs
        programming_ITs.value = response.data.programming_ITs.data;

        // Update counts
        marketingsCount.value = response.data.marketingsCount;
        projectManagementsCount.value = response.data.projectManagementsCount;
        businessManagementsCount.value = response.data.businessManagementsCount;

        // Update lastPage
        lastPage.value = response.data.last_page;
    } catch (error) {
        console.error('Error fetching data:', error);
    }
}

   

    // Define a generic search function
// Define a generic search function
const search = (data, searchTerm) => {
  if (!searchTerm || !searchTerm.trim()) {
    return data;
  }
  
  return data.filter(item => {
    // Perform search based on job_title or any other field you want
    return item.job_title.toLowerCase().includes(searchTerm.toLowerCase());
  });
};

// Create computed properties for filtered data
const filteredMarketings = computed(() => search(marketings.value, searchTerm.value));
const filteredProjectManagements = computed(() => search(projectManagements.value, searchTerm.value));
const filteredBusinessManagements = computed(() => search(businessManagements.value, searchTerm.value));
const filteredEducations = computed(() => search(educations.value, searchTerm.value));
const filteredProgramming_ITs = computed(() => search(programming_ITs.value, searchTerm.value));


const currentPage = ref(1);
const lastPage = ref(null);

const loadMore = async () => {
    try {        
        currentPage.value++; // Increment current page
        const response = await axios.get('/api/all/published/jobs', {
            params: { page: currentPage.value }
        });

        // Append new data to existing arrays
        marketings.value = [...marketings.value, ...response.data.marketings.data];
        projectManagements.value = [...projectManagements.value, ...response.data.projectManagements.data];
        businessManagements.value = [...businessManagements.value, ...response.data.businessManagements.data];
        educations.value = [...educations.value, ...response.data.educations.data];
        programming_ITs.value = [...programming_ITs.value, ...response.data.programming_ITs.data];
        
    } catch (error) {
        console.error('Error loading more data:', error);
    }
};


</script>
<template>
    <Navbar/>
    <div class="relative font-[sans-serif] before:absolute before:w-full before:h-full before:inset-0 before:bg-black before:opacity-50 before:z-10">
        <img src="https://readymadeui.com/cardImg.webp" alt="Banner Image" class="absolute inset-0 w-full h-full object-cover" />
        <div class="min-h-[200px] relative z-50 h-full max-w-6xl mx-auto flex flex-col justify-center items-center text-center text-white p-6">
            <h2 class="sm:text-4xl text-2xl font-bold mb-6">All Published Jobs</h2>
        </div> 
    </div>
    <section class="container mx-auto py-20">   
    <fwb-tabs v-model="activeTab" variant="underline" class="py-5"> 
      <!-- marketings tab -->
      <fwb-tab name="first" :title="'Marketing (' + marketingsCount + ')'"> 
        <div class=" p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <input type="text" class="form-input" placeholder="Search job here" v-model="searchTerm" @input="search"/>
            <hr class="h-px my-3 bg-gray-200 border-0 dark:bg-gray-700">
            <TabComponent :data="filteredMarketings"/>
        </div>
      </fwb-tab>

      <!--  Project Managements -->
      <fwb-tab name="second" :title="'Project Managements (' + projectManagementsCount + ')'">
        <div class=" p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">    
        <input type="text" class="form-input" placeholder="Search job here" v-model="searchTerm" @input="search"/>
            <hr class="h-px my-3 bg-gray-200 border-0 dark:bg-gray-700">
            <TabComponent :data="filteredProjectManagements"/>           
        </div>
      </fwb-tab>
      <!-- Business Management tab -->
      <fwb-tab name="third" :title="'Business Managements (' + businessManagementsCount + ')'">
        <div class=" p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">              
            <input type="text" class="form-input" placeholder="Search job here" v-model="searchTerm" @input="search"/>
            <hr class="h-px my-3 bg-gray-200 border-0 dark:bg-gray-700">
            <TabComponent :data="filteredBusinessManagements"/>
        </div>
      </fwb-tab>

      <!-- Education tab -->
      <fwb-tab name="fourth" :title="'Educations (' + educations.length + ')'">
        <div class=" p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">              
            <input type="text" class="form-input" placeholder="Search job here" v-model="searchTerm" @input="search"/>
            <hr class="h-px my-3 bg-gray-200 border-0 dark:bg-gray-700">                
            <TabComponent :data="filteredEducations"/>
        </div>
      </fwb-tab>

      <!-- Programming & IT tab -->
      <fwb-tab name="fifth" :title="'Programming & IT (' + programming_ITs.length + ')'">
        <div class=" p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">              
            <input type="text" class="form-input" placeholder="Search job here" v-model="searchTerm" @input="search"/>
            <hr class="h-px my-3 bg-gray-200 border-0 dark:bg-gray-700"> 
            <TabComponent :data="filteredProgramming_ITs"/>
        </div>
      </fwb-tab> 

    </fwb-tabs>

      <div class="text-center">
        <fwb-button outline @click.prevent="loadMore">
          Load More
        </fwb-button>
      </div>
   
  </section>

    <FooterView/>
</template>