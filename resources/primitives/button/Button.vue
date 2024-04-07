<script setup lang="ts">
import { buttonLooks } from "."

type Props = {
    look?: NonNullable<Parameters<typeof buttonLooks>>
}

defineProps<Props>()
</script>

<template>
    <button type="submit" :class="className(buttonLooks({ look }))">
        <slot />
    </button>
</template>

<style scoped></style>
