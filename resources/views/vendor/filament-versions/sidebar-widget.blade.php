@if (filament('filament-versions')->shouldHaveNavigationView())
<style>
    .fi-sidebar {
        display: flex;
        flex-direction: column;
    }

    .fi-sidebar-header {
        flex-shrink: 0;
    }

    .fi-sidebar-nav > ul {
        padding-block-end: 1.5rem;
    }
</style>
<div
    class="px-6 py-3 mt-auto text-xs text-gray-700 border-t filament-versions-nav-widget border-gray-950/5 dark:text-gray-300 dark:border-white/20"
    x-data
    @if (filament()->isSidebarCollapsibleOnDesktop() || filament()->isSidebarFullyCollapsibleOnDesktop())
        x-cloak
        x-show="$store.sidebar.isOpen"
    @endif
>
    <ul class="flex flex-wrap items-center gap-x-4 gap-y-2">
        @foreach ($versions as $version)
            <li class="flex-shrink-0">{{ str($version->getName()) }}: {{ str($version->getVersion())->ltrim('v') }}</li>
        @endforeach
    </ul>
</div>
@endif
