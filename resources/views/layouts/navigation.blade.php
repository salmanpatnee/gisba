<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @php
                        $nis2Active = request()->routeIs('admin.blog.*') || request()->routeIs('admin.categories.*');
                        $pmpActive = request()->routeIs('admin.pmp.*') || request()->routeIs('admin.pmp-categories.*') || request()->routeIs('admin.chapters.*');
                        $criscActive = request()->routeIs('admin.crisc.*') || request()->routeIs('admin.crisc-categories.*') || request()->routeIs('admin.crisc-enrollments.*');
                        $wrapperClasses = fn ($active) => $active
                            ? 'flex items-center px-1 pt-1 border-b-2 border-indigo-400'
                            : 'flex items-center px-1 pt-1 border-b-2 border-transparent hover:border-gray-300 transition duration-150 ease-in-out';
                        $labelClasses = fn ($active) => $active
                            ? 'inline-flex items-center gap-1 text-sm font-medium leading-5 text-gray-900 focus:outline-none'
                            : 'inline-flex items-center gap-1 text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 transition duration-150 ease-in-out';
                    @endphp

                    <div class="{{ $wrapperClasses($nis2Active) }}">
                        <x-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <button type="button" class="{{ $labelClasses($nis2Active) }}">
                                    {{ __('NIS2') }}
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link :href="route('admin.blog.index')">{{ __('Blogs') }}</x-dropdown-link>
                                <x-dropdown-link :href="route('admin.categories.index')">{{ __('Categories') }}</x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>

                    <div class="{{ $wrapperClasses($pmpActive) }}">
                        <x-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <button type="button" class="{{ $labelClasses($pmpActive) }}">
                                    {{ __('PMP') }}
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link :href="route('admin.pmp.index')">{{ __('Overview') }}</x-dropdown-link>
                                <x-dropdown-link :href="route('admin.pmp-categories.index')">{{ __('Categories') }}</x-dropdown-link>
                                <x-dropdown-link :href="route('admin.chapters.index')">{{ __('Chapters') }}</x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>

                    <div class="{{ $wrapperClasses($criscActive) }}">
                        <x-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <button type="button" class="{{ $labelClasses($criscActive) }}">
                                    {{ __('CRISC') }}
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link :href="route('admin.crisc.index')">{{ __('Posts') }}</x-dropdown-link>
                                <x-dropdown-link :href="route('admin.crisc-categories.index')">{{ __('Categories') }}</x-dropdown-link>
                                <x-dropdown-link :href="route('admin.crisc-enrollments.index')">{{ __('Enrollments') }}</x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>

                    <x-nav-link :href="route('admin.members.index')" :active="request()->routeIs('admin.members.*')">
                        {{ __('Members') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.user-activity.index')" :active="request()->routeIs('admin.user-activity.*')">
                        {{ __('User Activity') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.videos.index')" :active="request()->routeIs('admin.videos.*')">
                        {{ __('Videos') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.settings.edit')" :active="request()->routeIs('admin.settings.*')">
                        {{ __('Settings') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <div class="px-4 pt-2 pb-1 text-xs font-semibold text-gray-400 uppercase tracking-wide">{{ __('NIS2') }}</div>
            <x-responsive-nav-link :href="route('admin.blog.index')" :active="request()->routeIs('admin.blog.*')">
                {{ __('Blogs') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.categories.index')" :active="request()->routeIs('admin.categories.*')">
                {{ __('Categories') }}
            </x-responsive-nav-link>

            <div class="px-4 pt-3 pb-1 text-xs font-semibold text-gray-400 uppercase tracking-wide">{{ __('PMP') }}</div>
            <x-responsive-nav-link :href="route('admin.pmp.index')" :active="request()->routeIs('admin.pmp.*')">
                {{ __('Overview') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.pmp-categories.index')" :active="request()->routeIs('admin.pmp-categories.*')">
                {{ __('Categories') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.chapters.index')" :active="request()->routeIs('admin.chapters.*')">
                {{ __('Chapters') }}
            </x-responsive-nav-link>

            <div class="px-4 pt-3 pb-1 text-xs font-semibold text-gray-400 uppercase tracking-wide">{{ __('CRISC') }}</div>
            <x-responsive-nav-link :href="route('admin.crisc.index')" :active="request()->routeIs('admin.crisc.*')">
                {{ __('Posts') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.crisc-categories.index')" :active="request()->routeIs('admin.crisc-categories.*')">
                {{ __('Categories') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.crisc-enrollments.index')" :active="request()->routeIs('admin.crisc-enrollments.*')">
                {{ __('Enrollments') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('admin.members.index')" :active="request()->routeIs('admin.members.*')">
                {{ __('Members') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.user-activity.index')" :active="request()->routeIs('admin.user-activity.*')">
                {{ __('User Activity') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.videos.index')" :active="request()->routeIs('admin.videos.*')">
                {{ __('Videos') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.settings.edit')" :active="request()->routeIs('admin.settings.*')">
                {{ __('Settings') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
