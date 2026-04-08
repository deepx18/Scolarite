<x-client.app-layout title="Request Details" activeRoute="requests">
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h1 class="text-3xl font-bold text-on-surface mb-2">Request Details</h1>
                <p class="text-secondary">Reference: <span class="font-mono font-semibold text-primary">{{ $request->reference }}</span></p>
            </div>
            <a href="{{ route('requests.index') }}" class="text-primary hover:text-primary/80 flex items-center gap-2">
                <span class="material-symbols-outlined">arrow_back</span>
                Back to Requests
            </a>
        </div>
    </div>

    <!-- Main Content Section -->
    <div class="grid grid-cols-3 gap-6">
        <!-- Left Column: Request Details -->
        <div class="col-span-2 space-y-6">
            <!-- Core Details Card -->
            <div class="bg-surface-container-lowest rounded-2xl p-8 shadow-sm border border-outline-variant/10">
                <h2 class="text-xl font-bold text-on-surface mb-6">Request Information</h2>
                
                <div class="grid grid-cols-2 gap-6">
                    <!-- Type -->
                    <div>
                        <label class="text-sm text-secondary font-semibold block mb-2">Request Type</label>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                                <span class="material-symbols-outlined text-primary">description</span>
                            </div>
                            <span class="text-lg font-semibold text-on-surface">{{ $request->typeLabel() }}</span>
                        </div>
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="text-sm text-secondary font-semibold block mb-2">Status</label>
                        @php
                            $statusColors = [
                                'approved' => 'bg-green-100 text-green-700',
                                'pending' => 'bg-amber-100 text-amber-700',
                                'rejected' => 'bg-red-100 text-red-700',
                                'in_review' => 'bg-blue-100 text-blue-700',
                                'archived' => 'bg-gray-100 text-gray-700',
                            ];
                            $statusColor = $statusColors[$request->status] ?? 'bg-gray-100 text-gray-700';
                        @endphp
                        <span class="inline-block px-4 py-2 rounded-lg font-semibold text-sm {{ $statusColor }}">
                            {{ $request->statusLabel() }}
                        </span>
                    </div>

                    <!-- Submitted Date -->
                    <div>
                        <label class="text-sm text-secondary font-semibold block mb-2">Submitted Date</label>
                        <p class="text-on-surface">{{ $request->submitted_at?->format('M d, Y') ?? $request->created_at->format('M d, Y') }}</p>
                    </div>

                    <!-- Reviewed Date -->
                    <div>
                        <label class="text-sm text-secondary font-semibold block mb-2">Reviewed Date</label>
                        <p class="text-on-surface">
                            @if ($request->reviewed_at)
                                {{ $request->reviewed_at->format('M d, Y \a\t h:i A') }}
                            @else
                                <span class="text-secondary italic">Not yet reviewed</span>
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Comment Section -->
                @if ($request->comment)
                    <div class="mt-6 pt-6 border-t border-outline-variant/10">
                        <label class="text-sm text-secondary font-semibold block mb-2">Comments</label>
                        <p class="text-on-surface whitespace-pre-wrap">{{ $request->comment }}</p>
                    </div>
                @endif
            </div>

            <!-- Type-Specific Details Card -->
            @if ($request->details && count($request->details) > 0)
                <div class="bg-surface-container-lowest rounded-2xl p-8 shadow-sm border border-outline-variant/10">
                    <h2 class="text-xl font-bold text-on-surface mb-6">{{ $request->typeLabel() }} Details</h2>
                    
                    <div class="space-y-4">
                        @foreach ($request->details as $key => $value)
                            <div class="flex justify-between items-start py-3 border-b border-outline-variant/5 last:border-0">
                                <label class="text-sm text-secondary font-semibold">
                                    {{ ucfirst(str_replace('_', ' ', $key)) }}
                                </label>
                                <div class="text-right">
                                    @if (is_bool($value))
                                        <span class="inline-flex items-center gap-2 text-on-surface font-medium">
                                            <span class="material-symbols-outlined {{ $value ? 'text-green-600' : 'text-red-600' }}">
                                                {{ $value ? 'check_circle' : 'cancel' }}
                                            </span>
                                            {{ $value ? 'Yes' : 'No' }}
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
                </div>
            @endif
        </div>

        <!-- Right Column: Sidebar -->
        <div class="col-span-1 space-y-6">
            <!-- Student Information Card -->
            <div class="bg-surface-container-lowest rounded-2xl p-6 shadow-sm border border-outline-variant/10">
                <h3 class="text-lg font-bold text-on-surface mb-4">Student Information</h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="text-xs text-secondary font-semibold block mb-1">Name</label>
                        <p class="text-on-surface font-medium">
                            {{ $request->student->first_name }} {{ $request->student->last_name }}
                        </p>
                    </div>
                    
                    @if ($request->student->apogee_number)
                        <div>
                            <label class="text-xs text-secondary font-semibold block mb-1">APOGEE Number</label>
                            <p class="text-on-surface font-mono">{{ $request->student->apogee_number }}</p>
                        </div>
                    @endif

                    @if ($request->student->email)
                        <div>
                            <label class="text-xs text-secondary font-semibold block mb-1">Email</label>
                            <p class="text-on-surface break-all">{{ $request->student->email }}</p>
                        </div>
                    @endif

                    @if ($request->student->department)
                        <div>
                            <label class="text-xs text-secondary font-semibold block mb-1">Department</label>
                            <p class="text-on-surface">{{ $request->student->department }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Timeline Card -->
            <div class="bg-surface-container-lowest rounded-2xl p-6 shadow-sm border border-outline-variant/10">
                <h3 class="text-lg font-bold text-on-surface mb-4">Timeline</h3>
                
                <div class="space-y-4 relative">
                    <!-- Submitted -->
                    <div class="flex gap-4">
                        <div class="flex flex-col items-center">
                            <div class="w-3 h-3 rounded-full bg-primary"></div>
                            <div class="w-0.5 h-8 bg-outline-variant/20 mt-2"></div>
                        </div>
                        <div>
                            <p class="text-xs text-secondary font-semibold">SUBMITTED</p>
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
                                <p class="text-xs text-secondary font-semibold">REVIEWED</p>
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
                                <p class="text-xs text-secondary font-semibold">PENDING REVIEW</p>
                                <p class="text-secondary text-sm">Awaiting administrator review</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-client.app-layout>
