<template>
	<div class="container">
		<section id="product-search">
            <div class="content">
                <div class="add-product">
                    <router-link to="add" class="btn-common">Add new product</router-link>
                </div>
                <div class="cont-search">
                    
                        <div class="row">
                            <div class="col-md-5 search-id">
                                <input type="text" placeholder="Search.." name="id" v-model="id" @keyup.enter="searchFullProduct"  >
                                <!-- <span v-show="errors.has('id')">{{ errors.first('id') }}</span> -->
                            </div>
                            <div class="col-md-5 search-name">
                                <input type="text" placeholder="Search.." name="name" v-model="name" @keyup.enter="searchFullProduct" >
                                 <!-- <span v-show="errors.has('name')">{{ errors.first('name') }}</span> -->
                                
                            </div>
                            <div class="col-md-2 search">
                                <button type="submit" class="btn-common" v-on:click="searchFullProduct">Search</button>
                            </div>
                        </div>
                    
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th>Product ID</th>
                                <th>Product Name</th>
                                <th>Attribute</th>
                                <th>Print Lable</th>
                            </tr>
                        </thead>
                        <tbody class="thead-light">
                            <tr v-for="product, index in products">
                                <td>{{product.product_id}}</td>
                                <td><a href="" class="common-link-product">{{product.name}}</a></td>
                                <td><a href="" class="common-link-product">{{product.attribute}}</a></td>
                                 <td><a href="" class="btn-common btn-label" data-toggle="modal" data-target="#myModal3">Print Labels</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section> 
          
	</div>
    
</template>
<script>
    export default {
         data: function() {
        return {
            products: [],
            id:  '',
            name: ''
        }
    },
    mounted() {
        var app = this;
        axios.get('api/products')
            .then(function (resp) {
                app.products = resp.data.data;
                console.log(app.products);
            })
            .catch(function (resp) {
                alert("Could not load products");
            }); 
        },
        methods:{
            searchProductId() {
                var app = this;
                axios.get('api/products/search/id?id='+app.id)
                    .then(function (resp) {
                        app.products = resp.data.data;
                    })
                    .catch(function (resp) {
                        console.log('No data search');
                    }); 
            },
            searchFullProduct() {
                var app = this;
                axios.get('api/products/search?id='+app.id+'&name='+app.name)
                    .then(function (resp) {
                        app.products = resp.data.data;
                    })
                    .catch(function (resp) {
                        console.log('No data search');
                    }); 
            }

        }
    }
</script>
