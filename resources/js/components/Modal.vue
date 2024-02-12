<template>
    <!-- Modal backdrop -->
    <transition
      enter-active-class="transition ease-out duration-200"
      enter-from-class="opacity-0"
      enter-to-class="opacity-200"
      leave-active-class="transition ease-out duration-100"
      leave-from-class="opacity-100"
      leave-to-class="opacity-0"
    >
      <div v-show="modalOpen" class="fixed inset-0 bg-slate-900 bg-opacity-60 z-50 transition-opacity" aria-hidden="true"></div>
    </transition>
    <!-- Modal dialog -->
    <transition
      enter-active-class="transition ease-in-out duration-200"
      enter-from-class="opacity-0 translate-y-4"
      enter-to-class="opacity-100 translate-y-0"
      leave-active-class="transition ease-in-out duration-200"
      leave-from-class="opacity-100 translate-y-0"
      leave-to-class="opacity-0 translate-y-4"
    >
    
      <div v-show="modalOpen" :id="id" class="fixed inset-0 z-50 overflow-hidden flex items-start top-20 mb-4 justify-center px-4 sm:px-6" role="dialog" aria-modal="true">
        <div ref="modalContent" class="bg-white dark:bg-slate-800 border border-transparent dark:border-slate-700 overflow-auto max-w-2xl w-full max-h-full rounded shadow-lg">
          <slot></slot>   
        </div>
      </div>
    </transition>
  </template>
  
  <script setup>
  import { ref, onMounted, onUnmounted } from 'vue'
    const props = defineProps(['id', 'searchId', 'modalOpen'])
    const emit = defineEmits(['open-modal', 'close-modal'])
    const modalContent = ref(null)

      // close on click outside
    const clickHandler = ({ target }) => {
        if (!props.modalOpen || modalContent.value.contains(target)) return
        emit('close-modal')
    }
      // close if the esc key is pressed
    const keyHandler = ({ keyCode }) => {
        if (!props.modalOpen || keyCode !== 27) return
        emit('close-modal')
    }
    onMounted(() => {
        document.addEventListener('click', clickHandler)
        document.addEventListener('keydown', keyHandler)
    })
  
    onUnmounted(() => {
        document.removeEventListener('click', clickHandler)
        document.removeEventListener('keydown', keyHandler)
    })
    
  </script>