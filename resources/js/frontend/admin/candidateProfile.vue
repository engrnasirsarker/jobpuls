<script setup>
    import { FwbInput } from 'flowbite-vue';
    import Card from '@/components/Card.vue'

    import { ref, onMounted } from 'vue';
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    import CKEditor  from '@ckeditor/ckeditor5-vue';
    import CKEditorInspector from '@ckeditor/ckeditor5-inspector';
    import './style.css';
    
    const form = ref({
        gender:'',
        religion:'',
    });
    const ckeditor = CKEditor.component;
    const editor = ClassicEditor;
    const onReady = (editor) => {
        CKEditorInspector.attach(editor);
    };
    
    const onChange = (data) => {
        console.log(data);
    };

    const getData = async () => {
        try {
            const response = await axios.get('/api/candidate/profile')
            form.value = response.data
        } catch (error) {
            console.error('Error fetching data:', error);
        }
    }
    onMounted(() => {
        getData()
    })

    const submitForm = async () => {
        try {
            await axios.post('/api/candidate/profile/update', form.value)
            Toast.fire({icon: 'success', title: 'update success !'});
        } catch (error) {
            console.error('Error fetching data:', error);
        }
        
    }
    function onFileSelected(event){
        let file = event.target.files[0];
        if (file.size > 2024938) {
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
</script>

<template>    
    <Card>
        <template #header>
            Profile Page
        </template>
        <template #body>    
            <form action="" @submit.prevent="submitForm">
            <div class="flex flex-wrap -mx-3 mb-1">
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mt-2" for="title">
                         Name <strong class="text-red-600">*</strong>
                    </label>
                    <input type="text" v-model="form.name" class="form-input2" id="title">
                </div>
                <div class="w-full md:w-1/3 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mt-2" for="fname">
                        Fathers Name <strong class="text-red-600">*</strong>
                    </label>
                    <input type="text" v-model="form.fname" class="form-input2" id="fname">
                </div>
                <div class="w-full md:w-1/3 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mt-2" for="mname">
                        Mothers Name <strong class="text-red-600">*</strong>
                    </label>
                    <input type="text" v-model="form.mname" class="form-input2" id="mname">
                </div>
                
            </div>
            <div class="flex flex-wrap -mx-3 mb-1">
                <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mt-2" for="dob">
                         Date Of Birth <strong class="text-red-600">*</strong>
                    </label>
                    <input type="text" v-model="form.dob" class="form-input2" id="dob">
                </div>
                <div class="w-full md:w-1/4 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mt-2" for="nid">
                        NID
                    </label>
                    <input type="text" v-model="form.nid" class="form-input2" id="nid">
                </div>
                <div class="w-full md:w-1/4 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mt-2" for="blood">
                        Blood Group <strong class="text-red-600">*</strong>
                    </label>
                    <input type="text" v-model="form.blood_group" class="form-input2" id="blood">
                </div>
                <div class="w-full md:w-1/4 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mt-2" for="passport">
                       Passport 
                    </label>
                    <input type="text" v-model="form.passport" class="form-input2" id="passport">
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-1">
                <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mt-2" for="gender">
                        Gender <strong class="text-red-600">*</strong>
                    </label>
                    <select name="gender" id="gender" class="form-input2" v-model="form.gender">
                        <option value="">--Select--</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="w-full md:w-1/4 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mt-2" for="religion">
                        Religion <strong class="text-red-600">*</strong>
                    </label>
                    <select name="religion" id="religion" class="form-input2" v-model="form.religion">
                        <option value="">--Select--</option>
                        <option value="Muslim">Muslim</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Christian">Christian</option>
                    </select>
                </div>                
                <div class="w-full md:w-1/4 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mt-2" >
                       Change Photo
                    </label>
                    <input type="file" class="form-input2" @change="onFileSelected">
                </div>
                <div class="w-full md:w-1/4 px-3">                    
                    <img :src="'/'+form.image" class="rounded" alt="image" width="50" height="50">
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-1">
                <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mt-2" for="contact">
                         Contact No <strong class="text-red-600">*</strong>
                    </label>
                    <input type="text" v-model="form.contact_no" class="form-input2" id="contact">
                </div>
                <div class="w-full md:w-1/4 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mt-2" for="emer">
                        Emergency Contact No <strong class="text-red-600">*</strong>
                    </label>
                    <input type="text" v-model="form.emergency_contact_no" class="form-input2" id="emer">
                </div>
                <div class="w-full md:w-1/4 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mt-2" for="email">
                        E-mail <strong class="text-red-600">*</strong>
                    </label>
                    <input type="text" v-model="form.email" class="form-input2" id="email">
                </div>
                <div class="w-full md:w-1/4 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mt-2" for="whatsapp">
                       Whatsapp
                    </label>
                    <input type="text" v-model="form.whatsapp" class="form-input2" id="whatsapp">
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-1">
                <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mt-2" for="linkedin">
                        Linkedin Link
                    </label>
                    <input type="text" v-model="form.linkedin" class="form-input2" id="linkedin">
                </div>
                <div class="w-full md:w-1/4 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mt-2" for="facebook">
                        Facebook Link
                    </label>
                    <input type="text" v-model="form.faceboo" class="form-input2" id="facebook">
                </div>
                <div class="w-full md:w-1/4 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mt-2" for="github">
                        Github Link
                    </label>
                    <input type="text" v-model="form.github" class="form-input2" id="github">
                </div>
                <div class="w-full md:w-1/4 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mt-2" for="dribble">
                       Dribble Link
                    </label>
                    <input type="text" v-model="form.dribble" class="form-input2" id="dribble">
                </div>
            </div>
            <div class="w-full md:w-4/4 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mt-2" >
                   Address
                </label>
                <ckeditor
                    :editor="editor"
                    v-model="form.address"
                    @input="onChange"
                    class="custom-ckeditor"
                    ></ckeditor>
            </div>
            <div class="w-full md:w-4/4 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mt-2" >
                    Education Info
                </label>
                <ckeditor
                    :editor="editor"
                    v-model="form.education_info"
                    @input="onChange"
                    class="custom-ckeditor"
                    ></ckeditor>
            </div>
            <div class="w-full md:w-4/4 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mt-2" >
                    Training Info
                </label>
                
                <ckeditor
                :editor="editor"
                v-model="form.training_info"
                @input="onChange"
                ></ckeditor>
            </div>
            <div class="w-full md:w-4/4 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mt-2" >
                    Job Experience
                </label>
                
                <ckeditor
                :editor="editor"
                v-model="form.job_experience"
                @input="onChange"
                ></ckeditor>
            </div>
            <div class="w-full md:w-4/4 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mt-2" for="skills">
                    Skills
                </label>               
                <input type="text" v-model="form.skills" class="form-input2" id="skills">
                
            </div>
            <button type="submit" class="btn btn-green mt-2">Update</button>
            </form>
        </template> 
    </Card>
</template>
<style scoped>
.custom-ckeditor {
  height: 300px; /* Adjust the height as needed */
}
</style>
  
  
  