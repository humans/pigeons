<script setup lang="ts">
import { ContentContainer } from "@/primitives/content-container"
</script>

<template>
    <main class="[ h-screen w-screen flex justify-center ]">
        <ContentContainer class="[ max-w-lg ]">
            <div class="[ mt-12 ]">
                <slot />
            </div>
        </ContentContainer>
    </main>
</template>
