<template>
	<form class="kt-form" method="post" action="" enctype="multipart/form-data">
		<div style="background:#d3d3d5fc;">
			<div class="row">
				<div class="col-md-4">				
					<div class="kt-portlet__body"  style="padding-bottom: 0px;">
						<div class="form-group validated">
							<label class="form-control-label" for="Purchase">Purchase No.<strong style="color:red">*</strong> </label>
							<input type="text" class="form-control" disabled="" :value="allData.purchaseNo">
																
						</div>															
					</div>
				</div>

				<div class="col-md-4">						
					<div class="kt-portlet__body">
						<div class="form-group validated">
							<label class="form-control-label" for="invoice no">Supplier Invoice No <strong style="color:red">*</strong> </label>
							<input type="text" class="form-control" disabled="" :value="allData.invoiceNo">
						</div>															
					</div>
				</div>

				<div class="col-md-4">	
					<div class="kt-portlet__body">
						<div class="form-group validated">
							<label class="form-control-label" for="invoice date">Supplier Invoice date  <strong style="color:red">*</strong> </label>
							<input type="date" class="form-control" disabled="" :value="allData.invoiceDate">
						</div>								
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">				
					<div class="kt-portlet__body" style="padding-top: 0px;">
						<div class="form-group validated">
							<label class="form-control-label" for="supplier name">Supplier name  <strong style="color:red">*</strong> </label>
							<input type="text" class="form-control" disabled="" :value="allData.supplierName">
								
						</div>							
					</div>
				</div>
				<div class="col-md-4">
					<div class="kt-portlet__body" style="padding-top: 0px;">
						<div class="form-group validated">
							<label class="form-control-label" for="current date">Current Date <strong style="color:red">*</strong> </label>
							<input type="date" class="form-control" disabled="" :value="allData.currentDate">
						</div>
					</div>
				</div>
				<!-- <div class="col-md-4">
					<div class="kt-portlet__body" style="padding-top: 0px;">
						<div class="form-group validated">
							<label class="form-control-label" for="Upload Image">Invoice Upload <strong style="color:red">*</strong> </label>
							<input type="file" class="form-control" accept="image/*" disabled="">
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
							<th scope="col">Type Key:</th>
							<!-- <th>Upload Key</th> -->
							
						</tr>
					</thead>
					<tbody>
						<tr v-for="(list,key) in allData.purchaseList" :key="key">
							<td>{{ key+1  }}</td>
							<td>
								<input type="text" 
								class="form-control" 
								disabled="" 
								:value="list.productName">
							</td>
							<td>
								<input type="text" 
								class="form-control" 
								disabled="" 
								:value="list.quantity">
							</td>
							<td width="100" style="text-align:center; padding-top:20px"> 
								<input type="checkbox" 
								disabled=""
								v-model="list.serialNo === 'Yes'?true:false"
								:value="list.serialNo">
							</td>
							<td>
								<input type="text" 
								class="form-control" 
								disabled="" 
								:value="list.purchaseRate">
							</td>
							<td>
								<input type="text" 
								name="" 
								class="form-control" 
								disabled="" 
								:value="list.sellRate">
							</td>
							<td>
								<input type="text" 
								class="form-control" 
								disabled="" 
								:value="list.storeLocation">
							</td>
							<td>
								<input type="text" 

								class="form-control" 
								disabled="" 
								:value="list.amount">
							</td>
							<td>
								<vue-tags-input
								v-if=" list.serialNo === 'Yes' ? true : false " 
								v-model="tag"
								:avoid-adding-duplicates="true"
							    :max-tags="list.quantity"
							    :before-saving-tag="addTag(tag,list)"
							    @tags-changed="newTags => {
							    	return tags = newTags
							    }"/>
							</td>
							<!-- <td>
								
								<input 
								v-if="list.serialNo === 'Yes'?true:false" 
								type="file" 
								class="form-control">
							</td> -->
						</tr>
						<tr>
							<td colspan="2" style="text-align:center;">
								<strong style="font-size: 14px;">Total</strong>
							</td>
							<td>
								<strong><input type="text" 
								class="form-control" 
								:value="allData.totalQuantity" 
								disabled=""
								style="font-weight: bold;"></strong>
							</td>
							<td>&nbsp;</td>
							<td>
								<input type="text" 
								class="form-control" 
								:value="allData.totalPurchaseRate" 
								disabled=""
								style="font-weight: bold;">
							</td>
							<td>
								<input type="text" 
								class="form-control" 
								:value="allData.totalSaleRate" 
								disabled=""
								style="font-weight: bold;">
							</td>
							<td>&nbsp;</td>
							<td>
								<input type="text" 
								class="form-control" 
								:value="allData.totalAmountWithoutGst" 
								disabled=""
								style="font-weight: bold;">
							</td>
							
						</tr>
						<tr v-if="allData.cgst">
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
								disabled=""
								
								:value="allData.cgst" 
								style="font-weight: bold;">
							</td>
						</tr>
						<tr v-if="allData.cgst">
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
								disabled=""
								
								:value="allData.sgst" 
								style="font-weight: bold;">
							</td>
						</tr>
						<tr v-if="allData.igst">
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
								disabled=""
								:value="allData.igst"
								style="font-weight: bold;">
							</td>
						</tr>
						<tr>
							<td colspan="2" style="text-align:center;">
								<strong 
								style="font-size: 14px;">Grand Total
								</strong>
							</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>
								<input type="text" 
								class="form-control" 
								disabled="" 
								:value="allData.totalAmount"
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
								<strong style="color:#000">
									{{ allData.amountInWords }}
								</strong>
							</td>
						</tr>
					</tbody>
				</table>
			</div>							
		</div>
		<div style="background:#d3d3d5fc; padding-top: 25px;">
			
			<div class="row">
				<div class="col-md-4">				
					<div class="kt-portlet__body"  style="padding-top: 0px;">
						<div class="form-group validated">
							<label class="form-control-label" for="Upload Image">Invoice Upload <strong style="color:red">*</strong> </label>
							<input type="file" class="form-control" accept="image/*" disabled="">
						</div>								
					</div>
				</div>
			
				<div class="col-md-8">				
					<div class="kt-portlet__body" style="padding-top: 0px;">
						<div class="form-group validated">
							<label class="form-control-label" for="notes">Notes</label>
							<textarea disabled=""  rows="1" class="form-control" :value="allData.notes"></textarea>
						</div>								
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">				
					<div class="kt-portlet__body" style="padding-top: 0px;">
						<div class="form-group validated" style="text-align:center;">
							<button type="button" @click="onSave()" class="btn btn-success">Save</button>
							<button type="reset" class="btn btn-danger">Cancel</button>
						</div>								
					</div>
				</div>
			</div>
		</div>										<!--end: Form Actions -->
	</form>
