<template>
  <div>
    <input type="checkbox" name="light-switch" id="light-switch" v-model="isDark" class="light-switch sr-only" />
    <label class="flex items-center justify-center cursor-pointer w-8 h-8 bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:hover:bg-slate-600/80 rounded-full" for="light-switch">

      <i class="lni lni-sun dark:hidden"></i>  
            
      <i class="lni lni-night hidden dark:block"></i>

      <span class="sr-only">Switch to light / dark version</span>
    </label>
  </div>
</template>

<script setup>
import { useDark } from "@vueuse/core";
  const isDark = useDark({
    selector: 'html',
  });
  
</script>
