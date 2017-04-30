<template>
    <game-list :games_played="gamesPlayed"></game-list>
</template>

<script>
    export default {
        data() {
            return {
                gamesPlayed: [],
            }
        },
    }
</script>
