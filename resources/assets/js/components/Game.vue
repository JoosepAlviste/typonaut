<template>

    <play-full-screen :time="timeSeconds"
                      :round="currentRound"
                      @answer-was-submitted="handleAnswerSubmitted">
    </play-full-screen>

</template>

<script>

    import PlayFullScreen from './PlayFullScreen.vue'

    export default {

        props: {
            game: { required: true },
        },

        data() {
            return {
                timeSeconds: 0.0,
                timer: null,
                currentRoundNr: 0,
            }
        },

        computed: {
            currentRound() {
                return this.game.rounds[this.currentRoundNr]
            }
        },

        methods: {
            startTimer() {
                this.advanceTimer()
            },

            advanceTimer() {
                this.timer = setTimeout( () => {
                    this.timeSeconds += 0.1
                    this.advanceTimer()
                }, 100)
            },

            stopTimer() {
                clearTimeout(this.timer)
            },

            resetTimer() {
                this.timer = null
                this.timeSeconds = 0.0
            },

            nextRound() {
                if (this.currentRoundNr + 1 === this.game.rounds.length) {
                    return
                }

                this.currentRoundNr++
            },

            handleAnswerSubmitted(word) {
                if (word !== this.currentRound.word) {
                    // Wrong!
                    return
                }

                // Submit request to server to save result
                let time = this.timeSeconds
            },
        },

        components: { PlayFullScreen }
    }
</script>

<style lang="scss" scoped>

</style>
