import i18n from "@intlify/unplugin-vue-i18n/vite"
import hybridly from "hybridly/vite"
import path from "node:path"
import { defineConfig } from "vite"

export default defineConfig({
    plugins: [
        hybridly({}),
        i18n({
            include: path.resolve(__dirname, "./.hybridly/locales.json"),
        }),
    ],
})
