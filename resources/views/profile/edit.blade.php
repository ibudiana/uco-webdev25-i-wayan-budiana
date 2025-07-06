@extends('layouts.admin')

{{-- Meta Section --}}
@section('meta')
        <x-meta title="Edit Profile" description="Edit your profile information"/>
@endsection

{{-- Home Content --}}
@section('content')

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-gray-50 dark:bg-gray-900 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                @if (Auth::user()->hasRole('admin'))
                    <div class="p-4 sm:p-8 bg-gray-50 dark:bg-gray-900 shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('profile.partials.payment-methode-form')
                        </div>
                    </div>
                @endif

                <div class="p-4 sm:p-8 bg-gray-50 dark:bg-gray-900 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.shipping-addresse')
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-gray-50 dark:bg-gray-900 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-gray-50 dark:bg-gray-900 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
