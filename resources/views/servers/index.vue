<script lang="ts" setup>
import { ContentContainer } from "@/primitives/content-container"

type Props = {
    servers: App.Data.ServerData[]
}

defineProps<Props>()
</script>

<template layout>
    <div>
        <ContentContainer class="[ bg-canvas ]">
            <header>
                <h1>Servers</h1>

                <RouterLink :href="route('servers.create')">New Server</RouterLink>
            </header>

            <div>
                <div v-for="server in servers" :key="server.id" class="[ flex gap-4 ]">
                    <div>{{ server.name }}</div>
                    <div>{{ server.ip_address }}</div>

                    <RouterLink :href="route('servers.show', { server: server.id })">View Server</RouterLink>
                </div>
            </div>
        </ContentContainer>
    </div>
</template>

<style scoped></style>
