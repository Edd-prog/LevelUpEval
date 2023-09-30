<script setup>
import { ref, inject } from 'vue'

import axios from 'axios'

const toast = inject('toast')

const cardInfo = ref({
  type: 'visa',
  username: null,
  cvv: null,
  pan: null,
  month: null,
  year: null
})

/*
const cardInfo = ref({
  type: 'visa',
  username: 'Edgar Andrade',
  cvv: 123,
  pan: 38345688888888888,
  month: 8,
  year: 2023
})
*/

const sendOrderToAPI = async () => {
  console.log(cardInfo.value)
  await axios
    .post(`http://127.0.0.1:8080/api/verification`, cardInfo.value)
    .then((response) => {
      console.log(response)
      toast.success('Card info sent for final verification')
    })
    .catch((error) => {
      console.log(error)
      toast.error(error.response.data)
    })
}
</script>

<template>
  <div class="container">
    <div class="credit-card">
      <div class="card-body">
        <h1 class="mb-2">Credit Card</h1>

        <form class="mt-4">
          <div class="form-outline form-white mb-4">
            <div class="d-flex flex-row gap-3">
              <label> Card type</label>
              <select class="input-group-text" v-model="cardInfo.type">
                <option value="visa">VISA</option>
                <option value="am">American Express</option>
                <option value="mc">Mastercard</option>
              </select>
            </div>
          </div>

          <div class="form-outline form-white mb-4">
            <label> Card number</label>
            <input
              v-model="cardInfo.pan"
              type="number"
              class="form-control form-control-lg"
              minlength="16"
              maxlength="19"
              placeholder="4321123548786999"
            />
          </div>

          <div class="form-outline form-white mb-4">
            <label> Card holder</label>
            <input
              v-model="cardInfo.username"
              type="text"
              class="form-control form-control-lg"
              placeholder="John Smith"
            />
          </div>

          <div class="form-outline form-white mb-4">
            <label> Expiration Date</label>
            <div class="d-flex flex-row gap-2">
              <input
                v-model="cardInfo.month"
                type="text"
                class="form-control form-control-lg"
                placeholder="Month"
              />

              <input
                v-model="cardInfo.year"
                type="text"
                class="form-control form-control-lg"
                placeholder="Year"
              />
            </div>
          </div>

          <div class="form-outline form-white mb-4">
            <label> CVV</label>
            <input
              v-model="cardInfo.cvv"
              type="text"
              class="form-control form-control-lg"
              placeholder="123"
            />
          </div>
        </form>

        <button
          type="button"
          class="btn btn-info btn-block btn-lg"
          @click.prevent="sendOrderToAPI()"
        >
          <div class="d-flex justify-content-between">
            <span>Verify Card <i class="fas fa-long-arrow-alt-right ms-2"></i></span>
          </div>
        </button>
      </div>
    </div>
  </div>
</template>

<style scoped>
.credit-card {
  background: linear-gradient(to right, #6495ed, #4169e1);
  color: white;
  border-radius: 10px;
  padding: 20px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  font-family: Arial, sans-serif;
}

/* Style your form fields and other elements as needed */
</style>
