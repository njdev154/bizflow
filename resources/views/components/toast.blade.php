@props(['status' => session('status')])

@if ($status)
    <div
        x-data="{
            show: true,
            duration: 3000,
            progress: 0,
            start() {
                const startTime = Date.now();
                const tick = () => {
                    if (!this.show) return;
                    const elapsed = Date.now() - startTime;
                    this.progress = Math.min((elapsed / this.duration) * 100, 100);
                    if (this.progress >= 100) {
                        this.show = false;
                    } else {
                        requestAnimationFrame(tick);
                    }
                };
                requestAnimationFrame(tick);
            }
        }"
        x-init="start()"
        x-show="show"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="fixed top-6 right-6 z-50"
        style="display: none;"
    >
        <div class="flex items-center gap-3 bg-surface border border-border rounded-xl shadow-lg px-4 py-3 max-w-sm">
            <div class="relative w-8 h-8 shrink-0">
                <svg class="w-8 h-8 -rotate-90" viewBox="0 0 36 36">
                    <circle cx="18" cy="18" r="15.9155" fill="none" stroke="#E8F7EE" stroke-width="3"></circle>
                    <circle cx="18" cy="18" r="15.9155" fill="none" stroke="#16A34A" stroke-width="3"
                            stroke-dasharray="100" :stroke-dashoffset="100 - progress"
                            stroke-linecap="round"></circle>
                </svg>
                <svg class="absolute inset-0 m-auto w-4 h-4 text-success" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <p class="text-sm font-medium text-ink flex-1">{{ $status }}</p>
            <button @click="show = false" class="text-xs font-semibold text-muted hover:text-ink">OK</button>
        </div>
    </div>
@endif
