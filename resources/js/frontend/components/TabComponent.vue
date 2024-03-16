<script setup>
    import { ref } from 'vue';
    import { FwbBadge, FwbButton } from 'flowbite-vue';
    defineProps(['data', 'title']);
   
</script>
<template>  
    <div class="w-full lg:max-w-full mb-4" v-if="data.length == 0">
      <h2 class="text-center">Data not found</h2>
    </div>
    <div class="w-full lg:max-w-full mb-4" v-for="(item, index) in data" :key="index">  
      <div class="border border-gray-400 lg:border-gray-400 bg-white rounded p-4 justify-between leading-normal">
          <div class="grid grid-rows-3 grid-flow-col gap-4">
            <div class="row-span-3">
              <div class="text-gray-900 font-bold text-xl mb-2">
                {{item?.job_title}}              
                <fwb-badge type="green" class="inline-flex items-center">
                  {{item?.job_type}}
                </fwb-badge>              
              </div>

              <span v-for="(skill, skillIndex) in item?.skills?.split(' ')" :key="skillIndex"  class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800, ">
                  {{ skill }}
              </span>
              
            </div>
            <div class="row-span-3">
              <div class="text-gray-900 font-bold text-xl mb-2">
                Deadline        
              </div>

              <span  class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800, ">
                  {{ item.job_deadline }}
              </span>
              
            </div>
            <div class="row-span-3 text-end">
              <div class="inline-flex">                  
                <div class="self-center ">
                <div>
                  <fwb-badge type="green" >
                  $ {{item?.job_salary}}
                  </fwb-badge>
                </div>                  
                <router-link :to="`/job-details/${item?.id}`">
                    <fwb-button class="mt-1" outline size="sm" type="green" >
                      Apply
                    </fwb-button>
                </router-link>
                </div>
              </div>
            </div>              
          </div>                        
        </div>
    </div>  
</template>
