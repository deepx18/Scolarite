<x-client.admin-layout :title="__('portal.profile.page_title')" activeRoute="profile">

    <!-- Page Header -->
    <x-client.admin-header :title="__('portal.profile.header.title')"
        :description="__('portal.profile.header.description')" :breadcrumb="[
        ['label' => __('portal.profile.header.breadcrumb.portal'), 'url' => route('profile.show')],
        ['label' => __('portal.profile.header.breadcrumb.current')]
    ]" />

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Profile Sidebar -->
        <div class="lg:col-span-1">
            <!-- Profile Card -->
            <x-client.admin-section class="p-6">
                <div class="text-center">
                    <div class="mb-4 flex justify-center">
                        
                        <img 
                        src="https://ui-avatars.com/api/?name={{ urlencode(auth('student')->user()->first_name . " " . auth('student')->user()->last_name) }}&background=002045&color=ffffff&size=128" 
                            alt="{{ __('portal.profile.page_title') }}"
                            class="w-28 h-28 rounded-full object-cover ring-6 ring-primary/10 shadow-lg" />
                    </div>
                    <h2 class="text-xl md:text-2xl font-headline font-bold text-primary mb-1">
                        {{ auth('student')->user()->first_name . " " . auth('student')->user()->last_name }}</h2>
                    <p class="text-sm text-on-surface-variant font-body mb-4">
                        {{ auth('student')->user()->email ?? __('portal.profile.sidebar.fallback_email') }}</p>
                    <p class="text-xs font-headline font-bold text-secondary-container uppercase tracking-wider">
                        {{ __('portal.profile.sidebar.active_student') }}</p>
                </div>
                {{-- <div class="mt-6 pt-6 border-t border-outline-variant/20">
                    <x-client.admin-button variant="tonal" icon="photo_camera"
                        class="w-full justify-center rounded-full shadow-sm py-3">
                        {{ __('portal.profile.sidebar.edit_profile_picture') }}
                    </x-client.admin-button>
                </div> --}}
            </x-client.admin-section>
        </div>

        <!-- Profile Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Personal Information -->
            <x-client.admin-section :title="__('portal.profile.personal.title')"
                :description="__('portal.profile.personal.description')">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label
                            class="block text-xs font-headline font-bold text-on-surface-variant uppercase tracking-wider mb-2">{{ __('portal.profile.personal.first_name') }}</label>
                        <p class="text-on-surface font-body">
                            {{ auth('student')->user()->first_name ?? __('portal.profile.personal.fallback_first_name') }}
                        </p>
                    </div>
                    <div>
                        <label
                            class="block text-xs font-headline font-bold text-on-surface-variant uppercase tracking-wider mb-2">{{ __('portal.profile.personal.last_name') }}</label>
                        <p class="text-on-surface font-body">
                            {{ auth('student')->user()->last_name ?? __('portal.profile.personal.fallback_last_name') }}
                        </p>
                    </div>
                    <div>
                        <label
                            class="block text-xs font-headline font-bold text-on-surface-variant uppercase tracking-wider mb-2">{{ __('portal.profile.personal.email') }}</label>
                        <p class="text-on-surface font-body">
                            {{ auth('student')->user()->email ?? __('portal.profile.personal.fallback_email') }}</p>
                    </div>
                    <div>
                        <label
                            class="block text-xs font-headline font-bold text-on-surface-variant uppercase tracking-wider mb-2">{{ __('portal.profile.personal.phone') }}</label>
                        <p class="text-on-surface font-body">
                            {{ auth('student')->user()->phone ?? __('portal.profile.personal.fallback_phone') }}</p>
                    </div>
                </div>
                {{-- <div class="mt-6 pt-6 border-t border-outline-variant/20">
                    <x-client.admin-button variant="tonal" icon="edit" href="#" size="sm"
                        class="rounded-full shadow-sm px-5 py-2">
                        {{ __('portal.profile.personal.edit_information') }}
                    </x-client.admin-button>
                </div> --}}
            </x-client.admin-section>

            <!-- Academic Information -->
            <x-client.admin-section :title="__('portal.profile.academic.title')"
                :description="__('portal.profile.academic.description')">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label
                            class="block text-xs font-headline font-bold text-on-surface-variant uppercase tracking-wider mb-2">{{ __('portal.profile.academic.student_id') }}</label>
                        <p class="text-on-surface font-body font-mono">STU-2024-0847</p>
                    </div>
                    <div>
                        <label
                            class="block text-xs font-headline font-bold text-on-surface-variant uppercase tracking-wider mb-2">{{ __('portal.profile.academic.program') }}</label>
                        <p class="text-on-surface font-body">{{ __('portal.profile.academic.program_value') }}</p>
                    </div>
                    <div>
                        <label
                            class="block text-xs font-headline font-bold text-on-surface-variant uppercase tracking-wider mb-2">{{ __('portal.profile.academic.current_gpa') }}</label>
                        <p class="text-on-surface font-body font-bold text-primary">3.85 / 4.0</p>
                    </div>
                    <div>
                        <label
                            class="block text-xs font-headline font-bold text-on-surface-variant uppercase tracking-wider mb-2">{{ __('portal.profile.academic.enrollment_date') }}</label>
                        <p class="text-on-surface font-body">{{ __('portal.profile.academic.enrollment_date_value') }}
                        </p>
                    </div>
                    <div>
                        <label
                            class="block text-xs font-headline font-bold text-on-surface-variant uppercase tracking-wider mb-2">{{ __('portal.profile.academic.expected_graduation') }}</label>
                        <p class="text-on-surface font-body">
                            {{ __('portal.profile.academic.expected_graduation_value') }}</p>
                    </div>
                    <div>
                        <label
                            class="block text-xs font-headline font-bold text-on-surface-variant uppercase tracking-wider mb-2">{{ __('portal.profile.academic.academic_standing') }}</label>
                        <span
                            class="inline-block px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700">{{ __('portal.profile.academic.academic_standing_value') }}</span>
                    </div>
                </div>
            </x-client.admin-section>

            <!-- Contact Information -->
            <x-client.admin-section :title="__('portal.profile.contact.title')"
                :description="__('portal.profile.contact.description')">
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label
                            class="block text-xs font-headline font-bold text-on-surface-variant uppercase tracking-wider mb-2">{{ __('portal.profile.contact.mailing_address') }}</label>
                        <p class="text-on-surface font-body">
                            {{ auth('student')->user()->address ?? __('portal.profile.contact.fallback_address') }}</p>
                    </div>
                    <div>
                        <label
                            class="block text-xs font-headline font-bold text-on-surface-variant uppercase tracking-wider mb-2">{{ __('portal.profile.contact.emergency_contact') }}</label>
                        <p class="text-on-surface font-body">
                            {{ auth('student')->user()->emergency_contact ?? __('portal.profile.contact.fallback_emergency_contact') }}
                        </p>
                    </div>
                </div>
                {{-- <div class="mt-6 pt-6 border-t border-outline-variant/20">
                    <x-client.admin-button variant="tonal" icon="edit" href="#" size="sm">
                        {{ __('portal.profile.contact.edit_contact_info') }}
                    </x-client.admin-button>
                </div> --}}
            </x-client.admin-section>

            {{-- <!-- Account Actions -->
            <x-client.admin-section :title="__('portal.profile.account.title')"
                :description="__('portal.profile.account.description')">
                <div class="space-y-3 flex flex-col">
                    <x-client.admin-button variant="outlined" icon="file_download" href="#" class="justify-start">
                        {{ __('portal.profile.account.download_my_data') }}
                    </x-client.admin-button>
                    <x-client.admin-button variant="outlined" icon="delete_outline" href="#"
                        class="justify-start text-error hover:text-error">
                        {{ __('portal.profile.account.deactivate_account') }}
                    </x-client.admin-button>
                </div>
            </x-client.admin-section> --}}
        </div>
    </div>

</x-client.admin-layout>