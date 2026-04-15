@props(['request'])

@php
    $statusConfig = [
        'approved' => ['bg' => 'bg-green-100', 'text' => 'text-green-700', 'border' => 'border-green-200', 'icon' => 'verified'],
        'pending' => ['bg' => 'bg-amber-100', 'text' => 'text-amber-700', 'border' => 'border-amber-200', 'icon' => 'pending'],
        'rejected' => ['bg' => 'bg-red-100', 'text' => 'text-red-700', 'border' => 'border-red-200', 'icon' => 'cancel'],
        'in_review' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-700', 'border' => 'border-blue-200', 'icon' => 'schedule'],
        'archived' => ['bg' => 'bg-gray-100', 'text' => 'text-gray-700', 'border' => 'border-gray-200', 'icon' => 'archive'],
    ];

    $typeConfig = [
        'transfer' => ['bg' => 'bg-blue-50', 'icon' => 'compare_arrows', 'color' => 'text-blue-700'],
        'withdrawal' => ['bg' => 'bg-red-50', 'icon' => 'close', 'color' => 'text-red-700'],
        'transcript' => ['bg' => 'bg-purple-50', 'icon' => 'description', 'color' => 'text-purple-700'],
        'leave' => ['bg' => 'bg-amber-50', 'icon' => 'event_available', 'color' => 'text-amber-700'],
        'appeal' => ['bg' => 'bg-green-50', 'icon' => 'verification', 'color' => 'text-green-700'],
        'extension' => ['bg' => 'bg-indigo-50', 'icon' => 'schedule', 'color' => 'text-indigo-700'],
        'accommodation' => ['bg' => 'bg-cyan-50', 'icon' => 'accessibility', 'color' => 'text-cyan-700'],
        'enrollment_certificate' => ['bg' => 'bg-fuchsia-50', 'icon' => 'school', 'color' => 'text-fuchsia-700'],
        'diploma' => ['bg' => 'bg-slate-50', 'icon' => 'badge', 'color' => 'text-slate-700'],
        'student_card' => ['bg' => 'bg-lime-50', 'icon' => 'badge', 'color' => 'text-lime-700'],
        'financial_aid' => ['bg' => 'bg-emerald-50', 'icon' => 'paid', 'color' => 'text-emerald-700'],
        'other' => ['bg' => 'bg-gray-50', 'icon' => 'help_outline', 'color' => 'text-gray-700'],
    ];

    $statusStyle = $statusConfig[$request->status] ?? $statusConfig['pending'];
    $typeStyle = $typeConfig[$request->type] ?? $typeConfig['transfer'];
@endphp

<tr class="group hover:bg-surface-container-lowest transition-colors border-b border-outline-variant/5">
    <td class="px-8 py-5 font-mono text-primary font-semibold">{{ $request->reference }}</td>
    <td class="px-6 py-5">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg {{ $typeStyle['bg'] }} flex items-center justify-center">
                <span
                    class="material-symbols-outlined {{ $typeStyle['color'] }} text-lg">{{ $typeStyle['icon'] }}</span>
            </div>
            <span class="font-medium">{{ $request->typeLabel() }}</span>
        </div>
    </td>
    <td class="px-6 py-5 text-secondary">
        {{ $request->submitted_at?->format('M d, Y') ?? $request->created_at->format('M d, Y') }}</td>
    <td class="px-6 py-5">
        <div class="flex justify-center">
            <span
                class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider {{ $statusStyle['bg'] }} {{ $statusStyle['text'] }} border {{ $statusStyle['border'] }}">
                {{ $request->statusLabel() }}
            </span>
        </div>
    </td>
    <td class="px-8 py-5 text-right">
        <a href="{{ route('requests.show', $request) }}" class="text-primary hover:text-primary/80 transition-colors"
            aria-label="View Request Details">
            <span class="material-symbols-outlined">visibility</span>
        </a>
    </td>
</tr>