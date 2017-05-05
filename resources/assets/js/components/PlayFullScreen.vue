<template>
    <div class="play-container">
        <play-half-screen side="player" :time="time" :round="round" @answer-was-submitted="onAnswerSubmitted"></play-half-screen>
        <div class="time-container">
            <p>{{ time | formatTime }}</p>
        </div>
        <play-half-screen side="opponent" :time="time" :round="round"></play-half-screen>
    </div>
</template>

<script>
    import PlayHalfScreen from './PlayHalfScreen.vue'

    export default {

        props: {
            time: { required: true },
            round: { required: true },
        },

        filters: {
            formatTime(time) {
                return Math.round(time*10)/10
            }
        },

        methods: {
            onAnswerSubmitted(word) {
                this.$emit('answer-was-submitted', word)
            }
        },

        components: { PlayHalfScreen },
    }
</script>

<style lang="scss" scoped>

    .play-container {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-content: stretch;
        font-family: 'Noto Serif', serif;
    }

    .time-container {
        align-self: center;
        height: 100px;
        width: 100px;
        border-radius: 50%;
        background-color: #22313F;
        position: absolute;
        top:calc(50% - 50px);
        left:calc(50% - 50px);
        line-height: 95px;
        text-align: center;
        border: 5px solid #fffcff;
        color: #fffcff;
        border-right-color: #303036;
        border-bottom-color: #303036;
        transform: rotate(-45deg);

        p {
            transform: rotate(45deg);
            font-size: 1.4rem;
            font-family: 'Noto Sans', sans-serif;
        }
    }

</style>
