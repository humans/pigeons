<script setup lang="ts">
import { CsrfField } from "@/primitives/csrf-field"
import { Field } from "@/primitives/field"
import { Input } from "@/primitives/input"
import { Button } from "~/resources/primitives/button"

type Props = {
    server: App.Data.ServerData
}

const { server } = defineProps<Props>()

const form = useForm({
    method: "POST",
    url: route("servers.sites.store", { server: server.id }),
    fields: {
        name: "",
        type: "laravel",
        webroot: "/public",
    },
})
</script>

<template>
    <section>
        <h2 class="[ font-bold ]">Create a new site</h2>

        <form :action="route('servers.sites.store', { server: server.id })" method="POST" @submit.prevent="form.submit">
            <CsrfField />

            <Field id="name" label="Name">
                <Input type="text" name="name" v-model="form.fields.name" />
            </Field>

            <div class="[ flex mt-4 ]">
                <Button>Submit</Button>
            </div>
        </form>
    </section>
</template>

<style scoped></style>
