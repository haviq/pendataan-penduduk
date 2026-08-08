<x-filament-widgets::widget>
    <x-filament::section>
        <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px;">
            <div>
                <p style="font-size: 1.125rem; font-weight: 600; margin: 0;">
                    {{ $this->getGreeting() }}, {{ auth()->user()->name }} 👋
                </p>
                <p style="font-size: 0.875rem; color: #6b7280; margin: 4px 0 0 0;">
                    {{ $this->getFormattedDate() }}
                </p>
            </div>

            <div
                x-data="{ time: '' }"
                x-init="
                    const update = () => {
                        const now = new Date();
                        time = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
                    };
                    update();
                    setInterval(update, 1000);
                "
                style="font-size: 1.5rem; font-weight: 700; font-variant-numeric: tabular-nums; color: #059669;"
            >
                <span x-text="time"></span> WIB
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>