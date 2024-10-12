<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.profiles.index')" class="inline-block px-3 py-2 bg-indigo-600 text-white">Add</Link>
        </div>
        <div v-for="profile in profiles" class="mb-4 pb-4 border-b">
            <h3>
                {{profile.first_name}}
            </h3>
            <h3>
                {{profile.second_name}}
            </h3>
            <p>{{profile.phone}}</p>
        </div>
    </div>


</template>

<script>
import {Link} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
    name: "index.vue",

    props: {
        profiles: Array
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
