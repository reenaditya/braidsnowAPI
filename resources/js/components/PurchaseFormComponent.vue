<template>
	<div>
		<form 
		class="kt-form" 
		method="post" 
		action="" 
		enctype="multipart/form-data" 
		v-if="step === 1">
			<div style="background:#d3d3d5fc;">
				<div class="row">
					<div class="col-md-4">				
						<div class="kt-portlet__body"  style="padding-bottom: 0px;">
							<div class="form-group validated">
								<label class="form-control-label" for="Purchase">Purchase No. <strong style="color:red">*</strong> </label>
								<input type="text" class="form-control" v-model="purchaseNo" disabled="">
																	
							</div>															
						</div>
					</div>

					<div class="col-md-4">						
						<div class="kt-portlet__body">
							<div class="form-group validated">
								<label class="form-control-label" for="invoice no">Supplier Invoice No <strong style="color:red">*</strong> </label>
								<input type="text" class="form-control" v-model="invoiceNo">
								<span class="text-danger">{{ headError.invoiceNo }}</span>
							</div>															
						</div>
					</div>

					<div class="col-md-4">	
						<div class="kt-portlet__body">
							<div class="form-group validated">
								<label class="form-control-label" for="invoice date">Supplier Invoice date  <strong style="color:red">*</strong> </label>
								<input type="date" class="form-control" v-model="invoiceDate">
								<span class="text-danger">{{ headError.invoiceDate }}</span>
							</div>								
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">				
						<div class="kt-portlet__body" style="padding-top: 0px;">
							<div class="form-group validated">
								<label class="form-control-label" for="supplier name">Supplier name  <strong style="color:red">*</strong> </label>
									<autocomplete input-class="form-control"
									  :source="supplierAPI"
									  results-property="data"
									  @selected="onSelectSupplier">
									</autocomplete>
									<span class="text-danger">{{ headError.supplierName }}</span>
							</div>							
						</div>
					</div>
					<div class="col-md-4">
						<div class="kt-portlet__body" style="padding-top: 0px;">
							<div class="form-group validated">
								<label class="form-control-label" for="current date">Current Date <strong style="color:red">*</strong> </label>
								<input type="date" class="form-control" v-model="currentDate">
								<span class="text-danger">{{ headError.currentDate }}</span>
							</div>
						</div>
					</div>
					<div class="col-md-4"v-if="supplierName" >
						<div class="kt-portlet__body form-inline" style="padding-top: 30px;">
							<div class="form-group validated">
								<input 
								type="checkbox" 
								style="cursor: pointer"
								@change="activeGST()"
								v-model="gstsEnable"> 
								<label 
								class="form-control-label" 
								for="enabled gst" style="margin-left: 20px;">
								Enabled GST 

								</label>
								
							</div>
						</div>
					</div>
					<!-- <div class="col-md-4">
						<div class="kt-portlet__body" style="padding-top: 0px;">
							<div class="form-group validated">
								<label class="form-control-label" for="Upload Image">Invoice Upload <strong style="color:red">*</strong> </label>
								<input type="file" class="form-control" accept="image/*" @change="uploadImage($event)" id="file-input" ref="fileInput">
								<a :href="showImage" target="_blank"><img :src="showImage" alt="" width="100"></a>
								
							</div>
						</div>
					</div> -->										
				</div>
			</div>
			<div class="row" style="margin-top: 25px; padding: 25px;">
				<div class="col-md-12">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>S.no.</th>
								<th scope="col">Product Name</th>
								<th scope="col">Qty</th>
								<th scope="col">Sr. No.</th>
								<th scope="col">Purchase Rate</th>
								<th scope="col">Sell Rate</th>
								<th scope="col">Store Location</th>
								<th scope="col">Amt.</th>
								<th scope="col">Action</th>
							</tr> 
						</thead>
						<tbody>
							<tr>
								<td>#</td>
								<td>
									<!-- <input type="text" class="form-control" v-model="productName">
									 -->
									<autocomplete input-class="form-control"
									  	:source="productAPI"
									  	results-property="data"
									  	@selected="addDistributionGroup"
									  	:results-display="formattedDisplay">

									</autocomplete>
									<span class="text-danger">{{ errors.productName }}</span>
								</td>
								<td>
									<input type="text" 
									class="form-control" 
									v-model="quantity" 
									@input="calculateTotal()">
									<span class="text-danger">{{ errors.quantity }}</span>
								</td>
								<td width="100" style="text-align:center; padding-top:20px"> 
									<input type="checkbox" v-model="serialNo">
									
								</td>
								<td>
									<input type="text" class="form-control" v-model="purchaseRate" @input="calculateTotal()">
									<span class="text-danger">{{ errors.purchaseRate }}</span>
								</td>
								<td>
									<input type="text" class="form-control" v-model="sellRate">
									<span class="text-danger">{{ errors.sellRate }}</span>
								</td>
								<td>
									<autocomplete input-class="form-control"
									  	:source="storeLocationAPI"
									  	results-property="data"
									   	@selected="addLocation"
									  	:results-display="formattedDisplay">
									</autocomplete>
									<span class="text-danger" style="font-size:10px;">{{ errors.storeLocation }}</span>
								</td>
								<td>
									<input type="text" class="form-control" v-model="amount" disabled="">
									
								</td>
								<td>
									<button type="button" class="btn btn-primary" @click="onAdd()">Add</button>
								</td>
							</tr>
							<tr v-for="(list,key) in purchaseList" :key="key">
								<td>{{ key+1  }}</td>
								<td> 
									<input type="text" 
									disabled=""
									class="form-control" 
									:value="list.productName">
								</td>
								<td><input type="text" 
									disabled=""
									class="form-control" 
									:value="list.quantity"></td>
								<td><input type="text" 
									disabled=""
									class="form-control" 
									:value="list.serialNo"></td>
								<td><input type="text" 
									disabled=""
									class="form-control" 
									:value="list.purchaseRate"></td>
								<td><input type="text" 
									disabled=""
									class="form-control" 
									:value="list.sellRate"></td>
								<td><input type="text" 
									disabled=""
									class="form-control" 
									:value="list.storeLocation"></td>
								<td><input type="text" 
									disabled=""
									class="form-control" 
									:value="list.amount"></td>
								<td>
									<button 
									type="button" 
									class="btn btn-danger"
									@click="onDelete(key,list)">
									Delete
									</button>
								</td>
							</tr>

							<tr v-if="showTotal">
								<td colspan="2" style="text-align:center;">
									<strong 
									style="font-size: 14px;">									Total
									</strong>
								</td>
								<td>
									<strong><input type="text" 
									class="form-control" 
									v-model="totalQuantity" 
									disabled=""
									style="font-weight: bold;"></strong>
								</td>
								<td>
									&nbsp;
								</td>
								<td>
									<input type="text" 
									class="form-control" 
									v-model="totalPurchaseRate" 
									disabled=""
									style="font-weight: bold;">
								</td>
								<td>
									<input type="text" 
									class="form-control" 
									v-model="totalSaleRate" 
									disabled=""
									style="font-weight: bold;">
								</td>
								<td>&nbsp;</td>
								<td>
									<input type="text" 
									class="form-control" 
									v-model="totalAmountWithoutGst" 
									disabled=""
									style="font-weight: bold;">
								</td>
							</tr>

							<tr v-if="enableGST && showCgst">
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td><strong	style="font-size: 14px;">CGST</strong></td>
								<td>
									<input type="text" 
									class="form-control" 
									v-model="cgst"	
									@input="calculateGrandTotal()"								
									style="font-weight: bold;">
								</td>
							</tr>
							<tr v-if="enableGST && showCgst">
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td><strong	style="font-size: 14px;">SGST</strong></td>
								<td>
									<input type="text" 
									class="form-control" 
									v-model="sgst"
									@input="calculateGrandTotal()"
									style="font-weight: bold;">
								</td>
							</tr>
							<tr v-if="enableGST && showIgst">
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td><strong	style="font-size: 14px;">IGST</strong></td>
								<td>
									<input type="text" 
									class="form-control" 
									v-model="igst"
									@input="calculateGrandTotal()"								
									style="font-weight: bold;">
								</td>
							</tr>
							<tr v-if="enableGST">
								<td colspan="2" style="text-align:center;">
									<strong 
									style="font-size: 14px;">									Grand Total
									</strong>
								</td>
								<td>
									&nbsp;
								</td>
								<td>
									&nbsp;
								</td>
								<td>
									&nbsp;
								</td>
								<td>
									&nbsp;
								</td>
								<td>&nbsp;</td>
								<td>
									<input type="text" 
									class="form-control" 
									v-model="totalAmount" 
									disabled=""
									style="font-weight: bold;">
								</td>
							</tr>
							<tr>
								<td colspan="2"><label class="form-control-label"
								 for="in words" 
								 style="font-weight: bold;">
								 Total Amount in Words:
								</label>
								</td>
								<td colspan="7">
								 <strong style="color:#000">{{ titleCase(amountInWords) }} </strong>
								</td>

							</tr>

							
						</tbody>
					</table>
				</div>							
			</div>
			<div style="background:#d3d3d5fc;">
				<div class="row">
					<div class="col-md-6">				
						<div class="kt-portlet__body">
							<div class="form-group validated">
								<label class="form-control-label" for="Upload Image">Invoice Upload <strong style="color:red">*</strong> </label>
								<input type="file" class="form-control" accept="image/*" @change="uploadImage($event)" id="file-input" ref="fileInput">
								<a :href="showImage" target="_blank"><img :src="showImage" alt="" width="100"></a>
							</div>								
						</div>
					</div>
					<div class="col-md-6">				
						<div class="kt-portlet__body">
							<div class="form-group validated">
								<label class="form-control-label" for="notes">Notes</label>
								<textarea v-model="notes"  rows="1" class="form-control"></textarea>
							</div>								
						</div>
					</div>				
				</div>
				
				<div class="row">
					<div class="col-md-12">				
						<div class="kt-portlet__body" style="padding-top: 0px;">
							<div class="form-group validated" style="text-align:center;">
								<button type="button" @click="onNext()" class="btn btn-success">Next</button>
								<button type="reset" class="btn btn-danger">Cancel</button>
							</div>								
						</div>
					</div>
				</div>
			</div>										<!--end: Form Actions -->
		</form>
		<PurchaseNextComponent v-if="step === 2"  :allData="collectData"></PurchaseNextComponent>
	</div>
