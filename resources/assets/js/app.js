
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

window.Events = new Vue();

require('./scripts')

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));

import Lobby from './components/Lobby.vue'
import Modal from './components/Modal.vue'
import Spinner from './components/Spinner.vue'
import Game from './components/Game.vue'
import Page from './components/Page.vue'
import NestedNavItem from './components/NestedNavItem.vue'
import Countdown from './components/Countdown.vue'
import History from './components/History.vue'

const app = new Vue({
    el: '#app',

    data: {
        spinner: {
            show: false,
            text: '',
        },
        modal: {
            show: false,
            title: '',
            bodyText: '',
            primaryBtnText: '',
            secondaryBtnText: '',
        },
        games: []
    },

    methods: {
        displayModal(modalTexts) {
            this.modal.show = true
            this.modal.bodyText= modalTexts.bodyText
            this.modal.title = modalTexts.title
            this.modal.primaryBtnText = modalTexts.primaryBtnText
            this.modal.secondaryBtnText = modalTexts.secondaryBtnText
        },

        hideModal() {
            this.modal.show = false
        },

        handlePrimaryClick() {
            window.Events.$emit('modal-primary-clicked')
            this.hideModal()
        },

        handleSecondaryClick() {
            window.Events.$emit('modal-secondary-clicked')
            this.hideModal()
        },
    },

    mounted() {
        window.Events.$on('show-modal', (modalTexts, primaryCallback, secondaryCallback) => {
            this.displayModal(modalTexts)

            window.Events.$off('modal-primary-clicked')
            window.Events.$off('modal-secondary-clicked')

            if (typeof primaryCallback !== 'undefined') {
                window.Events.$on('modal-primary-clicked', primaryCallback)
            }

            if (typeof secondaryCallback !== 'undefined') {
                window.Events.$on('modal-secondary-clicked', secondaryCallback)
            }
        })

        window.Events.$on('hide-modal', () => {
            this.hideModal()
        })

        window.Events.$on('show-spinner', text => {
            this.spinner = {
                show: true,
                text: text,
            }
        })

        window.Events.$on('hide-spinner', () => {
            this.spinner = {
                show: false,
                text: '',
            }
        })
    },

    components: { Lobby, Modal, Spinner, Game, Page, NestedNavItem, Countdown, History },
});
