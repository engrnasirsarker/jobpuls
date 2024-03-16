<script setup>
    import { FwbButton } from 'flowbite-vue'
    import Card from '@/components/Card.vue'
    import { ref, onMounted } from 'vue'
    const form = ref({})

    onMounted(() => {
        getData()
    })

    const getData = async () => {
        const res = await axios.get('/api/about')
        form.value = res.data
    }
    const updateItem = async () => {
        await axios.post('/api/about', form.value)   
        Toast.fire({icon: 'success',title: 'Update success !'})  
        getData()       
    }
    function onFileSelected(event){
        let file = event.target.files[0];
        if (file.size > 2024938) {
            Swal.fire({
                position: 'top-center',icon: 
                'warning',title: 'Image size less then 2mb',            
            })
        }else{
            let reader = new FileReader();
            reader.onload = event => {
            form.value.edit_banner_image = event.target.result
            };
            reader.readAsDataURL(file);
        }
    }
</script>
<template>     
   <Card>
    <template #header>
        About Page
    </template>
    <template #body>
        <form @submit.prevent="updateItem">
        <div class="md:flex md:items-center mb-2">
            <div class="md:w-1/6 text-end">
                <label class="form-label px-2" for="title">
                    Page Title <strong class="text-red-600">*</strong>
                </label>
            </div>
            <div class="md:w-2/3">  
                <input type="text" class="form-input" id="title" v-model="form.page_title">
            </div>
        </div> 
        <div class="md:flex md:items-center mb-2">
            <div class="md:w-1/6 text-end">
                <label class="form-label px-2" for="history">
                    Company History 
                </label>
            </div>
            <div class="md:w-2/3">  
                <textarea name="history" id="history"
                class="form-input" cols="30" rows="7" v-model="form.company_history">

                </textarea>
            </div>
        </div> 
        <div class="md:flex md:items-center mb-2">
            <div class="md:w-1/6 text-end">
                <label class="form-label px-2" for="vission">
                    Company Vision 
                </label>
            </div>
            <div class="md:w-2/3">  
                <textarea name="vission" id="vission" 
                class="form-input" cols="30" rows="7" v-model="form.company_vision">

                </textarea>
            </div>
        </div> 
        <div class="md:flex md:items-center mb-2">
            <div class="md:w-1/6 text-end">
                <label class="form-label px-2" >
                    Current Banner
                </label>
            </div>
            <div class="md:w-2/3">  
                <img :src="'/'+form.banner_image" alt="">
            </div>
        </div> 
        <div class="md:flex md:items-center mb-2">
            <div class="md:w-1/6 text-end">
                <label class="form-label px-2" >
                    Banner Image
                </label>
            </div>
            <div class="md:w-2/3">  
                <input type="file" class="form-input" @change="onFileSelected">
            </div>
        </div> 
        <div class="md:flex md:items-center mb-2">
            <div class="md:w-1/6 text-end">
                <label class="form-label px-2">                   
                </label>
            </div>
            <div class="md:w-2/3">  
                <fwb-button color="default">
                    Update
                </fwb-button>
            </div>
        </div> 

        </form>
    </template>
   </Card>
</template>
  
