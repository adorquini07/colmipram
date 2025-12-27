<x-filament-panels::page>
    <div class="space-y-6">
        {{-- Card Principal del Estudiante --}}
        <x-filament::section>
            <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                <div class="flex-1">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                        {{ $this->record->full_name }}
                    </h2>
                    <div class="flex flex-wrap items-center gap-2 mt-2">
                        @if($this->record->course)
                        <x-filament::badge color="primary" size="lg">
                            📚 {{ $this->record->course->name }} - {{ $this->record->course->grade }}
                        </x-filament::badge>
                        @endif
                        @if($this->record->hasPaidCurrentMonth())
                        <x-filament::badge color="success" size="lg">✅ Al día</x-filament::badge>
                        @else
                        <x-filament::badge color="danger" size="lg">⚠️ Pago Pendiente</x-filament::badge>
                        @endif
                    </div>
                </div>
            </div>
        </x-filament::section>

        {{-- Información Personal y Académica en Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            {{-- Información Personal --}}
            <x-filament::section heading="👤 Información Personal">
                <div class="grid grid-cols-2 gap-4">
                    <div class="p-3 rounded-lg bg-gray-50 dark:bg-white/5">
                        <span class="text-xs text-gray-500 dark:text-gray-400 block">📧 Correo: {{ $this->record->email ?? '—' }}</span>
                    </div>
                    <div class="p-3 rounded-lg bg-gray-50 dark:bg-white/5">
                        <span class="text-xs text-gray-500 dark:text-gray-400 block">📱 Teléfono: {{ $this->record->phone ?? '—' }}</span>
                    </div>
                    <div class="p-3 rounded-lg bg-gray-50 dark:bg-white/5 col-span-2">
                        <span class="text-xs text-gray-500 dark:text-gray-400 block">🎂 Fecha de Nacimiento: {{ $this->record->birth_date?->format('d/m/Y') ?? '—' }}</span>
                    </div>
                </div>
            </x-filament::section>

            {{-- Información Académica --}}
            <x-filament::section heading="🎓 Información Académica">
                <div class="grid grid-cols-2 gap-4">
                    <div class="p-3 rounded-lg bg-gray-50 dark:bg-white/5">
                        <span class="text-xs text-gray-500 dark:text-gray-400 block">📖 Curso: {{ $this->record->course->name ?? '—' }}</span>
                    </div>
                    <div class="p-3 rounded-lg bg-gray-50 dark:bg-white/5">
                        <span class="text-xs text-gray-500 dark:text-gray-400 block">🏫 Grado: {{ $this->record->course->grade ?? '—' }} </span>
                    </div>
                    <div class="p-3 rounded-lg bg-gray-50 dark:bg-white/5 col-span-2">
                        <span class="text-xs text-gray-500 dark:text-gray-400 block">👨‍🏫 Director de Grupo: {{ $this->record->course?->teacher ? $this->record->course->teacher->name . ' ' . $this->record->course->teacher->last_name : '—' }}</span>
                    </div>
                </div>
            </x-filament::section>
        </div>

        {{-- Estado de Pagos en línea --}}
        <x-filament::section heading="💰 Estado de Pagos">
            <div class="grid grid-cols-3 gap-4">
                <div class="text-center p-4 rounded-lg border-2 {{ $this->record->hasPaidCurrentMonth() ? 'border-green-500 bg-green-50 dark:bg-green-500/10' : 'border-red-500 bg-red-50 dark:bg-red-500/10' }}">
                    <span class="text-4xl block mb-1">{{ $this->record->hasPaidCurrentMonth() ? '✅' : '❌' }}</span>
                    <span class="text-xs text-gray-600 dark:text-gray-400 block">{{ $this->getMonthName(now()->month) }} {{ now()->year }}: {{ $this->record->hasPaidCurrentMonth() ? 'PAGADO' : 'PENDIENTE' }}</span>
                </div>

                <div class="text-center p-4 rounded-lg border-2 {{ $this->record->hasPaidEnrollment() ? 'border-green-500 bg-green-50 dark:bg-green-500/10' : 'border-yellow-500 bg-yellow-50 dark:bg-yellow-500/10' }}">
                    <span class="text-4xl block mb-1">{{ $this->record->hasPaidEnrollment() ? '🎓' : '⏳' }}</span>
                    <span class="text-xs text-gray-600 dark:text-gray-400 block">Matrícula: {{ now()->year }} - {{ $this->record->hasPaidEnrollment() ? 'PAGADA' : 'PENDIENTE' }}</span>
                </div>

                <div class="text-center p-4 rounded-lg border-2 border-blue-500 bg-blue-50 dark:bg-blue-500/10">
                    <span class="text-4xl block mb-1">📊</span>
                    <span class="text-xs text-gray-600 dark:text-gray-400 block">Total Pagos: {{ $this->record->payments()->count() }} REGISTROS</span>
                </div>
            </div>
        </x-filament::section>

        {{-- Historial de Pagos como Tabla --}}
        <x-filament::section heading="📜 Historial de Pagos">
            @php
            $payments = $this->record->payments()->orderBy('year', 'desc')->orderBy('month', 'desc')->get();
            @endphp

            @if($payments->isEmpty())
            <div class="text-center py-8">
                <span class="text-5xl block mb-3">💸</span>
                <p class="text-gray-500 dark:text-gray-400">No hay pagos registrados</p>
            </div>
            @else
            <div class="space-y-3">
                @foreach($payments as $payment)
                <div class="flex flex-wrap items-center gap-4 p-4 rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-white/5">
                    {{-- Tipo --}}
                    <div class="w-32">
                        <x-filament::badge :color="$payment->type === 'matricula' ? 'info' : 'success'" size="lg">
                            {{ $payment->type === 'matricula' ? '🎓 Matrícula' : '📆 Mensualidad' }}
                        </x-filament::badge>
                    </div>
                    
                    {{-- Periodo --}}
                    <div class="flex-1 min-w-[120px]">
                        <span class="text-xs text-gray-500 dark:text-gray-400 block">📅 Periodo</span>
                        <span class="font-medium text-gray-900 dark:text-white">{{ $this->getMonthName($payment->month) }} {{ $payment->year }}</span>
                    </div>
                    
                    {{-- Monto --}}
                    <div class="min-w-[100px] text-right">
                        <span class="text-xs text-gray-500 dark:text-gray-400 block">💰 Monto</span>
                        <span class="font-bold text-lg text-green-600 dark:text-green-400">{{ $this->formatMoney($payment->amount) }}</span>
                    </div>
                    
                    {{-- Fecha de Pago --}}
                    <div class="min-w-[100px]">
                        <span class="text-xs text-gray-500 dark:text-gray-400 block">🗓️ Pagado</span>
                        <span class="text-gray-900 dark:text-white">{{ $payment->payment_date->format('d/m/Y') }}</span>
                    </div>
                    
                    {{-- Notas --}}
                    @if($payment->notes)
                    <div class="w-full mt-2 pt-2 border-t border-gray-100 dark:border-gray-700">
                        <span class="text-xs text-gray-500 dark:text-gray-400">📝 {{ $payment->notes }}</span>
                    </div>
                    @endif
                </div>
                @endforeach
                
                {{-- Total --}}
                <div class="flex justify-between items-center p-4 rounded-lg bg-green-50 dark:bg-green-500/10 border-2 border-green-500">
                    <span class="font-bold text-green-700 dark:text-green-300">
                        💵 Total ({{ $payments->count() }} {{ $payments->count() === 1 ? 'pago' : 'pagos' }}):
                    </span>
                    <span class="font-bold text-2xl text-green-600 dark:text-green-400">
                        {{ $this->formatMoney($payments->sum('amount')) }}
                    </span>
                </div>
            </div>
            @endif
        </x-filament::section>
    </div>
</x-filament-panels::page>