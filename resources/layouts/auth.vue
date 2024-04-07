<script setup lang="ts">
import { ContentContainer } from "@/primitives/content-container"
</script>

<template>
    <main class="[ flex min-h-full flex-1 flex-col justify-center py-12 sm:px-6 lg:px-8 ]">
        <ContentContainer class="[ max-w-lg ]">
            <div class="[ mt-12 ]">
                <slot />
            </div>
        </ContentContainer>
    </main>
</template>
