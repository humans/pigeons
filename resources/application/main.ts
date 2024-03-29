import { createHead } from "@unhead/vue"
import { initializeHybridly } from "virtual:hybridly/config"
import "./app.pcss"
import i18n from "./i18n"

initializeHybridly({
    viewTransition: false,
    enhanceVue: (vue) => {
        const head = createHead()
        head.push({
            titleTemplate: (title) => (title ? `${title} — Roost` : "Roost"),
        })
        vue.use(i18n)
        vue.use(head)
    },
})
