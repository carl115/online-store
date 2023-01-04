<template>
	<div class="py-1">
		<div class="w-full xl:w-8/12 mt-12 mb-12 ml-[25%]">
			<div class="relative flex flex-col min-w-0 bg-white w-full mb-6 rounded">
				<div class="rounded-t mb-0 px-4 py-3 border-0">
					<div class="flex items-center justify-between">
						<div class="relative w-full max-w-full flex-grow flex-1">
							<h3 class="font-bold">Purchases</h3>
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
									User
								</th>
								<th
									class="px-6 border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
								>
									Email
								</th>
								<th
									class="px-6 border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
								>
									Product Name
								</th>
								<th
									class="px-6 border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
								>
									Product Price
								</th>
								<th
									class="px-6 border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
								>
									Amount
								</th>
								<th
									class="px-6 border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
								>
									Total
								</th>
								<th
									class="px-6 border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
								>
									Actions
								</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(purchase, index) in purchases" :key="index">
								<td
									class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
								>
									{{ purchase.user.name }}
								</td>
								<td
									class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
								>
									{{ purchase.user.email }}
								</td>
								<td
									class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
								>
									{{ purchase.product.name }}
								</td>
								<td
									class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
								>
									{{ purchase.product.price }}
								</td>
								<td
									class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
								>
									{{ purchase.amount }}
								</td>
								<td
									class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
								>
									{{ purchase.total }}
								</td>
								<td
									class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
								>
									<button
										class="bg-blue-500 text-white active:bg-blue-700 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
										type="button"
									>
										Edit
									</button>
									<button
										class="bg-red-500 text-white active:bg-red-700 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
										type="button"
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
	</div>
</template>

<script>
	export default {
		data() {
			return {
				purchases: []
			}
		},
		created() {
			this.getPurchases()
		},
		methods: {
			mountTable() {
				$(document).ready(function () {
					$('#dataTables').DataTable()
				})
			},
			async getPurchases() {
				const { data } = await axios.get('http://localhost:8000/api/purchases')

				this.purchases = data

				this.mountTable()
			}
		}
	}
</script>
