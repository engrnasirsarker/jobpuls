<script setup>
    import { ref, onMounted } from 'vue';
    import BreadcrumbComponent from '@/components/BreadcrumbComponent.vue';
    import CreateModal from './CreateModal.vue';
    import EditModal from './EditModal.vue';
    import { FwbButton } from 'flowbite-vue'
    const isShowEditModal = ref(false);
    const isShowModal = ref(false);

    const rows = ref([]);
    
    const form = ref({});
    const editForm = ref({});
    const errors = ref();

    onMounted(() => {
        fetchData()
    })
    const fetchData = async()=>{
        try {
            const res = await axios.get('/api/section')
            rows.value = res.data.rows
           
        } catch (error) {
            console.log(error)
        }
    }
    
    const columns = [
        {label:"SL",field:"id",width:'10%'},
        {label:"Name",field:"section_name",type:"string"},
        {label:"Action",field:"action",width:'20%'},
    ]
    const createItem = async () => { 
        try {
            await axios.post(`/api/section`, form.value)       
            fetchData();
            form.value = { };  
            isShowModal.value = false
            Toast.fire({icon: 'success',title: 'Insert success !'})         
        } catch (error) {            
            errors.value = error.response.data.errors;
        } 
    };
    const editItem = (item) => { 
        editForm.value.section_name = item.section_name;
        editForm.value.id = item.id;
    }  
    // delete resource from storage 
    const updateItem = async () => {
        const id = editForm.value.id;
        try {
            await axios.patch(`/api/section/${id}`, editForm.value);
            Toast.fire({ icon: 'success', title: 'Update success !' });
            fetchData();
            isShowEditModal.value = false
            router.push('/admin/sections');
        } catch (error) {        
            errors.value = error.response.data.errors;
        }
    };
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
                axios.delete('/api/section/'+id)
                .then(fetchData())
                .catch(error => errors.value = error.response.data.errors);
                Swal.fire('Deleted!','Your file has been deleted.','success')            
            }
        })
    }
        
</script>
<template>    
    <BreadcrumbComponent :currentPage="'Student Section'"/> 
    <div class="col-span-full xl:col-span-8 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700 mx-3 mb-4">
        <header class="px-5 py-3 border-b border-slate-300 dark:border-slate-700">
        <div class="flex justify-between">
            <div>
              <h2 class="text-lg">All Section</h2>
            </div>
            <div>
                <button class="btn btn-green" @click.prevent="isShowModal = true">
                    <i class="lni lni-circle-plus"></i> Add New
                </button>
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
                        <button @click.prevent="isShowEditModal = true">
                            <fwb-button color="green" class="me-1" size="sm"  @click.prevent="editItem(props.row)">
                                <i class="lni lni-pencil"></i>
                            </fwb-button>
                        </button>
                                            
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
    <CreateModal :form="form" v-if="isShowModal" @close="isShowModal = false" @save="createItem" :errors="errors"/>
    <EditModal :editForm="editForm" v-if="isShowEditModal" @close="isShowEditModal = false" @update="updateItem" :errors="errors"/>
</template>
    
    
    