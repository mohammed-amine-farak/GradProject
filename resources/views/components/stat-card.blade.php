{{-- resources/views/components/stat-card.blade.php --}}
<div class="stat-card animate-in" style="animation-delay: {{ $delay }}s">
    <div class="stat-header">
        <div class="stat-icon">
            <i class="fas {{ $icon }}"></i>
        </div>
    </div>
    <div class="stat-value">{{ $value }}</div>
    <div class="stat-label">{{ $label }}</div>
    <div class="stat-change trend-up">
        {!! $change !!}
    </div>
</div>