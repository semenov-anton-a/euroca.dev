document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('loginForm');
  const submitBtn = document.getElementById('submitBtn');
  const btnText = submitBtn.querySelector('.btn-text');
  const btnLoader = submitBtn.querySelector('.btn-loader');
  const toggleBtns = document.querySelectorAll('.toggle-password');

  toggleBtns.forEach(function (btn) {
    btn.addEventListener('click', function () {
      const input = this.parentElement.querySelector('input');
      const eye = this.querySelector('.eye-icon');

      if (input.type === 'password') {
        input.type = 'text';
        eye.textContent = '🙈';
      } else {
        input.type = 'password';
        eye.textContent = '👁️';
      }
    });
  });

  if (form) {
    form.addEventListener('submit', function () {
      submitBtn.disabled = true;
      if (btnText) btnText.style.display = 'none';
      if (btnLoader) btnLoader.hidden = false;
    });
  }
});
