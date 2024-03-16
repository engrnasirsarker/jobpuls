<script setup>
import BreadcrumbComponent from '@/components/BreadcrumbComponent.vue'
import Card from '@/frontend/components/Card.vue'
import { FwbBadge, FwbButton } from 'flowbite-vue'
import { ref, onMounted } from 'vue'
const rows = ref({})
const errors = ref({})
const getData = async () => {
    const response = await axios.get('/api/job-post')
    rows.value = response.data    
}

onMounted(() => {
    getData()
})

    const deleteItem = (id)=>{
        Swal.fire({
        title: 'Are you sure?',
        text: "You want to delete this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                axios.delete('/api/job-post/'+id)
                .then(getData())
                .catch(error => errors.value = error.response.data.errors);
                Swal.fire('Deleted!','Your file has been deleted.','success')            
            }
        })
    }
</script>
<template>
    <BreadcrumbComponent :currentPage="'Jobs'" />    
    <Card>
        <template #header>
            <div class="flex justify-between">
                <div>
                <h2 class="text-lg">All Jobs Posting</h2>
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
                    <th class="p-2 whitespace-nowrap" width="5%">
                        <div class="font-semibold text-center">Edit</div>
                    </th>
                    <th class="p-2 whitespace-nowrap" width="5%">
                        <div class="font-semibold text-center">View</div>
                    </th>
                    <th class="p-2 whitespace-nowrap" width="5%">
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
                            {{
                                item.job_description ? 
                                (item.job_description.replace(/<\/?[^>]+(>|$)/g, '').slice(0, 30) + (item.job_description.length > 30 ? '...' : '')) : 
                                ''
                            }}
                        </td>
                        <td class="p-2 whitespace-nowrap"> 
                            <fwb-badge type="green" v-if="item.status == 'Approved'"> Approved</fwb-badge>   
                            <fwb-badge type="red" v-else-if="item.status == 'Rejected'">Rejected</fwb-badge>   
                            <fwb-badge type="yellow" v-else>Pending</fwb-badge>   
                        </td>
                        
                        <td class="p-2 whitespace-nowrap">    
                            <div class="font-semibold text-center">
                                <router-link :to="`/front/admin/edit-job-post/${item.id}`">
                                    <fwb-button color="green">
                                        <i class="fa fa-edit"></i>
                                    </fwb-button>
                                </router-link>
                            </div>            
                        </td>
                        <td class="p-2 whitespace-nowrap">    
                            <div class="font-semibold text-center">
                                <router-link :to="`/front/admin/view-job-post/${item.id}`">
                                    <fwb-button color="green">
                                        <i class="fa fa-eye"></i>
                                    </fwb-button>
                                </router-link>
                            </div>            
                        </td>
                        <td class="p-2 whitespace-nowrap">
                            <div class="font-semibold text-center">                            
                                <fwb-button color="red"
                                @click="deleteItem(item.id)">
                                   <i class="fa fa-trash"></i>
                                </fwb-button>                                
                            </div>
                        </td>
                    </tr>
                    
                </tbody>
            </table>
        </template>
    </Card>    
</template>
