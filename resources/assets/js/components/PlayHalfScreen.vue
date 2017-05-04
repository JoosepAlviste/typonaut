<template>
    <div class="half-screen" :class="[ side ]">
        <h1>Maakera</h1>
        <input type="text" class="form-control form-control-lg word-input" name="word-input">
        <div class="time-container">
            <h4>{{ timeText }}</h4>
            <h4 class="time-span">{{ time | formatTime }}</h4>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            side: { required: true },
            time: { required: true },
        },

        computed: {
            timeText() {
                if (this.side == 'player') {
                    return 'Your time:'
                } else {
                    return 'Opponent time:'
                }
            }
        },

        filters: {
            formatTime(time) {
                return Math.round(time*10)/10
            }
        }
    }
</script>

<style lang="scss" scoped>

    .half-screen {
        height: 90vh;
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-around;
        color: #ffffff;

        &.player {
            background-color: #44e5e7;
        }

        &.opponent {
            background-color: #5c7aff;
        }
    }

    .word-input {
        width: 75%
    }

    .time-container {
        text-align: center;
    }

</style>