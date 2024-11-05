document.getElementById('profile_picture').addEventListener('change', function() {
    if (this.files.length > 0) {
        this.closest('.file-upload').classList.add('loaded');
    } else {
        this.closest('.file-upload').classList.remove('loaded');
    }
});
