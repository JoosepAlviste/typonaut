<template>
    <div>
        <play-full-screen :time="timeSeconds"
                          :round="currentRound"
                          :opponent_typed="opponent_typed"
                          @answer-was-submitted="handleAnswerSubmitted"
                          @typed="handleTyped">
        </play-full-screen>
        <game-score v-show="showResults" :completed_rounds="completed_rounds" :game="game"></game-score>
    </div>

</template>

<script>

    import PlayFullScreen from './PlayFullScreen.vue'
    import GameScore from './GameScore.vue'

    export default {

        props: {
            game: { required: true },
        },

        data() {
            return {
                timeSeconds: 0.0,
                timer: null,
                currentRoundNr: 0,
                opponent_typed: '',
                completed_rounds: [],
                showResults: false, //change this somewhere
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
                this.completed_rounds.push(this.game.rounds[this.currentRoundNr])
                this.currentRoundNr++
            },

            handleAnswerSubmitted(word) {
                if (word !== this.currentRound.word) {
                    // Wrong!
                    return
                }

                // Submit request to server to save result
                let time = this.timeSeconds
                //TODO: switch round and display gameScore and Countdown
                //this.nextRound()
            },

            joinChannel() {
                Echo.join('game.' + this.game.id)
                    .here( (users) => {

                    })
                    .joining( (user) => {

                    })
                    .leaving( (user) => {

                    })
                    .listenForWhisper('typed', message => {
                        this.opponent_typed = message.typed
                    })
            },

            handleTyped(word) {
                Echo.join('game.' + this.game.id)
                    .whisper('typed', {
                        typed: word
                    })
            }
        },

        mounted() {
            this.joinChannel()
        },

        components: { PlayFullScreen, GameScore }
    }
</script>

<style lang="scss" scoped>

</style>
