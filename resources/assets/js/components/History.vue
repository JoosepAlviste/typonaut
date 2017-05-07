<template>

    <div class="history-container">
        <table class="table">
            <tbody>
                <tr v-for="game in games">
                    <td>{{ game.player_one.name }}</td>
                    <td>{{ game.player_one_score }} - {{ game.player_two_score }}</td>
                    <td>{{ game.player_two.name }}</td>
                </tr>
                <tr class="empty" v-show="games.length === 0">No games have been played yet!</tr>
            </tbody>
        </table>
    </div>

</template>

<script>
    export default {

        data() {
            return {
                games: [],
            }
        },

        mounted() {
            axios.get('/api/games')
                .then(({data}) => {
                    this.games = data
                })
        }
    }
</script>

<style lang="scss" scoped>

    td {
        text-align: center;
        border-top: 1px solid #0a0a0a;
    }

    .history-container table tr:first-child td {
        border-top: none;
    }

</style>
