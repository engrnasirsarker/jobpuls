<script setup>
    import { ref, onMounted } from 'vue';
    import { FwbButton } from 'flowbite-vue'
    import BreadcrumbComponent from '@/components/BreadcrumbComponent.vue';

    const errors = ref({});
    const sessions = ref([]);
    const classes = ref([]);
    const groups = ref([]);
    const form = ref({
        status: 1,
        gender: 'Male',
        religion: 'Islam',
    })
    const getSessions = async () => {
        try {
            const response = await axios.get('/api/session');
            sessions.value = response.data.rows
        } catch (error) {
            console.log(error)
        }
    }
    const getClasses = async () => {
        try {
            const response = await axios.get('/api/student-class');
            classes.value = response.data.rows
        } catch (error) {
            console.log(error)
        }
    }
    const getGroups = async () => {
        try {
            const response = await axios.get('/api/group');
            groups.value = response.data.rows
        } catch (error) {
            console.log(error)
        }
    }
    const submitForm = async () => {
        try {
            await axios.post('/api/student', form.value)
            form.value = {}
            router.push('/admin/student-list')
            Toast.fire({ icon: 'success', title: 'Insert success !' })
        } catch (error) {
            errors.value = error.response.data.errors;
        }
    }
    const onFileSelected = (event) => {
        let file = event.target.files[0];
        if (file.size > 1024938) {
            Swal.fire({
                position: 'top-center',icon: 
                'warning',title: 'Image size less then 1mb',            
            })
        }else{
            let reader = new FileReader();
            reader.onload = event => {
            form.value.image = event.target.result
            };
            reader.readAsDataURL(file);
        }
    }
    onMounted(()=>{
        getClasses()
        getSessions()
        getGroups()
    })
