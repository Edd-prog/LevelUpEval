<script setup>
import { ref, inject } from 'vue'

import axios from 'axios'

const toast = inject('toast')

const cardInfo = ref({
  type: 'visa',
  username: 'Edgar Andrade',
  cvv: 123,
  pan: 38345688888888888,
  month: 8,
  year: 2023
})

const sendOrderToAPI = async () => {
  console.log(cardInfo.value)
  await axios
    .post('http://levelup.test:80/api/verification', cardInfo.value)
    .then((response) => {
      console.log(response)
      toast.success('Card info sent for final verification')
    })
    .catch((error) => {
      console.log(error)
      toast.error('Card info is invalid')
    })
}
</script>

<template>
  <div class="container">
    <div class="card bg-primary text-white rounded-3">
      <div class="card-body">
        <h1 class="small mb-2">Credit Card</h1>

        <form class="mt-4">
          <div class="form-outline form-white mb-4">
            <label> Card type</label>
            <select v-model="cardInfo.type">
              <option value="visa">VISA</option>
              <option value="am">American Express</option>
              <option value="mc">Mastercard</option>
            </select>
          </div>
          <div class="form-outline form-white mb-4">
            <label> Card number</label>
            <input
              v-model="cardInfo.pan"
              type="number"
              class="form-control form-control-lg"
              minlength="16"
              maxlength="19"
            />
          </div>

          <div class="form-outline form-white mb-4">
            <label> Card holder</label>
            <input v-model="cardInfo.username" type="text" class="form-control form-control-lg" />
          </div>

          <div class="form-outline form-white mb-4">
            <label> Expiration Date</label>
            <input v-model="cardInfo.month" type="text" class="form-control form-control-lg" />
            <input v-model="cardInfo.year" type="text" class="form-control form-control-lg" />
          </div>

          <div class="form-outline form-white mb-4">
            <label> CVV</label>
            <input v-model="cardInfo.cvv" type="text" class="form-control form-control-lg" />
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
