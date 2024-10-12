<template>
    <div>
        <div class="mb-6 pb-4 border-b">
            <h1 class="text-xl text-center">
                Comments post
            </h1>
        </div>
        <div class=" w-1/2 mx-auto">
            <div class="pb-4 mb-4 border-b border-gray-200">
                <h3>
                    {{post.title}}
                </h3>
                <p>{{post.publish_at}}</p>
                    <div class="grid min-h-[140px] w-full place-items-center overflow-x-scroll rounded-lg p-6 lg:overflow-visible">
                    <img :src="post.img_url" class="object-cover object-center w-full">
                </div>
                <div class="flex">
                    <ToggleLike :post="this.post" @likedPost=""></ToggleLike>
                    <label>Нравиться</label>
                </div>
            </div>
            <div>
                <h3 @click="showComments" class="text-center cursor-pointer">Показать комментарии</h3>
            </div>
            <div class="pb-4 mb-4 border-b border-gray-200">
                <div class="mb-4">
                    <h3 class="font-bold">Comments</h3>
                </div>
                <div v-for="postComment in comments" class="mb-4 pb-4 border-b border-gray-200">
                    <div class="flex justify-between mb-3">
                        <div>
                            <p>{{postComment.content}}</p>
                            <p>{{postComment.date}}</p>
                        </div>
                        <div class="p-3">
                            <svg @click="toggleLikeComment(postComment)" xmlns="http://www.w3.org/2000/svg" :fill="postComment.is_liked ? '#010101' : 'none'" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="cursor-pointer size-6 mr-3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <div class="mb-1 mb-2">
                            <h3 class="font-bold">Answers</h3>
                        </div>
                        <div class="mb-3">
                            <h3 @click="showAnswers(postComment)" class="text-center cursor-pointer">Показать ответы</h3>
                        </div>
                        <div v-for="answer in answers" class="mb-4 pb-4 border-b border-gray-200" v-if="activeComment === postComment">
                            <div class="flex justify-between mb-3">
                                <div>
                                    <p>{{answer.content}}</p>
                                    <p>{{answer.date}}</p>
                                </div>
                                <div class="p-3">
                                    <svg @click="toggleLikeComment(answer)" xmlns="http://www.w3.org/2000/svg" :fill="answer.is_liked ? '#010101' : 'none'" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="cursor-pointer size-6 mr-3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div v-for="post in this.post">
                            {{post.key}}
                        </div>
                        <div class="flex justify-end">
                            <div  class="w-1/2">
                                <textarea class="border border-gray-200 w-full h-12" v-model="answerComment[postComment.id]" placeholder="comment"/>
                            </div>
                            <div class="m-1 pl-4">
                                <a @click.prevent="addAnswerComment(postComment)" href="#" class="inline-block px-3 py-2 bg-indigo-600 text-white">Add</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <h3 class="font-bold">Send Comment</h3>
                </div>
                <StoreForm :post="this.post" @changeListComment="addComment"></StoreForm>
            </div>
        </div>
    </div>
</template>

<script>
import StoreForm from "@/Components/Comment/StoreForm.vue"
import ToggleLike from "@/Components/Post/ToggleLike.vue"
export default {
    name: "Show",

    props: {
        post: Object
    },

    components: {
        StoreForm,
        ToggleLike
    },

    data() {
        return {
            comments: {},
            comment: {},
            answers: {},
            answerComment: {},
            activeComment: {}
        }
    },

    methods: {
        addComment(res) {
            this.comments.unshift(res.data)
        },

        addAnswerComment(postComment) {
            axios.post(`/comments/${postComment.id}`, {'content': this.answerComment[postComment.id]})
                .then(res => {
                    this.answers.unshift(res.data)
                    this.answerComment[postComment.id] = ''
                })
        },

        toggleLikeComment(postComment) {
            axios.post(`/comments/${postComment.id}/likes`).then(res => {
                postComment.is_liked = res.data.is_liked
            })
        },

        showComments() {
            axios.get(`/posts/${this.post.id}/comments`)
                .then(res => {
                    if(Object.keys(this.comments).length === 0) this.comments = res.data
                    else this.comments = {}
            })
        },

        showAnswers(postComment) {
            if(this.activeComment === postComment) {
                this.activeComment = null
            } else {
                this.activeComment = postComment
            }

            axios.get(`/comments/${postComment.id}`)
                .then(res => {
                    if(Object.keys(this.answers).length === 0) this.answers = res.data
                    else this.answers = {}
                })
        }
    }
}
</script>

<style scoped>

</style>
