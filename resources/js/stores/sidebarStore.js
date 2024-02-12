import { ref, watch } from 'vue';
import { defineStore } from 'pinia';

export const useSidebarStore = defineStore('sidebar', () => {

  // Define reactive state for sidebar expansion
  const sidebarExpanded = ref(true);

  // Watch for changes in sidebarExpanded and update local storage and body class
  watch(sidebarExpanded, () => {    
    const bodyElement = document.querySelector('#body');
    if (bodyElement) {
      if (sidebarExpanded.value) {
        bodyElement.classList.add('sidebar-expanded');
      } else {
        bodyElement.classList.remove('sidebar-expanded');
      }
    }
  });
    // Define a method to toggle the sidebar
    function toggleSidebar() {
      sidebarExpanded.value = !sidebarExpanded.value;
    }
    function toggleSidebarMini() {
      sidebarExpanded.value = true;
    }

    return {
      sidebarExpanded,
      toggleSidebar,
      toggleSidebarMini
    };
});
