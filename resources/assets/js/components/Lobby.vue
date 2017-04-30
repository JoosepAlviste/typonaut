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
                    .listen('UserWasChallenged', this.receiveChallenge)
            },

            challengeUser(user) {
                axios.post('/users/' + user.id + '/challenge')
                    .then(data => {
                        if (data.status == 200) {
                            // Show waiting for reply notification/modal
                        } else {
                            // Show something went wrong notification
                        }
                    })
            },

            receiveChallenge(data) {
                if (data.userChallenged.id !== window.Laravel.user.id) {
                    return
                }

                console.log(data)
            }
        },

        mounted() {
            this.joinLobby()

            Events.$on('challenge', user => {
                this.challengeUser(user)
            })
        },
    }
</script>
