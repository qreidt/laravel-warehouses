<template>
	<app-layout>
		<template #header>
			<h2 class="font-semibold text-xl text-gray-800 leading-tight">
				Dashboard
			</h2>
		</template>

		<div class="py-12 max-w-7xl mx-auto sm:px-7 lg:px-8">
			<welcome :username="user.name" class="w-max"/>
		</div>
	</app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import Welcome from '@/Jetstream/Welcome'

export default {

	props: {
		user: Object
	},

	components: {
		AppLayout,
		Welcome,
	},
}
</script>
