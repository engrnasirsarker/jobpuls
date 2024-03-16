<script setup>
    import BreadcrumbComponent from '@/frontend/components/BreadcrumbComponent.vue'
    import Card from '@/frontend/components/Card.vue'
    import { FwbBadge, FwbButton } from 'flowbite-vue'
    import { ref, onMounted } from 'vue'
    import { useRouter, useRoute } from 'vue-router'
    const route = useRoute();
    const rows = ref({})
    const job = ref({})
    const errors = ref({})
    const getData = async () => {
        const id = route.params.id
        const response = await axios.get('/api/applied/jobs/'+id)
        job.value = response.data.job       
        rows.value = response.data.appliedJobs       
    }

    onMounted(() => {
        getData()
    })

   
    const reject = async (postId, userId) => {        
       try {
            await axios.post('/api/applied/candidate/response',{
                selectValue:'Rejected',
                jobPostId:postId,
                userId:userId,
            })
            Toast.fire({icon: 'error',title: 'Candiate Rejected !'})
       } catch (error) {
            console.error('Error rejecting candidate:', error)
       }
    }
</script>
<template>
    <BreadcrumbComponent :currentPage="'Jobs'" />    
    <Card>
        <template #header>
           
            <div class="px-4 py-2 sm:px-6">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <h3 class="text-lg leading-6 font-semibold text-gray-900">
                            For Candidate of {{ job.job_title }}
                        </h3>  
                    </div>
                    <div class="text-right">
                        <router-link to="/front/admin/job-posts"
                        class="bg-stone-600 hover:bg-stone-500 text-neutral-100 py-2 px-4 rounded">
                            Back
                        </router-link>                                   
                        
                    </div>
                </div>                                     
            </div>
        </template>
        <template #body>
            <table class="table-auto w-full table-stripe">
                <!-- Table header -->
                <thead class="text-xs font-semibold uppercase dark:text-slate-500 bg-slate-50 dark:bg-slate-700 dark:bg-opacity-50">
                    <tr>
                    <th class="p-2 whitespace-nowrap">
                        <div class="font-semibold text-left">Candidate</div>
                    </th>
                   
                    <th class="p-2 whitespace-nowrap">
                        <div class="font-semibold text-left">Apply Date</div>
                    </th>
                   
                    <th class="p-2 whitespace-nowrap" width="10%">
                        <div class="font-semibold text-center">Actions</div>
                    </th>
                   
                    </tr>
                </thead>
                <!-- Table body -->
                <tbody class="text-sm divide-y divide-slate-100 dark:divide-slate-700">
                    
                    <tr v-for="item in rows" :key="item.id">
                        <td class="p-2 whitespace-nowrap">
                            {{item.user?.name}}
                        </td>
                       
                        <td class="p-2 whitespace-nowrap">
                            {{item.apply_date}}
                        </td>
                       
                        <td class="p-2 whitespace-nowrap"> 
                            <router-link :to="'/front/admin/applied-candidate-profile/'+item.id+'/'+item.user_id" class="bg-blue-600 hover:bg-blue-500 text-neutral-100 py-3 px-4 rounded mr-1">
                            View
                            </router-link>
                          
                            <button @click="reject(item.id, item.user_id)" class="bg-rose-600 hover:bg-rose-500 text-neutral-100 py-2 px-4 rounded">Reject</button>
                            
                        </td>                         
                       
                    </tr>
                    
                </tbody>
            </table>
        </template>
    </Card>    
</template>
