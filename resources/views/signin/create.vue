<script lang="ts" setup>
import { CsrfField } from "@/primitives/csrf-field"
import { Field } from "@/primitives/field"
import { Input } from "@/primitives/input"

defineProps<{}>()

const login = useForm({
    method: "POST",
    url: route("signin.store"),
    fields: {
        email: "",
        password: "",
    },
})
</script>

<template>
    <div>
        <h1>Sign in to Roost</h1>

        <form :action="route('signin.store')" method="POST" @submit.prevent="login.submit">
            <CsrfField />

            <Field id="email" label="Email address" :error="login.errors.email">
                <Input name="email" type="email" v-model="login.fields.email" />
            </Field>

            <Field id="password" label="Password" :error="login.errors.password">
                <Input name="password" type="password" v-model="login.fields.password" />
            </Field>

            <button type="submit">Sign in</button>
        </form>
    </div>
</template>

<style scoped></style>
