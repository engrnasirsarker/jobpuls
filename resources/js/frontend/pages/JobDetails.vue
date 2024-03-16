<script setup>
    import Navbar from '@/frontend/components/Navbar.vue'
    import FooterView from '@/frontend/components/FooterView.vue'
    import TopCompany from '@/frontend/components/TopCompany.vue'
    import { ref, onMounted } from 'vue'
    import { useRouter, useRoute } from 'vue-router'
    import {FwbButton, FwbBadge} from 'flowbite-vue'
    const route = useRoute();
    const item = ref({})
    const appliedJob = ref({})
    const form = ref({})
    const getData = async () => {
        const id = route.params.id
        const response = await axios.get('/api/job-post/details/'+id)
        item.value = response.data.job
    }
    onMounted(() => {
        getData()
        appliedCheck()
    })
    const currentUser = window.user
   
    const appliedCheck = async () => {
        const response = await axios.get('/api/applied/jobs')
        appliedJob.value = response.data.filter(job => job.job_post_id === item.value.id)      
    }
    const $router = useRouter();
    import { authStore } from '@/stores/auth';
    const isAuthenticated = ref(authStore.isAuthenticated);
    const authCheck = () => {
      if (!isAuthenticated.value) {
        $router.push('/login-index');
      }
    }
    const submitForm = async () => {
        try {
            const id = route.params.id
            await axios.post('/api/job/apply/'+id, form.value)
            $router.push('/jobs');
            Toast.fire({icon: 'success', title: 'Apply success !'})
        } catch (error) {
            errors.value = error.response.data.errors            
        }
    }
</script>
<template>
    <!-- start navber section -->
    <Navbar/>
     <!-- end navber section -->
   
    <div class="relative font-[sans-serif] before:absolute before:w-full before:h-full before:inset-0 before:bg-black before:opacity-50 before:z-10">
        <!-- <img :src="rows.banner_image" alt="Banner Image" class="absolute inset-0 w-full h-full object-cover" /> -->
        <div class="min-h-[200px] relative z-50 h-full max-w-6xl mx-auto flex flex-col justify-center items-center text-center text-white p-6">
            <h2 class="sm:text-4xl text-2xl font-bold mb-6">{{item.job_title}}</h2>            
        </div> 
    </div>
    <section class="container mx-auto py-20">        
        <div class="grid grid-cols-2 gap-4">
            <div>     
                
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
            </div>
            <div >
                <div class="col-start-2" v-if="appliedJob.length > 0">
                    <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900 dark:text-white">
                        <span class="text-center bg-blue-100 text-blue-800 text-xl font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800"> Already Applied</span> 
                    </h2> 
                </div>
               
                <div class="col-start-2" v-else-if="currentUser.user_type === 'candidate'">
                    <section class="bg-white dark:bg-gray-900">
                    <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
                        <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900 dark:text-white">
                            Apply For this Job
                        </h2>                        
                        <form @submit.prevent="submitForm" class="space-y-2">
                            <div>
                                <label for="cover" class="form-label">Cover Later</label>
                                <textarea name="cover" v-model="form.cover_letter" class="form-input" id="cover" cols="30" rows="6"></textarea>
                            </div>
                            <div>
                                <label for="current" class="form-label">Current Salary</label>
                                <input type="number" id="current" class="form-input" v-model="form.current_salary" placeholder="Enter Current Salary " required>
                            </div>
                            <div>
                                <label for="expected" class="form-label">Expected Salary</label>
                                <input type="number" v-model="form.expected_salary" id="expected" class="form-input" placeholder="Expected Salary" required>
                            </div>
                            <fwb-button color="green" @click="authCheck()">
                                Apply
                            </fwb-button>
                        </form>
                    </div>
                    </section>

                </div>
            </div>
        </div>
    </section>
    <TopCompany/>
    <FooterView/>
    <!-- end footer section -->   
</template>