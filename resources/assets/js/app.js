/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap')

window.Vue = require('vue')

window.Events = new Vue();

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'))
Vue.component('user-entry', require('./components/UserEntry.vue'))
Vue.component('user-list', require('./components/UserList.vue'))
Vue.component('lobby', require('./components/Lobby.vue'))
Vue.component('history', require('./components/History.vue'))
Vue.component('game-entry', require('./components/GameEntry.vue'))
Vue.component('game-list', require('./components/GameList.vue'))
Vue.component('game', require('./components/Game.vue'))
Vue.component('modal', require('./components/Modal.vue'))

const app = new Vue({
    el: '#app',

    data: {
        showModal: false,
        modalBody: "",
    },

    methods: {
        displayModal(text) {
            this.showModal = true
            this.modalBody = text
        },

        hideModal() {
            this.showModal = false
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
        window.Events.$on('show-modal', (text, primaryCallback, secondaryCallback) => {
            this.displayModal(text)

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
    }
})
