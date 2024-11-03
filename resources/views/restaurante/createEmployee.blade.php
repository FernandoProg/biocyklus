<x-guest-layout>
    <form method="POST" action="{{ route('restaurante.storeEmployee') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nombre')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Correo')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="cargo" :value="__('Cargo')" />
            <x-text-input id="cargo" class="block mt-1 w-full" type="text" name="cargo" :value="old('cargo')" required autocomplete="cargo" />
            <x-input-error :messages="$errors->get('cargo')" class="mt-2" />
        </div>

        <x-text-input id="role" type="text" name="role" value="empleado" required autocomplete="empleado" hidden/>

        <div class="flex items-center justify-end mt-4">

            <x-primary-button class="ms-4">
                {{ __('Registrar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

