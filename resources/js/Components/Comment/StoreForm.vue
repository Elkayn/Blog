<template>
        <div class="mb-4">
            <textarea class="border border-gray-200 w-1/2" v-model="comment.content" placeholder="comment"/>
        </div>
        <div class="mb-2">
            <a @click.prevent="storeComment" href="#" class="inline-block px-3 py-2 bg-indigo-600 text-white">Add</a>
        </div>
</template>

<script>
export default {
    name: "StoreForm",

    props: {
      post: Object
    },

    data() {
        return {
            comment: {}
        }
    },

    methods: {
        storeComment() {
            axios.post(`/posts/${this.post.id}/comments`, this.comment)
            .then(res => {
                this.$emit('changeListComment', res)
                this.comment = {}
            })

        }
    }
}


</script>

<style scoped>

</style>
