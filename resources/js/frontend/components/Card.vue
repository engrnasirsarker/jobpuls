<template>
    <div
    class="block rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
        <div
            class="border-b-2 border-neutral-100 px-6 py-3 dark:border-neutral-600 dark:text-neutral-50">
            <slot name="header"></slot>
        </div>
        <div class="p-6">
            <slot name="body"></slot>         
        </div>    
    </div>
</template>