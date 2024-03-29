<script setup lang="ts">
const i18n = useI18n()

const SidebarRoutes = [
    { text: i18n.t("nouns.home"), url: route("home.index") },
    { text: i18n.t("nouns.servers"), url: route("servers.index") },
    { text: i18n.t("nouns.sites"), url: route("sites.index") },
]
</script>

<template>
    <div class="[ flex min-h-screen ]">
        <aside class="[ w-[275px] hidden md:block h-screen p-4 text-sm border-r ]">
            <div>
                <div>
                    <RouterLink :href="route('home.index')" class="[ text-lg font-extrabold tracking-tight ]"> roost </RouterLink>
                </div>

                <div class="[ mt-5 grid gap-2 ]">
                    <div v-for="route in SidebarRoutes" :key="route.url">
                        <RouterLink :href="route.url" class="[ inline-flex items-center gap-2 ]">
                            <span class="[ h-6 w-6 rounded border ]"></span>
                            <span>{{ route.text }}</span>
                        </RouterLink>
                    </div>
                </div>
            </div>
        </aside>

        <main class="[ w-full min-h-screen p-4 ]">
            <slot />
        </main>
    </div>
</template>
