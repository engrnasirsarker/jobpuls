<script setup>
import { 
    FwbFooter,
    FwbFooterCopyright,
    FwbFooterLinkGroup, 
    FwbFooterLink,
    FwbFooterIcon
} from 'flowbite-vue'

</script> 
<template>
  
    <fwb-footer footer-type="sitemap">
    <div class="grid grid-cols-2 gap-8 py-8 px-6 md:grid-cols-3 container mx-auto">
      <div>
        <h2 class="mb-6 text-sm font-semibold text-gray-400 uppercase">
          JobPuls
        </h2>
        <fwb-footer-link-group class="text-gray-300 flex flex-col items-start">
          <fwb-footer-link class="mb-4" href="/">
            About
          </fwb-footer-link>
          <fwb-footer-link class="mb-4" href="/">
            Jobs
          </fwb-footer-link>
          <fwb-footer-link class="mb-4" href="/">
            Contact
          </fwb-footer-link>
          <fwb-footer-link class="mb-4" href="/">
            Blog
          </fwb-footer-link>
        </fwb-footer-link-group>
      </div>
      
      <div>
        <h2 class="mb-6 text-sm font-semibold uppercase text-gray-400">
          Legal
        </h2>
        <fwb-footer-link-group class="text-gray-300 flex flex-col items-start">
          <fwb-footer-link class="mb-4" href="/">
            About
          </fwb-footer-link>
          <fwb-footer-link class="mb-4" href="/">
            Job
          </fwb-footer-link>
          <fwb-footer-link class="mb-4" href="/">
            Blogs
          </fwb-footer-link>
        </fwb-footer-link-group>
      </div>
      <div>
        <h2 class="mb-6 text-sm font-semibold uppercase text-gray-400">
          Download
        </h2>
        <fwb-footer-link-group class="text-gray-300 flex flex-col items-start">
          <fwb-footer-link class="mb-4" href="/">
            About
          </fwb-footer-link>
          <fwb-footer-link class="mb-4" href="/">
            Contact
          </fwb-footer-link>
          <fwb-footer-link class="mb-4" href="/">
            Jobs
          </fwb-footer-link>
          <fwb-footer-link class="mb-4" href="/">
            Blogs
          </fwb-footer-link>
        </fwb-footer-link-group>
      </div>
    </div>
    <div class="py-6 px-4 bg-gray-700 md:flex md:items-center md:justify-center">
      <fwb-footer-copyright by="Nasir Uddin" class="text-sm text-gray-300 sm:text-center" href="/" />
      
    </div>
    </fwb-footer>
</template>