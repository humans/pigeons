<script lang="ts" setup>
import { Button } from "@/primitives/button"
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

<template layout="auth">
    <div class="[ sm:mx-auto sm:w-full sm:max-w-md ]">
        <h2 class="[ mt-6 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900 ]">Sign in to Roost</h2>
    </div>

    <div class="[ mt-10 sm:mx-auto sm:w-full sm:max-w-[480px] ]">
        <div class="[ bg-white px-6 py-12 shadow sm:rounded-lg sm:px-12 ]">
            <form :action="route('signin.store')" method="POST" @submit.prevent="login.submit" class="[ space-y-6 ]">
                <CsrfField />

                <Field id="email" label="Email address" :error="login.errors.email">
                    <Input name="email" type="email" v-model="login.fields.email" />
                </Field>

                <Field id="password" label="Password" :error="login.errors.password">
                    <Input name="password" type="password" v-model="login.fields.password" />
                </Field>

                <div>
                    <Button>Sign in</Button>
                </div>
            </form>
        </div>
    </div>
</template>

<style scoped></style>
