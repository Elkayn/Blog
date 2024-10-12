<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.categories.create')" class="inline-block px-3 py-2 bg-indigo-600 text-white">Add</Link>
        </div>
        <div v-for="category in categories" class="mb-4 pb-4 border-b flex justify-between items-center w-full">
            <div class="w-3/4 mr-4">
                <h3>
                    <Link :href="route('admin.categories.show', category.id)" class="hover:text-blue-500">
                        {{category.title}}
                    </Link>
                </h3>
                <h3>
                    {{category.description}}
                </h3>
                <p>{{category.created_at}}</p>
            </div>
            <div class="w-1/4">
                <Link :href="route('admin.categories.edit', category.id)" class="inline-block px-3 py-2 bg-green-400 text-white mr-2">Edit</Link>
                <a @click="deleteCategory(category.id)" :href="route('admin.categories.index')" class="inline-block px-3 py-2 bg-red-400 text-white">Delete</a>
            </div>
        </div>
    </div>


</template>

<script>
import {Link} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
    name: "index.vue",

    props: {
        categories: Array
    },

    components: {
        Link
    },

    data() {
        return {}
    },

    methods: {
        deleteCategory(categoryId) {
            axios.delete(`/admin/categories/${categoryId}`);
        }
    },

    layout: AdminLayout
}
</script>

<style scoped>

</style>
