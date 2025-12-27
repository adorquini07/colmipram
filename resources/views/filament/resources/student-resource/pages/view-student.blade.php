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
                    <span class="text-xs text-gray-600 dark:text-gray-400 block">{{ $this->getMonthName(now()->month) }} {{ now()->year }}</span>
                    <span class="font-bold {{ $this->record->hasPaidCurrentMonth() ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                        {{ $this->record->hasPaidCurrentMonth() ? 'PAGADO' : 'PENDIENTE' }}
                    </span>
                </div>

                <div class="text-center p-4 rounded-lg border-2 {{ $this->record->hasPaidEnrollment() ? 'border-green-500 bg-green-50 dark:bg-green-500/10' : 'border-yellow-500 bg-yellow-50 dark:bg-yellow-500/10' }}">
                    <span class="text-4xl block mb-1">{{ $this->record->hasPaidEnrollment() ? '🎓' : '⏳' }}</span>
                    <span class="text-xs text-gray-600 dark:text-gray-400 block">Matrícula {{ now()->year }}</span>
                    <span class="font-bold {{ $this->record->hasPaidEnrollment() ? 'text-green-600 dark:text-green-400' : 'text-yellow-600 dark:text-yellow-400' }}">
                        {{ $this->record->hasPaidEnrollment() ? 'PAGADA' : 'PENDIENTE' }}
                    </span>
                </div>

                <div class="text-center p-4 rounded-lg border-2 border-blue-500 bg-blue-50 dark:bg-blue-500/10">
                    <span class="text-4xl block mb-1">📊</span>
                    <span class="text-xs text-gray-600 dark:text-gray-400 block">Total Pagos</span>
                    <span class="font-bold text-blue-600 dark:text-blue-400">{{ $this->record->payments()->count() }} REGISTROS</span>
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
            <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
                <table class="w-full">
                    <thead class="bg-gray-100 dark:bg-gray-800">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 dark:text-gray-400 uppercase">Tipo</th>
                            <th class="px-4 py-3 text-center text-xs font-bold text-gray-600 dark:text-gray-400 uppercase">Año</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 dark:text-gray-400 uppercase">Mes</th>
                            <th class="px-4 py-3 text-right text-xs font-bold text-gray-600 dark:text-gray-400 uppercase">Monto</th>
                            <th class="px-4 py-3 text-center text-xs font-bold text-gray-600 dark:text-gray-400 uppercase">Fecha Pago</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 dark:text-gray-400 uppercase">Notas</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($payments as $payment)
                        <tr class="hover:bg-gray-50 dark:hover:bg-white/5">
                            <td class="px-4 py-3">
                                <x-filament::badge :color="$payment->type === 'matricula' ? 'info' : 'success'">
                                    {{ $payment->type === 'matricula' ? '🎓 Matrícula' : '📆 Mensualidad' }}
                                </x-filament::badge>
                            </td>
                            <td class="px-4 py-3 text-center font-bold text-gray-900 dark:text-white">{{ $payment->year }}</td>
                            <td class="px-4 py-3 text-gray-900 dark:text-white">{{ $this->getMonthName($payment->month) }}</td>
                            <td class="px-4 py-3 text-right font-bold text-green-600 dark:text-green-400">{{ $this->formatMoney($payment->amount) }}</td>
                            <td class="px-4 py-3 text-center text-gray-600 dark:text-gray-400">{{ $payment->payment_date->format('d/m/Y') }}</td>
                            <td class="px-4 py-3 text-gray-500 dark:text-gray-400 max-w-[150px] truncate">{{ $payment->notes ?? '—' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-gray-100 dark:bg-gray-800 border-t-2 border-gray-300 dark:border-gray-600">
                        <tr>
                            <td colspan="3" class="px-4 py-3 text-right font-bold text-gray-700 dark:text-gray-300">
                                💵 Total ({{ $payments->count() }} pagos):
                            </td>
                            <td class="px-4 py-3 text-right font-bold text-xl text-green-600 dark:text-green-400">
                                {{ $this->formatMoney($payments->sum('amount')) }}
                            </td>
                            <td colspan="2"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            @endif
        </x-filament::section>
    </div>
</x-filament-panels::page>