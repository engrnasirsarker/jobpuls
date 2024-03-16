<script setup>
  import DashboardCard from '@/partials/dashboard/DashboardCard.vue'
  import BreadcrumbComponent from '@/components/BreadcrumbComponent.vue';
  import { ref, onMounted } from 'vue';
  const activeCompanies = ref(0);
  const jobPost = ref(0);
  const pendingCompanies = ref(0);

  const fetchDashboard = () => {
    axios.get('/api/dashboard/data').then((response) => {
      activeCompanies.value = response.data.totalCompanies;
      jobPost.value = response.data.totalJobPost;

    })
  }

  onMounted(() => {
    fetchDashboard()
  })
</script>
<template>
  <BreadcrumbComponent :currentPage="'Dashboard'"/>
    <!-- Cards -->
  <div class="grid grid-cols-12 gap-6">
    <DashboardCard :title="'Active Companies'" :total_value="activeCompanies"/>
    <DashboardCard :title="'Pending Companies'" :total_value="pendingCompanies"/>
    <DashboardCard :title="'Job Posts'" :total_value="jobPost"/> 
  </div>
</template>
