import _ from 'lodash'
import * as bootstrap from 'bootstrap'
import axios from 'axios'
import jquery from 'jquery'
import Swal from 'sweetalert2'

window.Swal = Swal
window.$ = jquery
window.bootstrap = bootstrap
window.axios = axios
window._ = _
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

const csrf_token = document.head.querySelector('meta[name="csrf-token"]')

if (csrf_token) {
	window.csrf_token = csrf_token.content
	window.axios.defaults.headers.common['X-CSRF-TOKEN'] = window.csrf_token
} else {
	console.error('CSRF token not found: https://laravel.com/docs/9.x/csrf#csrf-x-xsrf-token')
}
