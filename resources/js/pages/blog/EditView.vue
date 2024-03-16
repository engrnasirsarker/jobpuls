<script setup>
    import { FwbButton } from 'flowbite-vue'
    import Card from '@/components/Card.vue'
    import { useRouter, useRoute } from 'vue-router'
    import { ref, onMounted } from 'vue'
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    import CKEditor  from '@ckeditor/ckeditor5-vue';
    import CKEditorInspector from '@ckeditor/ckeditor5-inspector';
    const ckeditor = CKEditor.component;
    const editor = ClassicEditor;
    const onReady = (editor) => {
        CKEditorInspector.attach(editor);
    };
    onMounted(()=>{
        getBlog()
    })
    const onChange = (data) => {
        console.log(data);
    };
    const form = ref({})
    const router = useRouter()
    const route = useRoute()
    const getBlog = async() => {
        const id = route.params.id
        const res = await axios.get('/api/blogs/'+id)
        form.value = res.data
    }
    const updateItem = async () => {
        await axios.patch(`/api/blogs/${form.value.id}`, form.value)   
        Toast.fire({icon: 'success',title: 'Update success !'})  
        router.push('/admin/blog-list')
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
                form.value.feature_image = event.target.result
            };
            reader.readAsDataURL(file);
        }
    }
</script>
<template>     
   <Card>
    <template #header>
        <header class="px-5 py-3 border-b border-slate-300 dark:border-slate-700">
        <div class="flex justify-between">
            <div>
              <h2 class="text-lg">Edit Blogs</h2>
            </div>
            <div>
                
                <router-link to="/admin/blog-list" class="btn btn-green">
                    <i class="lni lni-list"></i> Blog List
                </router-link>
            </div>
        </div>
      </header>
    </template>
    <template #body>
        <form @submit.prevent="updateItem">
        
        <div class="w-full md:w-4/4 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mt-2" >
                Title
            </label>
            <input type="text" class="form-input" id="title" placeholder="Enter title" v-model="form.title">
        </div> 
        <div class="w-full md:w-4/4 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mt-2" >
                Feature Image
            </label>
            <input type="file" class="form-input"  @change="onFileSelected">
        </div> 
        <div class="w-full md:w-4/4 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mt-2" >
                Body
            </label>
            <ckeditor
                :editor="editor"
                v-model="form.body"
                @input="onChange"
                class="custom-ckeditor"
                ></ckeditor>
        </div> 
       
        <fwb-button color="default" class="mt-3">
            Submit
        </fwb-button>

        </form>
    </template>
   </Card>
</template>