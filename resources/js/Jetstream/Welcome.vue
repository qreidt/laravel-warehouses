<template>
	<div class="bg-white shadow-xl sm:rounded-lg">
		<div class="p-6 sm:px-20 border-b border-gray-200">
			<div class="mt-2 text-3xl font-semibold">
				Laravel Warehouse Management System
			</div>

			<div class="mt-8">
				Welcome, {{ username }}
			</div>
		</div>
	</div>
</template>

<script>
import JetApplicationLogo from '@/Jetstream/ApplicationLogo'

export default {

	props: {
		username: String
	},

	components: {
		JetApplicationLogo,
	},
}
</script>