</template>
<script>
	import VueTagsInput from '@johmun/vue-tags-input';
	import axios from 'axios'
	import Swal from 'sweetalert2'
	export default {
		components: {
    		VueTagsInput,
  		},
		props: ['allData'],

		data: () => {
			return {
				keys:'',
				keysInFile:'',
				tag: '',
      			tags: [],
      			baseUrl:"http://localhost:3000/",
      			purchaseData:{}
			};
		},
		mounted(){

			this.purchaseData = this.allData
			/*console.log(JSON.stringify(this.allData),"next");
			console.log(this.tags)*/
		},
		methods:{

			inputKey(props){

			},

			taggify(newTags){
				tags = newTags

				console.log(newTags)
			},
			onSave(){
				
				axios
      			.post(`${this.baseUrl}api/purchase`,{purchaseData:this.purchaseData})
      			.then(response => window.history.push('/purchase/create'))
      			.catch(error => {
      				Swal.fire({
					  icon: 'erro',
					  title: 'Somthing went wrong',
					  showConfirmButton: false,
					  timer: 1500
					})
      			})
      			
      			

			},
			addTag(tag,list){
				
				this.purchaseData.purchaseList.filter(el => {

					if (el == list) {
						this.tag = ""
						return list.key = JSON.parse(JSON.stringify(this.tags))
					}

					return list

				}) 

				console.log(this.purchaseData); 
				
			}
		}
	}
</script>