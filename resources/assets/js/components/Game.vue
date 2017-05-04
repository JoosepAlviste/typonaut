<template>

    <play-full-screen :time="timeSeconds"></play-full-screen>

</template>

<script>

    import PlayFullScreen from './PlayFullScreen.vue'

    export default {

        data() {

            return {
                timeSeconds: 0.000,
                timer: null,
            }
        },

        methods: {
            startTimer() {
                this.advanceTimer()
            },

            advanceTimer() {
                this.timer = setTimeout( () => {
                    this.timeSeconds += 0.1
                    this.advanceTimer()
                }, 100)
            },

            stopTimer() {
                clearTimeout(this.timer)
            },

            resetTimer() {
                this.timer = null
                this.timeSeconds = 0.000
            }
        },

        components: { PlayFullScreen }
    }
</script>

<style lang="scss" scoped>

</style>