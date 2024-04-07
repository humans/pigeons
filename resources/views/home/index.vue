<script lang="ts" setup>
import { CardHeading } from "@/primitives/card-heading"
import { ContentContainer } from "@/primitives/content-container"

defineProps<{
    servers: App.Data.ServerData[]
}>()

useHead({
    title: "Home",
})
</script>

<template layout>
    <CardHeading :title="$t('app.home.title')" />

    <ContentContainer class="[ bg-canvas py-8 ]">
        <ul role="list" class="[ divide-y divide-gray-100 overflow-hidden bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl ]">
            <li v-for="server in servers" :key="server.id" class="[ flex items-center justify-between gap-x-6 py-5 px-4 ]">
                <div class="[ min-w-0 ]">
                    <div class="[ flex items-start gap-x-3 ]">
                        <p class="[ text-sm font-semibold leading-6 text-gray-900 ]">{{ server.name }}</p>
                    </div>
                    <div class="[ mt-1 flex items-center gap-x-2 text-xs leading-5 text-gray-500 ]">
                        <svg viewBox="0 0 2 2" class="h-0.5 w-0.5 fill-current">
                            <circle cx="1" cy="1" r="1" />
                        </svg>
                    </div>
                </div>
                <div class="[ flex flex-none items-center gap-x-4 ]">
                    <RouterLink
                        :href="route('servers.show', { server: server.id })"
                        preload
                        class="[ hidden rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:block ]"
                    >
                        {{ $t("actions.view") }}
                    </RouterLink>
                </div>
            </li>
        </ul>
    </ContentContainer>
</template>

<style scoped></style>
