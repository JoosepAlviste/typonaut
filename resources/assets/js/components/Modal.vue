<template>
    <div class="modal fade" :class="{show:show}" @click="hide">
        <div class="modal-dialog" role="document" @click.prevent="stop">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ title }}</h5>
                    <button type="button" class="close" aria-label="Close" @click="hide">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ body_text }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" @click="$emit('primary-clicked')">{{ primary_btn_text }}</button>
                    <button type="button" class="btn btn-secondary" @click="$emit('secondary-clicked')">{{ secondary_btn_text }}</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {

        props: [ 'show', 'title', 'body_text', 'primary_btn_text', 'secondary_btn_text' ],

        methods: {
            hide() {
                window.Events.$emit('hide-modal')
            },

            stop(e) {
                e.stopPropagation()
            }
        }
    }

</script>

<style lang="scss" scoped>
    .fade.show {
        background-color: rgba(0,0,0,0.5);
    }

    .show {
        display: block;
    }

    .modal-footer .btn {
        cursor: pointer;
    }
</style>