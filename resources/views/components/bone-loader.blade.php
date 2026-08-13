@props([
    'id' => 'bone-loader',
    'label' => 'Memuat data...',
    'duration' => 900,
])

<div id="{{ $id }}" class="bone-loader">
    <div class="bl-inner">
        <div class="bl-logo">
            <svg fill="none" viewBox="0 0 16 16" stroke="currentColor" stroke-width="1.5">
                <path d="M8 1L1 5v10h14V5z"/>
                <path d="M5 15V9h6v6"/>
            </svg>
        </div>
        <div class="bl-skeleton">
            <div class="bl-bar bl-bar-lg"></div>
            <div class="bl-bar bl-bar-md"></div>
            <div class="bl-bar bl-bar-sm"></div>
            <div class="bl-bar bl-bar-xs"></div>
        </div>
        <p class="bl-label">
            <span class="bl-dot"></span>
            {{ $label }}
        </p>
    </div>
</div>

<style>
#{{ $id }}.bone-loader {
    position: fixed; inset: 0; z-index: 9999;
    background: #f9fafb;
    display: flex; align-items: center; justify-content: center;
    transition: opacity .45s ease, visibility .45s ease;
}
#{{ $id }}.bone-loader.bl-hidden {
    opacity: 0; visibility: hidden; pointer-events: none;
}
.bl-inner { width: min(320px, 82vw); }
.bl-logo {
    width: 52px; height: 52px; margin: 0 auto 22px;
    background: #2563eb; border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    color: #fff; box-shadow: 0 8px 24px rgba(37,99,235,.35);
    animation: bl-pulse 1.4s ease-in-out infinite;
}
.bl-logo svg { width: 26px; height: 26px; }
@keyframes bl-pulse {
    0%,100% { transform: scale(1); box-shadow: 0 8px 24px rgba(37,99,235,.35); }
    50%     { transform: scale(1.06); box-shadow: 0 12px 32px rgba(37,99,235,.5); }
}
.bl-skeleton { display: flex; flex-direction: column; gap: 10px; margin-bottom: 24px; }
.bl-bar {
    height: 12px; border-radius: 8px;
    background: linear-gradient(90deg, #e5e7eb 25%, #f3f4f6 50%, #e5e7eb 75%);
    background-size: 200% 100%;
    animation: bl-shimmer 1.3s ease-in-out infinite;
    position: relative; overflow: hidden;
}
.bl-bar::after {
    content: ''; position: absolute; top: 0; bottom: 0; width: 60px;
    background: linear-gradient(90deg, transparent, rgba(59,130,246,.25), transparent);
    animation: bl-sweep 1.3s ease-in-out infinite;
}
@keyframes bl-shimmer { 0% { background-position: 200% 0; } 100% { background-position: -200% 0; } }
@keyframes bl-sweep { 0% { left: -60px; } 100% { left: 110%; } }
.bl-bar-lg { width: 100%; height: 14px; }
.bl-bar-md { width: 82%; height: 12px; }
.bl-bar-sm { width: 64%; height: 10px; }
.bl-bar-xs { width: 48%; height: 10px; }
.bl-label {
    display: flex; align-items: center; justify-content: center; gap: 8px;
    font-family: 'Inter', system-ui, sans-serif;
    font-size: .82rem; font-weight: 500; color: #6b7280;
}
.bl-dot {
    width: 7px; height: 7px; border-radius: 50%;
    background: #3b82f6;
    animation: bl-dot 1s ease-in-out infinite;
}
@keyframes bl-dot {
    0%,100% { opacity: 1; transform: scale(1); }
    50%     { opacity: .35; transform: scale(.7); }
}
</style>

<script>
(function () {
    var el = document.getElementById('{{ $id }}');
    if (!el) return;
    window.addEventListener('load', function () {
        setTimeout(function () {
            el.classList.add('bl-hidden');
        }, {{ $duration }});
    });
    // Fallback: pastikan ga nempel selamanya kalau load event udah lewat
    setTimeout(function () {
        if (document.readyState === 'complete') el.classList.add('bl-hidden');
    }, {{ $duration }} + 600);
})();
</script>
