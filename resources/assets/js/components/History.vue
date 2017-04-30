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

        mounted() {
            axios.get('/games')
                .then(({data}) => {
                    this.gamesPlayed = data
                })
        }
    }
</script>
