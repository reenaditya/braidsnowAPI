<template>
	<div class="kt-grid__item kt-grid__item--fluid kt-wizard-v3__wrapper">

											<!--begin: Form Wizard Form-->
											<form class="kt-form" id="kt_form">

												<!--begin: supplier info-->
									<supplierInfo></supplierInfo>
								    <billing></billing>
								    <uploadSerialNumber></uploadSerialNumber>
								    <reviewAndSubmit></reviewAndSubmit>

	
												<!--begin: Form Actions -->
												<div class="kt-form__actions">
													<div class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-prev">
														Previous
													</div>
													<div class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-submit">
														Submit
													</div>
													<div class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-next">
														Next Step
													</div>
												</div>

												<!--end: Form Actions -->
											</form>

											<!--end: Form Wizard Form-->
										</div>
   
</template>

<script>
	import supplierInfo from './SupplierInfoComponent.vue'
	import billing from './BillingComponent.vue'
	import uploadSerialNumber from './UploadSerialNumberComponent.vue'
	import reviewAndSubmit from './ReviewAndSubmitComponent.vue'
    export default {
    	components:{
    		supplierInfo,
    		billing,
    		uploadSerialNumber,
    		reviewAndSubmit
    	},
        mounted() {
            //console.log('Component mounted.')
        }
    }
</script>
