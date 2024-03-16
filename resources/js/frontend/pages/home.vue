<template>
  <!-- start navber section -->
  <Navbar/>
   <!-- end navber section -->
  <!-- hero section -->
  <Hero/>
  <!-- top companies section -->
  <TopCompany/>
  <!-- recent jobs section -->  
  <RecentPublishedJobs/>
  <!-- start footer section -->
  <FooterView/>
  <!-- end footer section -->
</template>

<script setup>
  import Navbar from '@/frontend/components/Navbar.vue'
  import Hero from '@/frontend/components/Hero.vue'
  import TopCompany from '@/frontend/components/TopCompany.vue'
  import RecentPublishedJobs from '@/frontend/components/RecentPublishedJobs.vue'
  import FooterView from '@/frontend/components/FooterView.vue'
  
</script>