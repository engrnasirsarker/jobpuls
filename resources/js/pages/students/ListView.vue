<script setup>
    import { ref, onMounted } from 'vue';
    import { FwbButton } from 'flowbite-vue'
    import BreadcrumbComponent from '@/components/BreadcrumbComponent.vue';
    const rows = ref([]);
    const columns = ref([
        { label: 'Name',field: 'name', type: 'string' },
        { label: 'ID No',field: 'id_no', type: 'string' },
        { label: 'Roll No',field: 'role', type: 'string' },
        { label: 'Session',field: 'session', type: 'string' },
        { label: 'Class',field: 'Class', type: 'string' },
        { label: 'Photo',field: 'image', type: 'string' },
        { label: 'Raw Pass',field: 'raw_pass', type: 'string' },
        { label: 'Action',field: 'action', type: 'string' },

    ])

    const fetchData = async()=>{
        try {
            const response = await axios.get('/api/student');
            rows.value = response.data.rows    
        } catch (error) {
            console.log(error)
        } 
        
    }

    onMounted(() => {
        fetchData()
    })
</script>
<template>
    <BreadcrumbComponent :currentPage="'Student List'"/>
    <div class="col-span-full xl:col-span-8 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700 mx-3 mb-4">
        <header class="px-5 py-3 border-b border-slate-300 dark:border-slate-700">
            <div class="flex justify-between">
                <div>
                    <h2 class="text-lg">All Student</h2>
                </div>
                <div>                
                    <router-link to="/admin/student-create">
                        <fwb-button color="green" class="me-1" size="sm" >
                            <i class="lni lni-circle-plus"></i> Add New
                        </fwb-button>
                    </router-link> 
                </div>
            </div>
        </header>
        <div class="p-3">
             <!-- Table -->
            <div class="overflow-x-auto">
                <vue-good-table
                    :columns="columns"
                    :rows="rows"
                    :pagination-options="{
                        enabled: true,
                        mode: 'records',
                        nextLabel: 'next',
                        prevLabel: 'prev',
                    }"
                    :search-options="{
                        enabled: true
                    }"
                    :theme="isDark.value ? 'nocturnal' : ''"
                >
                <template #table-row="props">
                    <span v-if="props.column.field == 'action'">
                                                                    
                        <fwb-button color="green" class="me-1" size="sm" >
                            <i class="lni lni-pencil"></i>
                        </fwb-button>
                                                                    
                        <fwb-button color="red" size="sm" 
                            @click="deleteItem(props.row.id)">
                            <i class="lni lni-trash-can"></i>
                        </fwb-button>
                        
                    </span>
                    <span v-else-if="props.column.field == 'id'">
                        {{ props.index + 1 }}
                    </span>
                </template>
                </vue-good-table>                     
            </div>      
        </div>
    </div>
</template>