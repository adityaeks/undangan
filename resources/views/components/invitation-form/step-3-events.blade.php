@php
    $parseEventTime = function($event, $defaultStart, $defaultEnd, $oldPrefix) {
        $start = old($oldPrefix.'_start_time');
        $end = old($oldPrefix.'_end_time');
        $isUntilFinish = old($oldPrefix.'_is_until_finish', null);
        $timezone = old($oldPrefix.'_timezone', $event?->timezone ?? 'WIB');

        if (!$start && $event?->start_time) {
            if (preg_match('/(\d{1,2})[:.](\d{2})/', $event->start_time, $m)) {
                $start = sprintf('%02d:%02d', $m[1], $m[2]);
            }
        }
        $start = $start ?: $defaultStart;

        if ($isUntilFinish === null) {
            if ($event?->end_time && stripos($event->end_time, 'selesai') !== false) {
                $isUntilFinish = true;
            } elseif ($event?->start_time && stripos($event->start_time, 'selesai') !== false) {
                $isUntilFinish = true;
            } else {
                $isUntilFinish = false;
            }
        } else {
            $isUntilFinish = (bool) $isUntilFinish;
        }

        if (!$end && !$isUntilFinish) {
            if ($event?->end_time && preg_match('/(\d{1,2})[:.](\d{2})/', $event->end_time, $m)) {
                $end = sprintf('%02d:%02d', $m[1], $m[2]);
            } elseif ($event?->start_time && preg_match('/-\s*(\d{1,2})[:.](\d{2})/', $event->start_time, $m)) {
                $end = sprintf('%02d:%02d', $m[1], $m[2]);
            }
        }
        $end = $end ?: ($isUntilFinish ? '' : $defaultEnd);

        if ($event?->start_time) {
            if (stripos($event->start_time, 'WITA') !== false) $timezone = 'WITA';
            elseif (stripos($event->start_time, 'WIT') !== false) $timezone = 'WIT';
            elseif (stripos($event->start_time, 'WIB') !== false) $timezone = 'WIB';
        }

        return [
            'start' => $start,
            'end' => $end,
            'isUntilFinish' => $isUntilFinish,
            'timezone' => $timezone ?: 'WIB',
        ];
    };

    $akadTimeData = $parseEventTime($akad, '08:00', '10:00', 'akad');
    $resepsiTimeData = $parseEventTime($resepsi, '11:00', '13:00', 'resepsi');
@endphp

