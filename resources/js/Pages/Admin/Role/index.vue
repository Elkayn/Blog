<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.roles.index')" class="inline-block px-3 py-2 bg-indigo-600 text-white">Add</Link>
        </div>
        <div v-for="role in roles" class="mb-4 pb-4 border-b">
            <h3>
                {{role.title}}
            </h3>
            <p>{{role.created_at}}</p>
        </div>
    </div>


</template>

<script>
import {Link} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
    name: "index.vue",

    props: {
        roles: Array
    },

    components: {
        Link
    },

    data() {
        return {}
    },

    methods: {},

    layout: AdminLayout
}
</script>

<style scoped>

</style>
