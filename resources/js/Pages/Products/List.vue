<template>
	<app-layout>
		<template #header>
			<h2 class="font-semibold text-xl text-gray-800 leading-tight">
				Products

				<inertia-link :href="route('products.create')" class="float-right">
					<jet-button class="bg-green-500 hover:bg-green-700">
						New
					</jet-button>
				</inertia-link>
			</h2>
		</template>

		<div class="mt-5 overflow-x-auto max-w-7xl mx-auto shadow rounded ">
			<div class="min-w-screen bg-gray-100 flex items-center justify-center overflow-hidden ">
				<table class="min-w-max w-full table-auto">
					<thead>
					<tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal text-left">
						<th class="py-4 px-6">Name</th>
						<th class="py-4 px-6">Price per Unit</th>
						<th class="py-4 px-6">Total Count</th>
						<th class="py-4 px-6">Total Value</th>
						<th></th>
					</tr>
					</thead>
					<tbody class="text-gray-600 text-sm font-light bg-white">
					<tr v-for="product in products" :key="product.id" class="hover:bg-gray-100 cursor-pointer">
						<td class="py-4 px-6">{{ product.name }}</td>
						<td class="py-4 px-6">{{ castCurrency(product.price) }}</td>
						<td class="py-4 px-6">{{ product.total_quantity }} {{ product.unit }}</td>
						<td class="py-4 px-6">{{ castCurrency(product.total_quantity * product.price) }}</td>
						<td>
							<inertia-link :href="route('products.show', product.id)" class="mx-2">
								<jet-button type="button">
									More
								</jet-button>
							</inertia-link>

							<jet-button type="button" class="bg-red-500" @click="deleteWarehouse(product.id)">
								Delete
							</jet-button>
						</td>
					</tr>
					</tbody>
				</table>
			</div>
		</div>
	</app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import JetButton from "@/Jetstream/Button";

export default {

	props: {
		user: Object,
		products: Array
	},

	components: {
		AppLayout,
		JetButton
	},

	methods: {

		castCurrency (value) {
			if (typeof value !== "number") {
				return value;
			}

			return '$ ' + new Intl.NumberFormat('en-US', {
				style: 'decimal',
				currency: 'USD',
				minimumFractionDigits: 4
			}).format(value);
		},

		deleteWarehouse(warehouse_id) {
			this.$inertia.delete(this.route('products.destroy', warehouse_id));
		}
	}
}
</script>
