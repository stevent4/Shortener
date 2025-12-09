<x-guest-layout>
    <div class="min-h-screen flex flex-col md:flex-row w-full">

        <!-- Kiri: Form (Login/Register) -->
        <div class="w-full md:w-1/2 flex items-center justify-center bg-white p-6 md:p-12">
            <div class="w-full max-w-md">
                
                <!-- Header -->
                <h2 id="form-title" class="text-3xl font-bold text-purple-600 mb-6 flex items-center space-x-2">
                    <span id="form-icon">🔒</span>
                    <span id="form-text">Login</span>
                </h2>

                <!-- Form -->
                <form id="auth-form" method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <!-- Name (only for register) -->
                    <div id="name-field" class="hidden">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full border rounded p-2" type="email" name="email" :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full border rounded p-2"
                                      type="password"
                                      name="password"
                                      required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password (only for register) -->
                    <div id="password-confirm-field" class="hidden">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                        <x-text-input id="password_confirmation" class="block mt-1 w-full border rounded p-2"
                                      type="password" name="password_confirmation" autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <!-- Submit & Toggle -->
                    <div class="flex flex-col md:flex-row items-center justify-between space-y-2 md:space-y-0">
                        <div class="flex space-x-2">
                            <button type="button" id="toggle-form" class="text-sm text-purple-600 hover:underline">
                                Don't have an account? Register
                            </button>
                        </div>
                        <x-primary-button id="submit-btn" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded">
                            Log in
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>

        <!-- Kanan: Info App -->
        <div class="flex w-full md:w-1/2 bg-gradient-to-tr from-purple-200 via-blue-200 to-green-100 items-center justify-center p-6 md:p-12">
            <div class="text-center max-w-lg">
                <h2 class="text-3xl font-bold text-purple-700 mb-4">🚀 Shortener App</h2>
                <p class="text-gray-700 mb-6 text-lg">
                    Buat link pendek dengan mudah, aman, dan cepat.  
                    Bisa privat, password, dan pantau klik link Anda.
                </p>
                <ul class="text-left text-gray-700 space-y-2 text-md">
                    <li>✅ Short link otomatis atau custom code</li>
                    <li>🔒 Private link dengan password</li>
                    <li>⏳ Setting expired date</li>
                    <li>📊 Statistik klik per link</li>
                    <li>🖥 Admin panel untuk manajemen semua link & user</li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        const toggleBtn = document.getElementById('toggle-form');
        const formTitle = document.getElementById('form-text');
        const formIcon = document.getElementById('form-icon');
        const authForm = document.getElementById('auth-form');
        const nameField = document.getElementById('name-field');
        const passwordConfirmField = document.getElementById('password-confirm-field');
        const rememberField = document.getElementById('remember-field');
        const submitBtn = document.getElementById('submit-btn');

        let isLogin = true;

        toggleBtn.addEventListener('click', () => {
            isLogin = !isLogin;

            if (isLogin) {
                // Switch to login
                formTitle.textContent = 'Login';
                formIcon.textContent = '🔒';
                authForm.action = "{{ route('login') }}";
                nameField.classList.add('hidden');
                passwordConfirmField.classList.add('hidden');
                rememberField.classList.remove('hidden');
                submitBtn.textContent = 'Log in';
                toggleBtn.textContent = "Don't have an account? Register";
            } else {
                // Switch to register
                formTitle.textContent = 'Register';
                formIcon.textContent = '📝';
                authForm.action = "{{ route('register') }}";
                nameField.classList.remove('hidden');
                passwordConfirmField.classList.remove('hidden');
                rememberField.classList.add('hidden');
                submitBtn.textContent = 'Register';
                toggleBtn.textContent = "Already have an account? Login";
            }
        });
    </script>
</x-guest-layout>
