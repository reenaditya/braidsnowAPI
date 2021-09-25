<template>
    <div class="kt-wizard-v3__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
    <div class="kt-heading kt-heading--md">Supplier Info</div>
        <div class="kt-form__section kt-form__section--first">
            <div class="kt-wizard-v3__form">
                <div class="form-group">
                    <label>Select Supplier</label>
                     <autocomplete
                            source="https://api.github.com/search/repositories?q="
                            results-property="items"
                            input-class="form-control"
                            results-display="full_name">
                    </autocomplete>
                       
                </div>
                <div class="form-group">
                    <label>Supplier Invoice Number</label>
                        <input type="text" class="form-control" name="address2" placeholder="invoice number">
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="form-group">
                            <label>Purchase Date</label>
                            <input type="text" class="form-control" name="postcode" placeholder="Postcode" value="3000">
                           
                        </div>
                    </div>
                    
                </div>

            </div>
        </div>
    </div>
</template>

<script>
import Vue from 'vue'
import Autocomplete from 'vuejs-auto-complete'
    export default {
        components: {
            Autocomplete,
        },
        mounted() {
            //console.log('Component mounted.')
        }
    }
</script>
