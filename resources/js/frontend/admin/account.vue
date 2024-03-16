<script setup>
import { ref, onMounted } from 'vue'
    onMounted(()=>{
        getUser()
    })
    const user = ref({})
    const getUser = async() => {
        const res = await axios.get('/api/user/account')
        user.value = res.data
    }
    const correct = ref(false);
    const incorrect = ref(false);

    const currentPassword = ref('');
    const newPassword = ref('');
    const confirmPassword = ref('');
    const image = ref('');

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
                image.value = event.target.result
            };
            reader.readAsDataURL(file);
        }
    }
    const changePassword = async () => {
        if (newPassword.value !== confirmPassword.value) {
            Toast.fire({icon: 'error', title: 'New password confirmation does not match'});
            return;
        }
        try {
            // Check if the current password is correct
            const response = await axios.post('/api/user/check/password', {
                current_password: currentPassword.value,
            });
            if (response.status === 200) {
                // Password matches, proceed with changing the password
                await axios.post('/api/user/change/password', {
                    current_password: currentPassword.value,
                    new_password: newPassword.value,
                    new_password_confirmation: confirmPassword.value,
                    name: user.value.name,
                    image: image.value
                });
                Toast.fire({icon: 'success', title: 'Password change success'});
                getUser()
            }
            
            
        } catch (error) {
            if (error.response.status === 422) {
                alert(error.response.data.error);
            } else {
                // Current password is incorrect
                incorrect.value = true;
            }
        }
    };

</script>
<template> 
    <div class="bg-gray-100">
        <div class="container mx-auto pb-5">
            <div class="bg-white shadow rounded-lg p-6">                
                <form action="">
                <div class="md:flex md:items-center mb-2">
                    <div class="md:w-1/6 text-end">
                        <label class="form-label" >
                            <img :src="'/'+user.image" alt=""
                            class="rounded-full">
                        </label>
                    </div>
                    <div class="md:w-1/3">
                        <input class="form-input" type="file" @change="onFileSelected">
                    </div>
                    <div class="md:w-1/3 text-right">
                        <button @click.prevent="changePassword" class="btn btn-green">Save</button>
                    </div>
                </div> 
                
                <div class="md:flex md:items-center mb-2">
                    <div class="md:w-1/6 text-end">
                        <label class="form-label px-2" for="name">
                            Full Name 
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input class="form-input" v-model="user.name" id="name"  type="text" placeholder="Enter Full Name ">
                    </div>
                </div> 
                
                <div class="md:flex md:items-center mb-2">
                    <div class="md:w-1/6 text-end">
                        <label class="form-label px-2" for="email">
                            E-mail
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input class="form-input" v-model="user.email"  id="email"  type="email" readonly placeholder="Enter E-mail ">
                    </div>
                </div> 
                <div class="md:flex md:items-center mb-2">
                    <div class="md:w-1/6 text-end">
                        <label class="form-label px-2" for="current_password">
                         Current  Password
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input class="form-input" v-model="currentPassword" id="current_password"  type="password" placeholder="Enter Current Password ">
                    </div>
                </div> 
                <div class="md:flex md:items-center mb-2">
                    <div class="md:w-1/6 text-end">
                        <label class="form-label px-2" for="new_password">
                         New  Password
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input class="form-input" v-model="newPassword"   id="new_password"  type="password" placeholder="Enter New Password ">
                    </div>
                </div> 
                <div class="md:flex md:items-center mb-2">
                    <div class="md:w-1/6 text-end">
                        <label class="form-label px-2" for="confirm_password">
                         Confirm  Password
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input class="form-input" v-model="confirmPassword" id="confirm_password"  type="password" placeholder="Enter Confirm Password ">
                    </div>
                </div> 
                </form>
            </div> 
        </div> 
    </div> 
</template>