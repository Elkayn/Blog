<template>
    <div class="">
        <div class="mb-4">
            <h3>Add category</h3>
        </div>
        <div v-if="is_success" class="mb-4 p-4 bg-green-400 w-1/2">
            <h3>Success</h3>
        </div>

        <div>
            <div class="mb-4">
                <input @keyup="storeCache" class="border border-gray-200 w-1/2" v-model="entries.category.title" type="text" placeholder="title" @input="is_success=false">
            </div>
            <div class="mb-4">
                <textarea @keyup="storeCache" class="border border-gray-200 w-1/2" v-model="entries.category.description" type="text" placeholder="description" @input="is_success=false"></textarea>
            </div>
            <div class="mb-4">
                <a @click="storeCategory" href="#" class="inline-block px-3 py-2 bg-indigo-600 text-white">Add</a>
            </div>
        </div>
    </div>
</template>

<script>

import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
    name: "Create.vue",

    props: {
        cache: Object
    },

    data() {
        return {
            entries: {
                category: {}
            },
            is_success: false
        }
    },

    mounted() {
        if(this.cache) {
            this.entries.category.title = this.cache.title,
                this.entries.category.description = this.cache.description
        }
    },

    methods: {
        storeCategory() {
            axios.post('/admin/categories', this.entries, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                },
            }).then(res => {
                    this.entries.category = {};
                    this.is_success = true;
            })
        },

        storeCache() {
            axios.post('/admin/categories/cache', {
                title: this.entries.category.title,
                description: this.entries.category.description,
            }).then(res => {
                console.log(res);
            })
        },
    },

    layout: AdminLayout
}
</script>

<style scoped>

</style>
