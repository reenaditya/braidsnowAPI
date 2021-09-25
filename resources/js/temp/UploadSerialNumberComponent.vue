<template>
    <div class="kt-wizard-v3__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
	<div class="kt-heading kt-heading--md">Upload Serial Number</div>
		<div class="kt-form__section kt-form__section--first">
			<div class="kt-wizard-v3__form">
				<div class="form-group">
					<label>Address Line 1</label>
						<input type="text" class="form-control" name="address1" placeholder="Address Line 1" value="Address Line 1">
						<span class="form-text text-muted">Please enter your Address.</span>
				</div>
				<div class="form-group">
					<label>Address Line 2</label>
						<input type="text" class="form-control" name="address2" placeholder="Address Line 2" value="Address Line 2">
						<span class="form-text text-muted">Please enter your Address.</span>
				</div>
				<div class="row">
					<div class="col-xl-6">
						<div class="form-group">
							<label>Postcode</label>
							<input type="text" class="form-control" name="postcode" placeholder="Postcode" value="3000">
							<span class="form-text text-muted">Please enter your Postcode.</span>
						</div>
					</div>
					<div class="col-xl-6">
						<div class="form-group">
							<label>City</label>
							<input type="text" class="form-control" name="city" placeholder="City" value="Melbourne">
							<span class="form-text text-muted">Please enter your City.</span>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</template>

<script>
    export default {
        mounted() {
            //console.log('Component mounted.')
        }
    }
</script>
