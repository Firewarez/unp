/* Script para alterar modo escuro */
function ToggleDarkModeIcon() {
    var modeIcon = document.getElementById('modeIcon');
    if (modeIcon.classList.contains('fa-sun')) {
      modeIcon.classList.replace('fa-sun', 'fa-moon');
    } else {
      modeIcon.classList.replace('fa-moon', 'fa-sun');
    }
  }
  /* ---------------------------------------------- */
  
  /* Config gear menu script */
  document.addEventListener('DOMContentLoaded', function () {
    const configMenu = document.querySelector('.config-menu');
    const menuList = document.getElementById('menu-list');
  
    if (configMenu && menuList) {
      configMenu.addEventListener('click', function () {
        if (menuList.style.display === 'none' || menuList.style.display === '') {
          menuList.style.display = 'block';
        } else {
          menuList.style.display = 'none';
        }
      });
  
      document.addEventListener('click', function (event) {
        if (!configMenu.contains(event.target) && !menuList.contains(event.target)) {
          menuList.style.display = 'none';
        }
      });
    }
  
    /* Config user menu script */
    const userMenu = document.querySelector('.user-icon');
    const userMenuList = document.getElementById('user-menu');
  
    if (userMenu && userMenuList) {
      userMenu.addEventListener('click', function () {
        if (userMenuList.style.display === 'none' || userMenuList.style.display === '') {
          userMenuList.style.display = 'block';
        } else {
          userMenuList.style.display = 'none';
        }
      });
  
      document.addEventListener('click', function (event) {
        if (!userMenu.contains(event.target) && !userMenuList.contains(event.target)) {
          userMenuList.style.display = 'none';
        }
      });
    }
    /* ---------------------------------------------- */
  
  
    /* Config topic menu script */
    const topicBtn = document.getElementById('topic-btn');
    const topicList = document.getElementById('topic-list');
    const closeTopicMenu = document.getElementById('close-topic-menu');
    const modalBtn = document.getElementById('modal-btn');
  
    if (modalBtn) {
      modalBtn.addEventListener('click', function () {
        if (!isAuthenticated) {
          window.location.href = 'logar.php';
          console.log('Usuário não autenticado');
        } else {
          // Código para abrir a modal
          console.log('Usuário autenticado');
        }
      });
    }
  
  
  
    if (topicBtn && topicList) {
      topicBtn.addEventListener('click', function (event) {
        event.stopPropagation(); // Impede que o clique se propague para o documento
        if (topicList.style.display === 'none' || topicList.style.display === '') {
          topicList.style.display = 'block';
        } else {
          topicList.style.display = 'none';
        }
      });
  
      document.addEventListener('click', function (event) {
        if (!topicBtn.contains(event.target) && !topicList.contains(event.target)) {
          topicList.style.display = 'none';
        }
      });
    }
  
    if (closeTopicMenu) {
      closeTopicMenu.addEventListener('click', function (event) {
        event.stopPropagation(); // Impede que o clique se propague para o documento
        topicList.style.display = 'none';
      });
    }
    /* ---------------------------------------------- */
  
  
  });
  
  