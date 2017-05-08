<template>

    <div class="game-score-container">
        <div class="card dark-card">
            <div class="card-block">
                <div class="overview-container">
                    <div class="scores">{{ score }}</div>
                    <div class="winner-text">{{ winner }}</div>
                </div>
                <hr>
                <table class="rounds-table">
                    <thead>
                        <tr class="header">
                            <td class="word">Word</td>
                            <td class="player-time">{{ game.player_one.name }}'s time</td>
                            <td class="player-time">{{ game.player_two.name }}'s time</td>
                            <td class="winner">Result</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="round in completed_rounds">
                            <td class="word">{{ round.word }}</td>
                            <td class="player-time">{{ round.player_one_time | formatTime }}</td>
                            <td class="player-time">{{ round.player_two_time | formatTime}}</td>
                            <td class="winner">{{ calculateWinnerText(round.player_one_time, round.player_two_time) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="card-footer" v-if="!game_over">
                <div class="d-flex">

                    <span class="flex">
                        <button class="btn btn-secondary" :disabled="buttonDisabled" @click="nextRoundClicked">{{ playerText }}</button>
                    </span>

                    <span>
                        {{ opponentText }}
                    </span>

                </div>
            </div>
            <div class="card-footer" v-else>
                <button class="btn btn-secondary" @click="$emit('dismissed')">Game over!</button>
            </div>
        </div>
    </div>

</template>

<script>

    export default {
        props: {
            completed_rounds: { required: true },
            game: { required: true },
            game_over: { required: true },
        },

        data() {
            return {
                opponentAccepted: false,
                playerAccepted: false,
                buttonDisabled: false,
            }
        },

        computed: {

            score() {
                let scoreOne = 0
                let scoreTwo = 0
                this.completed_rounds.forEach( round => {
                    if (round.player_one_time < round.player_two_time) {
                        scoreOne++
                    } else {
                        scoreTwo++
                    }
                })
                
                return window.Laravel.user.id == this.game.player_one.id ? scoreOne + " - " + scoreTwo : scoreTwo + " - " + scoreOne
            },

            winner() {
                let lastRound = this.completed_rounds[this.completed_rounds.length - 1]

                return this.calculateWinnerText(lastRound.player_one_time, lastRound.player_two_time)
            },

            opponentText() {
                return this.opponentAccepted ? 'Opponent accepted' : 'Waiting for opponent...'
            },

            playerText() {
                return this.playerAccepted ? 'Ready...' : 'Next round'
            }
        },

        filters: {
            formatTime(time) {
                return Math.round(time*10)/10
            }
        },


        methods: {
            nextRoundClicked() {
                this.playerAccepted = true
                this.buttonDisabled = true
                Echo.join('game.' + this.game.id)
                    .whisper('next-clicked', {})
                this.checkBothAccepted()
            },

            checkBothAccepted() {
                if (this.opponentAccepted && this.playerAccepted) {
                    this.$emit('dismissed')
                }
            },

            calculateWinnerText(player_one_time, player_two_time) {
                let playerOne = this.game.player_one.id
                let playerTwo = this.game.player_two.id
                let winner = parseFloat(player_one_time) < parseFloat(player_two_time) ? playerOne : playerTwo

                return window.Laravel.user.id == winner ? 'You won!' : 'You lost!'
            }
        },

        mounted() {
            this.buttonDisabled = false
            Echo.join('game.' + this.game.id)
                .listenForWhisper('next-clicked', (e) => {
                    this.opponentAccepted = true
                    this.checkBothAccepted()
                })
        }
    }

</script>

<style lang="scss" scoped>

    .game-score-container {
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: 1050;
        display: flex;
        align-items: center;
        justify-content: center;

        background-color: rgba(0, 0, 0, 0.7);

        hr {
            border-top: 1px solid #fdfcfc;
        }
    }

    .overview-container {
        text-align: center;
        font-family: 'Noto Serif', serif;

        .scores {
            font-size: 60px;
        }

        .winner-text {
            font-size: 50px;
        }
    }

    .game-score-container .dark-card {
        border: 2px solid #fdfcfc;
        background-color: rgba(0, 0, 0, 0.8);
        border-radius: 2px;

        .card-block {
            padding: 1.5rem;
        }
    }

    .rounds-table {
        padding: 0;
        font-size: 1.1rem;

        .header td {
            padding-bottom: 10px;
        }

        td {
            padding: 0px 10px;
            text-align: center;
        }
    }

    .flex {
        flex: 1;
    }
</style>
