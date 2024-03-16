<script setup>
import { FwbBreadcrumb, FwbBreadcrumbItem } from 'flowbite-vue';
import DashboardCard from '@/partials/dashboard/DashboardCard.vue'
import { onMounted, ref } from 'vue';
const total = ref(0)
const currentUser = window.user
const fetchDashboard = async() => {
    const response =  await axios.get('/api/front/dashboard/data')
    total.value = response.data
}
onMounted(() => {
    fetchDashboard()
})
</script>
<template> 
    <fwb-breadcrumb>
        <fwb-breadcrumb-item home href="#">
            Home
        </fwb-breadcrumb-item>                    
        <fwb-breadcrumb-item>
            Dashboard 
        </fwb-breadcrumb-item>
    </fwb-breadcrumb>
    <div class="grid grid-cols-3 gap-3">
        <div>
            <DashboardCard :title="'Job Applyed'" v-if="currentUser?.user_type == 'candidate'" :total_value="total"/>
            <DashboardCard :title="'Job Post'" v-if="currentUser?.user_type == 'employer'" :total_value="total"/>
        </div>
        <div v-if="currentUser?.user_type == 'employer'" >
            <DashboardCard :title="'Employee'" :total_value="total"/>
        </div>
        <!-- ... -->
        <div>
            <DashboardCard :title="'Job Saved'" v-if="currentUser?.user_type == 'candidate'"  :total_value="total"/>
            <DashboardCard :title="'Job Posted'" v-if="currentUser?.user_type == 'employer'"  :total_value="total"/>
        </div>
    </div>
</template>