<template>

    <div class="countdown-container">
        <h1 class="pulsate" :class="{ hidden: !timerOn }">{{ timeSeconds }}</h1>
    </div>

</template>

<script>
    export default {

        data() {
            return {
                timer: null,
                timeSeconds: 3,
                timerOn: false
            }
        },

        methods: {
            startTimer() {
                this.timerOn = true
                this.advanceTimer()
            },

            advanceTimer() {
                this.timer = setTimeout( () => {
                    this.timeSeconds -= 1
                    if (this.timeSeconds === 0) {
                        this.timeSeconds = 'GO'
                        setTimeout( () => {
                            this.stopTimer()
                        }, 1000)
                    } else {
                        this.advanceTimer()
                    }
                }, 1000)
            },

            stopTimer() {
                this.timerOn = false
                clearTimeout(this.timer)
            },

            resetTimer() {
                this.timer = null
                this.timeSeconds = 3
            },
        },

        mounted() {
            this.startTimer()
        }
    }
</script>

<style lang="scss" scoped>
    .countdown-container {
        position: fixed;
        top: 0;
        bottom: 0;
        right: 0;
        left: 0;
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;

        h1 {
            font-size: 250px;
            color: rgba(255, 255, 255, 0.4);
        }
    }

    .pulsate {
        -webkit-animation: pulsate 1s ease-out;
        -webkit-animation-iteration-count: infinite;
        opacity: 0;
    }

    @-webkit-keyframes pulsate {
        0% {
            opacity: 0;
        }
        50% {
            opacity: 1.0;
        }
        100% {
            opacity: 0;
        }
    }
</style>