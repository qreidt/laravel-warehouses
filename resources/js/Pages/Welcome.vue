<template>
	<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-600 sm:items-center sm:pt-0">
		<div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block text-lg">
			<inertia-link v-if="$page.props.user" href="/dashboard" class="text-gray-700">
				Dashboard
			</inertia-link>

			<template v-else>
				<inertia-link :href="route('login')" class="text-gray-700">
					Log in
				</inertia-link>

				<inertia-link v-if="canRegister" :href="route('register')" class="ml-4 text-gray-700">
					Register
				</inertia-link>
			</template>
		</div>

		<div class="max-w- mx-auto sm:px-6 lg:px-8">
			<div class="flex justify-center pt-8 sm:justify-start sm:pt-0 logo text-5xl font-bold uppercase">
				Warehouse Management
			</div>

			<div class="mt-8">
				<div class="font-semibold text-gray-700">
					Here you can register your products and your warehouses and we can help you on your day-to-day management.
				</div>
				<div class="grid grid-cols-1 md:grid-cols-2 mt-5">
					<div class="text-3xl bg-gray-500 rounded-lg text-white mr-4 mb-4 p-4 flex flex-row justify-start">
						<div class="w-min bg-white p-4 text-gray-600 rounded">{{ userCount }}</div>
						<div class="ml-5 flex flex-col justify-center">Users</div>
					</div>

					<div class="text-3xl bg-gray-500 rounded-lg text-white ml-4 mb-4 p-4 flex flex-row justify-start">
						<div class="w-min bg-white p-4 text-gray-600 rounded">{{ teamCount }}</div>
						<div class="ml-5 flex flex-col justify-center">Teams</div>
					</div>

					<div class="text-3xl bg-gray-600 rounded-lg text-white mr-4 mt-4 p-4 flex flex-row justify-start">
						<div class="w-min bg-white p-4 text-gray-700 rounded">{{ warehouseCount }}</div>
						<div class="ml-5 flex flex-col justify-center">Warehouses</div>
					</div>

					<div class="text-3xl bg-gray-600 rounded-lg text-white ml-4 mt-4 p-4 flex flex-row justify-start">
						<div class="w-min bg-white p-4 text-gray-700 rounded">{{ productCount }}</div>
						<div class="ml-5 flex flex-col justify-center">Products</div>
					</div>
				</div>
			</div>

			<div class="flex justify-center mt-4 sm:items-center sm:justify-between">
				<div class="ml-4 text-center text-sm text-gray-700 sm:text-right sm:ml-0">
					Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})
				</div>
			</div>
		</div>
	</div>
</template>

<style scoped>
.bg-gray-100 {
	background-color: #f7fafc;
	background-color: rgba(247, 250, 252, var(--tw-bg-opacity));
}

.text-gray-500 {
	color: #a0aec0;
	color: rgba(160, 174, 192, var(--tw-text-opacity));
}

.text-gray-700 {
	color: #4a5568;
	color: rgba(74, 85, 104, var(--tw-text-opacity));
}

.logo {
	color: #ea3a2e;
	word-spacing: 1rem;
	letter-spacing: 0.2rem;
}
</style>

<script>
export default {
	props: {
		canLogin: Boolean,
		canRegister: Boolean,
		laravelVersion: String,
		phpVersion: String,
		userCount: Number,
		teamCount: Number,
		warehouseCount: Number,
		productCount: Number,
	}
}
</script>
