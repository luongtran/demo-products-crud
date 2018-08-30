<template>
	<div>
		 <section id="add-product">
            <div class="content">
                <form class="example" action="action_page.php">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="product-name">
                                <input type="text" placeholder="Product name">
                            </div>
                            <div class="multiselect">
                                <div class="selectBox" onclick="showCheckboxes()">
                                    <select>
                                        <option>Select options</option>
                                    </select>
                                    <div class="overSelect"></div>
                                </div>
                                <div id="checkboxes">
                                    <label for="one">
                                        <input type="checkbox" id="one" />First checkbox</label>
                                    <label for="two">
                                        <input type="checkbox" id="two" />Second checkbox</label>
                                    <label for="three">
                                        <input type="checkbox" id="three" />Third checkbox</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="cont-search">
                                <div class="form-group">
                                    <select class="form-control" id="exampleSelect1" v-model="selectWebsite" name="website">
                                       <option disabled value="">Select User Name</option>
                            			<option v-for="website in websites" v-bind:value="website.id">{{website.name}}</option>
                                    </select>
                                    
                                </div>
                                <div class="form-group">
                                    <select class="form-control" id="exampleSelect2" v-model="selectCompany">
                                        <option value="" disabled selected>Finaly Category</option>
                                        <option v-for="category in categories" v-bind:value="category.id">{{category.name}}</option>
                                    </select>
                                </div>
                            </div>
                            <fieldset class="form-group">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value="option1" checked v-model="boolean" v-bind:value="false"> Simple product
                                    </label>
                                </div>
                                <div class="form-check disabled">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios2" value="option2" v-model="boolean" v-bind:value="true">Variable product
                                    </label>
                                </div>
                                <div class="form-group mt-3 group-attribute">
                                    <input type="text" placeholder="Attribute" class="attribute ml-1">
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div class="table-responsive table-attribute">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Attribute</th>
                                    <th>Price</th>
                                    <th>Stoct</th>
                                    <th>Weight</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="thead-light">
                                <tr v-for="(item, index) in nameTables">
                                    <td>{{ ++index }}</td>
                                    <td><input type="text"></td>
                                    <td><input type="text"></td>
                                    <td><input type="text"></td>
                                    <td><input type="text"></td>
                                    <td><button type="button" class="common-btn btn-add" v-if="boolean" @click="addNewRow">add</button><button type="button" class="common-btn bnt-remove" v-if="boolean" @click="deleteNewRow(newRow.id)">remove</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </section>
	</div>
</template>
<script>
	export default {
         data: function() {
        return {
            websites: [],
            categories: [],
            selectWebsite: '',
            selectCompany: '',
            boolean: false,
            newRow: {
        		attribute: '',
        		price: '',
        		stoct: '',
        		weight: '',
        	},
            nameTables: [{
        		attribute: '',
        		price: '',
        		stoct: '',
        		weight: '',
        	}]
        }
    },
    mounted() {
        this.showWebsite();
        this.showCategory();
    },
    methods:{
        showWebsite() {
        	axios.get('api/websites')
	            .then(resp =>  {
	                this.websites = resp.data.data;
	            })
	            .catch(resp => {
	                alert("Could not load products");
	            }); 
        },
         showCategory() {
        	axios.get('api/categories')
	            .then(resp =>  {
	                this.categories = resp.data.data;
	            })
	            .catch(resp => {
	                alert("Could not load products");
	            }); 
        },

        addNewRow() {
        	this.newRow.id = (new Date()).getTime()
        	this.nameTables.push(this.newRow);

        },
        deleteNewRow(item) {
        	this.nameTables.pop(item, 1)
        }

    }
    }
</script>
