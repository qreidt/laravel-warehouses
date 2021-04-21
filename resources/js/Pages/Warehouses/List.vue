<template>
	<app-layout>
		<template #header>
			<h2 class="font-semibold text-xl text-gray-800 leading-tight">
				Warehouses

				<a :href="route('warehouses.create')" class="float-right">
					<jet-button class="bg-green-500 hover:bg-green-700">
						New
					</jet-button>
				</a>
			</h2>
		</template>

		<div class="mt-5 overflow-x-auto max-w-7xl mx-auto shadow rounded ">
			<div class="min-w-screen bg-gray-100 flex items-center justify-center overflow-hidden ">
				<table class="min-w-max w-full table-auto">
					<thead>
					<tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal text-left">
						<th class="py-4 px-6">Name</th>
						<th class="py-4 px-6">Product Count</th>
						<th class="py-4 px-6">Zipcode</th>
						<th></th>
					</tr>
					</thead>
					<tbody class="text-gray-600 text-sm font-light bg-white hover:bg-gray-100 cursor-pointer">
					<tr v-for="warehouse in warehouses" :key="warehouse.id">
						<td class="py-4 px-6">{{ warehouse.name }}</td>
						<td class="py-4 px-6">{{ warehouse.products_count }} products</td>
						<td class="py-4 px-6">{{ warehouse.zipcode }}</td>
						<td>
							<inertia-link :href="route('warehouses.show', warehouse.id)" class="mx-2">
								<jet-button type="button">
									More
								</jet-button>
							</inertia-link>

							<jet-button type="button" class="bg-red-500" @click="deleteWarehouse(warehouse.id)">
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
		warehouses: Array
	},

	components: {
		AppLayout,
		JetButton
	},

	methods: {
		deleteWarehouse(warehouse_id) {
			this.$inertia.delete(this.route('warehouses.destroy', warehouse_id));
		}
	}
}
</script>
