<template>
    <transition name="slide-fade">
        <div v-if="show" class="d-flex notification-container">
            <div class="notification" :class="[ notificationClass ]">
                {{ text }}
            </div>
        </div>
    </transition>
</template>

<script>
    export default {
        props: {
            text: { required: true },
            show: { required: true },
            type: { required: false, default: 'success' },
        },

        computed: {
            notificationClass() {
                return 'is-' + this.type
            }
        },
    }
</script>

<style lang="scss" scoped>

    .notification-container {
        position: fixed;
        bottom: 40px;
        width: 100%;
        justify-content: center;
    }

    .notification {
        background-color: whitesmoke;
        border-radius: 3px;
        padding: 1rem 1.5rem 1rem 1.5rem;
        position: relative;

        &.is-success {
            background-color: #23d160;
            color: #fff;
        }

        &.is-danger {
            background-color: #ff3860;
            color: #fff;
        }
    }

    .slide-fade-enter-active {
        transition: all .3s ease;
    }

    .slide-fade-leave-active {
        transition: all .5s cubic-bezier(1.0, 0.5, 0.8, 1.0);
    }

    .slide-fade-enter, .slide-fade-leave-to {
        transform: translateY(10px);
        opacity: 0;
    }

</style>
