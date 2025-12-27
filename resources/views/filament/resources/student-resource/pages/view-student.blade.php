<x-filament-panels::page>
    <div class="space-y-6">
        {{-- Información Personal --}}
        <x-filament::section icon="heroicon-o-user" heading="Información Personal">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Nombre Completo</dt>
                    <dd class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">
                        {{ $this->record->full_name }}
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Correo Electrónico</dt>
                    <dd class="mt-1 text-gray-900 dark:text-white">
                        {{ $this->record->email ?? 'No registrado' }}
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Teléfono</dt>
                    <dd class="mt-1 text-gray-900 dark:text-white">
                        {{ $this->record->phone ?? 'No registrado' }}
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Fecha de Nacimiento</dt>
                    <dd class="mt-1 text-gray-900 dark:text-white">
                        {{ $this->record->birth_date ? $this->record->birth_date->format('d/m/Y') : 'No registrada' }}
                    </dd>
                </div>
            </div>
        </x-filament::section>

        {{-- Información Académica --}}
        <x-filament::section icon="heroicon-o-academic-cap" heading="Información Académica">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Curso</dt>
                    <dd class="mt-1">
                        @if($this->record->course)
                            <x-filament::badge color="primary">
                                {{ $this->record->course->name }}
                            </x-filament::badge>
                        @else
                            <span class="text-gray-500">Sin asignar</span>
                        @endif
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Grado</dt>
                    <dd class="mt-1">
                        @if($this->record->course)
                            <x-filament::badge color="{{ $this->getGradeColor($this->record->course->grade) }}">
                                {{ $this->record->course->grade }}
                            </x-filament::badge>
                        @else
                            <span class="text-gray-500">Sin asignar</span>
                        @endif
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Director de Grupo</dt>
                    <dd class="mt-1 text-gray-900 dark:text-white">
                        @if($this->record->course?->teacher)
                            {{ $this->record->course->teacher->name }} {{ $this->record->course->teacher->last_name }}
                        @else
                            Sin asignar
                        @endif
                    </dd>
                </div>
            </div>
        </x-filament::section>

        {{-- Estado de Pagos --}}
        <x-filament::section icon="heroicon-o-banknotes" heading="Estado de Pagos">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Mes Actual ({{ $this->getMonthName(now()->month) }})</dt>
                    <dd class="mt-1">
                        @if($this->record->hasPaidCurrentMonth())
                            <x-filament::badge color="success">
                                ✓ Al día
                            </x-filament::badge>
                        @else
                            <x-filament::badge color="danger">
                                ⚠ Pendiente
                            </x-filament::badge>
                        @endif
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Matrícula {{ now()->year }}</dt>
                    <dd class="mt-1">
                        @if($this->record->hasPaidEnrollment())
                            <x-filament::badge color="success">
                                ✓ Pagada
                            </x-filament::badge>
                        @else
                            <x-filament::badge color="warning">
                                ⏳ Pendiente
                            </x-filament::badge>
                        @endif
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Pagos Registrados</dt>
                    <dd class="mt-1 text-gray-900 dark:text-white">
                        {{ $this->record->payments()->count() }} pagos
                    </dd>
                </div>
            </div>
        </x-filament::section>

        {{-- Historial de Pagos --}}
        <x-filament::section icon="heroicon-o-clock" heading="Historial de Pagos">
            @php
                $paymentsByYear = $this->getPaymentsByYear();
            @endphp

            @if(empty($paymentsByYear))
                <div class="text-center py-8">
                    <div class="text-gray-400 dark:text-gray-500 text-4xl mb-2">💰</div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">No hay pagos registrados</p>
                </div>
            @else
                <div class="space-y-3" x-data="{ openYears: [{{ array_key_first($paymentsByYear) }}] }">
                    @foreach($paymentsByYear as $year => $payments)
                        <div class="border border-gray-200 dark:border-gray-700 rounded-xl overflow-hidden">
                            {{-- Accordion Header --}}
                            <button
                                type="button"
                                @click="openYears.includes({{ $year }}) ? openYears = openYears.filter(y => y !== {{ $year }}) : openYears.push({{ $year }})"
                                class="w-full flex items-center justify-between px-4 py-3 bg-gray-50 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors"
                            >
                                <div class="flex items-center gap-3">
                                    <span class="text-lg font-semibold text-gray-900 dark:text-white">
                                        📅 {{ $year }}
                                    </span>
                                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-primary-100 text-primary-700 dark:bg-primary-900 dark:text-primary-300">
                                        {{ count($payments) }} {{ count($payments) === 1 ? 'pago' : 'pagos' }}
                                    </span>
                                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300">
                                        Total: {{ $this->formatMoney(collect($payments)->sum('amount')) }}
                                    </span>
                                </div>
                                <svg 
                                    class="w-5 h-5 text-gray-500 transition-transform duration-200"
                                    x-bind:class="{ 'rotate-180': openYears.includes({{ $year }}) }"
                                    fill="none" 
                                    stroke="currentColor" 
                                    viewBox="0 0 24 24"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>

                            {{-- Accordion Content --}}
                            <div
                                x-show="openYears.includes({{ $year }})"
                                x-collapse
                                class="border-t border-gray-200 dark:border-gray-700"
                            >
                                <div class="overflow-x-auto">
                                    <table class="w-full text-sm">
                                        <thead class="bg-gray-50 dark:bg-gray-800/50">
                                            <tr>
                                                <th class="px-4 py-2 text-left font-medium text-gray-500 dark:text-gray-400">Tipo</th>
                                                <th class="px-4 py-2 text-left font-medium text-gray-500 dark:text-gray-400">Mes</th>
                                                <th class="px-4 py-2 text-right font-medium text-gray-500 dark:text-gray-400">Monto</th>
                                                <th class="px-4 py-2 text-left font-medium text-gray-500 dark:text-gray-400">Fecha de Pago</th>
                                                <th class="px-4 py-2 text-left font-medium text-gray-500 dark:text-gray-400">Notas</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                            @foreach($payments as $payment)
                                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50">
                                                    <td class="px-4 py-3">
                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $payment['type'] === 'matricula' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300' : 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' }}">
                                                            {{ $this->getTypeLabel($payment['type']) }}
                                                        </span>
                                                    </td>
                                                    <td class="px-4 py-3 text-gray-900 dark:text-white">
                                                        {{ $this->getMonthName($payment['month']) }}
                                                    </td>
                                                    <td class="px-4 py-3 text-right font-medium text-gray-900 dark:text-white">
                                                        {{ $this->formatMoney($payment['amount']) }}
                                                    </td>
                                                    <td class="px-4 py-3 text-gray-600 dark:text-gray-300">
                                                        {{ $this->formatDate($payment['payment_date']) }}
                                                    </td>
                                                    <td class="px-4 py-3 text-gray-500 dark:text-gray-400 max-w-xs truncate">
                                                        {{ $payment['notes'] ?? '-' }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </x-filament::section>
    </div>
</x-filament-panels::page>