</template>
<style type="text/css">
		.autocomplete__box img {
    		display: none;
		}
</style>
<script>
	import NumberToWord from './tools/NumberToWordComponent';
	import Vue from 'vue'
	import axios from 'axios'
	import Autocomplete from 'vuejs-auto-complete'
	import PurchaseNextComponent from './PurchaseNextComponent'
	import Swal from 'sweetalert2'
	

	export default {

		components: {
      		Autocomplete,
      		PurchaseNextComponent
  		},
		data: function() {
			return {
				step:1,
				flag:true,
				enableGST:false,
				gstsEnable:false,
				baseUrl:"http://localhost:3000/",
				purchaseNo:"",
				invoiceNo:"",
				invoiceDate:"",
				supplierName:"",
				supplierId:"",
				currentDate:"",
				productName:"",
				productId:"",
				quantity:"",
				serialNo:"",
				purchaseRate:"",
				sellRate:"",
				storeLocation:"",
				storeLocationId:"",
				amount:"",
				totalAmountWithoutGst:0,
				cgst:0,
				sgst:0,
				igst:0,
				amountInWords:"",
				notes:"",
				totalAmount:0,
				collectData:{},
				purchaseList:[],
				productAPI:'',
				supplierAPI:'',
				storeLocationAPI:'',
				imageUpload:"",
				showImage:"",
				totalQuantity:0,
				totalPurchaseRate:0,
				totalSaleRate:0,
				showTotal:false,
				stateCode:0,
				showCgst:false,
				showIgst:false,
				errors:{
					productName:"",
					quantity:"",
					serialNo:"",
					purchaseRate:"",
					sellRate:"",
					storeLocation:""
				},
				headError:{
					invoiceNo:"",
					invoiceDate:"",
					supplierName:"",				
					currentDate:""
				}
			}
		},
		mounted(){

			/*this.purchaseNo="testing";*/
			axios
      		.get(`${this.baseUrl}api/purchase-no`)
      		.then(response => this.purchaseNo = response.data.data)
      		.catch(error => console.log(error))

      		this.productAPI = this.baseUrl+"api/product-name?q="; 
      		this.supplierAPI = this.baseUrl+"api/supplier-name?q=";
      		this.storeLocationAPI = this.baseUrl+"api/store-location?q=";

		},
		updated(){
			if (this.purchaseList.length===0){
      			this.showTotal = false
			}
      		else{
      			this.showTotal = true
      		}

      		if (this.gstsEnable) {
      			this.enableGST = true
      		}else{
      			this.enableGST = false
      		}
      		/*if (this.supplierName){
      			this.gstsEnable = true
      		}else{
      			this.gstsEnable = false
      		}*/
		},
		methods:{
			reset() {
			    const input = this.$refs.fileInput
			    input.type = 'text'
			    input.type = 'file'
			},
			activeGST(){
				if(this.stateCode===24){
					this.showCgst = true
					this.showIgst = false
				}else{					
					this.showCgst = false
					this.showIgst = true
				}
			},
			uploadImage(event) {
				
    			this.imageUpload = event.target.files[0];
    			const fsize = this.imageUpload.size; 
			    const file = Math.round((fsize / 1024)); 
			    
			    if (file <= 2048) {
			        
			        const fileType = this.imageUpload['type'];
			        const validImageTypes = ['image/gif', 'image/jpeg', 'image/png'];
			        if (!validImageTypes.includes(fileType)) {
			            
			            alert('Invalid file type');
			            this.reset();
			            return false;
			        }else{

			            if (this.imageUpload) {
			                var reader = new FileReader();
			                reader.readAsDataURL(this.imageUpload);
			                reader.onload = (event) => {
			                  
			                  this.showImage = event.target.result;   
			                 
			                }
			            }
			        }
			    }else{
			    	alert('File too Big, please select a file less than 2mb');
			    	 this.reset();
			    }
    			
   			},
			
			
			addDistributionGroup(input){
				this.productName = input.display;
				this.productId = input.value;				
			},
			addLocation(input){
				this.storeLocation = input.display;
				this.storeLocationId = input.value;
			},
			onSelectSupplier(input){
				this.supplierName = input.display;
				this.supplierId = input.value;
				axios.post(`${this.baseUrl}api/ledger-info`,{id:input.value})
				.then(res => this.stateCode = res.data.state);
				if (this.supplierName) {
      			this.gstsEnable = false
      			}else{
      			this.gstsEnable = true
      			}
			},
			onDelete(key, list) {  

				const {quantity,purchaseRate,sellRate,amount} = list;

				this.purchaseList.splice(key, 1);
				this.totalQuantity = parseFloat(this.totalQuantity) - parseFloat(quantity);
				this.totalPurchaseRate = parseFloat(this.totalPurchaseRate) - parseFloat(purchaseRate);
				this.totalSaleRate = parseFloat(this.totalSaleRate) - parseFloat(sellRate);

				this.totalAmountWithoutGst = parseFloat(this.totalAmountWithoutGst) - parseFloat(amount);
				this.totalAmount = parseFloat(this.totalAmount) - parseFloat(amount);
				this.amountInWords = NumberToWord(this.totalAmount);
				//this.showTr()
      		},

			onAdd(){
				if(this.validateFormData()){

					this.purchaseList.push({
						productName:this.productName,
						productId:this.productId,
						quantity:this.quantity,
						serialNo:this.serialNo === true?'Yes':'No',
						purchaseRate:this.purchaseRate,
						sellRate:this.sellRate,
						storeLocation:this.storeLocation,
						storeLocationId:this.storeLocationId,
						amount:this.amount,
						key:'',
						keyFile:''
					});
					this.totalQuantity = parseFloat(this.totalQuantity ) + parseFloat(this.quantity);
					this.totalPurchaseRate = parseFloat(this.totalPurchaseRate)  + parseFloat(this.purchaseRate);
					this.totalSaleRate = parseFloat(this.totalSaleRate)  + parseFloat(this.sellRate);
					this.totalAmountWithoutGst = this.totalAmountWithoutGst + parseFloat(this.amount);

					if (this.igst) 
						this.totalAmount = this.totalAmountWithoutGst + parseFloat(this.igst);
					else
						this.totalAmount = this.totalAmountWithoutGst + parseFloat(this.cgst) + parseFloat(this.sgst);					

					this.amountInWords = NumberToWord(this.totalAmount);
					//this.showTr()

					this.emptyFormData();
				}
				
				
				//alert(this.quantity);
			},
			validateFormData(){

				if (!this.productName) {
					this.errors.productName = "Please Enter Product Name";
					
				} else {
					this.errors.productName = "";
					
				}
				if (this.quantity == "") {
					this.errors.quantity = "Please Enter quantity";
					
				} else{

					if(isNaN(this.quantity)){
						this.errors.quantity = "Please Enter Only Numbers";
						
					}else{

						this.errors.quantity = "";
						
					}
				}
				
				if (!this.purchaseRate) {
					this.errors.purchaseRate = "Please Enter purchase Rate";
					
				} else{

					if(isNaN(this.purchaseRate)){
						this.errors.purchaseRate = "Please Enter Only Numbers";
						
					}else{

						this.errors.purchaseRate = "";
						
					}
				}
				if (!this.sellRate) {
					this.errors.sellRate = "Please Enter Sell Rate";
					
				} else{

					if(isNaN(this.sellRate)){
						this.errors.sellRate = "Please Enter Only Numbers";
						
					}else{

						this.errors.sellRate = "";
						
					}
				}
				if (!this.storeLocation) {
					this.errors.storeLocation = "Please Enter Store Location";
					
				} else {
					this.errors.storeLocation = "";
					
				}
				
				for (let key in this.errors) {
        			if (this.errors[key] !== null && this.errors[key] != "")
            		return false;
    			}
				return true;
			},
			emptyFormData(){
				
				this.productName = "";
				this.quantity = "";
				this.serialNo = "";
				this.purchaseRate = "";
				this.sellRate = "";
				this.storeLocation = "";
				this.imageUpload = "";
				this.amount = "";
			},

			calculateTotal()
			{
				/*var x = document.getElementById("amount").value;*/
				
				if (this.purchaseRate == null || this.purchaseRate == "") {
					this.purchaseRate = 0;
				}
				if (this.quantity == null || this.quantity == "") {
					this.quantity = 0;
				}

				this.amount = this.quantity * this.purchaseRate;

				
			},

			calculateGrandTotal(){

				if (this.cgst == null || this.cgst == "") {
					this.cgst = 0;
				}
				if (this.sgst == null || this.sgst == "") {
					this.sgst = 0;
				}	

				if (this.igst) {

					this.totalAmount = this.totalAmountWithoutGst + parseFloat(this.igst);

				}else{

					this.totalAmount = this.totalAmountWithoutGst + parseFloat(this.cgst) + parseFloat(this.sgst);	
				}

				this.amountInWords = NumberToWord(this.totalAmount);		

			},

			onNext(){				
				if(this.totalValidation()){
					if (this.purchaseList.length == 0) {

						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: 'Please enter atleast one product!'
						})
					}else{

						this.collectData = {
							purchaseList:this.purchaseList,
							purchaseNo:this.purchaseNo,
							invoiceNo:this.invoiceNo,
							invoiceDate:this.invoiceDate,
							supplierName:this.supplierName,
							currentDate:this.currentDate,
							uploadImage:this.uploadImage,
							totalQuantity:this.totalQuantity,
							totalSaleRate:this.totalSaleRate,
							totalPurchaseRate:this.totalPurchaseRate,
							totalAmountWithoutGst:this.totalAmountWithoutGst,
							cgst:this.cgst,
							sgst:this.sgst,
							igst:this.igst,
							totalAmount:this.totalAmount,
							amountInWords:this.amountInWords,
							notes:this.notes
						}

						this.step = 2;
					}
				}
			},
			titleCase(str){

				str = str.toLowerCase();

				str = str.split(' ');

				for (var i = 0; i < str.length; i++) {
				    str[i] = str[i].charAt(0).toUpperCase() + str[i].slice(1); 

				}
				  
				return str.join(' ');
			},
			totalValidation()
			{
				if (!this.invoiceNo) {
					this.headError.invoiceNo = "Please Enter Invoice number";
					
				} else {
					this.headError.invoiceNo = "";
					
				}
				if (!this.invoiceDate) {
					this.headError.invoiceDate = "Please Enter Invoice date";
					
				} else {
					this.headError.invoiceDate = "";
					
				}

				if (!this.supplierName) {
					this.headError.supplierName = "Please Enter supplier name";
					
				} else {
					this.headError.supplierName = "";
					
				}

				if (!this.currentDate) {
					this.headError.currentDate = "Please select current date";
					
				} else {
					this.headError.currentDate = "";
					
				}
				for (let key in this.headError) {
        			if (this.headError[key] !== null && this.headError[key] != "")
            		return false;
    			}
				return true;
				
			}


		}
	}

</script>