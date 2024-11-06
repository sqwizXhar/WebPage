function autoGrow(el) {
    el.style.height = '10px';
    el.style.height = el.scrollHeight + 'px';
}

document.getElementById('content').addEventListener('input', function() {
    autoGrow(this);
});