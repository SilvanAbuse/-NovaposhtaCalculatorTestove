<template>
<!--  <HelloWorld msg="Welcome to Your Vue.js App"/>-->
<DeliveryCalculator/>
</template>

<script>
// import HelloWorld from './components/HelloWorld.vue'
import DeliveryCalculator from './components/DeliveryCalculator.vue'
import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';

export default {
  name: 'App',
  components: {
    DeliveryCalculator
  }
}
</script>

<style>

#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
