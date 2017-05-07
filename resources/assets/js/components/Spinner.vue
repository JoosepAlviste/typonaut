<template>
    <div class="spinner-container" v-if="show">
        <div class="spinner-content">

            <div class="spinner-loader">
                <div class="spinner">
                    <div class="bounce1"></div>
                    <div class="bounce2"></div>
                    <div class="bounce3"></div>
                </div>
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

    .spinner-container {
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: 1050;
        display: flex;
        align-items: center;
        justify-content: center;

        background-color: rgba(0, 0, 0, 0.7);
    }

    .spinner-text {
        font-size: 1.5rem;
    }

    .spinner-content {
        color: #fdfcfc;
    }

    .spinner {
        margin: 0 auto 10%;
        width: 70px;
        text-align: center;
    }

    .spinner > div {
        width: 18px;
        height: 18px;
        background-color: #fdfcfc;

        border-radius: 100%;
        display: inline-block;
        -webkit-animation: sk-bouncedelay 1.4s infinite ease-in-out both;
        animation: sk-bouncedelay 1.4s infinite ease-in-out both;
    }

    .spinner .bounce1 {
        -webkit-animation-delay: -0.32s;
        animation-delay: -0.32s;
    }

    .spinner .bounce2 {
        -webkit-animation-delay: -0.16s;
        animation-delay: -0.16s;
    }

    @-webkit-keyframes sk-bouncedelay {
        0%, 80%, 100% { -webkit-transform: scale(0) }
        40% { -webkit-transform: scale(1.0) }
    }

    @keyframes sk-bouncedelay {
        0%, 80%, 100% {
            -webkit-transform: scale(0);
            transform: scale(0);
        } 40% {
              -webkit-transform: scale(1.0);
              transform: scale(1.0);
          }
    }

</style>
