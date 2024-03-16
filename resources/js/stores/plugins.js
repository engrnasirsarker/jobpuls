// pluginStore.js
import { reactive } from 'vue';
import axios from 'axios';

const plugins = reactive({
    isActive: {}
});

const fetchInitialStatus = async () => {
    try {
        const response = await axios.get('/api/plugins/status');
        plugins.isActive = response.data.isActive;
    } catch (error) {
        console.error(error);
    }
};

fetchInitialStatus(); // Call fetchInitialStatus when the store is initialized

export { plugins, fetchInitialStatus  };
