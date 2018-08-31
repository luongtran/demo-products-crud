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
                                <input type="text" placeholder="Search.." name="id" v-model="id" @keyup.enter="searchFullProduct">
                            </div>
                            <div class="col-md-5 search-name">
                                <input type="text" placeholder="Search.." name="name" v-model="name" @keyup.enter="searchFullProduct">
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
                                <td><router-link :to="{name: 'product-edit', params: {id: product.id}}" class="common-link-product">{{product.name}}</router-link></td>
                                <td><a class="common-link-product">{{product.attribute}}</a></td>
                                 <td><a  href="" class="btn-common btn-label" @click.prevent="showModal(product)">Print Labels</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section> 
        <product-detail></product-detail>
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
        components: {
            'product-detail': require('./includes/ProductDetailModal.vue')
        },
        methods:{
            // searchProductId() {
            //     var app = this;
            //     axios.get('api/products/search/id?id='+app.id)
            //         .then(function (resp) {
            //             app.products = resp.data.data;
            //         })
            //         .catch(function (resp) {
            //             console.log('No data search');
            //         }); 
            // },
            searchFullProduct() {
                axios.get('api/products/search?id='+this.id+'&name='+this.name)
                    .then(resp => {
                        this.products = resp.data.data;
                    })
                    .catch(resp => {
                        console.log('No data search');
                    }); 
            },
            showModal(product){
                this.$event.$emit('showProductDetailModal', product);
            }
        },
        mounted() {
            axios.get('api/products')
            .then(resp => {
                this.products = resp.data.data;    
            })
            .catch(resp => {
                alert("Could not load products");
            }); 
        }
    }
</script>
