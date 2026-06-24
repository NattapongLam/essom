<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-tr from-slate-50 via-gray-100 to-indigo-50 px-4 sm:px-6 lg:px-8 py-12">
        
        <div class="w-full sm:max-w-md text-center mb-8">
            <img src="{{ asset('img/logo-essom.png') }}" class="mx-auto" style="width: 165px;" alt="Essom Logo">
            <h2 class="mt-6 text-3xl font-bold tracking-tight text-gray-900">
                เข้าสู่ระบบใช้งาน
            </h2>
            <p class="mt-2 text-base text-gray-500">
                ยินดีต้อนรับกลับมา กรุณากรอกข้อมูลของคุณ
            </p>
        </div>

        <div class="w-full sm:max-w-md bg-white shadow-2xl border border-gray-100 rounded-2xl px-8 py-10 sm:px-10">
            
            <x-auth-session-status class="mb-5 text-base" :status="session('status')" />

            <x-auth-validation-errors class="mb-5 text-base" :errors="$errors" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div>
                    <x-label for="email" :value="__('อีเมล')" class="text-sm font-semibold text-gray-700 tracking-wide uppercase mb-2 block" />
                    <div class="relative rounded-md shadow-sm">
                        <x-input id="email" class="block w-full rounded-xl border-gray-300 py-3.5 px-4 text-gray-900 placeholder-gray-400 focus:border-indigo-500 focus:ring-indigo-500 text-base transition-all" type="email" name="email" :value="old('email')" required autofocus placeholder="name@company.com" />
                    </div>
                </div>

                <div>
                    <x-label for="password" :value="__('รหัสผ่าน')" class="text-sm font-semibold text-gray-700 tracking-wide uppercase mb-2 block" />
                    <div class="relative rounded-md shadow-sm">
                        <x-input id="password" class="block w-full rounded-xl border-gray-300 py-3.5 px-4 text-gray-900 placeholder-gray-400 focus:border-indigo-500 focus:ring-indigo-500 text-base transition-all"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" placeholder="••••••••" />
                    </div>
                </div>

                <div class="flex items-center justify-between pt-2">
                    <div class="flex items-center">
                        <input id="remember_me" type="checkbox" class="h-4.5 w-4.5 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 transition cursor-pointer" name="remember">
                        <label for="remember_me" class="ml-2 block text-base text-gray-600 cursor-pointer select-none">
                            {{ __('จำฉันไว้ในระบบ') }}
                        </label>
                    </div>

                    {{-- @if (Route::has('password.request'))
                        <a class="text-base font-semibold text-indigo-600 hover:text-indigo-500 transition-colors" href="{{ route('password.request') }}">
                            {{ __('ลืมรหัสผ่าน?') }}
                        </a>
                    @endif --}}
                </div>

                <div class="pt-4">
                    <x-button class="w-full justify-center items-center rounded-xl bg-indigo-600 py-4 px-4 text-center text-lg font-bold text-white shadow-lg shadow-indigo-600/20 hover:bg-indigo-500 active:scale-[0.97] transition-all duration-150 touch-manipulation block style-button">
                        {{ __('เข้าสู่ระบบ') }}
                    </x-button>
                </div>
            </form>
        </div>
        
        <p class="mt-10 text-center text-xs text-gray-400">
            &copy; {{ date('Y') }} ESSOM Co., Ltd. All rights reserved.
        </p>
    </div>

    <style>
        .style-button {
            background-color: #4f46e5 !important;
            color: #ffffff !important;
            display: flex !important;
            width: 100% !important;
        }
        .style-button:hover {
            background-color: #4338ca !important;
        }
    </style>
</x-guest-layout>