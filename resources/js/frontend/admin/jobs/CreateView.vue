<script setup>
import VueMultiselect from 'vue-multiselect'
import BreadcrumbComponent from '@/components/BreadcrumbComponent.vue'
import Card from '@/frontend/components/Card.vue'
import { ref } from 'vue'
import { useRouter } from 'vue-router'
const $router = useRouter();
const form = ref({
    job_category:'',
    job_type:'',
    skills: []
})

const value = ref([])
const createItem = async () => {    
    await axios.post('/api/job-post', form.value)
    Toast.fire({icon: 'success', title: 'Insert success !'});
    $router.push('/front/admin/job-posts');
}

</script>
<template>
    <BreadcrumbComponent :currentPage="'Jobs'" />    
    <Card>
        <template #header>
            <div class="flex justify-between">
                <div>
                <h2 class="text-lg">Post New job</h2>
                </div>
                <div>
                    <router-link to="/front/admin/job-posts" class="btn btn-green">
                        <i class="lni lni-list"></i> Job List
                    </router-link>
                    
                </div>
            </div>
        </template>
        <template #body>
            <form @submit.prevent="createItem">
            <div class="md:flex md:items-center mb-2">
                <div class="md:w-1/6 text-end">
                    <label class="form-label px-2" for="title">
                        Title 
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input class="form-input"  id="title" v-model="form.job_title" type="text" placeholder="Enter title ">
                </div>
            </div>     
            <div class="md:flex md:items-center mb-2">
                <div class="md:w-1/6 text-end">
                    <label class="form-label px-2" for="address">
                        Address 
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input class="form-input"  id="address" v-model="form.job_location" type="text" placeholder="Enter Address ">
                </div>
            </div>     
            <div class="md:flex md:items-center mb-2">
                <div class="md:w-1/6 text-end">
                    <label class="form-label px-2" for="description">
                        Description 
                    </label>
                </div>
                <div class="md:w-2/3">
                    <textarea name="description" 
                        id="description" v-model="form.job_description"
                        class="form-input"
                        cols="30" rows="6">

                    </textarea>
                   
                </div>
            </div>     
            <div class="md:flex md:items-center mb-2">
                <div class="md:w-1/6 text-end">
                    <label class="form-label px-2" for="category">
                        Category 
                    </label>
                </div>
                <div class="md:w-2/3">                   
                   <select name="category" id="category" class="form-input" v-model="form.job_category">
                       <option selected value="" >--Select--</option>
                       <option value="Marketing" >Marketing</option>
                       <option value="Project Management" >Project Management</option>
                       <option value="Business Management" >Business Management</option>
                       <option value="Education" >Education</option>
                       <option value="Programming & IT" >Programming & IT</option>

                   </select>
                </div>
            </div>  
            
            <div class="md:flex md:items-center mb-2">
                <div class="md:w-1/6 text-end">
                    <label class="form-label px-2" for="category">
                        Skill 
                    </label>
                </div>
                <div class="md:w-2/3">  
                    <VueMultiselect    
                        v-model="form.skills"              
                        :options="['php','vuejs','laravel','reactjs']"
                        :multiple="true"
                        :close-on-select="true"
                        placeholder="--select--"
                        />

                </div>
            </div>  
            
            <div class="md:flex md:items-center mb-2">
                <div class="md:w-1/6 text-end">
                    <label class="form-label px-2" for="job_type">
                        Job Type 
                    </label>
                </div>
                <div class="md:w-2/3">                   
                   <select name="category" id="category" class="form-input" v-model="form.job_type">
                       <option selected value="" >--Select--</option>
                       <option value="On Site" >On Site</option>
                       <option value="Remote" >Remote</option>
                   </select>
                </div>
            </div>  
            
            <div class="md:flex md:items-center mb-2">
                <div class="md:w-1/6 text-end">
                    <label class="form-label px-2" for="experience">
                        Expereance 
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input class="form-input"  id="experience" v-model="form.job_experience" type="text" placeholder="Enter Expereance ">
                </div>
            </div>     
            <div class="md:flex md:items-center mb-2">
                <div class="md:w-1/6 text-end">
                    <label class="form-label px-2" for="salary">
                        Salary 
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input class="form-input"  id="salary" v-model="form.job_salary" type="text" placeholder="Enter Salary ">
                </div>
            </div>     
            <div class="md:flex md:items-center mb-2">
                <div class="md:w-1/6 text-end">
                    <label class="form-label px-2" for="deadline">
                        Deadline 
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input class="form-input"  id="deadline" v-model="form.job_deadline" type="date" placeholder="Enter Deadline ">
                </div>
            </div>  
              
            <div class="md:flex md:items-center mb-2">
                <div class="md:w-1/6 text-end">
                    <label class="form-label px-2"></label>
                </div>
                <div class="md:w-2/3">
                    <button class="btn btn-green">
                        <i class="fa fa-save"></i> Submit
                    </button>
                </div>
            </div>     
            </form>
        </template>
    </Card>    
</template>
<style src="vue-multiselect/dist/vue-multiselect.css"></style>
