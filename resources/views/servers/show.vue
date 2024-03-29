<script setup lang="ts">
import { ContentContainer } from "@/primitives/content-container"
import CreateSiteForm from "@/views/servers/CreateSiteForm.vue"

// import CreateSiteForm from "./CreateSiteForm.vue"

type Props = {
    server: App.Data.ServerData
    sites: App.Data.SiteData[]
}

defineProps<Props>()
</script>

<template layout>
    <ContentContainer>
        <header class="[ flex justify-between ]">
            <div>
                <h1>{{ server.name }}</h1>

                <div>
                    <div>{{ server.ip_address }}</div>
                </div>
            </div>
        </header>

        <details>
            <summary>Public Key</summary>

            <textarea class="[ font-mono ]">{{ server.public_key }}</textarea>
        </details>

        <CreateSiteForm :server />

        <div>
            <div v-for="site in sites" :key="site.id" class="[ flex gap-4 ]">
                <div>{{ site.name }}</div>
                <div>{{ site.type }}</div>
            </div>
        </div>
    </ContentContainer>
</template>

<style scoped></style>
