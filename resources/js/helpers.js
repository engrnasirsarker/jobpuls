/*==========================================
    start get token in headers for vue js
===========================================*/ 
axios.interceptors.request.use(
    config => {
      const token =  window.access_token      
      if (token) {
        config.headers.Authorization = token;
      }
      return config;
    },
    error => {
      return Promise.reject(error);
    } 
  );

/*==========================================
    end get token in headers for vue js
===========================================*/
export const numericOnlyDirective = {
    mounted(el) {
        el.addEventListener('keypress', (event) => {
                const charCode = event.charCode;
            // Allow numeric digits, period, and backspace
            if (
                (charCode >= 48 && charCode <= 57) || // 0-9
                charCode === 46 || // period (.)
                charCode === 8 // backspace
            ) {
            // Allow the input
            } else {
                event.preventDefault(); // Prevent other characters
            }
        });
    },
};