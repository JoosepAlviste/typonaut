<template>
    <div class="game">

        <div v-if="opponent_here">
            Playing vs. {{ opponent.name }}.

            <div v-if="game_started">

                <div class="sentence">
                    <p>Your sentence is:</p>
                    <h4>{{ game.words }}</h4>
                </div>

                <div class="form-group">
                    <label for="player-message">Type here:</label>
                    <textarea class="form-control"
                              name="player-message"
                              id="player-message"
                              rows="10"
                              v-model="player_text"
                              @keydown.enter="handleSubmit">
                    </textarea>
                </div>

                <div class="form-group">
                    <label for="opponent-message">Opponent:</label>
                    <textarea class="form-control" name="opponent-message" id="opponent-message" rows="10" v-model="opponent_text" disabled>
                    </textarea>
                </div>

            </div>
        </div>

        <div v-else>

            <div v-if="opponent_left">
                Opponent has left...
            </div>

            <div v-else>
                Opponent is not here yet.
            </div>

        </div>

    </div>
</template>

<script>
    export default {

        props: [ 'game_id' ],

        data() {
            return {
                opponent_here: false,
                opponent_left: false,
                opponent: null,
                game: null,

                game_started: false,
                player_text: '',
                opponent_text: '',
            }
        },

        watch: {
            opponent_here() {
                if (this.opponent_here === true) {
                    this.sendGameStart()
                }
            },

            player_text() {
                Echo.join('game.' + this.game_id)
                    .whisper('typed', {
                        message: this.player_text
                    })
            }
        },

        methods: {
            connectToGame() {
                Echo.join('game.' + this.game_id)
                    .here((users) => {
                        if (users.length > 1) {
                            this.opponent_here = true
                            this.opponent = users.filter(u => {
                                return u.id != window.Laravel.user.id
                            })[0]
                        }
                    })
                    .joining((user) => {
                        this.opponent_here = true
                        this.opponent = user
                    })
                    .leaving((user) => {
                        this.opponent_left = true
                        this.opponent_here = false
                    })
                    .listenForWhisper('typed', this.receiveTyping)
                    .listen('GameWasFinished', data => {
                        console.log(data)
                        if (data.game.winner_id === window.Laravel.user.id) {
                            // You won!
                            console.log('You won!')
                        } else {
                            // You lost :(
                            console.log('You lost :(')
                        }

                        // redirect to history?
                    })
            },

            receiveTyping(data) {
                this.opponent_text = data.message
            },

            getGame() {
                axios.get('/api/games/' + this.game_id)
                    .then(data => {
                        this.game = data.data
                    })
            },

            sendGameStart() {
                axios.post('/api/games/' + this.game_id + '/start')
                    .then(data => {
                        this.startGame()
                    })
            },

            startGame() {
                this.game_started = true
            },

            handleSubmit() {
                if (this.player_text === this.game.words) {
                    axios.post('/api/games/' + this.game_id + '/finish')
                } else {
                    // Show red warning or something, wrong text entered
                }
            }
        },

        mounted() {
            this.getGame()
            this.connectToGame()
        },
    }
</script>
