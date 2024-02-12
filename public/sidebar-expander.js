if (localStorage.getItem('sidebar-expanded') == 'true') {
    document.querySelector('body').classList.add('sidebar-expanded');
  } else {
    document.querySelector('body').classList.remove('sidebar-expanded');
  }