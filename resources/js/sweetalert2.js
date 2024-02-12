
/*==============================
    start sweet alert
================================*/
// swal sweet alert
import Swal from 'sweetalert2'
import 'sweetalert2/dist/sweetalert2.min.css';
window.Swal = Swal;

// toaster sweet alert
const Toast = Swal.mixin({
  toast: true,
  position: 'top',
  showConfirmButton: false, 
  timer: 3000
});
window.Toast = Toast;
/*==============================
    end sweet alert
================================*/