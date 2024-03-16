<script setup>
import BreadcrumbComponent from '@/components/BreadcrumbComponent.vue'
import Card from '@/frontend/components/Card.vue'
import EditModal from '@/pages/job/EditModal.vue';
import { FwbBadge, FwbButton } from 'flowbite-vue'
import { ref, onMounted } from 'vue'
const rows = ref({})
const editForm = ref({
    status: '',
});
const errors = ref();
const getData = async () => {
    const response = await axios.get('/api/jobs')
    rows.value = response.data    
}
const editItem = (item) => { 
    editForm.value.status = item.status;
    editForm.value.id = item.id;
}  
const isShowEditModal = ref(false);
onMounted(() => {
    getData()
})
const updateItem = async () => {
    const id = editForm.value.id;
    try {
        await axios.patch(`/api/job/${id}`, editForm.value);
        Toast.fire({ icon: 'success', title: 'Update success !' });
        getData();
        isShowEditModal.value = false
        router.push('/admin/job-list');
    } catch (error) {        
        errors.value = error.response.data.errors;
    }
};
</script>
<template>
    <BreadcrumbComponent :currentPage="'Jobs'" />    
    <Card>
        <template #header>
            <div class="flex justify-between">
                <div>
                <h2 class="text-lg">All Jobs </h2>
                </div>
                <div>
                    <router-link to="/front/admin/create-job-post" class="btn btn-green">
                        <i class="lni lni-circle-plus"></i> Add New
                    </router-link>
                    
                </div>
            </div>
        </template>
        <template #body>
            <table class="table-auto w-full table-stripe">
                <!-- Table header -->
                <thead class="text-xs font-semibold uppercase dark:text-slate-500 bg-slate-50 dark:bg-slate-700 dark:bg-opacity-50">
                    <tr>
                    <th class="p-2 whitespace-nowrap">
                        <div class="font-semibold text-left">Title</div>
                    </th>
                   
                    <th class="p-2 whitespace-nowrap">
                        <div class="font-semibold text-left">Description</div>
                    </th>
                    <th class="p-2 whitespace-nowrap">
                        <div class="font-semibold text-left">Status</div>
                    </th>
                    <th class="p-2 whitespace-nowrap" width="10%">
                        <div class="font-semibold text-center">View</div>
                    </th>
                    <th class="p-2 whitespace-nowrap" width="10%">
                        <div class="font-semibold text-center">Delete</div>
                    </th>
                    </tr>
                </thead>
                <!-- Table body -->
                <tbody class="text-sm divide-y divide-slate-100 dark:divide-slate-700">
                    
                    <tr v-for="item in rows" :key="item.id">
                        <td class="p-2 whitespace-nowrap">
                            {{item.job_title}}
                        </td>
                        <td class="p-2 whitespace-nowrap">    
                            {{ item.job_description?.slice(0, 30) }}
                            {{ item.job_description?.length > 30 ? '...' : '' }}
                        </td>
                        <td class="p-2 whitespace-nowrap"> 
                            <fwb-badge type="green" v-if="item.status == 'Approved'"> Approved</fwb-badge>   
                            <fwb-badge type="red" v-else-if="item.status == 'Rejected'">Rejected</fwb-badge>   
                            <fwb-badge type="yellow" v-else>Pending</fwb-badge>   
                        </td>
                        
                        <td class="p-2 whitespace-nowrap">    
                            <div class="font-semibold text-center">
                                <button @click.prevent="isShowEditModal = true">
                                    <fwb-button color="green" class="me-1" size="sm"  @click.prevent="editItem(item)">
                                        <i class="fa fa-edit"></i> View
                                    </fwb-button>
                                </button>
                            </div>            
                        </td>
                        <td class="p-2 whitespace-nowrap">
                            <div class="font-semibold text-center">                            
                                <fwb-button color="red">
                                   <i class="fa fa-trash"></i> Delete
                                </fwb-button>
                            </div>
                        </td>
                    </tr>
                    
                </tbody>
            </table>
        </template>
    </Card>    
    <EditModal :editForm="editForm" v-if="isShowEditModal" @close="isShowEditModal = false" @save="updateItem" :errors="errors"/>
</template>
