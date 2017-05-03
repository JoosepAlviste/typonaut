<template>
    <li class="user-entry list-group-item" @click="handleChallenge">
        <p>{{ user.name }}</p>
    </li>
</template>

<script>
    export default {
        props: [ 'user' ],

        methods: {
            handleChallenge() {
                Events.$emit('challenge', this.user)
            }
        }
    }
</script>
