/**
 * GudangMeme - Post Show Page JavaScript
 * Handles: Save-to-Collection modal logic
 */

/**
 * Buka modal simpan ke koleksi
 */
function openSaveModal() {
    const modal = document.getElementById('save-modal');
    if (modal) {
        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }
}

/**
 * Tutup modal simpan ke koleksi
 */
function closeSaveModal() {
    const modal = document.getElementById('save-modal');
    if (modal) {
        modal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }
}

// Tutup modal saat tekan tombol Escape
document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
        closeSaveModal();
    }
});
