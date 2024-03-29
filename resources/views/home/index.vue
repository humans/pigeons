<script lang="ts" setup>
import { ContentContainer } from "@/primitives/content-container"
import { PageTitle } from "@/primitives/page-title"

defineProps<{
    servers: App.Data.ServerData[]
}>()

useHead({
    title: "Home",
})
</script>

<template layout>
    <div>
        <ContentContainer class="[ bg-canvas ]">
            <header>
                <PageTitle>
                    {{ $t("app.home.title") }}
                </PageTitle>
            </header>

            <section class="[ mt-8 ]">
                <h2 class="[ text-2xl font-bold tracking-tight ]">{{ $t("nouns.servers") }}</h2>

                <div>
                    <div v-for="server in servers" :key="server.id">
                        <div>{{ server.name }}</div>

                        <RouterLink :href="route('servers.show', { server: server.id })" preload>
                            {{ $t("actions.view") }}
                        </RouterLink>
                    </div>
                </div>
            </section>
        </ContentContainer>
    </div>
</template>

<style scoped></style>