<!-- STEP 3: RANGKAIAN ACARA -->
<div x-show="currentStep === 3" x-transition data-step="3" class="space-y-6">

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <!-- ACARA 1: AKAD NIKAH / PEMBERKATAN -->
        <div class="p-5 rounded-2xl bg-sand-50/70 border border-sand-200 space-y-4">
            <div class="flex items-center gap-2 pb-2 border-b border-sand-200">
                <span class="w-7 h-7 rounded-xl bg-charcoal-900 text-brand-200 flex items-center justify-center font-bold text-xs">1</span>
                <h4 class="font-serif text-sm font-bold text-charcoal-950">Akad Nikah / Pemberkatan</h4>
            </div>

            <div class="space-y-3">
                <div class="space-y-1">
                    <label class="block text-xs font-bold text-charcoal-900">
                        Tanggal Acara <span class="text-rose-500">*</span>
                    </label>
                    <input 
                        type="date" 
                        name="akad_date" 
                        value="{{ old('akad_date', $akad?->date?->format('Y-m-d') ?? ($akad?->date ? \Carbon\Carbon::parse($akad->date)->format('Y-m-d') : '')) }}" 
                        required
                        class="w-full px-3 py-2 rounded-xl border border-sand-300 text-xs text-charcoal-900 focus:outline-none focus:ring-2 focus:ring-brand-500/20 bg-white"
                    >
                </div>

                <div class="space-y-1.5" x-data="{ 
                    startTime: '{{ $akadTimeData['start'] }}',
                    endTime: '{{ $akadTimeData['end'] }}',
                    untilFinish: {{ $akadTimeData['isUntilFinish'] ? 'true' : 'false' }},
                    timezone: '{{ $akadTimeData['timezone'] }}',
                    get formattedTime() {
                        let t = this.startTime;
                        if (this.untilFinish) {
                            t += ' - Selesai';
                        } else if (this.endTime) {
                            t += ' - ' + this.endTime;
                        }
                        if (this.timezone) {
                            t += ' ' + this.timezone;
                        }
                        return t;
                    }
                }">
                    <div class="flex items-center justify-between">
                        <label class="block text-xs font-bold text-charcoal-900">
                            Waktu / Jam <span class="text-rose-500">*</span>
                        </label>
                        <label class="inline-flex items-center gap-1.5 cursor-pointer select-none text-[11px] font-medium text-sand-600 hover:text-charcoal-900">
                            <input 
                                type="checkbox" 
                                name="akad_is_until_finish" 
                                value="1" 
                                x-model="untilFinish"
                                class="rounded border-sand-300 text-brand-600 focus:ring-brand-500 w-3.5 h-3.5"
                            >
                            <span>Sampai Selesai</span>
                        </label>
                    </div>

                    <div class="grid grid-cols-12 gap-2">
                        <!-- Jam Mulai -->
                        <div class="col-span-5 space-y-1">
                            <span class="text-[10px] font-semibold text-sand-500 uppercase tracking-wider block">Mulai</span>
                            <input 
                                type="time" 
                                name="akad_start_time" 
                                x-model="startTime"
                                required
                                class="w-full px-2.5 py-2 rounded-xl border border-sand-300 text-xs font-medium text-charcoal-900 focus:outline-none focus:ring-2 focus:ring-brand-500/20 bg-white"
                            >
                        </div>

                        <!-- Jam Selesai -->
                        <div class="col-span-4 space-y-1" x-show="!untilFinish">
                            <span class="text-[10px] font-semibold text-sand-500 uppercase tracking-wider block">Selesai</span>
                            <input 
                                type="time" 
                                name="akad_end_time" 
                                x-model="endTime"
                                :disabled="untilFinish"
                                class="w-full px-2.5 py-2 rounded-xl border border-sand-300 text-xs font-medium text-charcoal-900 focus:outline-none focus:ring-2 focus:ring-brand-500/20 bg-white"
                            >
                        </div>

                        <div class="col-span-4 space-y-1" x-show="untilFinish" style="display: none;">
                            <span class="text-[10px] font-semibold text-sand-500 uppercase tracking-wider block">Selesai</span>
                            <div class="h-[34px] px-2.5 rounded-xl border border-dashed border-sand-300 bg-sand-100/70 text-sand-500 text-xs font-medium flex items-center justify-center">
                                Selesai
                            </div>
                        </div>

                        <!-- Zona Waktu -->
                        <div class="col-span-3 space-y-1">
                            <span class="text-[10px] font-semibold text-sand-500 uppercase tracking-wider block">Zona</span>
                            <select 
                                name="akad_timezone" 
                                x-model="timezone"
                                class="w-full px-2 py-2 rounded-xl border border-sand-300 text-xs font-medium text-charcoal-900 focus:outline-none focus:ring-2 focus:ring-brand-500/20 bg-white"
                            >
                                <option value="WIB">WIB</option>
                                <option value="WITA">WITA</option>
                                <option value="WIT">WIT</option>
                            </select>
                        </div>
                    </div>

                    <!-- Hidden input for auto-syncing formatted string -->
                    <input type="hidden" name="akad_time" :value="formattedTime">
                </div>
            </div>

            <div class="space-y-1">
                <label class="block text-xs font-bold text-charcoal-900">
                    Nama Tempat / Gedung / Masjid <span class="text-rose-500">*</span>
                </label>
                <input 
                    type="text" 
                    name="akad_venue" 
                    value="{{ old('akad_venue', $akad?->venue_name) }}" 
                    placeholder="Masjid Agung Al-Azhar / Ballroom Hotel Gran Mahakam" 
                    required
                    class="w-full px-3 py-2 rounded-xl border border-sand-300 text-xs text-charcoal-900 focus:outline-none focus:ring-2 focus:ring-brand-500/20 bg-white"
                >
            </div>

            <div class="space-y-1">
                <label class="block text-xs font-bold text-charcoal-900">
                    Alamat Lengkap <span class="text-rose-500">*</span>
                </label>
                <textarea 
                    name="akad_address" 
                    rows="2" 
                    placeholder="Jl. Sisingamangaraja No.1, Kebayoran Baru, Jakarta Selatan" 
                    required
                    class="w-full px-3 py-2 rounded-xl border border-sand-300 text-xs text-charcoal-900 focus:outline-none focus:ring-2 focus:ring-brand-500/20 bg-white"
                >{{ old('akad_address', $akad?->address) }}</textarea>
            </div>

            <div class="space-y-1">
                <label class="block text-xs font-bold text-charcoal-900">
                    Link Google Maps (URL)
                </label>
                <input 
                    type="url" 
                    name="akad_maps_link" 
                    value="{{ old('akad_maps_link', $akad?->maps_url) }}" 
                    placeholder="https://maps.app.goo.gl/..." 
                    class="w-full px-3 py-2 rounded-xl border border-sand-300 text-xs text-charcoal-900 focus:outline-none focus:ring-2 focus:ring-brand-500/20 bg-white"
                >
                <p class="text-[10px] text-sand-500">Tautan navigasi bagi tamu undangan membuka Google Maps.</p>
            </div>
        </div>

        <!-- ACARA 2: RESEPSI PERNIKAHAN -->
        <div class="p-5 rounded-2xl bg-sand-50/70 border border-sand-200 space-y-4">
            <div class="flex items-center gap-2 pb-2 border-b border-sand-200">
                <span class="w-7 h-7 rounded-xl bg-brand-600 text-white flex items-center justify-center font-bold text-xs">2</span>
                <h4 class="font-serif text-sm font-bold text-charcoal-950">Resepsi Pernikahan</h4>
            </div>

            <div class="space-y-3">
                <div class="space-y-1">
                    <label class="block text-xs font-bold text-charcoal-900">
                        Tanggal Acara <span class="text-rose-500">*</span>
                    </label>
                    <input 
                        type="date" 
                        name="resepsi_date" 
                        value="{{ old('resepsi_date', $resepsi?->date?->format('Y-m-d') ?? ($resepsi?->date ? \Carbon\Carbon::parse($resepsi->date)->format('Y-m-d') : '')) }}" 
                        required
                        class="w-full px-3 py-2 rounded-xl border border-sand-300 text-xs text-charcoal-900 focus:outline-none focus:ring-2 focus:ring-brand-500/20 bg-white"
                    >
                </div>

                <div class="space-y-1.5" x-data="{ 
                    startTime: '{{ $resepsiTimeData['start'] }}',
                    endTime: '{{ $resepsiTimeData['end'] }}',
                    untilFinish: {{ $resepsiTimeData['isUntilFinish'] ? 'true' : 'false' }},
                    timezone: '{{ $resepsiTimeData['timezone'] }}',
                    get formattedTime() {
                        let t = this.startTime;
                        if (this.untilFinish) {
                            t += ' - Selesai';
                        } else if (this.endTime) {
                            t += ' - ' + this.endTime;
                        }
                        if (this.timezone) {
                            t += ' ' + this.timezone;
                        }
                        return t;
                    }
                }">
                    <div class="flex items-center justify-between">
                        <label class="block text-xs font-bold text-charcoal-900">
                            Waktu / Jam <span class="text-rose-500">*</span>
                        </label>
                        <label class="inline-flex items-center gap-1.5 cursor-pointer select-none text-[11px] font-medium text-sand-600 hover:text-charcoal-900">
                            <input 
                                type="checkbox" 
                                name="resepsi_is_until_finish" 
                                value="1" 
                                x-model="untilFinish"
                                class="rounded border-sand-300 text-brand-600 focus:ring-brand-500 w-3.5 h-3.5"
                            >
                            <span>Sampai Selesai</span>
                        </label>
                    </div>

                    <div class="grid grid-cols-12 gap-2">
                        <!-- Jam Mulai -->
                        <div class="col-span-5 space-y-1">
                            <span class="text-[10px] font-semibold text-sand-500 uppercase tracking-wider block">Mulai</span>
                            <input 
                                type="time" 
                                name="resepsi_start_time" 
                                x-model="startTime"
                                required
                                class="w-full px-2.5 py-2 rounded-xl border border-sand-300 text-xs font-medium text-charcoal-900 focus:outline-none focus:ring-2 focus:ring-brand-500/20 bg-white"
                            >
                        </div>

                        <!-- Jam Selesai -->
                        <div class="col-span-4 space-y-1" x-show="!untilFinish">
                            <span class="text-[10px] font-semibold text-sand-500 uppercase tracking-wider block">Selesai</span>
                            <input 
                                type="time" 
                                name="resepsi_end_time" 
                                x-model="endTime"
                                :disabled="untilFinish"
                                class="w-full px-2.5 py-2 rounded-xl border border-sand-300 text-xs font-medium text-charcoal-900 focus:outline-none focus:ring-2 focus:ring-brand-500/20 bg-white"
                            >
                        </div>

                        <div class="col-span-4 space-y-1" x-show="untilFinish" style="display: none;">
                            <span class="text-[10px] font-semibold text-sand-500 uppercase tracking-wider block">Selesai</span>
                            <div class="h-[34px] px-2.5 rounded-xl border border-dashed border-sand-300 bg-sand-100/70 text-sand-500 text-xs font-medium flex items-center justify-center">
                                Selesai
                            </div>
                        </div>

                        <!-- Zona Waktu -->
                        <div class="col-span-3 space-y-1">
                            <span class="text-[10px] font-semibold text-sand-500 uppercase tracking-wider block">Zona</span>
                            <select 
                                name="resepsi_timezone" 
                                x-model="timezone"
                                class="w-full px-2 py-2 rounded-xl border border-sand-300 text-xs font-medium text-charcoal-900 focus:outline-none focus:ring-2 focus:ring-brand-500/20 bg-white"
                            >
                                <option value="WIB">WIB</option>
                                <option value="WITA">WITA</option>
                                <option value="WIT">WIT</option>
                            </select>
                        </div>
                    </div>

                    <!-- Hidden input for auto-syncing formatted string -->
                    <input type="hidden" name="resepsi_time" :value="formattedTime">
                </div>
            </div>

            <div class="space-y-1">
                <label class="block text-xs font-bold text-charcoal-900">
                    Nama Tempat / Gedung / Ballroom <span class="text-rose-500">*</span>
                </label>
                <input 
                    type="text" 
                    name="resepsi_venue" 
                    value="{{ old('resepsi_venue', $resepsi?->venue_name) }}" 
                    placeholder="Grand Ballroom Hotel Mulia Senayan" 
                    required
                    class="w-full px-3 py-2 rounded-xl border border-sand-300 text-xs text-charcoal-900 focus:outline-none focus:ring-2 focus:ring-brand-500/20 bg-white"
                >
            </div>

            <div class="space-y-1">
                <label class="block text-xs font-bold text-charcoal-900">
                    Alamat Lengkap <span class="text-rose-500">*</span>
                </label>
                <textarea 
                    name="resepsi_address" 
                    rows="2" 
                    placeholder="Jl. Asia Afrika No.6, Senayan, Jakarta Pusat" 
                    required
                    class="w-full px-3 py-2 rounded-xl border border-sand-300 text-xs text-charcoal-900 focus:outline-none focus:ring-2 focus:ring-brand-500/20 bg-white"
                >{{ old('resepsi_address', $resepsi?->address) }}</textarea>
            </div>

            <div class="space-y-1">
                <label class="block text-xs font-bold text-charcoal-900">
                    Link Google Maps (URL)
                </label>
                <input 
                    type="url" 
                    name="resepsi_maps_link" 
                    value="{{ old('resepsi_maps_link', $resepsi?->maps_url) }}" 
                    placeholder="https://maps.app.goo.gl/..." 
                    class="w-full px-3 py-2 rounded-xl border border-sand-300 text-xs text-charcoal-900 focus:outline-none focus:ring-2 focus:ring-brand-500/20 bg-white"
                >
                <p class="text-[10px] text-sand-500">Tautan navigasi bagi tamu undangan membuka Google Maps.</p>
            </div>
        </div>

    </div>
</div>
