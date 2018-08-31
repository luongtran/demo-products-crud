<template>
    <div>
         <section id="add-product">
            <div class="content">
                <form v-on:submit="updateProduct()" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="product-name">
                                <input type="text" placeholder="Product name" name="name" v-model="product.name" v-validate="{required:true}">
                                <span class="span-error" v-show="errors.has('name')">{{ errors.first('name') }}</span>
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
                                    <select class="form-control" id="exampleSelect1" v-model="product.website_id" name="website">
                                       <option disabled value="">Select User Name</option>
                                        <option v-for="website in websites" v-bind:value="website.id">{{website.name}}</option>
                                    </select>
                                    
                                </div>
                                <div class="form-group">
                                    <select class="form-control" id="exampleSelect2" v-model="product.category_id">
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
                            <tbody class="thead-light" v-if="!boolean">
                                    <tr>
                                        <td>1</td>
                                        <td><input type="text" v-model="product.attribute" v-validate="{ required: true }" name="attribute"><br>
                                            <span v-show="errors.has('attribute')" class="span-error">{{ errors.first('attribute') }}</span>
                                        </td>
                                        <td><input type="text" v-model="product.price" v-validate="{ required: true, numeric: true }" name="price"><br>
                                            <span v-show="errors.has('price')" class="span-error">{{ errors.first('price') }}</span>
                                        </td>
                                        <td><input type="text" v-model="product.stock" v-validate="{ required: true, numeric: true }" name="stock"><br>
                                            <span v-show="errors.has('stock')" class="span-error">{{ errors.first('stock') }}</span>
                                        </td>
                                        <td><input type="text" v-model="product.weight" v-validate="{ required: true , numeric: true }" name="weight"><br>
                                            <span v-show="errors.has('weight')" class="span-error">{{ errors.first('weight') }}</span>
                                        </td>
                                    </tr>  
                            </tbody>
                            <tbody class="thead-light" v-else>
                                    <tr v-for="(item, index) in nameTables">
                                        <td>{{ ++index }}</td>
                                        <td><input type="text" v-model="item.attribute"></td>
                                        <td><input type="text" v-model="item.price"></td>
                                        <td><input type="text" v-model="item.stock"></td>
                                        <td><input type="text" v-model="item.weight"></td>
                                        <td><button type="button" class="common-btn btn-add" v-if="boolean" @click="addNewRow">add</button><button type="button" class="common-btn bnt-remove" v-if="boolean" @click="deleteNewRow(item.id)">remove</button></td>
                                    </tr>   
                            </tbody>
                        </table>
                    </div>
                    <button type="submit" class="btn btn-primary" v-if="boolean">Update</button>
                    <button type="submit" class="btn btn-warning" v-else >Update</button>
                    <!-- <button type="submit" class="btn btn-primary">Update</button> -->
               </form>
            </div>
        </section>
    </div>
</template>
<script>
    export default {
         data: function() {
        return {
            product: [],
            websites: [],
            categories: [],
            selectWebsite: '',
            selectCompany: '',
            boolean: false,
            newRow: {
                
            },
            nameTables: [{
                attribute: '',
                price: '',
                stock: '',
                weight: '',
            }],
            productId: ''
        }
    },
    mounted() {
        this.showWebsite();
        this.showCategory();
        var id = this.$route.params.id;
        this.productId = id;
            axios.get('api/products/'+this.$route.params.id)
                .then(resp =>  {
                    this.product = resp.data.data;
                })
                .catch(resp => {
                    alert("Could not load products");
                })
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
            this.nameTables.push({
                attribute: '',
                price: '',
                stoct: '',
                weight: '',
            });
        },
        deleteNewRow(item) {
            this.nameTables.pop(item, 1);
        },
        updateProduct() {
            event.preventDefault();
            this.$validator.validateAll().then((result) => {
                if(result) {
                    axios.put('api/products/'+ this.$route.params.id, this.product)
                        .then(resp =>  {
                             this.$router.push({path: '/'});
                        })
                        .catch(resp => {
                            alert("Could not load products");
                        }); 
                }
            })
        },

       
    }
    }
</script>
<style type="text/css" scoped>  
.span-error {
  color: #c9aa5f;
  margin-top:5px;
}
</style>

