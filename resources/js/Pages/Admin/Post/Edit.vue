<template>
    <div class="">
        <div class="mb-4">
            <h3>Edit post</h3>
        </div>
        <div v-if="is_success" class="mb-4 p-4 bg-green-400">
            <h3>Success</h3>
        </div>

        <div>
            <div class="mb-4">
                <input class="border border-gray-200 w-1/2" v-model="editPost.title" type="text" placeholder="title">
            </div>
            <div class="mb-4">
                <textarea class="border border-gray-200 w-1/2" v-model="editPost.content" type="text" placeholder="content"></textarea>
            </div>
            <div class="mb-4">
                <input class="border border-gray-200 w-1/2" v-model="editPost.view" type="text" placeholder="view">
            </div>
            <div class="mb-4">
                <input class="border border-gray-200 w-1/2" v-model="editPost.publish_at" type="datetime-local" placeholder="title">
            </div>
            <div class="mb-4">
                <select class="border border-gray-200 w-1/2" v-model="editPost.category_id">
                    <option v-for="category in categories" :value="category.id">{{category.title}}</option>
                </select>
            </div>
            <div class="mb-4">
                <input class="mr-2" id="is-commentable" v-model="editPost.is_commentable" type="checkbox">
                <label for="is-commentable">Is commentable</label>
            </div>
            <div class="mb-4">
                <select multiple="true" class="border border-gray-200 w-1/2" v-model="selectedTag">
                    <option v-for="tag in tags" :value="tag.id">{{tag.title}}</option>
                </select>
            </div>
            <div class="mb-4">
                <img :src="editPost.img_url" :alt="editPost.title">
            </div>
            <div class="mb-4">
                <input @change="setImage" class="border border-gray-200 w-1/2" type="file" placeholder="image">
            </div>
            <div class="mb-4">
                <a @click="updatePost" href="#" class="inline-block px-3 py-2 bg-indigo-600 text-white">Save</a>
            </div>
        </div>
    </div>
</template>

<script>

import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
    name: "Edit.vue",

    props: {
        categories: Array,
        post: Object,
        tags: Array,
        defaultTags: Array
    },

    data() {
        return {
            editPost: {...this.post,
                        _method: 'patch'},
            is_success: false,
            selectedTag: this.defaultTags
        }
    },

    methods: {
        updatePost() {
            this.editPost.tagsArray = this.selectedTag
            axios.post(`/admin/posts/${this.editPost.id}`, this.editPost, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                }
            }).then(res => {
                    this.is_success = true;
                })
        },

        setImage(e) {
            this.editPost.image = e.target.files[0];
        }
    },

    layout: AdminLayout
}
</script>

<style scoped>

</style>
