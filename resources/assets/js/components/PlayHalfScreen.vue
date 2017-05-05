<template>
    <div class="half-screen pt-5" :class="[ side ]">
        <h1>{{ round.word }}</h1>
        <input type="text"
               class="form-control form-control-lg word-input"
               name="word-input"
               v-model="typed"
               :disabled="side === 'opponent'"
               @keydown.enter="onEnterPressed">
    </div>
</template>

<script>
    export default {
        props: {
            side: { required: true },
            round: { required: true },
        },

        data() {
            return {
                typed: '',
            }
        },

        methods: {
            onEnterPressed(e) {
                if (this.round.word !== this.typed) {
                    // Incorrect word
                    return
                }

                this.$emit('answer-was-submitted', this.typed)
            }
        }
    }
</script>

<style lang="scss" scoped>

    .half-screen {
        height: 100vh;
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;

        &.player {
            background-color: #303036;
            color: #fffcff;
        }

        &.opponent {
            background-color: #fffcff;
            color: #303036;
        }

        h1 {
            flex: 0.35;
        }
    }

    .word-input {
        width: 75%;

        &:focus {
            border-color: #48d1cc;
        }
    }

    .time-container {
        text-align: center;
    }

</style>
