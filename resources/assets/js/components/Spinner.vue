<template>
    <div class="spinner" v-if="show">
        <div class="spinner-content">

            <div class="spinner-loader">
                <!-- TODO: Loader here -->
            </div>

            <div class="spinner-text">
                {{ text }}
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        props: [ 'text', 'show' ],
    }
</script>

<style lang="scss" scoped>

    .spinner {
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: 1050;
        display: flex;
        align-items: center;
        justify-content: center;

        background-color: rgba(255, 255, 255, 0.5);
    }

    .spinner-content {
        color: #333333;
    }

</style>
