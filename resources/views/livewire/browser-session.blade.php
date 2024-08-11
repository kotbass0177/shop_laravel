<x-filament-breezy::grid-section md=2 :title="__('ข้อมูลการเข้าใช้งาน')" :description="__(
    'คุณสามารถออกจากระบบจากเซสชันเบราว์เซอร์อื่นๆ ทั้งหมดบนทุกอุปกรณ์ของคุณได้ หากคุณรู้สึกว่าบัญชีของคุณถูกบุกรุก คุณควรเปลี่ยนรหัสผ่านด้วย',
)">
    <x-filament::card>


        {{-- <form wire:submit.prevent="submit" class="space-y-6">
           

        </form> --}}
        <div class="mt-4">
            {{ $this->revokeAllAction }}
        </div>
        <div
            class="mt-4 divide-y border border-gray-300 dark:border-gray-600 rounded-md divide-gray-300 dark:divide-gray-600">
            @foreach ($this->sessions() as $session)
                <div wire:key="session-{{ $session->id }}"
                    class="first:rounded-t-md last:rounded-b-md bg-slate-50 dark:bg-gray-800">
                    <div class="px-6 py-4">
                        <div class="flex justify-between items-start gap-x-4">
                            <div>
                                <div class="flex gap-x-4">
                                    <div>
                                        <x-filament::icon :alias="$session->agent->isDesktop()
                                            ? 'session::desktop'
                                            : 'session::mobile'" :icon="$session->agent->isDesktop()
                                            ? 'heroicon-o-computer-desktop'
                                            : 'heroicon-o-device-phone-mobile'"
                                            class="h-8 w-8 text-gray-500 dark:text-gray-400" />
                                    </div>

                                    <div>
                                        <div class="text-sm">
                                            {{ $session->agent->platform() ?: __('ไม่ระบุ') }}
                                            -
                                            {{ $session->agent->browser() ?: __('ไม่ระบุ') }}
                                        </div>

                                        <div class="text-xs mt-1">
                                            <x-filament::link
                                                href="https://tools.keycdn.com/geo?host={{ $session->ip_address }}"
                                                :tooltip="__('ค้นหาข้อมูลทางภูมิศาสตร์ของที่อยู่ IP นี้')" target="_blank" rel="nofollow noopener"
                                                class="text-xs font-normal">
                                                {{ $session->ip_address }}
                                            </x-filament::link>

                                            <span>-</span>

                                            @if ($session->is_current_device)
                                                <span
                                                    class="text-success-500 font-semibold">{{ __('อุปกรณ์นี้') }}</span>
                                            @else
                                                <span>{{ __('ใช้งานล่าสุด :time', ['time' => $session->last_active]) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                @unless ($session->is_current_device)
                                    {{ ($this->revokeAction)(['session' => $session->id]) }}
                                @endunless
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <x-filament-actions::modals />
    </x-filament::card>
</x-filament-breezy::grid-section>
