<template>
    <div class="">
        <div class="mb-4">
            <h3>Edit category</h3>
        </div>
        <div v-if="is_success" class="mb-4 p-4 bg-green-400">
            <h3>Success</h3>
        </div>

        <div>
            <div class="mb-4">
                <input class="border border-gray-200 w-1/2" v-model="editCategory.title" type="text" placeholder="title">
            </div>
            <div class="mb-4">
                <textarea class="border border-gray-200 w-1/2" v-model="editCategory.description" type="text" placeholder="description"></textarea>
            </div>
            <div class="mb-4">
                <a @click="updateCategory" href="#" class="inline-block px-3 py-2 bg-indigo-600 text-white">Save</a>
            </div>
        </div>
    </div>
</template>

<script>

import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
    name: "Edit.vue",

    props: {
        category: Object
    },

    data() {
        return {
            editCategory: {...this.category,
                        _method: 'patch'},
            is_success: false,
        }
    },

    methods: {
        updateCategory() {
            axios.post(`/admin/categories/${this.editCategory.id}`, this.editCategory, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                }
            }).then(res => {
                    this.is_success = true;
                })
        },
    },

    layout: AdminLayout
}
</script>

<style scoped>

</style>
