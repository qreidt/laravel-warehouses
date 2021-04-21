<template>
	<app-layout>
		<template #header>
			<h2 class="font-semibold text-xl text-gray-800 leading-tight">
				{{ product.id ? 'Product Information' : 'New Product' }}
			</h2>
		</template>

		<div>

			<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
				<jet-form-section @submitted="product.id ? updateProduct() : createProduct()">
					<template #title>
						Product Information
					</template>

					<template #description>
						Create a new product to allocate into your warehouses.
					</template>

					<template #form>
						<div class="col-span-6 sm:col-span-4">
							<jet-label for="name" value="Product Name"/>
							<jet-input id="name" type="text" class="mt-1 block w-full" autofocus
									   v-model="form.name" placeholder="ex: Product X"/>
							<jet-input-error :message="form.errors.name" class="mt-2"/>
						</div>

						<!-- TODO awaiting for currency input support for Vue 3 -->
						<!-- vue-currency-input: https://www.npmjs.com/package/vue-currency-input -->
						<!-- v-money?: https://www.npmjs.com/package/v-money -->
						<div class="col-span-6 sm:col-span-4 md:col-span-3">
							<jet-label for="price" value="Product Unit Price"/>
							<jet-input id="price" type="text" class="mt-1 block w-full"
									   v-model.number="form.price" placeholder="ex: 123,45"/>
							<jet-input-error :message="form.errors.price" class="mt-2"/>
						</div>

						<div class="col-span-6 sm:col-span-4">
							<jet-label for="unit" value="Product Unit Type"/>
							<jet-select id="unit" v-model="form.unit" class="mt-1 block w-full">
								<option :value="null">Select Product Unit</option>
								<option v-for="unit in units" :value="unit">
									{{ unit }}
								</option>
							</jet-select>
							<jet-input-error :message="form.errors.unit" class="mt-2"/>
						</div>
					</template>

					<template #actions>
						<jet-action-message :on="form.recentlySuccessful" class="mr-3">
							Saved.
						</jet-action-message>

						<jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
							{{ product.id ? 'Update' : 'Create' }}
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
import JetSelect from "@/Jetstream/SelectInput";
import JetActionMessage from "@/Jetstream/ActionMessage";

export default {
	data() {
		return {
			form: this.$inertia.form({
				name: this.product.name ?? '',
				price: this.product.price ?? 0,
				unit: this.product.unit ?? null
			})
		}
	},

	props: {
		product: {
			type: Object,
			default: () => ({})
		},

		units: Array
	},

	components: {
		AppLayout,
		JetFormSection,
		JetLabel,
		JetInput,
		JetInputError,
		JetButton,
		JetSelect,
		JetActionMessage
	},

	methods: {
		createProduct () {
			this.form.post(route('products.store'), {
				errorBag: 'product',
				preserveScroll: true
			});
		},

		updateProduct () {
			this.form.patch(route('products.update', this.product.id), {
				errorBag: 'product',
				preserveScroll: true
			});
		}
	}
}
</script>
