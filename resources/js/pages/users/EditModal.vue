<script setup>
    import { ref, onMounted, defineProps } from 'vue'
    import { FwbButton, FwbModal } from 'flowbite-vue'

    const roles = ref([])
    
    const fetchRoles = async () => {
        const response = await axios.get("/api/roles")
        roles.value = response.data.roles
    }
    onMounted(() => {
        fetchRoles()
    })
    
    defineProps({  
        editForm: {
            type: Object,
            required: true
        }, 
        errors: {
            type: Object,
            default: () => ({})
        }
    })
    
    /* Define emits for updating the form prop 
    and sending the data to the parent component */
    const emits = defineEmits(['save']);
    // Function to submit the form
   
    const submitForm = (form) => {
        try {
            emits('save', form);
        } catch (error) {
            emits('save', null); // Notify the parent component about the unsuccessful submission
            console.error("Error submitting form:", error);
        }
    };

    
</script>
<template>     
    
    <fwb-modal size="2xl">
      <template #header>
        <div class="flex items-center text-lg">
            Edit User
        </div>
      </template>
      <template #body>
        <form class="w-full max-w-lg" method="post" v-on:submit.prevent="submitForm">
            <div class="md:flex md:items-center mb-2">
                <div class="md:w-2/6 text-end">
                    <label class="form-label px-2" for="name">
                        Name <strong class="text-red-600">*</strong>
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input class="form-input" v-model="editForm.name" id="name" type="text" placeholder="Enter user name">
                    <span class="text-red-500" v-if="errors.name">
                        {{ errors.name[0] }}
                    </span>
                </div>
            </div>            
            <div class="md:flex md:items-center mb-2">
                <div class="md:w-2/6 text-end">
                    <label class="form-label px-2" for="mobile">
                        Mobile 
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input class="form-input" v-model="editForm.mobile" id="mobile" type="text" placeholder="Enter Mobile No">
                </div>
            </div>            
            <div class="md:flex md:items-center mb-2">
                <div class="md:w-2/6 text-end">
                    <label class="form-label px-2" for="mobile">
                        Role 
                    </label>
                </div>
                <div class="md:w-2/3">                   
                    <select id="role" class="select-class" v-model="editForm.role_id">
                        <option selected value="" >--Select--</option>
                        <option v-for="role in roles" :key="role.id" :value="role.id">{{ role.name }}</option>
                    </select>
                </div>
            </div>            
            <div class="md:flex md:items-center mb-2">
                <div class="md:w-2/6 text-end">
                    <label class="form-label px-2" for="mobile">
                        Status <strong class="text-red-600">*</strong>
                    </label>
                </div>
                <div class="md:w-2/3">  
                    <select id="status" v-model="editForm.status" class="select-class">
                        <option selected value="Active">Active</option>
                        <option value="InActive">InActive</option>
                    </select>
                </div>
            </div> 
            <div class="md:flex md:items-center mb-2">
                <div class="md:w-2/6 text-end">
                    <label class="form-label px-2" for="email">
                        E-mail <strong class="text-red-600">*</strong>
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input class="form-input" v-model="editForm.email" id="email" type="email" placeholder="Enter user email">
                    <span class="text-red-500" v-if="errors.email">
                        {{ errors.email[0] }}
                    </span>
                </div>
            </div>   
            <div class="md:flex md:items-center mb-2">
                <div class="md:w-2/6 text-end">
                    <label class="form-label px-2" for="password">
                        Password <strong class="text-red-600">*</strong>
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input class="form-input" v-model="editForm.password" id="password" type="password" placeholder="Enter user password">
                </div>
            </div>  
            <div class="md:flex md:items-center mb-2">
                <div class="md:w-2/6 text-end">
                    <label class="form-label px-2" for="cpassword">
                        Confirm Password <strong class="text-red-600">*</strong>
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input class="form-input" v-model="editForm.cpassword" id="cpassword" type="password" placeholder="Enter user password">
                </div>
            </div>            
            <div class="md:flex md:items-center">
                <div class="md:w-1/3"></div>
                <div class="md:w-2/3">
                    <fwb-button color="default">
                       <i class="lni lni-save"></i> Update
                    </fwb-button>
                </div>
            </div>
            </form>
            
      </template>      
    </fwb-modal>
</template>
  
