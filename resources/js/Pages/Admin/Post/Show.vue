<template>
    <div>
        <div>{{ post.id }}</div>
        <div>{{ post.title }}</div>
        <div>{{ post.content }}</div>
        <div>{{ post.view }}</div>
        <div>{{ post.is_commentable }}</div>
        <div>{{this.selectedCategory().title}}</div>
        <div>
            <img :src="post.img_url" :alt="post.title">
        </div>
    </div>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
    name: "Show.vue",

    props: {
      categories: Array,
      post: Object
    },

    data() {
        return {

        }
    },

    methods: {
        selectedCategory() {
            return this.categories.find(category => category.id === this.post.category_id);
        }
    },

    layout: AdminLayout
}
</script>

<style scoped>

</style>
