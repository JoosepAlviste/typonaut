<template>
    <div>
        <play-full-screen :time="timeSeconds"
                          :round="currentRound"
                          :opponent_typed="opponent_typed"
                          @answer-was-submitted="handleAnswerSubmitted"
                          @typed="handleTyped">
        </play-full-screen>

        <game-score v-if="showResults"
                    :completed_rounds="completed_rounds"
                    :game="game"
                    :game_over="gameOver"
                    @dismissed="handleScoreDismissed">
        </game-score>

        <countdown :show="showCountdown" @countdown-was-finished="handleCountdownFinish">
        </countdown>
    </div>

</template>

<script>

    import PlayFullScreen from './PlayFullScreen.vue'
    import GameScore from './GameScore.vue'
    import Countdown from './Countdown.vue'

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
                showCountdown: false,

                playerFinished: false,
                opponentFinished: false,

                gameOver: false,
            }
        },

        computed: {
            currentRound() {
                if (this.currentRoundNr >= this.game.rounds.length) {
                    return this.game.rounds[this.game.rounds.length - 1]
                }

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
                if (this.currentRoundNr === this.game.rounds.length) {
                    return false
                }

                this.opponentFinished = false
                this.playerFinished = false

                return true
            },

            handleAnswerSubmitted(word) {
                if (word !== this.currentRound.word || this.showCountdown) {
                    // Wrong!
                    return
                }

                let time = this.timeSeconds
                // Remove this if want to see opponent time
                this.stopTimer()

                axios.post('/api/games/' + this.game.id + '/rounds/' + this.currentRound.id, {
                    user_id: window.Laravel.user.id,
                    time: time,
                    word: word,
                })
                    .then((data) => {
                        let round = data.data

                        if (round.player_one_time !== null && round.player_two_time !== null) {
                            this.completed_rounds.push(round)
                            this.currentRoundNr++
                        }

                        Echo.join('game.' + this.game.id)
                            .whisper('finished', {
                                round: round,
                            })
                        this.playerFinished = true
                        this.checkRoundEnd()
                    })
                    .catch(error => {
                        // Do something with error?
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
                    .listenForWhisper('finished', (data) => {
                        this.opponentFinished = true

                        if (typeof data.round !== 'undefined' && data.round.player_one_time !== null && data.round.player_two_time !== null) {
                            this.completed_rounds.push(data.round)
                            this.currentRoundNr++
                        }

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

                if (this.currentRoundNr === this.game.rounds.length) {
                    this.gameOver = true
                }

                this.showResults = true
            },

            startRound() {
                this.stopTimer()
                this.resetTimer()
                this.emptyFields()
                // Show countdown
                // Don't allow submitting answer here
                this.showCountdown = true
                this.opponent_typed = ''
                window.Events.$emit('new-round')

                setTimeout(() => {
                    this.startTimer()
                    // Allow submitting answers again..

                    window.Events.$emit('new-round-start-typing')
                }, 4000)
            },

            emptyFields() {
                this.opponent_typed = ''
            },

            handleCountdownFinish(e) {
                this.showCountdown = false
            },

            handleScoreDismissed(e) {
                this.showResults = false

                if (this.gameOver) {
                    this.redirectAfterGameOver()
                }

                if (this.nextRound()) {
                    this.startRound()
                } else {
                    // Game over! Show final game report or something
                    this.redirectAfterGameOver()
                }
            },

            redirectAfterGameOver() {
                console.log('REDIRECTING')
                window.location = '/history'
            }
        },

        mounted() {
            this.joinChannel()

            this.startRound()
        },

        components: { PlayFullScreen, GameScore, Countdown }
    }
</script>

<style lang="scss" scoped>

</style>
