<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gradient-to-r from-purple-500 to-indigo-600 rounded-lg shadow-lg p-6 text-white mb-6">
                <h1 class="text-3xl font-bold mb-2">Admin Dashboard - {{ auth()->user()->name }}</h1>
                <p class="text-purple-100">System administration and management</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-lg p-6">
                        <h3 class="text-lg font-semibold mb-4">System Overview</h3>
                        <!-- Admin-specific content -->
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold mb-4">Admin Actions</h3>
                        <div class="space-y-3">
                            <button class="w-full bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                                Manage Users
                            </button>
                            <button class="w-full bg-orange-600 text-white px-4 py-2 rounded-lg hover:bg-orange-700">
                                System Settings
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


