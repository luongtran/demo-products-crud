<template>
    <div id="app">
        <section id="main-content">
        	<section class="wrapper">
        		<div class="row">
        			<router-view></router-view>
    			</div>
    		</section>
    </section>
    </div>
</template>
<script>
    export default {
        name: 'app' //component add route view
    }
</script>