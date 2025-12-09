@extends('layouts.app', ['title' => 'Password'])

@section('content')
    <div class="flex items-center justify-center">
        <div class="">


            <!-- Icon Fun -->
            <div class="text-5xl animate-bounce text-center">🔐</div>

            <!-- Header -->
            <h1 class="text-xl sm:text-2xl font-extrabold text-purple-600 text-center">Masukkan Password</h1>
            <p class="text-gray-600 text-sm sm:text-base text-center">
                Untuk membuka link ini, masukkan password yang benar
            </p>

            <!-- Error -->
            @error('password')
                <div class="bg-red-100 text-red-700 px-4 py-2 rounded-full text-sm animate-fadeIn">
                    {{ $message }}
                </div>
            @enderror

            <!-- Form -->
            <form method="POST" action="{{ url($link->short_code) }}" class="flex flex-col space-y-3">
                @csrf
                <input type="password" name="password" placeholder="Password"
                    class="w-full border border-gray-300 rounded-full px-4 py-2 text-sm sm:text-base
                       focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-transparent transition" />

                <button type="submit"
                    class="w-full bg-purple-500 hover:bg-purple-600 text-white font-semibold px-4 py-2 rounded-full shadow-md
                       transition transform hover:-translate-y-0.5">
                    🔑 Unlock
                </button>
            </form>

            <!-- Fun Footer Text -->
            <p class="text-gray-500 text-xs mt-2 text-center">
                🔒 Safe & fun. No stress, just secret links!
            </p>

        </div>
    </div>
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.5s ease-out forwards;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .animate-bounce {
            animation: bounce 1.5s infinite;
        }
    </style>
@endsection
