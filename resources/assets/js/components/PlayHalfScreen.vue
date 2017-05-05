<template>
    <div class="half-screen pt-5" :class="[ side ]">
        <h1>Maakera</h1>
        <input type="text" class="form-control form-control-lg word-input" name="word-input">
    </div>
</template>

<script>
    export default {
        props: {
            side: { required: true },
        },
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