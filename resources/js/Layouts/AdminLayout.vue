<template>
    <div class="w-full">
        <div class="w-full mx-auto bg-gray-200 p-4">
            <header class="flex justify-between p-1">
                <div>
                    ADMIN PANEL
                </div>
                <div>
                    <Link :href="route('logout')" method="post" class="font-bold cursor-pointer text-red-500">Log out</Link>
                </div>
            </header>
        </div>
    </div>
    <div class="w-full">
        <div class="w-full flex min-h-screen mx-auto">
            <div class="w-1/4 p-4 bg-gray-100">
                <sidebar>
                    <div class="mb-2"><Link :href="route('admin.posts.index')">Posts</Link></div>
                    <div class="mb-2"><Link :href="route('admin.profiles.index')">Profiles</Link></div>
                    <div class="mb-2"><Link :href="route('admin.categories.index')">Categories</Link></div>
                    <div class="mb-2"><Link :href="route('admin.comments.index')">Comments</Link></div>
                    <div class="mb-2"><Link :href="route('admin.roles.index')">Roles</Link></div>
                    <div class="mb-2"><Link :href="route('admin.tags.index')">Tags</Link></div>
                    <div class="mb-2"><Link :href="route('admin.statistic.index')">Statistic</Link></div>
                </sidebar>
            </div>
            <div class="w-3/4 p-4">
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
    name: "AdminLayout",

    components: {
        Link
    }
}
</script>

<style scoped>

</style>
