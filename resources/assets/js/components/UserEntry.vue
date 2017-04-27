<template>
    <li class="user-entry list-group-item" @click="sendChallenge">
        <p>{{ user.name }}</p>
    </li>
</template>

<script>
    export default {
        props: [ 'user' ],

        methods: {
            sendChallenge() {
                console.log(this.user.name);
            }
        }
    }
</script>