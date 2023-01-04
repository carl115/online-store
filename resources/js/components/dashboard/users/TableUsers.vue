<template>
	<div class="py-1">
		<div class="w-full xl:w-8/12 mt-12 mb-12 ml-[25%]">
			<div class="relative flex flex-col min-w-0 bg-white w-full mb-6 rounded">
				<div class="rounded-t mb-0 px-4 py-3 border-0">
					<div class="flex items-center justify-between">
						<div class="relative w-full max-w-full flex-grow flex-1">
							<h3 class="font-bold">Users</h3>
						</div>
						<div class="relative w-full max-w-full flex-grow flex-1 text-right">
							<button
								class="bg-green-500 text-white active:bg-green-700 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
								type="button"
								@click="createUser"
							>
								Create User
							</button>
						</div>
					</div>
				</div>
				<div class="block w-full overflow-x-auto">
					<table
						id="dataTables"
						class="items-center bg-transparent w-full border-collapse"
					>
						<thead>
							<tr>
								<th
									class="px-6 border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
								>
									User name
								</th>
								<th
									class="px-6 border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
								>
									Email
								</th>
								<th
									class="px-6 border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
								>
									Actions
								</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(user, index) in users" :key="index">
								<td
									class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
								>
									{{ user.name }}
								</td>
								<td
									class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
								>
									{{ user.email }}
								</td>
								<td>
									<button
										class="bg-blue-500 text-white active:bg-blue-700 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
										type="button"
										@click="updateUser(user.id)"
									>
										Edit
									</button>
									<button
										class="bg-red-500 text-white active:bg-red-700 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
										type="button"
										@click="deleteUser(user.id)"
									>
										Delete
									</button>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<user-form v-if="showUserForm"></user-form>
	</div>
</template>

<script>
	import UserForm from './UserForm.vue'

	export default {
		data() {
			return {
				is_create: null,
				users: [],
				userId: null,
				showUserForm: false
			}
		},
		components: {
			UserForm
		},
		created() {
			this.getUsers()
		},
		methods: {
			mountTable() {
				$(document).ready(function () {
					$('#dataTables').DataTable()
				})
			},
			async getUsers() {
				const { data } = await axios.get('http://localhost:8000/api/users')

				this.users = data

				this.mountTable()
			},
			createUser() {
				this.is_create = true
				this.showUserForm = true
			},
			updateUser(id) {
				this.is_create = false
				this.showUserForm = true
				this.userId = id
			},
			async deleteUser(id) {
				const result = await Swal.fire({
					title: 'Are you sure to delete user?',
					showCancelButton: true,
					confirmButtonText: 'Delete'
				})
				if (result.isConfirmed) {
					try {
						await axios.delete(`http://localhost:8000/api/users/delete/${id}`)

						this.getUsers()

						Swal.fire('Deleted!', 'User deleted correctly', 'success')
					} catch (error) {
						Swal.fire('Error occurred!', '', 'error')
						console.error(error)
					}
				}
			}
		}
	}
</script>
