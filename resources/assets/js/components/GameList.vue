<template>
    <div class="game-list">
        <ul class="list-group list-group-flush">
            <game-entry v-for="(game, index) in games_played" :game="game" :key="index"></game-entry>
            <li class="empty list-group-item" v-show="games_played.length === 0">No games played yet!</li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: {
            games_played: { required: true },
        },
    }
</script>