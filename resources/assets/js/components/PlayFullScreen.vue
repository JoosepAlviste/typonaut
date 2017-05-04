<template>
    <div class="play-container">
        <play-half-screen side="player" :time="time"></play-half-screen>
        <play-half-screen side="opponent" :time="time"></play-half-screen>
    </div>
</template>

<script>
    import PlayHalfScreen from './PlayHalfScreen.vue'

    export default {

        props: {
            time: { required: true }
        },

        components: { PlayHalfScreen }
    }
</script>

<style lang="scss" scoped>

    .play-container {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-content: stretch;
    }

</style>