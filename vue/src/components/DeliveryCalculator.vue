<template>
  <div class="container">
    <form v-on:submit.prevent="submitForm">
        <label>Місто-відправник</label>
        <SimpleTypeahead
            id="typeahead_id"
            placeholder="Start writing..."
            :items="cities"
            :minInputLength="1"
            :itemProjection="settlementsMapForInput"
            @selectItem="setCitySender"
            @onInput="searchSettmelements($event)"
            @onFocus="onFocusEventHandler"
            @onBlur="setCitySender"
        >
        </SimpleTypeahead>

      <label>Місто-одержувач</label>
      <SimpleTypeahead
          id="CityRecipient"
          placeholder="Start writing..."
          :items="cities"
          :minInputLength="1"
          :itemProjection="settlementsMapForInput"
          @selectItem="setCityRecipient"
          @onInput="searchSettmelements($event)"
          @onFocus="onFocusEventHandler"
          @onBlur="setCityRecipient"
      >
      </SimpleTypeahead>
      <br/>
      <label>Тип послуги</label>
      <select name="ServiceType" @change="setServiceType($event)">
        <option value="DoorsDoors">Адреса-Адреса</option>
        <option value="DoorsWarehouse" selected> Адреса-Відділення</option>
        <option value="WarehouseWarehouse">Відділення-Відділення</option>
        <option value="WarehouseDoors">Відділення-Адреса</option>
      </select>

      <label>Вид відправлення</label>
      <select name="DeliveryType" @change="setDeliveryType">
        <option value="Cargo" selected>Вантажі</option>
        <option value="Documents">Документи</option>
        <option value="TiresWheels">Шини та диски</option>
        <option value="Pallet">Палети</option>
      </select>

      <br/>

      <div v-if="this.form.deliveryType == 'Pallet'">
        <label>Тип палети</label>
        <select name="PackRef" @change="setPackRef($event)">
          <option value="627b0c23-d110-11dd-8c0d-001d92f78697">Палета від 1,5 м2 до 2 м2 (816)</option>
          <option value="627b0c24-d110-11dd-8c0d-001d92f78697">Палета від 2 м2 до 3 м2 (817)</option>
          <option value="627b0c25-d110-11dd-8c0d-001d92f78697">Палета від 0,5 м2 до 0,99 м2 (408)</option>
          <option value="627b0c26-d110-11dd-8c0d-001d92f78697">Палета до 0,49 м2 (204)</option>
        </select>
        <input type="number" placeholder="Оголошена вартість" name="announcedPrice">
        <input type="number" placeholder="Кількість" name="count">
      </div>

      <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <div class="result" v-if="this.deliveryCost > 0">Вартість доставки: {{this.deliveryCost}}</div>
  </div>
</template>

<script>
import SimpleTypeahead from 'vue3-simple-typeahead'
import 'vue3-simple-typeahead/dist/vue3-simple-typeahead.css' //Optional default CSS
import axios from 'axios'

export default {
  data() {
    return {
      cities: ['Вінниця','Дніпро','Київ','Львів','Одеса','Харків','Запоріжжя'],
      form: {
        citySender: '',
        cityRecipient: '',
        serviceType: 'DoorsWarehouse',
        deliveryType: 'Cargo',
        optionsSeat: [],
        cargoDetails: [],
      },
      packRef: '',
      deliveryCost: 0
    }
  },
  name: "DeliveryCalculator",
  components: {
    SimpleTypeahead
  },
  methods: {
    searchSettmelements: function(query) {
      axios.get( `${process.env.VUE_APP_API_URL}/novaposhta/searchSettlements`, {
        params: {
          search: query.input
        }
      })
          .then((res) => {
            this.cities = res.data.items
          })
          .catch((error) => {
            console.log(error)
          }).finally(() => {
      });
    },

    settlementsMapForInput: function(item) {
      return item.type_description + ' ' + item.description + ' ' + item.region_description + ' ' + item.area_description
    },

    submitForm: function(submitEvent) {

      if(this.form.deliveryType == 'Pallet') {
        this.setOptionsSeat(submitEvent.target.elements);
      }

      if(this.form.deliveryType == 'TiresWheels') {
        this.setCargoDetails();
      }


      this.clearDeliveryPrice();
      axios.post(  `${process.env.VUE_APP_API_URL}/novaposhta/calculateDelivery`, this.form)
          .then((res) => {
            this.deliveryCost = res.data.delivery.cost;
          })
          .catch((error) => {
            console.log(error)
            this.clearDeliveryPrice();
          }).finally(() => {
      });
    },

    setCitySender: function(city) {
      this.form.citySender = city.ref
    },

    setCityRecipient: function(city) {
      this.form.cityRecipient = city.ref
    },

    setServiceType: function(serviceType) {
      this.form.serviceType = serviceType.target.value
    },

    setDeliveryType: function(deliveryType) {
      this.clearForm();
      this.form.deliveryType = deliveryType.target.value
    },

    setOptionsSeat: function(optionsSeat) {
      let obj = {
        count: optionsSeat.count.value,
        announcedPrice: optionsSeat.announcedPrice.value,
        packRef: this.packRef,
        weight: 1,
        volumetricWidth: 20,
        volumetricLength: 20,
        volumetricHeight: 20,
      }
      this.form.optionsSeat.push(obj)
    },



    setPackRef: function(packRef) {
      this.packRef = packRef.target.value;
    },

    setCargoDetails: function() {
      let obj = {
        CargoDescription: "d7c456cf-aa8b-11e3-9fa0-0050568002cf",
        Amount: "1",
      }
      this.form.cargoDetails.push(obj)
    },

    clearDeliveryPrice() {
      this.deliveryCost = 0;
    }
    ,
    clearOptionsSeats: function() {
      this.form.optionsSeat = []
    },

    clearCargoDetails: function() {
      this.form.cargoDetails = []
    },

    clearForm: function() {
      this.clearOptionsSeats();
      this.clearCargoDetails();
      this.clearDeliveryPrice();
    }

  }
}
</script>

<style scoped>
.container {
  display: grid;
  place-items: center;
}
.result {
  font-size: 1.5rem;
  font-weight: bold;
}
</style>