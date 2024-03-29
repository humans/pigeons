<script setup lang="ts">
import { ContentContainerVariants } from "."

type Props = {
    wrap?: NonNullable<Parameters<typeof ContentContainerVariants>[0]>["wrap"]
    padding?: NonNullable<Parameters<typeof ContentContainerVariants>[0]>["padding"]
}

defineProps<Props>()
</script>

<template>
    <div :class="className(ContentContainerVariants({ wrap, padding }))">
        <slot></slot>
    </div>
</template>

<style scoped></style>
