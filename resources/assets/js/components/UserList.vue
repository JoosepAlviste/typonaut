<template>
    <div class="user-list">
        <ul class="list-group list-group-flush">
            <user-entry v-for="(user, index) in users_in_lobby"
                        :key="index"
                        :user="user">
            </user-entry>
            <li class="empty list-group-item" v-show="users_in_lobby.length === 0">Nobody is here!</li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: {
            users_in_lobby: { required: true },
        },
    }
</script>
