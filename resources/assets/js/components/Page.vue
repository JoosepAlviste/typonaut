<template>
    <div class="page-container" :class="[ pageContainerClass ]">

        <slot name="navigation"></slot>

        <div class="page-wrap">
            <button class="menu-toggle-btn" @click="handleMenuToggleClicked"></button>

            <div class="page-content-container">
                <slot></slot>
            </div>
        </div>

    </div>
</template>

<script>

    export default {

        data() {
            return {
                is_menu_open: false,
            }
        },

        computed: {
            pageContainerClass() {
                return this.is_menu_open ? 'open' : ''
            }
        },

        methods: {
            handleMenuToggleClicked() {
                this.is_menu_open = !this.is_menu_open
            }
        }
    }
</script>

<style lang="scss" scoped>

    @import '../../sass/variables';
    @import '../../sass/mixins';

    .menu {
        position: fixed;
        top: 0;
        left: -$nav-width;

        width: $nav-width;
        height: 100%;
        padding: 50px 30px;
        @include box-sizing(border-box);

        @include transition(all .3s ease-in);
        text-align: center;

        background-color: $primary-light;

        .brand {
            height: 46px;

            font-size: 53px;
            font-weight: 900;
            line-height: .6;

            color: $primary-dark;
        }

        ul {
            padding: 0;
            margin-top: 30px;
            list-style: none;

            li {
                a {
                    display: block;

                    font-weight: 900;
                    line-height: 50px;

                    @include transition(all .3s ease);
                    text-decoration: none;
                    text-transform: uppercase;

                    color: $primary-dark;
                    border-top: 1px solid lighten($primary-dark, 70%);

                    &:hover {
                        letter-spacing: 1px;
                    }
                }

                &:last-child {
                    border-bottom: 1px solid lighten($primary-dark, 70%);
                }
            }
        }
    }

    .page-container.open {

        .menu {
            left: 0;
        }

        .page-wrap {
            margin-left: $nav-width;
        }

        .menu-toggle-btn:before,
        .menu-toggle-btn:after {
            @include transform(rotate(45deg));
        }
    }

    .page-wrap {
        @include box-sizing(border-box);

        @include transition(all .3s ease-in);
    }

    .menu-toggle-btn {
        position: absolute;

        width: 51px;
        height: 51px;
        margin: 50px;
        z-index: 2;

        cursor: pointer;

        border: none;
        @include border-radius(50px);
        background: $primary-light;
        @include transition(transform .3s ease-out);

        &:hover {
            @include transform(scale(1.1));
        }

        &:focus {
            outline: none;
        }

        &:before,
        &:after {
            position: absolute;

            content: "";
            @include transition(all .5s ease);

            background-color: $primary-dark;
        }

        &:before {
            top: 12px;
            left: 25px;

            width: 1px;
            height: 27px;
        }

        &:after {
            top: 25px;
            left: 12px;

            width: 27px;
            height: 1px;
        }
    }

</style>
