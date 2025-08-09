<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.name', 'Laravel')); ?></title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative overflow-hidden">
            <!-- Background with Gradient -->
            <div class="absolute inset-0 bg-gradient-to-br from-sky-50 via-blue-50 to-indigo-50"></div>
            
            <!-- Floating Elements -->
            <div class="floating-elements absolute inset-0"></div>
            
            <!-- Medical Icons Background -->
            <div class="absolute inset-0 opacity-5">
                <svg class="absolute top-10 left-10 w-16 h-16 text-sky-300" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M19 8h-2v3h-3v2h3v3h2v-3h3v-2h-3V8zM4 6h5v2h2V6h1V4H4v2zm0 5h7v2H4v-2zm0 3h7v2H4v-2z"/>
                </svg>
                <svg class="absolute top-20 right-20 w-12 h-12 text-blue-300" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                </svg>
                <svg class="absolute bottom-20 left-20 w-14 h-14 text-cyan-300" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zM12 17c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zM15.1 8H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/>
                </svg>
                <svg class="absolute bottom-10 right-10 w-10 h-10 text-indigo-300" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                </svg>
            </div>
            
            <!-- Content Container -->
            <div class="relative z-10 w-full max-w-md">
                <!-- Logo -->
                <div class="flex justify-center mb-8">
                    <div class="bg-white rounded-2xl p-4 shadow-lg border border-sky-200">
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 bg-gradient-to-br from-sky-500 to-blue-600 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 8h-2v3h-3v2h3v3h2v-3h3v-2h-3V8zM4 6h5v2h2V6h1V4H4v2zm0 5h7v2H4v-2zm0 3h7v2H4v-2z"/>
                                </svg>
                            </div>
                            <span class="text-xl font-bold bg-gradient-to-r from-sky-600 to-blue-600 bg-clip-text text-transparent">ClinivieApp</span>
                        </div>
                    </div>
                </div>

                <!-- Auth Card -->
                <div class="auth-card px-8 py-8 shadow-2xl sm:rounded-2xl border border-white/20 backdrop-blur-sm">
                    <?php echo e($slot); ?>

                </div>
            </div>

            <!-- Footer -->
            <div class="relative z-10 mt-8 text-center">
                <p class="text-sm text-gray-500">
                    © <?php echo e(date('Y')); ?> ClinivieApp. Advanced clinic management system.
                </p>
            </div>
        </div>
    </body>
</html>
<?php /**PATH C:\Users\offh0\Desktop\clinivie\resources\views/layouts/guest.blade.php ENDPATH**/ ?>