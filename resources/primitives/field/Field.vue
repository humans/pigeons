<script setup lang="ts">
import FieldMessage from "@/primitives/field-message/FieldMessage.vue"

type Props = {
    id: string
    label: string
    error?: string
}

const props = defineProps<Props>()

const { id, error } = toRefs(props)

provide("field/id", id)
provide("field/error", error)
</script>

<template>
    <div class="field">
        <label :for="id" class="field__label [ text-sm font-medium ]">{{ label }}</label>

        <div class="field__control">
            <slot />
        </div>

        <FieldMessage :error v-if="error">
            {{ error }}
        </FieldMessage>
    </div>
</template>

<style scoped></style>
