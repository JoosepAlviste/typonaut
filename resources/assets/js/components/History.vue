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

        methods: {
            handleChallenge(user) {
                console.log(user)
            },
        },

        mounted() {
            axios.get('/api/games')
                .then(({data}) => {
                    this.gamesPlayed = data
                })
        }
    }
</script>
