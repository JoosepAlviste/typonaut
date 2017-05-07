<template>

    <div class="history-container">
        <ul class="list-group list-group-flush">
            <li class="list-group-item" v-for="game in games">
                <span>{{ game.player_one.name }}</span>
                <span>{{ game.player_one_score }} - {{ game.player_two_score }}</span>
                <span>{{ game.player_two.name }}</span>
            </li>
            
            <li class="empty list-group-item" v-show="games.length === 0">No games have been played yet!</li>
        </ul>
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

    .list-group-item {
        display: flex;
        flex-direction: row;
        justify-content: space-around;
        align-items: center;
    }

</style>
