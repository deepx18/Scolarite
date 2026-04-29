<x-client.admin-layout :title="__('portal.requests.show.page_title')" activeRoute="requests">
    <!-- Page Header -->
    <x-client.admin-header :title="__('portal.requests.show.header.title')"
        :description="__('portal.requests.show.header.reference', ['reference' => $request->reference])" :breadcrumb="[
        ['label' => __('portal.requests.show.header.breadcrumb.requests'), 'url' => route('requests.index')],
        ['label' => __('portal.requests.show.header.breadcrumb.item', ['reference' => $request->reference])]
    ]">

    </x-client.admin-header>

    <!-- Main Content Section -->
    <div class="grid grid-cols-3 gap-6">
        <!-- Left Column: Request Details -->
        <div class="col-span-2 space-y-6">
            <!-- Request Information Section -->
            <x-client.admin-section :title="__('portal.requests.show.sections.request_information')">
                <div class="grid grid-cols-2 gap-6">
                    <!-- Type -->
                    <div>
                        <label
                            class="text-sm text-on-surface-variant font-semibold block mb-2">{{ __('portal.requests.show.labels.request_type') }}</label>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                                <span class="material-symbols-outlined text-primary">description</span>
                            </div>
                            <span class="text-lg font-semibold text-on-surface">{{ $request->typeLabel() }}</span>
                        </div>
                    </div>

                    <!-- Status -->
                    <div>
                        <label
                            class="text-sm text-on-surface-variant font-semibold block mb-2">{{ __('portal.requests.show.labels.status') }}</label>
                        @php
                            $statusColors = [
                                'approved' => 'bg-green-100 text-green-700',
                                'pending' => 'bg-amber-100 text-amber-700',
                                'rejected' => 'bg-red-100 text-red-700',
                                'in_review' => 'bg-blue-100 text-blue-700',
                            ];
                            $statusColor = $statusColors[$request->status] ?? 'bg-gray-100 text-gray-700';
                        @endphp
                        <span class="inline-block px-4 py-2 rounded-lg font-semibold text-sm {{ $statusColor }}">
                            {{ $request->statusLabel() }}
                        </span>
                    </div>

                    <!-- Submitted Date -->
                    <div>
                        <label
                            class="text-sm text-on-surface-variant font-semibold block mb-2">{{ __('portal.requests.show.labels.submitted_date') }}</label>
                        <p class="text-on-surface">
                            {{ $request->submitted_at?->format('M d, Y') ?? $request->created_at->format('M d, Y') }}
                        </p>
                    </div>

                    <!-- Reviewed Date -->
                    <div>
                        <label
                            class="text-sm text-on-surface-variant font-semibold block mb-2">{{ __('portal.requests.show.labels.reviewed_date') }}</label>
                        <p class="text-on-surface">
                            @if ($request->reviewed_at)
                                {{ $request->reviewed_at->format('M d, Y \a\t h:i A') }}
                            @else
                                <span
                                    class="text-on-surface-variant italic">{{ __('portal.requests.show.timeline.not_yet_reviewed') }}</span>
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Comment Section -->
                @if ($request->comment)
                    <div class="mt-6 pt-6 border-t border-outline-variant/10">
                        <label
                            class="text-sm text-on-surface-variant font-semibold block mb-2">{{ __('portal.requests.show.labels.comments') }}</label>
                        <p class="text-on-surface whitespace-pre-wrap">{{ $request->comment }}</p>
                    </div>
                @endif
                @if ($request->admin_comment)
                    <div class="mt-6 pt-6 border-t border-outline-variant/10">
                        <label
                            class="text-sm text-on-surface-variant font-semibold block mb-2">{{ __('portal.requests.show.labels.admin_comments') }}</label>
                        <p class="text-on-surface whitespace-pre-wrap">{{ $request->admin_comment }}</p>
                    </div>
                @endif
            </x-client.admin-section>

            <!-- Type-Specific Details Section -->
            @if ($request->details && count($request->details) > 0)
                <x-client.admin-section :title="__('portal.requests.show.sections.details', ['type' => $request->typeLabel()])">
                    <div class="space-y-4">
                        @foreach ($request->details as $key => $value)
                            <div class="flex justify-between items-start py-3 border-b border-outline-variant/5 last:border-0">
                                @php
                                    $detailTranslationKey = 'portal.requests.show.detail_fields.' . $key;
                                    $detailLabel = __($detailTranslationKey);
                                @endphp
                                <label class="text-sm text-on-surface-variant font-semibold">
                                    {{ $detailLabel === $detailTranslationKey ? ucfirst(str_replace('_', ' ', $key)) : $detailLabel }}
                                </label>
                                <div class="text-right">
                                    @if (is_bool($value))
                                        <span class="inline-flex items-center gap-2 text-on-surface font-medium">
                                            <span
                                                class="material-symbols-outlined {{ $value ? 'text-green-600' : 'text-red-600' }}">
                                                {{ $value ? 'check_circle' : 'cancel' }}
                                            </span>
                                            {{ $value ? __('portal.common.yes') : __('portal.common.no') }}
                                        </span>
                                    @elseif (is_array($value))
                                        <span class="text-on-surface">{{ implode(', ', $value) }}</span>
                                    @else
                                        <span class="text-on-surface">{{ $value }}</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </x-client.admin-section>
            @endif
            
        </div>

        <!-- Right Column: Sidebar -->
        <div class="col-span-1 space-y-6">
            <!-- Student Information Card -->
            <x-client.admin-section :title="__('portal.requests.show.sections.student_information')">
                <div class="space-y-4">
                    <div>
                        <label
                            class="text-xs text-on-surface-variant font-semibold block mb-1">{{ __('portal.requests.show.labels.name') }}</label>
                        <p class="text-on-surface font-medium">
                            {{ $request->student->first_name }} {{ $request->student->last_name }}
                        </p>
                    </div>

                    @if ($request->student->apogee_number)
                        <div>
                            <label
                                class="text-xs text-on-surface-variant font-semibold block mb-1">{{ __('portal.requests.show.labels.apogee_number') }}</label>
                            <p class="text-on-surface font-mono">{{ $request->student->apogee_number }}</p>
                        </div>
                    @endif

                    @if ($request->student->email)
                        <div>
                            <label
                                class="text-xs text-on-surface-variant font-semibold block mb-1">{{ __('portal.requests.show.labels.email') }}</label>
                            <p class="text-on-surface break-all">{{ $request->student->email }}</p>
                        </div>
                    @endif

                    @if ($request->student->department)
                        <div>
                            <label
                                class="text-xs text-on-surface-variant font-semibold block mb-1">{{ __('portal.requests.show.labels.department') }}</label>
                            <p class="text-on-surface">{{ $request->student->department }}</p>
                        </div>
                    @endif
                </div>
            </x-client.admin-section>

            <!-- Timeline Card -->
            <x-client.admin-section :title="__('portal.requests.show.sections.timeline')">
                <div class="space-y-4 relative">
                    <!-- Submitted -->
                    <div class="flex gap-4">
                        <div class="flex flex-col items-center">
                            <div class="w-3 h-3 rounded-full bg-primary"></div>
                            <div class="w-0.5 h-8 bg-outline-variant/20 mt-2"></div>
                        </div>
                        <div>
                            <p class="text-xs text-on-surface-variant font-semibold">
                                {{ __('portal.requests.show.timeline.submitted') }}</p>
                            <p class="text-on-surface text-sm">
                                {{ $request->submitted_at?->format('M d, Y') ?? $request->created_at->format('M d, Y') }}
                            </p>
                        </div>
                    </div>

                    <!-- Reviewed (if applicable) -->
                    @if ($request->reviewed_at)
                        <div class="flex gap-4">
                            <div class="flex flex-col items-center">
                                <div class="w-3 h-3 rounded-full bg-primary"></div>
                            </div>
                            <div>
                                <p class="text-xs text-on-surface-variant font-semibold">
                                    {{ __('portal.requests.show.timeline.reviewed') }}</p>
                                <p class="text-on-surface text-sm">
                                    {{ $request->reviewed_at->format('M d, Y \a\t h:i A') }}
                                </p>
                            </div>
                        </div>
                    @else
                        <div class="flex gap-4">
                            <div class="flex flex-col items-center">
                                <div class="w-3 h-3 rounded-full bg-outline-variant/30"></div>
                            </div>
                            <div>
                                <p class="text-xs text-on-surface-variant font-semibold">
                                    {{ __('portal.requests.show.timeline.pending_review') }}</p>
                                <p class="text-on-surface-variant text-sm">
                                    {{ __('portal.requests.show.timeline.awaiting_review') }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </x-client.admin-section>
        </div>
    </div>
</x-client.admin-layout>