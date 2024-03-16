<script setup>
    import { ref, onMounted } from 'vue';
    import BreadcrumbComponent from '@/components/BreadcrumbComponent.vue';
  
    import { FwbButton } from 'flowbite-vue'
    const isShowEditModal = ref(false);
    const isShowModal = ref(false);

    const rows = ref([]);
    
    const errors = ref();

    onMounted(() => {
        fetchData()
    })
    const fetchData = async()=>{
        try {
            const res = await axios.get('/api/blogs')
            rows.value = res.data           
        } catch (error) {
            console.log(error)
        }
    }
    
    const columns = [
        {label:"SL",field:"id",width:'10%'},
        {label:"Title",field:"title",type:"string"},
        {label:"Body",field:"body",type:"string"},
        {label:"Feature Image",field:"feature_image",type:"string"},
        {label:"Action",field:"action",width:'20%'},
    ]
   
   
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
                axios.delete('/api/blogs/'+id)
                .then(fetchData())
                .catch(error => errors.value = error.response.data.errors);
                Swal.fire('Deleted!','Your file has been deleted.','success')            
            }
        })
    }
        
</script>
<template>    
    <BreadcrumbComponent :currentPage="'Student Subject'"/> 
    <div class="col-span-full xl:col-span-8 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700 mx-3 mb-4">
        <header class="px-5 py-3 border-b border-slate-300 dark:border-slate-700">
        <div class="flex justify-between">
            <div>
              <h2 class="text-lg">All Blogs</h2>
            </div>
            <div>
                
                <router-link to="/admin/blog-create" class="btn btn-green">
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
                       
                        <router-link v-if="can('blog-update')" :to="`/admin/blog-edit/${props.row.id}`">
                            <fwb-button color="green" class="me-1" size="sm">
                                <i class="lni lni-pencil"></i>
                            </fwb-button>
                        </router-link>          
                        <fwb-button v-if="can('blog-delete')" color="red" size="sm" 
                            @click="deleteItem(props.row.id)">
                            <i class="lni lni-trash-can"></i>
                        </fwb-button>
                        
                    </span>
                    <span v-else-if="props.column.field == 'id'">
                        {{ props.index + 1 }}
                    </span>
                    <span v-else-if="props.column.field == 'body'">
                        {{
                            props.row.body ? 
                            (props.row.body.replace(/<\/?[^>]+(>|$)/g, '').slice(0, 30) + (props.row.body.length > 30 ? '...' : '')) : 
                            ''
                        }}
                    </span>
                    <span v-else-if="props.column.field == 'feature_image'">
                        <img :src="'/'+props.row.feature_image" alt="" width="50">
                    </span>
                </template>
                </vue-good-table>
                     
            </div>        
        </div>    
    </div> 
</template>
    
    
    