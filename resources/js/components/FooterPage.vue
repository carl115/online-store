<template>
	<div class="bg-white py-10 text-black flex items-center justify-around">
		<div class="mx-5 flex flex-col justify-center items-center">
			<font-awesome-icon icon="fa-regular fa-gem" class="mb-3 text-7xl" />
			<strong>&copy; 2022 Online Store</strong>
		</div>
		<div class="flex flex-col">
			<strong class="mb-4">Social Media</strong>
			<div>
				<a href="" title="Facebook">
					<font-awesome-icon
						icon="fa-brands fa-square-facebook"
						class="mr-4 text-4xl hover:text-blue-600"
					/>
				</a>
				<a href="" title="Twitter">
					<font-awesome-icon
						icon="fa-brands fa-twitter"
						class="mr-4 text-4xl hover:text-cyan-500"
					/>
				</a>
				<a href="" title="Instagram">
					<font-awesome-icon
						icon="fa-brands fa-instagram"
						class="mr-4 text-4xl hover:text-purple-700"
					/>
				</a>
				<a href="" title="YouTube">
					<font-awesome-icon
						icon="fa-brands fa-youtube"
						class="text-4xl hover:text-red-600"
					/>
				</a>
			</div>
		</div>
	</div>
</template>

<script>
	import { library } from '@fortawesome/fontawesome-svg-core'
	import { faGem } from '@fortawesome/free-regular-svg-icons'
	import {
		faFacebookSquare,
		faTwitter,
		faInstagram,
		faYoutube
	} from '@fortawesome/free-brands-svg-icons'
	import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

	library.add(faGem, faFacebookSquare, faTwitter, faInstagram, faYoutube)

	export default {
		components: {
			FontAwesomeIcon
		}
	}
</script>
