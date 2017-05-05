<template>
    <li class="nested-menu-item">
        <span class="nested-nav-title" @click="is_open = !is_open">
            <span class="title-container"><slot name="title"></slot></span>

            <span class="nested-nav-arrow-container">
                <svg class="nested-nav-arrow" width="444.819px" height="444.819px" viewBox="0 0 444.819 444.819"
                     xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" style="enable-background:new 0 0 444.819 444.819;">
                    <g>
                        <path d="M433.968,278.657L248.387,92.79c-7.419-7.044-16.08-10.566-25.977-10.566c-10.088,0-18.652,3.521-25.697,10.566
                            L10.848,278.657C3.615,285.887,0,294.549,0,304.637c0,10.28,3.619,18.843,10.848,25.693l21.411,21.413
                            c6.854,7.23,15.42,10.852,25.697,10.852c10.278,0,18.842-3.621,25.697-10.852L222.41,213.271L361.168,351.74
                            c6.848,7.228,15.413,10.852,25.7,10.852c10.082,0,18.747-3.624,25.975-10.852l21.409-21.412
                            c7.043-7.043,10.567-15.608,10.567-25.693C444.819,294.545,441.205,285.884,433.968,278.657z"/>
                    </g>
                </svg>
            </span>
        </span>
        <ul class="submenu">
            <slot></slot>
        </ul>
    </li>
</template>

<script>

    export default {

        data() {
            return {
                is_open: false,
            }
        }
    }
</script>

<style lang="scss" scoped>

    @import '../../sass/variables';
    @import '../../sass/mixins';

    .nested-nav-title {

        display: block;

        font-weight: 900;
        line-height: 50px;

        text-decoration: none;
        text-transform: uppercase;

        color: $primary-dark;
        border-top: 1px solid lighten($primary-dark, 70%);

        cursor: pointer;
    }

    .submenu {
        overflow: hidden;
        max-height: 0;
        @include transition(all .5s ease-out);

        list-style: none;

        padding-left: 0;
        padding-bottom: 0;

        li a {
            display: block;

            font-weight: 500;
            line-height: 40px;

            @include transition(all .3s ease);
            text-decoration: none;
            text-transform: uppercase;

            color: $primary-dark;

            &:hover {
                letter-spacing: 1px;
            }
        }
    }

    .nested-menu-item {

        &:hover {
            .submenu {
                display: block;
                max-height: 200px;
                padding-bottom: 10px;
            }

            .nested-nav-arrow {
                @include transform(rotate(0deg));
            }
        }
    }

    .nested-nav-arrow-container {

        margin-left: 8px;

        .nested-nav-arrow {
            width: 15px;
            height: 12px;

            @include transform(rotate(180deg));
            @include transition(transform .3s ease-out);
        }
    }

</style>
