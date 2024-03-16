<script setup>
    import BreadcrumbComponent from '@/components/BreadcrumbComponent.vue';
    import Card from '@/components/Card.vue'
    import {FwbButton} from 'flowbite-vue'
    import {ref, onMounted} from 'vue'
    const rows = ref({})
    const getData = async () => {
        const res = await axios.get('/api/candidates')
        rows.value = res.data
    }
    onMounted(() => {
        getData()
    })
</script>
<template>   
    <BreadcrumbComponent :currentPage="'Candidate List'"/>
    <Card>
        <template #header>
            All Candidate
        </template>
        <template #body>
            <table class="table-auto w-full table-stripe">
                <!-- Table header -->
                <thead class="text-xs font-semibold uppercase dark:text-slate-500 bg-slate-50 dark:bg-slate-700 dark:bg-opacity-50">
                    <tr>
                    <th class="p-2 whitespace-nowrap">
                        <div class="font-semibold text-left">Candidate Name</div>
                    </th>
                    <th class="p-2 whitespace-nowrap">
                        <div class="font-semibold text-left">Status</div>
                    </th>
                    <th class="p-2 whitespace-nowrap" width="10%">
                        <div class="font-semibold text-center">Edit</div>
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
                            {{item.name}}
                        </td>
                        <td class="p-2 whitespace-nowrap">    
                            <span v-if="item.status == 1">Active</span>
                            <span v-else>InActive</span>
                        </td>
                        <td class="p-2 whitespace-nowrap">    
                            <div class="font-semibold text-center">
                                <fwb-button color="green">
                                   <i class="fa fa-edit"></i> Edit
                                </fwb-button>
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
</template>


