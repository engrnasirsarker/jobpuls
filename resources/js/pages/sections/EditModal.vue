<script setup>

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
    const emits = defineEmits(['update']);
    // Function to submit the form
   
    const submitForm = (form) => {
        try {
            emits('update', form);
        } catch (error) {            
            console.error("Error submitting form:", error);
        }
    };

    
</script>
<template>     
    
    <fwb-modal size="2xl">
      <template #header>
        <div class="flex items-center text-lg">
            Edit Section
        </div>
      </template>
      <template #body>
        <form class="w-full max-w-lg" method="post" v-on:submit.prevent="submitForm">
            <div class="md:flex md:items-center mb-2">
                <div class="md:w-2/6 text-end">
                    <label class="form-label px-2" for="name">
                      Section  Name <strong class="text-red-600">*</strong>
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input class="form-input" v-model="editForm.section_name" id="name" type="text" placeholder="Enter section name">
                    <span class="text-red-500" v-if="errors.section_name">
                        {{ errors.section_name[0] }}
                    </span>
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
  
