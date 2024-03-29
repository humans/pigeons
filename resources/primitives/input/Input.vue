<script setup lang="ts">
import { useVModel } from "@vueuse/core"
import { inject, useAttrs } from "vue"

defineOptions({
    inheritAttrs: false,
})

const props = defineProps<{
    modelValue?: string | number
    defaultValue?: string | number
}>()

const emits = defineEmits<{
    (e: "update:modelValue", payload: string | number): void
}>()

const { class: classes, ...attrs } = useAttrs()

const modelValue = useVModel(props, "modelValue", emits, {
    passive: true,
    defaultValue: props.defaultValue,
    error: false,
})

const id = inject("field/id")
const error = inject("field/error")
</script>

<template>
    <input
        v-model="modelValue"
        :id="id"
        :class="
            className(
                'input [ shadow-sm px-4 py-2 rounded w-full transition duration-100 ]',
                '[ bg-input-background text-input-foreground border border-input-border focus:border-input-border ]',
                '[ placeholder:text-input-placeholder ]',
                '[ focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-offset-background focus-visible:ring-foreground ]',
                {
                    'input--has-error [ border-red-600 ]': error,
                },
                classes ?? ''
            )
        "
        v-bind="attrs"
    />
</template>
