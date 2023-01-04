<template>
	<div class="h-screen flex items-center justify-center">
		<div class="flex rounded-md overflow-hidden">
			<div>
				<img
					src="../../../../public/images/pexels-johannes-plenio-1103970.jpg"
					style="width: 450px; height: 100%"
				/>
			</div>
			<div class="bg-white w-96 p-9 flex items-center justify-center" style="height: 500px">
				<slot></slot>
			</div>
		</div>
	</div>
</template>
