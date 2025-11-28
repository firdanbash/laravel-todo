import './bootstrap';
import { initFlowbite } from 'flowbite';

// Inisialisasi Flowbite
document.addEventListener('DOMContentLoaded', function() {
    initFlowbite();

    // Auto-expand todo section jika di halaman todo
    if (window.location.pathname === '/todo') {
        const dropdownTodo = document.getElementById('dropdown-todo');
        const collapseButton = document.querySelector('[data-collapse-toggle="dropdown-todo"]');
        if (dropdownTodo && collapseButton && dropdownTodo.classList.contains('hidden')) {
            // Trigger click untuk expand
            setTimeout(() => {
                collapseButton.click();
            }, 100);
        }
    }
});

// Theme toggle functionality
var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    themeToggleLightIcon?.classList.remove('hidden');
} else {
    themeToggleDarkIcon?.classList.remove('hidden');
}

var themeToggleBtn = document.getElementById('theme-toggle');
themeToggleBtn?.addEventListener('click', function() {
    themeToggleDarkIcon?.classList.toggle('hidden');
    themeToggleLightIcon?.classList.toggle('hidden');

    if (localStorage.getItem('color-theme')) {
        if (localStorage.getItem('color-theme') === 'light') {
            document.documentElement.classList.add('dark');
            localStorage.setItem('color-theme', 'dark');
        } else {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('color-theme', 'light');
        }
    } else {
        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('color-theme', 'light');
        } else {
            document.documentElement.classList.add('dark');
            localStorage.setItem('color-theme', 'dark');
        }
    }
});

// Function untuk show toast
function showToast(toastId, triggerBtnId, duration = 3000) {
    const toast = document.getElementById(toastId);
    const triggerBtn = document.getElementById(triggerBtnId);

    if (toast && triggerBtn) {
        // Show toast
        toast.classList.remove('hidden');

        // Auto-hide setelah duration
        setTimeout(() => {
            if (!toast.classList.contains('hidden')) {
                triggerBtn.click();
            }
        }, duration);
    }
}

// Livewire event listeners
document.addEventListener('livewire:init', () => {
    // Event untuk modal create
    Livewire.on('close-modal', () => {
        const toggleBtn = document.querySelector('[data-modal-toggle="defaultModal"]');
        if (toggleBtn) toggleBtn.click();
    });

    // Event untuk delete modal
    Livewire.on('open-delete-modal', () => {
        const btn = document.getElementById('toggleDeleteModal');
        if (btn) btn.click();
    });

    Livewire.on('close-delete-modal', () => {
        const btn = document.querySelector('[data-modal-toggle="deleteModal"]');
        if (btn) btn.click();
    });

    // Event untuk edit modal
    Livewire.on('open-edit-modal', () => {
        const btn = document.getElementById('toggleEditModal');
        if (btn) {
            btn.click();
        }
    });

    Livewire.on('close-edit-modal', () => {
        const btn = document.querySelector('[data-modal-toggle="updateProductModal"]');
        if (btn) {
            btn.click();
        }
    });

    // Event untuk toast notifications
    Livewire.on('show-create-toast', () => {
        showToast('createSuccessToast', 'openCreateSuccessToastBtn');
    });

    Livewire.on('show-update-toast', () => {
        showToast('updateSuccessToast', 'openUpdateSuccessToastBtn');
    });

    // Event untuk refresh dropdowns
    Livewire.on('refresh-dropdowns', () => {
        setTimeout(() => {
            initFlowbite();
        }, 150);
    });

    // Reinitialize Flowbite setelah Livewire selesai update
    Livewire.hook('message.processed', (message, component) => {
        setTimeout(() => {
            initFlowbite();
        }, 50);
    });
});

// Inisialisasi ulang saat navigasi
document.addEventListener('livewire:navigated', () => {
    setTimeout(() => {
        initFlowbite();
    }, 100);
});
