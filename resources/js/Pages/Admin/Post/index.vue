<template>
    <div class="">
        <div class="mb-4">
            <Link :href="route('admin.posts.create')" class="inline-block px-3 py-2 bg-indigo-600 text-white">Add</Link>
        </div>
        <div class="mb-4 flex justify-between">
            <div class="">
                <input @keyup="postFilter" class="border border-gray-200" type="text" v-model="dataFilter.title" placeholder="title">
            </div>
            <div class="">
                <input @keyup="postFilter" class="border border-gray-200" type="text" v-model="dataFilter.content" placeholder="content">
            </div>
            <div class="">
                <input @keyup="postFilter" class="border border-gray-200" type="text" v-model="dataFilter.category_title" placeholder="category title">
            </div>
            <div class="mb-4">
                <a @click.prevent="sbrosFilter" href="#" class="inline-block px-3 py-2 bg-indigo-600 text-white">Throw</a>
            </div>
        </div>
        <div v-for="post in postsData.data" class="mb-4 pb-4 border-b flex justify-between items-center">
            <div>
                <h3>
                    <Link :href="route('admin.posts.show', post.id)" class="hover:text-blue-500">
                        {{post.title}}
                    </Link>
                </h3>
                <p>{{post.created_at}}</p>
            </div>
            <div>
                <Link :href="route('admin.posts.edit', post.id)" class="inline-block px-3 py-2 bg-green-400 text-white mr-2">Edit</Link>
                <a @click.prevent="deletePost(post.id)" href="#" class="inline-block px-3 py-2 bg-red-400 text-white">Delete</a>
            </div>
        </div>
        <div class="mb-4 flex">
            <a href="#" v-for="page in postsData.meta.links" @click="postFilter(page.label)"
               :class="[page.label == this.dataFilter.page ? 'bg-indigo-600' : '', 'inline-block px-2 py-1 mr-2 border border-gray-200 text-sm']">
                {{ str(page) }}
            </a>
        </div>
    </div>

</template>

<script>
import {Link} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
    name: "index.vue",

    props: {
        posts: Array
    },

    components: {
        Link
    },

    data() {
        return {
            dataFilter: {page: "1"},
            postsData: this.posts
        }
    },

    methods: {
        sbrosFilter(){
            this.dataFilter = {}
            this.postsData = this.posts
        },

        str(page){
            if("&laquo; Previous" === page.label) {return "Предыдущий"}
            else if ("Next &raquo;" === page.label) {return "Следующий"}
            else {return page.label}
        },

        postFilter(page = 1){
            if(page == "&laquo; Previous"){
                page = String(this.dataFilter.page - 1)
            }
            if(page == "Next &raquo;"){
                page = String(Number(this.dataFilter.page) + 1)
            }
            this.dataFilter.page = typeof page == "string" ? page : 1
            axios.get('/admin/posts', {
                params: this.dataFilter
            }).then(res=>{
                this.postsData = res.data
            })
        },

        deletePost(postId) {
            axios.delete(`/admin/posts/${postId}`)
                .then(this.postFilter);
        }
    },

    layout: AdminLayout
}
</script>

<style scoped>

</style>
