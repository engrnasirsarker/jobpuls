<script setup>
    defineProps(['currentPage'])
</script>
<template>
    <nav class="flex mx-3" aria-label="Breadcrumb">
      <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
        <li class="inline-flex items-center">
          <router-link to="/admin/dashboard" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
            <i class="lni lni-home me-1"></i>
            Home
          </router-link>
        </li>
           
        <li aria-current="page">
          <div class="flex items-center">
            <i class="lni lni-angle-double-right"></i>
            <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">{{currentPage}}</span>
          </div>
        </li>
      </ol>
    </nav>
</template>