<template>
    <div class="mb-2">
        <h1 class="text-xl text-center font-bold">
            Posts
        </h1>
    </div>
    <div class="w-full flex flex-col items-center">
        <div v-for="post in postsSpisok" class="mb-4 pb-4 border-b w-64 bg-gray-200">
            <div class="mb-2 p-2">
                <h3 class="text-xl font-medium">
                    <Link :href="route('posts.show', post.id)" class="hover:text-blue-500">
                        {{post.title}}
                    </Link>
                </h3>
                <p>{{post.publish_at}}</p>
            </div>
            <div class="grid min-h-[140px] w-full place-items-center rounded-lg p-6 lg:overflow-visible">
                <img :src="post.img_url" class="object-cover object-center w-full h-32">
            </div>
            <div class="pl-6 pr-6 flex justify-between">
                <ToggleLike :post="post" @likedPost=""></ToggleLike>
                <a @click.prevent="deletePost(post)" v-if="this.$page.props.auth.user.profile.id === post.profile_id" href="#" class="font-bold cursor-pointer text-red-500">Delete</a>
            </div>
        </div>
    </div>
</template>

<script>
import {Link} from "@inertiajs/vue3"
import ClientLayout from "@/Layouts/ClientLayout.vue"
import ToggleLike from "@/Components/Post/ToggleLike.vue"
export default {
    name: "Index",

    props:{
        posts: Array
    },

    data() {
        return {
            postsSpisok: this.posts
        }
    },

    methods: {
        deletePost(post){
            axios.delete(`/posts/${post.id}`)
                .then(res => {
                    this.postsSpisok = res.data
                })
        }
    },

    components: {
        Link,
        ToggleLike
    },

    layout: ClientLayout
}
</script>

<style scoped>

</style>
