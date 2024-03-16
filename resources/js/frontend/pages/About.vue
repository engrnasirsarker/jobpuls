<script setup>
    import Navbar from '@/frontend/components/Navbar.vue'
    import FooterView from '@/frontend/components/FooterView.vue'
    import TopCompany from '@/frontend/components/TopCompany.vue'
    import { ref, onMounted } from 'vue'
    import { FwbHeading } from 'flowbite-vue'
    const rows = ref({})
    const getData = async () => {
        const response = await axios.get('/api/about')
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
            <h2 class="sm:text-4xl text-2xl font-bold mb-6">About Us</h2>
            <p class="font-light text-gray-500 sm:text-xl dark:text-gray-400">We use an agile approach to test assumptions and connect with the needs of your audience early and often.</p>
        </div> 
    </div>
    <section>
        <div class="container mx-auto pt-20">  
            <fwb-heading tag="h2" class="text-center py-2">
                Our History
            </fwb-heading>         
            <p class="">
                {{ rows.company_history }}
            </p>
        </div>
        
        <div class="container mx-auto py-20">  
            <fwb-heading tag="h2" class="text-center py-2 mb-4">
                Our Vission
            </fwb-heading>  
            <p class="">
                {{ rows.company_vision }}
            </p>
        </div>
        <TopCompany/>
    </section>
    <FooterView/>
    <!-- end footer section -->

   
</template>