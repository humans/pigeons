<script setup lang="ts">
type Props = {
    title: string
    button?: {
        title: string
        route: string
    }
}

defineProps<Props>()
</script>

<template>
    <div class="[ border-b border-gray-200 bg-white px-4 py-5 sm:px-6 ]">
        <div class="[ -ml-4 -mt-2 flex flex-wrap items-center justify-between sm:flex-nowrap ]">
            <div class="[ ml-4 mt-2 ]">
                <h3 class="[ text-base font-semibold leading-6 text-gray-900 ]">{{ title }}</h3>
            </div>
            <div v-if="button" class="[ ml-4 mt-2 flex-shrink-0 ]">
                <RouterLink
                    :href="button.route"
                    class="[ flex justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 ]"
                    >{{ button.title }}</RouterLink
                >
            </div>
        </div>
    </div>
</template>
