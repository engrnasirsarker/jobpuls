<template>
  <div class="flex flex-col col-span-full sm:col-span-4 xl:col-span-4 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
    <div class="p-5">     
      <h2 class="text-lg font-semibold text-slate-800 dark:text-slate-100 mb-2">
        {{title}}
      </h2>      
      <div class="flex items-center">
        <div class="text-3xl font-bold text-slate-800 dark:text-slate-100">
          {{total_value}}
        </div>        
      </div>
    </div>
    
  </div>
</template>

<script setup>
defineProps(['title','total_value'])
</script>