<script setup lang="ts">
import { ContentContainer } from "@/primitives/content-container"
import CreateSiteForm from "@/views/servers/CreateSiteForm.vue"
import CardHeading from "~/resources/primitives/card-heading/CardHeading.vue"

// import CreateSiteForm from "./CreateSiteForm.vue"

type Props = {
    server: App.Data.ServerData
    sites: App.Data.SiteData[]
}

defineProps<Props>()
</script>

<template layout>
    <CardHeading :title="server.name" />

    <ContentContainer class="[ bg-canvas py-8 ]">
        <header class="[ flex justify-between ]">
            <div>{{ server.ip_address }}</div>
        </header>

        <details>
            <summary>Public Key</summary>

            <textarea
                class="[ font-mono block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-4 ]"
                >{{ server.public_key }}</textarea
            >
        </details>

        <CreateSiteForm :server class="mt-6" />

        <ul role="list" class="[ divide-y divide-gray-200 mt-6 border border-gray-100 ]">
            <li v-for="site in sites" :key="site.id" class="[ flex justify-between p-4 ]">
                <div>{{ site.name }}</div>
                <div>{{ site.type }}</div>
            </li>
        </ul>
    </ContentContainer>
</template>

<style scoped></style>
