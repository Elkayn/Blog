<template>
    <div class="">
        <div class="mb-4">
            <h3>Add post</h3>
        </div>
        <div v-if="is_success" class="mb-4 p-4 bg-green-400 w-1/2">
            <h3>Success</h3>
        </div>

        <div>
            <div class="mb-4">
                <input @keyup="storeCache" class="border border-gray-200 w-1/2" v-model="entries.post.title" type="text" placeholder="title" @input="is_success=false">
            </div>
            <div class="mb-4">
                <textarea @keyup="storeCache" class="border border-gray-200 w-1/2" v-model="entries.post.content" type="text" placeholder="content" @input="is_success=false"></textarea>
            </div>
            <div class="mb-4">
                <input ref="input_image" @change="setImage" class="border border-gray-200 w-1/2" type="file" placeholder="image">
            </div>
            <div class="mb-4">
                <input @keyup="storeCache" class="border border-gray-200 w-1/2" v-model="entries.post.view" type="text" placeholder="view" @input="is_success=false">
            </div>
            <div class="mb-4">
                <input @keyup="storeCache" class="border border-gray-200 w-1/2" v-model="entries.post.publish_at" type="datetime-local" placeholder="title" @input="is_success=false">
            </div>
            <div class="mb-4">
                <select @keyup="storeCache" class="border border-gray-200 w-1/2" v-model="entries.post.category_id" @change="is_success=false">
                    <option v-for="category in categories" :value="category.id">{{category.title}}</option>
                </select>
            </div>
            <div class="mb-4">
                <input @keyup="storeCache" class="mr-2" id="is-commentable" v-model="entries.post.is_commentable" type="checkbox" @input="is_success=false">
                <label for="is-commentable">Is commentable</label>
            </div>
            <div class="mb-4">
                <select multiple="true" class="border border-gray-200 w-1/2" v-model="tagsArray" @change="is_success=false">
                    <option v-for="tag in tags" :value="tag.id">{{tag.title}}</option>
                </select>
            </div>
            <div class="mb-4">
                <input @keyup="storeCache" class="border border-gray-200 w-1/2" v-model="entries.tags" type="text" placeholder="tags" @input="is_success=false">
            </div>
            <div class="mb-4">
                <a @click="storePost" href="#" class="inline-block px-3 py-2 bg-indigo-600 text-white">Add</a>
            </div>
        </div>
    </div>
</template>

<script>

import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
    name: "create.vue",

    props: {
        categories: Array,
        tags: Array,
        cache: Object
    },

    data() {
        return {
            entries: {
                post: {},
                tags: []
            },
            is_success: false,
            tagsArray: {}
        }
    },

    mounted() {
        if(this.cache) {
            this.entries.post.title = this.cache.title,
            this.entries.post.content = this.cache.content,
            this.entries.post.view = this.cache.view,
                this.entries.tags = this.cache.tags
        }
    },

    methods: {
        storePost() {
            this.entries.post.tagsArray = this.tagsArray;
            axios.post('/admin/posts', this.entries, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(res => {
                    this.entries.post = {};
                    this.entries.tags = [];
                    this.is_success = true;
                    this.$refs.input_image.value = null
                })
        },

        setImage(e) {
            this.entries.post.image = e.target.files[0];
        },

        storeCache() {
            axios.post('/admin/posts/cache', {
                title: this.entries.post.title,
                content: this.entries.post.content,
                view: this.entries.post.view,
                tags: this.entries.tags
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