</script>
<template>
    <BreadcrumbComponent :currentPage="'Student List'"/>
    <div class="col-span-full xl:col-span-8 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700 mx-3 mb-4">
        <header class="px-5 py-3 border-b border-slate-300 dark:border-slate-700">
            <div class="flex justify-between">
                <div>
                    <h2 class="text-lg">Add New Student</h2>
                </div>
                <div>                
                    <router-link to="/admin/student-list">
                        <fwb-button color="dark" class="me-1 dark:bg-slate-500 dark:text-slate-900" size="sm" >
                            <i class="lni lni-list"></i> Back
                        </fwb-button>
                    </router-link> 
                </div>
            </div>
        </header>
        <div class="p-3">            
            <form @submit.prevent="submitForm" enctype="multipart/form-data">
            <div class="md:flex md:items-center mb-2">
                <div class="md:w-1/6 text-end">
                    <label class="form-label px-2" for="name">
                      Student  Name <strong class="text-red-600">*</strong>
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input class="form-input"  id="name" type="text" 
                    v-model="form.name"
                    placeholder="Enter student name">                    
                    <span class="text-red-500" v-if="errors.name">
                        {{ errors.name[0] }}
                    </span>                    
                </div>                
            </div>     
            <div class="md:flex md:items-center mb-2">
                <div class="md:w-1/6 text-end">
                    <label class="form-label px-2" for="fname">
                      Father's  Name <strong class="text-red-600">*</strong>
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input class="form-input" id="fname" type="text" 
                    v-model="form.fname"
                    placeholder="Enter Father's name">                    
                    <span class="text-red-500" v-if="errors.fname">
                        {{ errors.fname[0] }}
                    </span>                    
                </div>                
            </div>     
            <div class="md:flex md:items-center mb-2">
                <div class="md:w-1/6 text-end">
                    <label class="form-label px-2" for="mname">
                      Mother's  Name <strong class="text-red-600">*</strong>
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input class="form-input" id="mname" type="text" 
                    v-model="form.mname"
                    placeholder="Enter Mother's name">                    
                    <span class="text-red-500" v-if="errors.mname">
                        {{ errors.mname[0] }}
                    </span>                    
                </div>                
            </div>     
            <div class="md:flex md:items-center mb-2">
                <div class="md:w-1/6 text-end">
                    <label class="form-label px-2" for="mobile">
                      Mobile 
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input class="form-input" id="mobile" type="text" 
                    v-model="form.mobile"
                    placeholder="Enter Mobile name">                    
                    <span class="text-red-500" v-if="errors.mobile">
                        {{ errors.mobile[0] }}
                    </span>                    
                </div>                
            </div>     
            <div class="md:flex md:items-center mb-2">
                <div class="md:w-1/6 text-end">
                    <label class="form-label px-2" for="gender">
                      Gender <strong class="text-red-600">*</strong>
                    </label>
                </div>
                <div class="md:w-2/3">
                    <select name="gender" id="gender" class="form-input" v-model="form.gender">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>         
                    <span class="text-red-500" v-if="errors.gender">
                        {{ errors.gender[0] }}
                    </span>                    
                </div>                
            </div>     
            <div class="md:flex md:items-center mb-2">
                <div class="md:w-1/6 text-end">
                    <label class="form-label px-2" for="religion">
                      Religion <strong class="text-red-600">*</strong>
                    </label>
                </div>
                <div class="md:w-2/3">
                    <select name="religion" id="religion" class="form-input" v-model="form.religion">
                        <option value="Islam">Islam</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Christian">Christian</option>
                        <option value="Other">Other</option>
                    </select>                   
                    <span class="text-red-500" v-if="errors.religion">
                        {{ errors.religion[0] }}
                    </span>                    
                </div>                
            </div>  
            <div class="md:flex md:items-center mb-2">
                <div class="md:w-1/6 text-end">
                    <label class="form-label px-2">
                      Session <strong class="text-red-600">*</strong>
                    </label>
                </div>
                <div class="md:w-2/3">
                    <v-select v-model="form.session_id"
                        placeholder="--Select--"
                        :reduce="data => data.id"
                        :get-option-label="data => `${data.session_name}`"                            
                        :options="sessions">
                    </v-select>                  
                    <span class="text-red-500" v-if="errors.session_id">
                        {{ errors.session_id[0] }}
                    </span>                    
                </div>                
            </div>   
            <div class="md:flex md:items-center mb-2">
                <div class="md:w-1/6 text-end">
                    <label class="form-label px-2">
                      Class <strong class="text-red-600">*</strong>
                    </label>
                </div>
                <div class="md:w-2/3">
                    <v-select v-model="form.class_id"
                        placeholder="--Select--"
                        :reduce="data => data.id"
                        :get-option-label="data => `${data.class_name}`"                            
                        :options="classes">
                    </v-select>                   
                    <span class="text-red-500" v-if="errors.class_id">
                        {{ errors.class_id[0] }}
                    </span>                    
                </div>                
            </div>     
            <div class="md:flex md:items-center mb-2">
                <div class="md:w-1/6 text-end">
                    <label class="form-label px-2">
                      Group <strong class="text-red-600">*</strong>
                    </label>
                </div>
                <div class="md:w-2/3">
                    <v-select v-model="form.group_id"
                        placeholder="--Select--"
                        :reduce="data => data.id"
                        :get-option-label="data => `${data.group_name}`"                            
                        :options="groups">
                    </v-select>                   
                    <span class="text-red-500" v-if="errors.group_id">
                        {{ errors.group_id[0] }}
                    </span>                    
                </div>                
            </div>     
            <div class="md:flex md:items-center mb-2">
                <div class="md:w-1/6 text-end">
                    <label class="form-label px-2" for="dob">
                      Date of Birth   <strong class="text-red-600">*</strong>
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input class="form-input" id="dob" 
                    v-model="form.dob" type="date">                    
                    <span class="text-red-500" v-if="errors.dob">
                        {{ errors.dob[0] }}
                    </span>                    
                </div>                
            </div>     
            <div class="md:flex md:items-center mb-2">
                <div class="md:w-1/6 text-end">
                    <label class="form-label px-2" for="status">
                      Status <strong class="text-red-600">*</strong>
                    </label>
                </div>
                <div class="md:w-2/3">
                    <select name="status" id="status" class="form-input" v-model="form.status">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>               
                    <span class="text-red-500" v-if="errors.status">
                        {{ errors.status[0] }}
                    </span>                    
                </div>                
            </div>     
            <div class="md:flex md:items-center mb-2">
                <div class="md:w-1/6 text-end">
                    <label class="form-label px-2" for="address">
                      Address 
                    </label>
                </div>
                <div class="md:w-2/3">
                    <textarea name="address" class="form-input" id="address" cols="30" rows="2" v-model="form.address" placeholder="Enter address"></textarea>               
                    <span class="text-red-500" v-if="errors.address">
                        {{ errors.address[0] }}
                    </span>                    
                </div>                
            </div>     
            <div class="md:flex md:items-center mb-2">
                <div class="md:w-1/6 text-end">
                    <label class="form-label px-2">
                      Photo
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input class="form-input"
                    @change="onFileSelected" type="file" > 
                </div>                
            </div> 
            <div class="md:flex md:items-center mb-2">
                <div class="md:w-1/6 text-end"></div>
                <div class="md:w-2/3">
                   <fwb-button type="submit">
                       Submit
                   </fwb-button>    
                </div>                
            </div> 
            </form>
        </div>
    </div>
</template>