<template>
	<div class="h-screen flex items-center justify-center">
		<div class="flex rounded-md overflow-hidden">
			<div
				class="bg-[url('../../../../public/eugene-golovesov-bpki4YtXMGM-unsplash.jpg')] bg-cover w-[450px]"
			></div>
			<div class="bg-white w-96 p-9 flex items-center justify-center" style="height: 500px">
				<slot></slot>
			</div>
		</div>
	</div>
</template>
