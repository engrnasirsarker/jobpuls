<script setup>
import { FwbBreadcrumb, FwbBreadcrumbItem, FwbButton } from 'flowbite-vue';
import DashboardCard from '@/partials/dashboard/DashboardCard.vue'
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
            <DashboardCard :title="'Job Post'" :total_value="'50'"/>
        </div>
        <div>
            <DashboardCard :title="'Employee'" :total_value="'50'"/>
        </div>
        <!-- ... -->
        <div>
            <DashboardCard :title="'Job Posted'" :total_value="'50'"/>
        </div>
    </div>
</template>