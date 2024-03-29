import { type ClassValue, clsx } from "clsx"
import { extendTailwindMerge } from "tailwind-merge"

const CustomTwMerge = extendTailwindMerge({
    extend: {},
})

export function className(...inputs: ClassValue[]) {
    return CustomTwMerge(clsx(inputs))
}
