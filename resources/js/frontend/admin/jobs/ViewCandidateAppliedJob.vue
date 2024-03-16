<script setup>
    import { ref, onMounted } from 'vue'
    import { useRouter, useRoute } from 'vue-router'
    import Card from '@/frontend/components/Card.vue'
    const route = useRoute();
    const item = ref({})
    const totalApply = ref(0)
    const getData = async () => {
        const id = route.params.id
        const response = await axios.get('/api/job-post/details/'+id)
        item.value = response.data.job
        totalApply.value = response.data.totalApply
    }
    onMounted(() => {
        getData()
    })
</script>
<template>
    <Card>
        <template #header>
            <div class="flex justify-between">
                <div>
                <h2 class="text-lg">View Applied Job</h2>
                </div>
                <div>
                    <router-link to="/front/admin/candidate-applied-jobs" class="btn btn-green">
                        <i class="lni lni-list"></i> Job List
                    </router-link>
                </div>
            </div>
        </template>
        <template #body>
            <section class="container mx-auto">  
                <h2 class="mt-2 text-lg font-semibold text-gray-900 dark:text-white">Job Title:</h2>
                {{ item.job_title }}     
                <h2 class="mt-2 text-lg font-semibold text-gray-900 dark:text-white">Job Salary:</h2>
                $ {{ item.job_salary }}     
                <h2 class="mb-t text-lg font-semibold text-gray-900 dark:text-white">Deadline:</h2>
                {{ item.job_deadline }}   
                <div class="h-full pr-6">  
                    <h2 class="mt-2 text-lg font-semibold text-gray-900 dark:text-white">Description:</h2>       
                    <p class="mt-3 mb-12 text-lg text-gray-600 dark:text-slate-400">
                        <div v-html="item.job_description"></div>                        
                    </p>
                </div>
            </section>
        </template>
    </Card>    
</template>