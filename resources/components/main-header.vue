<script setup lang="ts">
import { ChevronDownIcon, BellIcon, MagnifyingGlassIcon } from "@heroicons/vue/24/outline"
import { ref } from "vue"

const i18n = useI18n()
const user = useProperty("security.user")

const UserRoutes = [
    { text: i18n.t("nouns.profile"), url: "#" },
    { text: i18n.t("nouns.sign-out"), url: "#" },
]

const open = ref(false)
</script>

<template>
    <div class="[ flex flex-1 gap-x-4 self-stretch lg:gap-x-6 ]">
        <form class="[ relative flex flex-1 ]" action="#" method="GET">
            <label for="search-field" class="[ sr-only ]">Search</label>
            <MagnifyingGlassIcon class="[ pointer-events-none absolute inset-y-0 left-0 h-full w-5 text-gray-400 ]" aria-hidden="true" />
            <input
                id="search-field"
                class="[ block h-full w-full border-0 py-0 pl-8 pr-0 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm ]"
                placeholder="Search..."
                type="search"
                name="search"
            />
        </form>
        <div class="[ flex items-center gap-x-4 lg:gap-x-6 ]">
            <button type="button" class="[ -m-2.5 p-2.5 text-gray-400 hover:text-gray-500 ]">
                <span class="[ sr-only ]">View notifications</span>
                <BellIcon class="[ h-6 w-6 ]" aria-hidden="true" />
            </button>

            <!-- Separator -->
            <div class="[ hidden lg:block lg:h-6 lg:w-px lg:bg-gray-200 ]" aria-hidden="true" />

            <!-- Profile dropdown -->
            <div class="[ relative ]">
                <div class="[ -m-1.5 flex items-center p-1.5 ]" @click="open = !open">
                    <span class="[ sr-only ]">Open user menu</span>
                    <span class="[ h-8 w-8 rounded-full bg-gray-200 ]"></span>
                    <span class="[ hidden lg:flex lg:items-center ]">
                        <span class="[ ml-4 text-sm font-semibold leading-6 text-gray-900 ]" aria-hidden="true">{{ user.name }}</span>
                        <ChevronDownIcon class="[ ml-2 h-5 w-5 text-gray-400 ]" aria-hidden="true" />
                    </span>
                </div>
                <transition
                    v-show="open"
                    enter-active-class="[ transition ease-out duration-100 ]"
                    enter-from-class="[ transform opacity-0 scale-95 ]"
                    enter-to-class="[ transform opacity-100 scale-100 ]"
                    leave-active-class="[ transition ease-in duration-75 ]"
                    leave-from-class="[ transform opacity-100 scale-100 ]"
                    leave-to-class="[ transform opacity-0 scale-95 ]"
                >
                    <div class="[ absolute right-0 z-10 mt-2.5 w-32 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none ]">
                        <div v-for="route in UserRoutes" :key="route.url">
                            <RouterLink :href="route.url" :class="['block px-3 py-1 text-sm leading-6 text-gray-900']">{{ route.text }}</RouterLink>
                        </div>
                    </div>
                </transition>
            </div>
        </div>
    </div>
</template>
