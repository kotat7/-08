// Клиентская валидация (дублирует серверную для удобства)
document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('form[data-validate]');
    if (!form) return;

    form.addEventListener('submit', (e) => {
        const email = form.querySelector('input[name="email"]');
        const pass  = form.querySelector('input[name="password"]');
        const name  = form.querySelector('input[name="name"]');
        let ok = true;

        if (name && name.value.trim() === '') {
            markInvalid(name, 'Введите имя'); ok = false;
        }
        if (email && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
            markInvalid(email, 'Некорректный email'); ok = false;
        }
        if (pass && pass.value.length < 6) {
            markInvalid(pass, 'Пароль минимум 6 символов'); ok = false;
        }
        if (!ok) e.preventDefault();
    });

    function markInvalid(el, msg) {
        el.classList.add('is-invalid');
        let fb = el.parentElement.querySelector('.invalid-feedback');
        if (!fb) {
            fb = document.createElement('div');
            fb.className = 'invalid-feedback';
            el.parentElement.appendChild(fb);
        }
        fb.textContent = msg;
    }

    // Подтверждение удаления
    document.querySelectorAll('[data-confirm-delete]').forEach(btn => {
        btn.addEventListener('click', (e) => {
            if (!confirm('Точно удалить?')) e.preventDefault();
        });
    });
});
