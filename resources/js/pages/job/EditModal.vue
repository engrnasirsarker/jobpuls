<script setup>
    import { defineProps } from 'vue'
    import { FwbButton, FwbModal } from 'flowbite-vue'

   
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
            Change Status
        </div>
      </template>
      <template #body>
        <form class="w-full max-w-lg" method="post" v-on:submit.prevent="submitForm">
            
            <div class="md:flex md:items-center mb-2">
                <div class="md:w-2/6 text-end">
                    <label class="form-label px-2" for="mobile">
                        Status <strong class="text-red-600">*</strong>
                    </label>
                </div>
                <div class="md:w-2/3">  
                    <select id="status" v-model="editForm.status" class="select-class">
                        <option value="">--Select--</option>
                        <option value="Approved">Approved</option>
                        <option value="Rejected">Rejected</option>
                        <option value="Pending">Pending</option>
                    </select>
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
  
