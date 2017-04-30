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
            },

            challengeUser(user) {
                Echo.join('lobby')
                    .whisper('challenge', {
                        challenger: window.Laravel.user,
                        userChallenged: user,
                    })
                // Show some waiting for response notification...
            },

            receiveChallenge(event) {
                if (event.userChallenged.id !== window.Laravel.user.id) {
                    return
                }

                // Show modal or something to accept or decline challenge
                console.log(event)
            },

            acceptChallenge(challenger) {
                // TODO: Emit accept-challenge from modal
                
                axios.post('/api/games')
                    .then(data => {
                        window.location = "/game/" + data.id
                    })
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
