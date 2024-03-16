<script setup>
import { FwbButton } from 'flowbite-vue'
</script> 
<template>
    <div class="bg-dark-400">  
        <div class="relative isolate px-6 lg:px-8">
        <div class="mx-auto max-w-2xl py-20 sm:py-24 lg:py-30">
            <div class="text-center">
            <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">Find The Perfect Job That You Deserves</h1>
            <p class="mt-6 text-lg leading-8 text-gray-600">Anim aute id magna aliqua ad ad non deserunt sunt. Qui irure qui lorem cupidatat commodo. Elit sunt amet fugiat veniam occaecat fugiat aliqua.</p>
            <div class="mt-10 flex items-center justify-center gap-x-6">
                
                <router-link to="jobs">
                    <fwb-button color="default">
                    Search A Job
                    </fwb-button>
                </router-link>
                <fwb-button color="default" outline>
                Find the Talent <span aria-hidden="true">→</span>
                </fwb-button>
            </div>
            </div>
        </div>
        </div>
    </div> 
</template>