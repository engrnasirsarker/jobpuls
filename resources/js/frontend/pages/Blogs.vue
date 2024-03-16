<script setup>
    import Navbar from '@/frontend/components/Navbar.vue'
    import FooterView from '@/frontend/components/FooterView.vue'
    import TopCompany from '@/frontend/components/TopCompany.vue'
    import { ref, onMounted } from 'vue'
    import { FwbHeading } from 'flowbite-vue'
    const rows = ref({})
    const getData = async () => {
        const response = await axios.get('/api/front/blogs')
        rows.value = response.data
    }
    onMounted(() => {
        getData()
    })
</script>
<template>
    <!-- start navber section -->
    <Navbar/>
     <!-- end navber section -->
     <div class="relative font-[sans-serif] before:absolute before:w-full before:h-full before:inset-0 before:bg-black before:opacity-50 before:z-10">
        <img src="https://readymadeui.com/cardImg.webp" alt="Banner Image" class="absolute inset-0 w-full h-full object-cover" />
        <div class="min-h-[200px] relative z-50 h-full max-w-6xl mx-auto flex flex-col justify-center items-center text-center text-white p-6">
            <h2 class="sm:text-4xl text-2xl font-bold mb-6">Blogs</h2>
            <p class="font-light text-gray-500 sm:text-xl dark:text-gray-400">We use an agile approach to test assumptions and connect with the needs of your audience early and often.</p>
        </div> 
    </div>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
            
            <div class="grid gap-8 lg:grid-cols-2">
                <article v-for="item in rows" class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                    <img :src="item.feature_image" alt="card-image" />
                    <div class="flex justify-between items-center mb-5 text-gray-500">
                        <span class="bg-primary-100 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800">
                            <svg class="mr-1 w-3 h-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"></path></svg>
                           
                        </span>
                        <span class="text-sm">1 days ago</span>
                    </div>
                    <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                        <router-link :to="'/blog-details/'+item.id">
                            {{ item.title }}
                        </router-link>
                    </h2>
                    <p class="mb-5 font-light text-gray-500 dark:text-gray-400">
                        {{
                            item.body ? 
                            (item.body.replace(/<\/?[^>]+(>|$)/g, '').slice(0, 200) + (item.body.length > 30 ? '...' : '')) : 
                            ''
                        }}
                    </p>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-4">
                            <img class="w-7 h-7 rounded-full" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/jese-leos.png" alt="Jese Leos avatar" />
                            <span class="font-medium dark:text-white">
                                {{item.user.name}}
                            </span>
                        </div>
                        <router-link :to="'/blog-details/'+item.id" class="inline-flex items-center font-medium text-primary-600 dark:text-primary-500 hover:underline">
                            Read more
                            <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </router-link>
                    </div>
                </article>                     
            </div>  
        </div>
    </section>
    <TopCompany/>
    <FooterView/>
    <!-- end footer section -->

   
</template>