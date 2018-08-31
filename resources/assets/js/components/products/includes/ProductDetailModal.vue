<template>
	<div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title text-center">Print Labels</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                     <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>{{product.name}} ({{product.attribute}})</td>
                                <td><button type="button" class="btn-common btn-label">{{product.price}}</button></td>
                                <td><button type="button" class="btn-common btn-label">Print</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
	export default {
		data(){
			return {
				product: {}
			}
		},
		created(){
			this.$event.$on('showProductDetailModal', product => {
				$('#myModal').modal('show');
				this.product = product;
			});
		},
		beforeDestroy(){
			this.$event.$off('showProductDetailModal');
		}
	}
</script>