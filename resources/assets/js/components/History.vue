<template>

    <div class="history-container">
        <ul class="list-group list-group-flush">
            <!--<li class="list-group-item" v-for="game in games">-->
                <!--<span>{{ game.playerOne.name }}</span>-->
                <!--<span>{{ game.playerOneScore }} - {{ game.playerTwoScore }}</span>-->
                <!--<span>{{ game.playerTwo.name }}</span>-->
            <!--</li>-->
            <!--  TODO: Uncomment above when working, delete below -->
            <li class="list-group-item">
                <span>Player1</span>
                <span>5 - 2</span>
                <span>Player2</span>
            </li>
            <li class="list-group-item">
                <span>Player1</span>
                <span>5 - 2</span>
                <span>Player2</span>
            </li>
            <li class="empty list-group-item" v-show="games.length === 0">No games have been played yet!</li>
        </ul>
    </div>

</template>

<script>
    export default {

        props: {
            games: { required: true },
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