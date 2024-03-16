<script setup>
    import { ref, onMounted } from 'vue';
    import BreadcrumbComponent from '@/components/BreadcrumbComponent.vue';
    import { FwbButton, FwbCard } from 'flowbite-vue'
  
    const isActive = ref({});

    const fetchInitialStatus = async () => {
        try {
            const response = await axios.get('/api/plugins/status');
            isActive.value = response.data.isActive;
        } catch (error) {
            console.error(error);
        }
    };

    const toggleActive = async (resource, itemId) => {
        try {
            await axios.put(`/api/plugins/${resource}/toggle-active`, {
                itemId: itemId,
                active: !isActive.value[itemId]
            });
            isActive.value[resource] = !isActive.value[resource];
            Toast.fire({
                icon: 'success',
                title: 'success'
            })
            window.location.reload();
        } catch (error) {
            console.error(error);
        }
    };

    const getButtonColor = (resource) => {
        return isActive.value[resource] ? 'red' : 'purple';
    };
  
    const getButtonLabel = (resource) => {
        return isActive.value[resource] ? 'Deactivate' : 'Activate';
    };

    onMounted(()=>{
        fetchInitialStatus();
    });  
        
</script>
<template>    
    <BreadcrumbComponent :currentPage="'Plugins'"/> 
    <div class="col-span-full xl:col-span-8 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700 mx-3 mb-4">
        <header class="px-5 py-3 border-b border-slate-300 dark:border-slate-700">
        <div class="flex justify-between">
            <div>
              <h2 class="text-lg">Plugins</h2>
            </div>            
        </div>
      </header>
        <div class="p-3">    
            
            <div class="grid grid-cols-3 gap-3">
                <div>
                    <fwb-card  variant="image">
                        <div class="p-5">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            Emplpoyee
                            </h5>
                            <div class="text-right">
                                <fwb-button size="xs" :color="getButtonColor('employee')" @click="toggleActive('employee', 1)">
                                    {{ getButtonLabel('employee') }}
                                </fwb-button>
                               
                            </div>
                        </div>
                    </fwb-card> 
                </div>
                <div>
                    <fwb-card  variant="image">
                        <div class="p-5">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            Blogs
                            </h5>
                            <div class="text-right">
                                <fwb-button size="xs" :color="getButtonColor('blogs')" @click="toggleActive('blogs', 2)">
                                    {{ getButtonLabel('blogs') }}
                                </fwb-button>
                            </div>
                        </div>
                    </fwb-card> 
                </div>
                <div>
                    <fwb-card  variant="image">
                        <div class="p-5">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            Pages
                            </h5>
                            <div class="text-right">
                                
                                <fwb-button size="xs" :color="getButtonColor('pages')" @click="toggleActive('pages', 3)">
                                    {{ getButtonLabel('pages') }}
                                </fwb-button>
                            </div>
                        </div>
                    </fwb-card> 
                </div>
            </div>     
        </div>    
    </div> 
</template>