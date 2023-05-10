'use strict'

const form = document.getElementById('myForm');
const Modal_form = document.getElementById('Modal_form');

form.addEventListener('submit', (event) => {
  event.preventDefault();

  // Получение данных формы
  const formData = new FormData(form);
  const name = formData.get('name');
  const email = formData.get('email');
  const tel = formData.get('tel');
  


  // Проверка заполнения полей
  if (!name || !email || !tel) {
    alert('Пожалуйста, заполните все поля формы.');
    return;
  }

  // Проверка правильности введенных данных
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  const telRegex = /^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,14}(\s*)?$/;
  if (!emailRegex.test(email)) {
    alert('Пожалуйста, введите корректный email.');
    return;
  }
  if (!telRegex.test(tel)) {
    alert('Пожалуйста, введите корректный номер телефона в формате +7XXXXXXXXXX.');
    return;
  }

  // Отправка данных на сервер
  fetch('/sendmail.php', {
    method: 'POST',
    body: formData,
    
  })
  .then(response => {
    if (response.ok) {
      alert('Спасибо за заявку! Мы свяжемся с вами в ближайшее время.');
      form.reset();
      
    } else {
      throw new Error(`Network response was not ok. Status: ${response.status}`);
    }
  })
    .catch(error => alert(error.message));
});


