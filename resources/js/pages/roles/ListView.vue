<script setup>
  import {ref, onMounted} from 'vue';
  import BreadcrumbComponent from '@/components/BreadcrumbComponent.vue'; 
    const rows = ref([]);
    const fetchRoles = async() => {
      try {
        const res = await axios.get('/api/roles');
        rows.value = res.data.roles;
      } catch (error) {
        console.log(error)
      }
    }
    const columns = ref([
      { label: "Sl",field: "id", width:'10%'},
      { label: "Name",field: "name",type: "string"},  
      { label: "Action",field: "action", width:'20%'},  
    ]);
    const errors = ref({});
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
                axios.delete('/api/role/'+id)
                .then(fetchRoles())
                .catch(error => errors.value = error.response.data.errors);
                Swal.fire('Deleted!','Your file has been deleted.','success')            
            }
        })
    }
    onMounted(() => {
      fetchRoles();
    })

    import { useDark } from "@vueuse/core";
      const isDark = useDark({
        selector: 'html',
    });
    import { FwbButton } from 'flowbite-vue'
</script>
<template>
    <BreadcrumbComponent :currentPage="'Roles'"/>    
    <div class="col-span-full xl:col-span-8 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700 mx-3 mb-4">
      <header class="px-5 py-3 border-b border-slate-300 dark:border-slate-700">
        <div class="flex justify-between">
            <div>
              <h2 class="text-lg">All Role</h2>
            </div>
            <div>
              <router-link to="/admin/role-create" class="btn btn-green">
                <i class="lni lni-circle-plus"></i> Add New
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
            :search-options="{
                    enabled: true
                }"
            :pagination-options="{
                enabled: true,
                mode: 'records',
                nextLabel: 'next',
                prevLabel: 'prev',
            }"              
            :theme="isDark ? 'nocturnal' : ''"
            >
            <template #table-row="props">
              <span v-if="props.column.field == 'action'">
                       
                  <router-link :to="`/admin/role-edit/${props.row.id}`">
                    <fwb-button color="green" size="sm" class="me-1">
                      <i class="lni lni-pencil"></i>
                    </fwb-button>
                  </router-link>
                                  
                  <fwb-button color="red" size="sm" 
                      @click="deleteItem(props.row.id)">
                    <i class="lni lni-trash-can"></i>
                  </fwb-button>
              </span>
            </template>
          </vue-good-table>          
          
        </div>
      </div>
    </div>
</template>
