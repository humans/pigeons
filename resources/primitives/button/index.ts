import { cva } from "class-variance-authority"

export { default as Button } from "./Button.vue"

const lookOptions = {
    default: "bg-indigo-600 hover:bg-indigo-500 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600",
    outline: "bg-white text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50",
    soft: "bg-indigo-50 text-indigo-600 hover:bg-indigo-100",
    danger: "bg-red-600 hover:bg-red-500 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600",
}

export const buttonLooks = cva("rounded-md px-3 py-1.5 text-sm flex justify-center font-semibold leading-6 shadow-sm ", {
    variants: {
        look: lookOptions,
    },
    defaultVariants: {
        look: "default",
    },
})
