<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Profile Avatar') }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-600">
                        {{ __("Update your profile avatar.") }}
                    </p>
                    <div class="col-md-4 mt-6 space-y-6">
                        <img src="{{ asset($user->avatar) }}" class="img-thumbnail" alt="{{ $user->name }}'s Avatar">
                    </div>
                    <form action="{{ route('profile.upload-photo') }}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-6">
                        @csrf
                        <div class="mb-3">
                            <label for="avatar" class="form-label">Load Avatar</label>
                            <input type="file" class="form-control" id="avatar" name="photo" required>
                        </div>
                        <x-primary-button>{{ __('Upload') }}</x-primary-button>
                    </form>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
