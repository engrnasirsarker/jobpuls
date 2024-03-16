<script setup>
    import { ref, onMounted } from 'vue'
    import { useRouter, useRoute } from 'vue-router'
    import Card from '@/frontend/components/Card.vue'
    import { FwbBreadcrumb, FwbBreadcrumbItem } from 'flowbite-vue'
    const route = useRoute();
    const item = ref({})
    const jobPost = ref({})
   
    const getData = async () => {
        const postId = route.params.postId
        const userId = route.params.userId
        const response = await axios.get('/api/applied/candidate/profile/'+postId+'/'+userId)
        item.value = response.data.user
        jobPost.value = response.data.jobPost
    }
    const select = async () => {
        await axios.post('/api/applied/candidate/response',{
            selectValue:'Selected',
            jobPostId:jobPost.value.id,
            userId:item.value.id,
        })
        Toast.fire({icon: 'success',title: 'Candiate Selected !'})
    }
    const reject = async () => {        
        await axios.post('/api/applied/candidate/response',{
            selectValue:'Rejected',
            jobPostId:jobPost.value.id,
            userId:item.value.id,
        })
        Toast.fire({icon: 'error',title: 'Candiate Rejected !'})
    }
    onMounted(() => {
        getData()
    })
</script>
<template>
    <fwb-breadcrumb>
        <fwb-breadcrumb-item home href="#">
        Home
        </fwb-breadcrumb-item>
        <router-link to="/">
            <fwb-breadcrumb-item href="#">
                Applied Candidate
            </fwb-breadcrumb-item>
        </router-link>
        <fwb-breadcrumb-item>
        Candidate Profile {{ jobPost.id }}
        </fwb-breadcrumb-item>
    </fwb-breadcrumb>

    <div class="bg-gray-100">
        <div class="container mx-auto pb-5">
            <div class="grid grid-cols-4 sm:grid-cols-12 gap-6 px-4">
                <div class="col-span-4 sm:col-span-3">
                    <div class="bg-white shadow rounded-lg p-6">
                        <div class="flex flex-col items-center">
                            <img :src="'/'+item.image" class="w-32 h-32 bg-gray-300 rounded mb-4 shrink-0">

                            <h1 class="text-xl font-bold">{{item.name}}</h1>
                            <p class="text-gray-700">Software Developer</p>
                            <div class="mt-6 flex flex-wrap gap-4 justify-center">
                                
                                <button @click="select" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">Select</button>
                                <button @click="reject" class="bg-rose-600 hover:bg-rose-500 text-neutral-100 py-2 px-4 rounded">Reject</button>
                            </div>
                        </div>
                        <hr class="my-6 border-t border-gray-300">
                        <div class="flex flex-col">
                            <span class="text-gray-700 uppercase font-bold tracking-wider mb-2">Skills</span>
                            <ul>
                                <li class="mb-2">JavaScript</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-span-4 sm:col-span-9">
                    <div class="bg-white overflow-hidden shadow rounded-lg border">
                        <div class="px-4 py-5 sm:px-6">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <h3 class="text-lg leading-6 font-semibold text-gray-900">
                                        Basic Demo Graphic Information 
                                    </h3>  
                                </div>
                                <div class="text-right">
                                    <router-link :to="`/front/admin/applied-jobs/${route.params.postId}`"
                                    class="bg-stone-600 hover:bg-stone-500 text-neutral-100 py-2 px-4 rounded">
                                        Back
                                    </router-link>                                   
                                    
                                </div>
                            </div>                                     
                        </div>
                        <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                            <dl class="sm:divide-y sm:divide-gray-200 px-4">
                                <div class="py-1 sm:py-1 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-2">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Full name
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{item.name}}
                                    </dd>
                                </div>           
                                <div class="py-1 sm:py-1 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-2">
                                    <dt class="text-sm font-medium text-gray-500">
                                       Fathar Name
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{item.fname}}
                                    </dd>
                                </div>           
                                <div class="py-1 sm:py-1 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-2">
                                    <dt class="text-sm font-medium text-gray-500">
                                       Mother Name
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{item.mname}}
                                    </dd>
                                </div>           
                                <div class="py-1 sm:py-1 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-2">
                                    <dt class="text-sm font-medium text-gray-500">
                                       Fathar Name
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{item.fname}}
                                    </dd>
                                </div>           
                                <div class="py-1 sm:py-1 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-2">
                                    <dt class="text-sm font-medium text-gray-500">
                                       Date Of Birth
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{item.dob}}
                                    </dd>
                                </div>           
                                <div class="py-1 sm:py-1 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-2">
                                    <dt class="text-sm font-medium text-gray-500">
                                       Blood Group
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{item.blood_group}}
                                    </dd>
                                </div>           
                                <div class="py-1 sm:py-1 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-2">
                                    <dt class="text-sm font-medium text-gray-500">
                                       NID
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{item.nid}}
                                    </dd>
                                </div>           
                                <div class="py-1 sm:py-1 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-2">
                                    <dt class="text-sm font-medium text-gray-500">
                                       Passport No
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{item.passport_no}}
                                    </dd>
                                </div>           
                                <div class="py-1 sm:py-1 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-2">
                                    <dt class="text-sm font-medium text-gray-500">
                                      Cell No
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{item.cell_no}}
                                    </dd>
                                </div>           
                                <div class="py-1 sm:py-1 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-2">
                                    <dt class="text-sm font-medium text-gray-500">
                                      Emergency Contact No
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{item.emergency_contact_no}}
                                    </dd>
                                </div>           
                                <div class="py-1 sm:py-1 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-2">
                                    <dt class="text-sm font-medium text-gray-500">
                                      E-mail
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{item.email}}
                                    </dd>
                                </div>           
                                <div class="py-1 sm:py-1 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-2">
                                    <dt class="text-sm font-medium text-gray-500">
                                       Whatsapp
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{item.whatsapp}}
                                    </dd>
                                </div>           
                                <div class="py-1 sm:py-1 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-2">
                                    <dt class="text-sm font-medium text-gray-500">
                                       Linkedin
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{item.linkedin}}
                                    </dd>
                                </div>           
                                <div class="py-1 sm:py-1 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-2">
                                    <dt class="text-sm font-medium text-gray-500">
                                       Facebook
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{item.facebook}}
                                    </dd>
                                </div>           
                                <div class="py-1 sm:py-1 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-2">
                                    <dt class="text-sm font-medium text-gray-500">
                                       Github
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{item.github}}
                                    </dd>
                                </div>           
                                <div class="py-1 sm:py-1 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-2">
                                    <dt class="text-sm font-medium text-gray-500">
                                       Dribble
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{item.dribble_link}}
                                    </dd>
                                </div>           
                                <div class="py-1 sm:py-1 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-2">
                                    <dt class="text-sm font-medium text-gray-500">
                                       Portfolio website
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{item.portfolio_link}}
                                    </dd>
                                </div>           
                                
                            </dl>
                        </div>
                        <div class="px-4 py-5 sm:px-6">
                            <h3 class="text-lg leading-6 font-semibold text-gray-900">
                                Education Information 
                            </h3>                                
                            <div v-html="item.education_info"></div>  
                        </div> 

                        <div class="px-4 py-5 sm:px-6">
                            <h3 class="text-lg leading-6 font-semibold text-gray-900">
                                Professional Training Information
                            </h3>                                
                            <div v-html="item.training_info"></div>   
                        </div> 

                        <div class="px-4 py-5 sm:px-6">
                            <h3 class="text-lg leading-6 font-semibold text-gray-900">
                                Experience Information 
                            </h3>                                
                            <div v-html="item.job_experience"></div> 
                        </div> 

                        <div class="px-4 py-5 sm:px-6">
                            <h3 class="text-lg leading-6 font-semibold text-gray-900">
                                Skills
                            </h3>                                
                            <div v-html="item.skills"></div>  
                        </div> 

                    </div>

                    
                </div>
            </div>
        </div>
    </div>
   
</template>