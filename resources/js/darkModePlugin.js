// darkModePlugin.js
import { useDark } from '@vueuse/core';

const darkModePlugin = {
  install(app) {
    const isDark = useDark({
      selector: 'html',
    });
    // Add the reactive property to the app context
    app.config.globalProperties.isDark = isDark;
  },
};

export default darkModePlugin;
