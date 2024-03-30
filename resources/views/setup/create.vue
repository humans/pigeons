<script setup lang="ts">
import { Field } from "@/primitives/field"
import { Input } from "@/primitives/input"

const register = useForm({
    method: "POST",
    url: route("setup.store"),
    fields: {
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
    },
})
</script>

<template>
    <div>
        <h1>Create your owner account for Roost</h1>

        <form :action="route('setup.store')" @submit.prevent="register.submit">
            <Field id="name" label="Your name" :error="register.errors.name">
                <Input type="text" name="name" v-model="register.fields.name" />
            </Field>

            <Field id="email" label="Your email address" :error="register.errors.email">
                <Input type="email" name="email" v-model="register.fields.email" />
            </Field>

            <Field id="password" label="Your password" :error="register.errors.password">
                <Input type="password" name="password" v-model="register.fields.password" />
            </Field>

            <Field id="password-confirmation" label="Repeat your password" :error="register.errors.password_confirmation">
                <Input type="password" name="password_confirmation" v-model="register.fields.password_confirmation" />
            </Field>

            <button>Finish setup</button>
        </form>
    </div>
</template>

<style scoped></style>
