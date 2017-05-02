<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header with-badge">
                        Lobby
                        <span class="badge badge-pill badge-info float-right">{{ usersInLobby.length }}</span>
                    </div>

                    <div class="card-block lobby-block">
                        <user-list :users_in_lobby="otherUsersList"></user-list>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                usersInLobby: [],
            }
        },

        computed: {
            otherUsersList() {
                return this.usersInLobby.filter((user) => user.id !== window.Laravel.user.id)
            }
        },

        methods: {
            receiveChallenge(event) {
                if (event.userChallenged.id !== window.Laravel.user.id) {
                    return
                }

                // Show modal or something to accept or decline challenge
                window.Events.$emit(
                    'show-modal',
                    'You are challenged by ' + event.challenger.name + '! Do you accept?',
                    () => this.acceptChallenge(event.challenger),
                    () => {
                        console.log('secondary clicked')
                    }
                )
            },

            acceptChallenge(challenger) {
                axios.post('/api/games', {
                    challenger_id: challenger.id,
                })
                    .then(data => {
                        Echo.join('lobby')
                            .whisper('acceptChallenge', {
                                challenger: challenger,
                                userChallenged: window.Laravel.user,
                                gameId: data.data.id,
                            })

                        window.location = "/game/" + data.data.id
                    })

            },

            joinLobby() {
                Echo.join('lobby')
                    .here((users) => {
                        this.usersInLobby = users
                    })
                    .joining((user) => {
                        this.usersInLobby.push(user)
                    })
                    .leaving((user) => {
                        this.usersInLobby = this.usersInLobby.filter(u => u.id !== user.id)
                    })
                    .listenForWhisper('challenge', this.receiveChallenge)
                    .listenForWhisper('acceptChallenge', (event) => {
                        // The other user accepted my challenge
                        // Redirect to the game!
//                        console.log('challenge accepted')
//                        console.log(event)
                        window.location = "/game/" + event.gameId
                    })
                    .listenForWhisper('declineChallenge', (event) => {
                        // The other user declined my challenge
                        console.log('challenge declined')
                        console.log(event)
                    })
            },

            challengeUser(user) {
                Echo.join('lobby')
                    .whisper('challenge', {
                        challenger: window.Laravel.user,
                        userChallenged: user,
                    })

                // Show some waiting for response notification...
            },
        },

        mounted() {
            this.joinLobby()

            Events.$on('challenge', user => {
                this.challengeUser(user)
            })
            Events.$on('accept-challenge', this.acceptChallenge)
        },
    }
</script>
