<template>
    <div class="modal fade" :class="{show:show}" @click="hide">
        <div class="modal-dialog" role="document" @click.prevent="stop">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" aria-label="Close" @click="hide">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <slot></slot>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" @click="$emit('primary-clicked')">Save changes</button>
                    <button type="button" class="btn btn-secondary" @click="$emit('secondary-clicked')">Close</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {

        props: [ 'show' ],

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
</style>