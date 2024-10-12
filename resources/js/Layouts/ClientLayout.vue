<template>
    <div class="w-full">
        <div class="w-full mx-auto bg-gray-200 p-4">
            <header class="flex justify-between p-2">
                <div>
                    CLIENT PANEL
                </div>
                <div>
                    <Link :href="route('logout')" method="post" class="font-bold cursor-pointer text-red-500">Log out</Link>
                </div>
            </header>
        </div>
    </div>
    <div class="w-full">
        <div class="w-full min-h-screen mx-auto">
            <div class="p-4">
                <article>
                    <slot />
                </article>
            </div>
        </div>
    </div>
</template>

<script>
import {Link} from "@inertiajs/vue3";

export default {
    name: "ClientLayout",

    components: {
        Link
    }
}
</script>

<style scoped>

</style>
