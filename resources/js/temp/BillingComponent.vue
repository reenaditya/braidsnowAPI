<template>
    <div class="kt-wizard-v3__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
	<div class="kt-heading kt-heading--md">Billing</div>
		<div class="kt-form__section kt-form__section--first">
			<div class="kt-wizard-v3__form">

				
				
				<div class="row">
					<div class="col-xl-1">
						<div class="form-group">
							<label>Category</label>
								<select v-model="purchase.category"  class="form-control">
									<option value=""></option>
									<option value="test">test</option>
								</select>
						</div>
					</div>
					<div class="col-xl-2">
						<div class="form-group">
							<label>Product</label>
								<select v-model="purchase.product" class="form-control">
									<option value=""></option>
									<option value="test">test</option>
								</select>
						</div>
					</div>
					<div class="col-xl-1">
						<div class="form-group">
							<label>Location</label>
								<select v-model="purchase.location" class="form-control">
									<option value=""></option>
									<option value="test">test</option>
								</select>
						</div>
					</div>
					<div class="col-xl-2">
						<div class="form-group">
							<label>HSN</label>
								<input type="text" v-model="purchase.hsn" class="form-control" value="123456">
						</div>
					</div>
					<div class="col-xl-1">
						<div class="form-group">
							<label>Tax Slab</label>
								<select v-model="purchase.taxSlab" class="form-control">
									<option value="">0</option>
									<option value="5">5</option>
									<option value="12">12</option>
									<option value="18">18</option>
									<option value="27">27</option>
								</select>
						</div>
					</div>
					<div class="col-xl-1">
						<div class="kt-checkbox-list">
							<label>Serial No</label>
							<input type="checkbox" v-model="purchase.serialNo">
								
						</div>
						
					</div>
					<div class="col-xl-1">
						<div class="form-group">
							<label>Qty</label>
		<input type="text" v-numericOnly class="form-control" v-model="purchase.quantity" @keyup="total">
								
						</div>
						
					</div>
					<div class="col-xl-1">
						<div class="form-group">
							<label>Rate</label>
		<input type="text" v-numericOnly class="form-control" v-model="purchase.rate" @keyup="total">
								
						</div>
						
					</div>
					<div class="col-xl-1">
						<div class="form-group">
							<label>Total</label>
							<input type="text" v-numericOnly class="form-control" v-model="purchase.total">
								
						</div>
						
					</div>
					<div class="col-xl-1">
						<button class="btn btn-success" @click="addMore()" style="margin-top: 23px">Add</button>
						
					</div>
				</div>
				

				<div class="row" v-for="row in rows">
					<div class="col-xl-1">
						
							<span>{{ row.category }}</span>	
						
					</div>
					<div class="col-xl-2">
						
							
								<span>{{ row.product }}</span>
						
					</div>
					<div class="col-xl-1">
						
							
								<span>{{ row.location }}</span>
					
					</div>
					<div class="col-xl-2">
						
							
								<span>{{ row.hsn }}</span>
						
					</div>
					<div class="col-xl-1">
						
							
								<span>{{ row.taxSlab }}</span>
						
					</div>
					<div class="col-xl-1">
						
							
							<span>{{ row.serialNo }}</span>
								
						
						
					</div>
					<div class="col-xl-1">
						
							
							<span>{{ row.quantity }}</span>
								
						
						
					</div>
					<div class="col-xl-1">
						
							
							<span>{{ row.rate }}</span>
								
						
						
					</div>
					<div class="col-xl-1">
						
							
							<span>{{ row.total }}</span>
								
						
						
					</div>
					<div class="col-xl-1">
						
							
							<button class="btn btn-danger">Delete</button>
								
						
						
					</div>
				</div>

			</div>
		</div>
	</div>
</template>

<script>
    export default {
    	data:function(){
    		return {
    			purchase:[{
    				category:'',
		    		product:'',
		    		location:'',
		    		hsn:'',
		    		taxSlab:'',
		    		serialNo:'',
		    		quantity:'',
		    		rate:'',
		    		total:'',
    			}],
	    		
	    		rows: [],
    		}
    	},
        methods:{
        	addMore(){
        		this.rows.push({
        			category: this.purchase.category,
        			product: this.purchase.product,
        			location: this.purchase.location,
        			hsn: this.purchase.hsn,
        			taxSlab: this.purchase.taxSlab,
        			serialNo: this.purchase.serialNo,
        			quantity: this.purchase.quantity,
        			rate: this.purchase.rate,
        			total: this.purchase.total
        		});
        	},
        	total(){
        		this.purchase.total = this.purchase.quantity*this.purchase.rate;
        		
        	}
        }
    }
</script>
