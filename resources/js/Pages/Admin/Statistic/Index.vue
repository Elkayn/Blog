<template>
    <div class="mb-4">
        <h1 class="text-center font-bold text-xl">Статистика</h1>
    </div>
    <div>
        <table class="w-full text-left table-auto min-w-max">
            <thead>
                <tr>
                    <th class="p-2 border-b border-blue-gray-50">Дата</th>
                    <th class="p-2 border-b border-blue-gray-50">Количество постов</th>
                    <th class="p-2 border-b border-blue-gray-50">Количество комментариев</th>
                    <th class="p-2 border-b border-blue-gray-50">Количество лайков у постов</th>
                    <th class="p-2 border-b border-blue-gray-50">Количество лайков у комментариев</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="data in this.statisticsData">
                    <td class="p-2 border-b border-blue-gray-50">{{data.date}}</td>
                    <td class="p-2 border-b border-blue-gray-50">{{data.count_posts}}</td>
                    <td class="p-2 border-b border-blue-gray-50">{{data.count_comments}}</td>
                    <td class="p-2 border-b border-blue-gray-50">{{data.count_likes_posts}}</td>
                    <td class="p-2 border-b border-blue-gray-50">{{data.count_likes_comments}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
    name: "Index",

    props: {
        statistics: Array
    },

    data() {
        return{
            statisticsData: this.statistics
        }
    },

    layout: AdminLayout
}
</script>

<style scoped>

</style>
