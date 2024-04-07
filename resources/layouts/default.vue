<script setup lang="ts">
import { Bars3Icon } from "@heroicons/vue/24/outline"
import { ref } from "vue"

const sidebarOpen = ref(false)
</script>

<template>
    <div class="[ bg-gray-100 h-screen ]">
        <Sidebar :sidebar-open="sidebarOpen" />
        <div class="lg:pl-72">
            <div class="[ bg-white sticky top-0 z-40 lg:mx-auto lg:max-w-7xl lg:px-8 ]">
                <div class="flex h-16 items-center gap-x-4 bg-white px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-0 lg:shadow-none">
                    <button type="button" class="-m-2.5 p-2.5 text-gray-700 lg:hidden" @click="sidebarOpen = !sidebarOpen">
                        <span class="sr-only">Open sidebar</span>
                        <Bars3Icon class="h-6 w-6" aria-hidden="true" />
                    </button>

                    <!-- Separator -->
                    <div class="[ h-6 w-px bg-gray-200 lg:hidden ]" aria-hidden="true" />

                    <MainHeader />
                </div>
            </div>

            <main class="[ py-10 ]">
                <div class="[ mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 ]">
                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>
