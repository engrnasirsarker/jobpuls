<script setup>
import { FwbHeading } from 'flowbite-vue'
import { ref, onMounted } from 'vue'
const rows = ref({})
const getData = async () => {
  const response = await axios.get('/api/top-company')
  rows.value = response.data
}
const image = '/assets/images/avatar.jpeg'
onMounted(() => {
  getData()
})
</script> 
<template>   
  <section class="bg-white dark:bg-gray-900">
    <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-6">
        <div class="mx-auto mb-8 max-w-screen-sm lg:mb-16">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Top Companies</h2>
            <p class="font-light text-gray-500 sm:text-xl dark:text-gray-400">Explore the whole collection of open-source web components and elements built with the utility classes from Tailwind</p>
        </div> 
        <div class="grid container mx-auto gap-8 lg:gap-16 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5" >
            <div class="text-center text-gray-500 dark:text-gray-400" v-for="item in rows" :key="item">
                <img v-if="item.image != null" class="mx-auto mb-4 w-19 h-19 rounded" :src="'/'+item.image" alt="Bonnie Avatar">
                <img v-else class="mx-auto mb-4 w-19 h-19 rounded" :src="image" alt="Bonnie Avatar">
                <h3 class="mb-1 text-1xl font-bold tracking-tight text-gray-900 dark:text-white">
                    <a href="#">{{item.name}}</a>
                </h3>
                <p>CEO/Co-founder</p>
              
            </div>
            
          
        </div>  
    </div>
  </section>
</template>