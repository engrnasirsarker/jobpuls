<script setup>

    import { FwbButton, FwbModal } from 'flowbite-vue'
    
    defineProps({  
        form: {
            type: Object,
            required: true
        }, 
        errors: {
            type: Object,
            default: () => ({})
        }
    })
    
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
          Add New Student Group
        </div>
      </template>
      <template #body>
        <form class="w-full max-w-lg" method="post" v-on:submit.prevent="submitForm">
            <div class="md:flex md:items-center mb-2">
                <div class="md:w-2/6 text-end">
                    <label class="form-label px-2" for="name">
                      Group  Name <strong class="text-red-600">*</strong>
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input class="form-input" v-model="form.student_group_name" id="name" type="text" placeholder="Enter Group name">
                    
                    <span class="text-red-500" v-if="errors.student_group_name">
                        {{ errors.student_group_name[0] }}
                    </span>
                    
                </div>
                
            </div>            
           
            <div class="md:flex md:items-center">
                <div class="md:w-1/3"></div>
                <div class="md:w-2/3">
                    <fwb-button color="default">
                       <i class="lni lni-save"></i> Submit
                    </fwb-button>
                </div>
            </div>
            </form>
            
      </template>      
    </fwb-modal>
</template>
  
