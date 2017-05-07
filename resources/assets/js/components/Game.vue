<template>
    <div>
        <play-full-screen :time="timeSeconds"
                          :round="currentRound"
                          :opponent_typed="opponent_typed"
                          @answer-was-submitted="handleAnswerSubmitted"
                          @typed="handleTyped">
        </play-full-screen>
        <game-score v-if="showResults" :completed_rounds="completed_rounds" :game="game"></game-score>
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

                playerFinished: false,
                opponentFinished: false,
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
                    return false
                }

                this.opponentFinished = false
                this.playerFinished = false

                this.completed_rounds.push(this.game.rounds[this.currentRoundNr])
                this.currentRoundNr++

                return true
            },

            handleAnswerSubmitted(word) {
                if (word !== this.currentRound.word) {
                    // Wrong!
                    return
                }

                let time = this.timeSeconds

                axios.post('/api/games/' + this.game.id + '/rounds/' + this.currentRound.id, {
                    user_id: window.Laravel.user.id,
                    time: time,
                    word: word,
                })
                    .then(() => {
                        Echo.join('game.' + this.game.id)
                            .whisper('finished', {})
                        this.playerFinished = true
                        this.checkRoundEnd()
                    })
            },

            joinChannel() {
                Echo.join('game.' + this.game.id)
                    .here( (users) => {
                        // Check if opponent here too
                    })
                    .joining( (user) => {
                        // Check if opponent here too
                    })
                    .leaving( (user) => {
                        // Notify of opponent leaving
                    })
                    .listenForWhisper('typed', message => {
                        this.opponent_typed = message.typed
                    })
                    .listenForWhisper('finished', () => {
                        this.opponentFinished = true

                        this.checkRoundEnd()
                    })
            },

            handleTyped(word) {
                Echo.join('game.' + this.game.id)
                    .whisper('typed', {
                        typed: word
                    })
            },

            checkRoundEnd() {
                if (!this.opponentFinished || !this.playerFinished) {
                    return
                }

                // Next round, show results n stuff
                // TODO: switch round and display gameScore and Countdown
                if (this.nextRound()) {
                    this.startRound()
                } else {
                    // Game over! Show final game report or something
                    console.log('Game over!')
                }
            },

            startRound() {
                this.stopTimer()
                this.resetTimer()
                // Show countdown
                // Don't allow submitting answer here

                setTimeout(() => {
                    this.startTimer()
                    // Allow submitting answers again..
                }, 4000)
            },
        },

        mounted() {
            this.joinChannel()

            this.startRound()
        },

        components: { PlayFullScreen, GameScore }
    }
</script>

<style lang="scss" scoped>

</style>
