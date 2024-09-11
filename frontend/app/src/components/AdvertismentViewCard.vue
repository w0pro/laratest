<script setup>
import {useAdvertisementStore} from "@/stores/advertisement"
const advertisementStore = useAdvertisementStore()
import {useRoute} from "vue-router";
import {ref} from "vue";
import {storeToRefs} from "pinia";
const noData = ref('')
const requestId = useRoute().params?.id

const {getAdvertisementStore: advertisement} = storeToRefs(advertisementStore)

const formHandler = (inputs = {}) =>{
  const form = advertisementStore.getAdvertisement(`api/advertisement/${requestId}`, {} , inputs)

  form.submit()
      .then(response => response.status === 200?
          advertisementStore.setAdvertisement(response.data):
          noData.value = 'Объявление не найдено')
}
formHandler()

</script>
<template>
  <div>
    <p v-if="noData">
      {{noData}}
    </p>
    <div v-else-if="advertisement" class="card__content">
      <h1>{{advertisement.title}}</h1>
      <img v-if="advertisement.headPhoto" :src="advertisement.headPhoto.link" alt="">
      <div>
        <button @click="formHandler({fields:'description'})" class="button__1" v-if="!advertisement.description">Смотреть описание</button>
        <div v-else>
          {{advertisement.description}}
        </div>
      </div>
      <p>Цена{{advertisement.price}}</p>
      <div>
        <button @click="formHandler({fields:'links'})" class="button__1" v-if="!advertisement.links">Смотреть галерею</button>
        <div v-else>
          <div class="gallery_wrapper">
            <img v-for="img in advertisement.links" :src="img.link" alt="">
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
  .card__content {
    display: flex;
    flex-direction: column;
    gap: 20px;
  }

</style>
