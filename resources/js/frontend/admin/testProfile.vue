<script setup>
import { FwbInput } from 'flowbite-vue';
import { ref } from 'vue'
import Card from '@/components/Card.vue'


</script>
<template>
    <Card>
        <template #header>
            Profile Page
        </template>
        <template #body>    
            <div class="flex flex-wrap -mx-3 mb-1">
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mt-2" for="grid-first-name">
                         Name <strong class="text-red-600">*</strong>
                    </label>
                    <input type="text" class="form-input2" id="title">
                </div>
                <div class="w-full md:w-1/3 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mt-2" for="grid-last-name">
                        Fathers Name <strong class="text-red-600">*</strong>
                    </label>
                    <input type="text" class="form-input2" id="title">
                </div>
                <div class="w-full md:w-1/3 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mt-2" for="grid-last-name">
                        Mothers Name <strong class="text-red-600">*</strong>
                    </label>
                    <input type="text" class="form-input2" id="title">
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-1">
                <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mt-2" for="grid-first-name">
                         Date Of Birth <strong class="text-red-600">*</strong>
                    </label>
                    <input type="text" class="form-input2" id="title">
                </div>
                <div class="w-full md:w-1/4 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mt-2" for="grid-last-name">
                        NID
                    </label>
                    <input type="text" class="form-input2" id="title">
                </div>
                <div class="w-full md:w-1/4 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mt-2" for="grid-last-name">
                        Blood Group <strong class="text-red-600">*</strong>
                    </label>
                    <input type="text" class="form-input2" id="title">
                </div>
                <div class="w-full md:w-1/4 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mt-2" for="grid-last-name">
                       Passport 
                    </label>
                    <input type="text" class="form-input2" id="title">
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-1">
                <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mt-2" for="grid-first-name">
                         Contact No <strong class="text-red-600">*</strong>
                    </label>
                    <input type="text" class="form-input2" id="title">
                </div>
                <div class="w-full md:w-1/4 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mt-2" for="grid-last-name">
                        Emergency Contact No <strong class="text-red-600">*</strong>
                    </label>
                    <input type="text" class="form-input2" id="title">
                </div>
                <div class="w-full md:w-1/4 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mt-2" for="grid-last-name">
                        E-mail <strong class="text-red-600">*</strong>
                    </label>
                    <input type="text" class="form-input2" id="title">
                </div>
                <div class="w-full md:w-1/4 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mt-2" for="grid-last-name">
                       Whatsapp
                    </label>
                    <input type="text" class="form-input2" id="title">
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-1">
                <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mt-2" for="grid-first-name">
                        Linkedin Link
                    </label>
                    <input type="text" class="form-input2" id="title">
                </div>
                <div class="w-full md:w-1/4 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mt-2" for="grid-last-name">
                        Facebook Link
                    </label>
                    <input type="text" class="form-input2" id="title">
                </div>
                <div class="w-full md:w-1/4 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mt-2" for="grid-last-name">
                        Github Link
                    </label>
                    <input type="text" class="form-input2" id="title">
                </div>
                <div class="w-full md:w-1/4 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mt-2" for="grid-last-name">
                       Dribble Link
                    </label>
                    <input type="text" class="form-input2" id="title">
                </div>
            </div>
            <div class="w-full md:w-4/4 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mt-2" for="grid-first-name">
                    Education Info
                </label>
                <textarea name="" class="form-input2" id="" cols="30" rows="4"></textarea>
            </div>
            <div class="w-full md:w-4/4 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mt-2" for="grid-first-name">
                    Training Info
                </label>
                
                <textarea name="" class="form-input2" id="" cols="30" rows="4"></textarea>
            </div>
            <div class="w-full md:w-4/4 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mt-2" for="grid-first-name">
                    Job Experience
                </label>
                
                <textarea name="" class="form-input2" id="" cols="30" rows="4"></textarea>
            </div>
            <div class="w-full md:w-4/4 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mt-2" for="grid-first-name">
                    Skills
                </label>               
                <input type="text" class="form-input2">
            </div>
            <button class="btn btn-green mt-2">Update</button>
        </template> 
    </Card>
</template>
