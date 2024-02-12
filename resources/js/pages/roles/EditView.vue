<script setup>
    import { ref, onMounted } from 'vue';  
    import { useRouter, useRoute } from 'vue-router'
    import BreadcrumbComponent from '@/components/BreadcrumbComponent.vue'; 
    const $router = useRouter();
    const $route = useRoute();
    const categorizedPermissions = ref([])
    const selectAll = ref(false)
    const selectedPermissions = ref([])
    const errors = ref({})
    const role = ref({})
    onMounted(() => {
        fetchCategorizedPermissions()
        fetchRole()
    })
    // fetch role with id
    const fetchRole = async () => {
        try {
            const roleId = $route.params.id
            const res = await axios.get('/api/role/'+roleId)
            role.value = res.data.role
            selectedPermissions.value = role.value.permissions.map(permission => permission.id);
        } catch (error) {
            console.error('Error fetching role data:', error)
        }
    }
    // get all permission
    const fetchCategorizedPermissions = async () => {
        try {
            const res = await axios.get('/api/permissions')
            categorizedPermissions.value = res.data
        } catch (error) {
            console.log(error)
        }
    }
    // select all
    const toggleSelectAll = () =>{
        if(selectAll.value){
            selectedPermissions.value = []
            Object.keys(categorizedPermissions.value).forEach(key => {
                selectedPermissions.value.push(...categorizedPermissions.value[key].map(permission => permission.id))
            })
        }else{
            selectedPermissions.value = []
        }
    }
    // role update
    const updateRole = async () => {
        try {
            const roleId = $route.params.id
            await axios.put('/api/role/'+roleId,{
                name: role.value.name,
                permissions: selectedPermissions.value
            })
            Toast.fire({icon: 'success', title: 'Role update success !'}) 
            $router.push('/admin/roles')
                        
        } catch (error) {
            errors.value = error.response.data.errors;
        }
    }   
</script>
<template>
    <BreadcrumbComponent :currentPage="'Role Edit'"/>    
    <div class="col-span-full xl:col-span-8 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700 mx-3 mb-4">
        <header class="px-5 py-3 border-b border-slate-300 dark:border-slate-700">        
            <div class="flex justify-between">
                <div>
                <h2 class="text-lg">Edit Role</h2>
                </div>            
                <div>
                <router-link to="/admin/roles" class="btn btn-green">
                    <i class="lni lni-list"></i> Role List
                </router-link>
                </div>
            </div>
        </header>
        <div class="p-3">
            <form @submit.prevent="updateRole">
            <div class="mb-5">
                <label for="large-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role Name</label>
                <input type="text" id="name" class="form-input" placeholder="Enter Role Name" required v-model="role.name">
                
                <span class="text-red-500" v-if="errors.name">
                    {{ errors.name[0] }}
                </span>
            </div>

            <div class="text-center">
                <h3 class="font-bold text-2xl">Permissions</h3>                
            </div>
            <div class="flex items-center">
                <input id="checked-checkbox" type="checkbox" class="input-form" @change="toggleSelectAll" v-model="selectAll">
                <label for="checked-checkbox" class="ms-2 py-3 text-sm font-semibold text-gray-900 dark:text-gray-300">Select All</label>
            </div>
                <hr>
            <div class="grid grid-cols-2 gap-2">
                <div v-for="(permissions, category) in categorizedPermissions" :key="category">
                    <h3 class="font-semibold text-gray-900 dark:text-white">{{category}}</h3>
                    <ul class="w-80 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600" v-for="permission in permissions" :key="permission">
                            <div class="flex items-center ps-3">
                                <input :id="permission.id" type="checkbox"  class="input-form" :value="permission.id" v-model="selectedPermissions">
                                <label :for="permission.id" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ permission.name }}</label>
                            </div>
                        </li>
                    </ul>
                   
                </div>
            </div> 
            <button class="btn btn-green my-3" type="submit">
                <i class="lni lni-save"></i> Update
            </button>            
            </form>
        </div>
    </div>   
    
</template>
