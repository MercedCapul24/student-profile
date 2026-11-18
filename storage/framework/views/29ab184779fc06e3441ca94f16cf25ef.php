<script>
document.querySelectorAll('form').forEach(function (form) {
    if (form.method.toLowerCase() !== 'post') return;

    var token = document.createElement('input');
    token.type = 'hidden';
    token.name = 'submit_token';
    token.value = (window.crypto && crypto.randomUUID)
        ? crypto.randomUUID()
        : Date.now() + '-' + Math.random();
    form.appendChild(token);

    var locked = false;
    form.addEventListener('submit', function (e) {
        if (locked) { e.preventDefault(); return; }
        locked = true;
        var btn = form.querySelector('button[type="submit"]');
        if (btn) {
            btn.disabled = true;
            btn.textContent = btn.dataset.loading || 'Saving...';
        }
    });
});

window.addEventListener('pageshow', function (e) {
    if (e.persisted) { location.reload(); }
});
</script><?php /**PATH C:\Users\Vash Dave Jumanguin\student-profile\resources\views/partials/form-guard.blade.php ENDPATH**/ ?>