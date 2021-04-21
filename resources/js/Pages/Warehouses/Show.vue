<template>
	<app-layout>
		<template #header>
			<h2 class="font-semibold text-xl text-gray-800 leading-tight">
				{{ warehouse.id ? 'Warehouse Information' : 'New Warehouse' }}
			</h2>
		</template>

		<div>

			<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
				<jet-form-section @submitted="warehouse.id ? updateWarehouse() : createWarehouse()">
					<template #title>
						Warehouse Information
					</template>

					<template #description>
						Create a new warehouse to allocate your products.
					</template>

					<template #form>
						<div class="col-span-6 sm:col-span-4">
							<jet-label for="name" value="Warehouse Name"/>
							<jet-input id="name" type="text" class="mt-1 block w-full" autofocus
									   v-model="form.name" placeholder="ex: Warehouse 01"/>
							<jet-input-error :message="form.errors.name" class="mt-2"/>
						</div>

						<div class="col-span-6 sm:col-span-4">
							<jet-label for="is_active" value="Warehouse Active"/>
							<jet-select id="is_active" v-model="form.is_active" class="mt-1 block w-full">
								<option :value="true">Active</option>
								<option :value="true">Inactive</option>
							</jet-select>
							<jet-input-error :message="form.errors.is_active" class="mt-2"/>
						</div>

						<div class="col-span-6 sm:col-span-4 md:col-span-3">
							<jet-label for="zipcode" value="Warehouse Zipcode"/>
							<jet-input id="zipcode" type="text" class="mt-1 block w-full"
									   v-model="form.zipcode" placeholder="ex: 00.000"/>
							<jet-input-error :message="form.errors.zipcode" class="mt-2"/>
						</div>

						<div class="col-span-6 sm:col-span-4 md:col-span-3">
							<jet-label for="address-state" value="Warehouse State"/>
							<jet-input id="address-state" type="text" class="mt-1 block w-full"
									   v-model="form.state" placeholder="ex: Example State" />
							<jet-input-error :message="form.errors.state" class="mt-2"/>
						</div>

						<div class="col-span-6 sm:col-span-4 md:col-span-3">
							<jet-label for="address-city" value="Warehouse City"/>
							<jet-input id="address-city" type="text" class="mt-1 block w-full"
									   v-model="form.city" placeholder="ex: Example City" />
							<jet-input-error :message="form.errors.city" class="mt-2"/>
						</div>

						<div class="col-span-6 sm:col-span-4 md:col-span-3">
							<jet-label for="address-street" value="Warehouse Street"/>
							<jet-input id="address-street" type="text" class="mt-1 block w-full"
									   v-model="form.street" placeholder="ex: Example Street" />
							<jet-input-error :message="form.errors.street" class="mt-2"/>
						</div>

						<div class="col-span-6 sm:col-span-4 md:col-span-3">
							<jet-label for="address-street-number" value="Warehouse Street Number"/>
							<jet-input id="address-street-number" type="text" class="mt-1 block w-full"
									   v-model="form.number" placeholder="ex: 321" />
							<jet-input-error :message="form.errors.number" class="mt-2"/>
						</div>

						<div class="col-span-6 sm:col-span-4 md:col-span-3">
							<jet-label for="address-complement" value="Warehouse Address Complement"/>
							<jet-input id="address-complement" type="text" class="mt-1 block w-full"
									   v-model="form.complement" placeholder="ex: Entry 3" />
							<jet-input-error :message="form.errors.complement" class="mt-2"/>
						</div>
					</template>

					<template #actions>
						<jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
							{{ warehouse.id ? 'Update' : 'Create' }}
						</jet-button>
					</template>
				</jet-form-section>
			</div>

		</div>

	</app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import JetFormSection from "@/Jetstream/FormSection";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetButton from "@/Jetstream/Button";
import JetSelect from "@/Jetstream/SelectInput"

export default {
	data() {
		return {
			form: this.$inertia.form({
				team_id: this.user.current_team_id,
				name: this.warehouse.name,
				is_active: this.warehouse.is_active ?? true,
				zipcode: this.warehouse.zipcode,
				state: this.warehouse.state,
				city: this.warehouse.city,
				street: this.warehouse.street,
				number: this.warehouse.number,
				complement: this.warehouse.complement,
			})
		}
	},

	props: {
		warehouse: {
			type: Object,
			default: () => ({})
		},

		user: Object
	},

	components: {
		AppLayout,
		JetFormSection,
		JetLabel,
		JetInput,
		JetInputError,
		JetButton,
		JetSelect
	},

	methods: {
		createWarehouse () {
			this.form.post(route('warehouses.store'), {
				errorBag: 'warehouse',
				preserveScroll: true
			});
		},

		updateWarehouse () {
			this.form.patch(route('warehouses.update', this.warehouse.id), {
				errorBag: 'warehouse',
				preserveScroll: true
			});
		}
	}
}
</script>
