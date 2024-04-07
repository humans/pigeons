<script setup lang="ts">
import { XMarkIcon, HomeIcon, ServerIcon, GlobeAltIcon } from "@heroicons/vue/24/outline"

const i18n = useI18n()
const { matches } = useRoute()

const SidebarRoutes = [
    { text: i18n.t("nouns.home"), url: route("home.index"), name: "home", icon: HomeIcon },
    { text: i18n.t("nouns.servers"), url: route("servers.index"), name: "servers", icon: ServerIcon },
    { text: i18n.t("nouns.sites"), url: route("sites.index"), name: "sites", icon: GlobeAltIcon },
]

type Props = {
    sidebarOpen: boolean
}

defineProps<Props>()
</script>

<template>
    <div v-show="sidebarOpen">
        <div class="[ relative z-50 lg:hidden ]" @click="sidebarOpen = false">
            <transition
                v-show="sidebarOpen"
                enter="[ transition-opacity ease-linear duration-300 ]"
                enter-from="[ opacity-0 ]"
                enter-to="[ opacity-100 ]"
                leave="[ transition-opacity ease-linear duration-300 ]"
                leave-from="[ opacity-100 ]"
                leave-to="[ opacity-0 ]"
            >
                <div class="[ fixed inset-0 bg-gray-900/80 ]" />
            </transition>

            <div class="[ fixed inset-0 flex ]">
                <transition
                    v-show="sidebarOpen"
                    enter="[ transition ease-in-out duration-300 transform ]"
                    enter-from="[ -translate-x-full ]"
                    enter-to="[ translate-x-0 ]"
                    leave="[ transition ease-in-out duration-300 transform ]"
                    leave-from="[ translate-x-0 ]"
                    leave-to="[ -translate-x-full ]"
                >
                    <div class="[ relative mr-16 flex w-full max-w-xs flex-1 ]">
                        <transition
                            v-show="sidebarOpen"
                            enter="[ ease-in-out duration-300 ]"
                            enter-from="[ opacity-0 ]"
                            enter-to="[ opacity-100 ]"
                            leave="[ ease-in-out duration-300 ]"
                            leave-from="[ opacity-100 ]"
                            leave-to="[ opacity-0 ]"
                        >
                            <div class="[ absolute left-full top-0 flex w-16 justify-center pt-5 ]">
                                <button type="button" class="[ -m-2.5 p-2.5 ]" @click="sidebarOpen = false">
                                    <span class="[ sr-only ]">Close sidebar</span>
                                    <XMarkIcon class="[ h-6 w-6 text-white ]" aria-hidden="true" />
                                </button>
                            </div>
                        </transition>

                        <div class="[ flex grow flex-col gap-y-5 overflow-y-auto bg-white px-6 pb-4 ]">
                            <div class="[ flex h-16 shrink-0 items-center ]">
                                <RouterLink :href="route('home.index')" class="[ text-lg font-extrabold tracking-tight ]"> roost </RouterLink>
                            </div>
                            <nav class="[ flex flex-1 flex-col ]">
                                <ul role="list" class="[ flex flex-1 flex-col gap-y-7 ]">
                                    <li>
                                        <ul role="list" class="[ -mx-2 space-y-1 ]">
                                            <li v-for="route in SidebarRoutes" :key="route.url">
                                                <RouterLink
                                                    :href="route.url"
                                                    :class="[
                                                        matches(`${route.name}.*`) ? 'bg-gray-50 text-indigo-600' : 'text-gray-700 hover:text-indigo-600 hover:bg-gray-50',
                                                        'group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold',
                                                    ]"
                                                    @click="sidebarOpen = false"
                                                >
                                                    <component :is="route.icon" class="[ h-6 w-6 ]" />
                                                    {{ route.text }}
                                                </RouterLink>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </transition>
            </div>
        </div>
    </div>

    <div class="[ hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col ]">
        <div class="[ flex grow flex-col gap-y-5 overflow-y-auto border-r border-gray-200 bg-white px-6 pb-4 ]">
            <div class="[ flex h-16 shrink-0 items-center ]">
                <RouterLink :href="route('home.index')" class="[ text-lg font-extrabold tracking-tight ]"> roost </RouterLink>
            </div>
            <nav class="[ flex flex-1 flex-col ]">
                <ul role="list" class="[ flex flex-1 flex-col gap-y-7 ]">
                    <li>
                        <ul role="list" class="[ -mx-2 space-y-1 ]">
                            <li v-for="route in SidebarRoutes" :key="route.url">
                                <RouterLink
                                    :href="route.url"
                                    class="[ items-center gap-2 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold hover:bg-gray-50 hover:text-indigo-600 ]"
                                    :class="[matches(`${route.name}.*`) ? 'bg-gray-50 text-indigo-600' : 'text-gray-700']"
                                >
                                    <component :is="route.icon" class="[ h-6 w-6 ]" />
                                    <span>{{ route.text }}</span>
                                </RouterLink>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>
