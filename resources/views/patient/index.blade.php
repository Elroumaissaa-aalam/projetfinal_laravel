<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @yield('content')
     <script>
        // Universal Modal System
        class UniversalModal {
            constructor() {
                this.modal = document.getElementById('universal-modal');
                this.title = document.getElementById('modal-title');
                this.content = document.getElementById('modal-content');
                this.actions = document.getElementById('modal-actions');
                this.closeBtn = document.getElementById('modal-close');
                this.cancelBtn = document.getElementById('modal-cancel');
                this.confirmBtn = document.getElementById('modal-confirm');

                this.init();
            }

            init() {
                // Close modal events
                this.closeBtn.addEventListener('click', () => this.close());
                this.cancelBtn.addEventListener('click', () => this.close());

                // Close on outside click
                this.modal.addEventListener('click', (e) => {
                    if (e.target === this.modal) {
                        this.close();
                    }
                });

                // Close on Escape key
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape' && !this.modal.classList.contains('hidden')) {
                        this.close();
                    }
                });
            }

            show(options = {}) {
                const {
                    title = 'Information',
                    content = '',
                    type = 'info', // info, success, warning, error, confirm
                    confirmText = 'OK',
                    cancelText = 'Cancel',
                    showCancel = false,
                    onConfirm = null,
                    onCancel = null
                } = options;

                this.title.textContent = title;
                this.content.innerHTML = content;

                // Update confirm button
                this.confirmBtn.textContent = confirmText;
                this.confirmBtn.className = `px-4 py-2 rounded-md transition-colors ${this.getButtonClass(type)}`;

                // Show/hide cancel button
                if (showCancel) {
                    this.cancelBtn.textContent = cancelText;
                    this.cancelBtn.classList.remove('hidden');
                } else {
                    this.cancelBtn.classList.add('hidden');
                }

                // Set up event handlers
                this.confirmBtn.onclick = () => {
                    if (onConfirm) onConfirm();
                    this.close();
                };

                this.cancelBtn.onclick = () => {
                    if (onCancel) onCancel();
                    this.close();
                };

                // Show modal
                this.modal.classList.remove('hidden');
                this.confirmBtn.focus();
            }

            close() {
                this.modal.classList.add('hidden');
            }

            getButtonClass(type) {
                switch (type) {
                    case 'success':
                        return 'bg-green-600 hover:bg-green-700 text-white';
                    case 'warning':
                        return 'bg-yellow-600 hover:bg-yellow-700 text-white';
                    case 'error':
                        return 'bg-red-600 hover:bg-red-700 text-white';
                    case 'confirm':
                        return 'bg-blue-600 hover:bg-blue-700 text-white';
                    default:
                        return 'bg-purple-600 hover:bg-purple-700 text-white';
                }
            }
        }

        // Initialize modal when DOM is loaded
        let universalModal;
        document.addEventListener('DOMContentLoaded', function() {
            universalModal = new UniversalModal();
        });

        // Global helper functions
        function showModal(options) {
            if (universalModal) {
                universalModal.show(options);
            }
        }

        function showInfo(title, content) {
            showModal({ title, content, type: 'info' });
        }

        function showSuccess(title, content) {
            showModal({ title, content, type: 'success' });
        }

        function showWarning(title, content) {
            showModal({ title, content, type: 'warning' });
        }

        function showError(title, content) {
            showModal({ title, content, type: 'error' });
        }

        function showConfirm(title, content, onConfirm, onCancel = null) {
            showModal({
                title,
                content,
                type: 'confirm',
                showCancel: true,
                confirmText: 'Confirm',
                onConfirm,
                onCancel
            });
        }

        function showComingSoon(feature) {
            showInfo('Coming Soon', `The <strong>${feature}</strong> feature is currently under development and will be available soon.`);
        }
    </script>
    @stack('scripts')
</body>
</html>