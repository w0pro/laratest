<script setup >
import {useAdvertisementStore} from "@/stores/advertisement"
import {ref} from "vue";
import {storeToRefs} from "pinia";
import AdvertisementItem from "@/components/AdvertisementItem.vue";
import {useRoute} from "vue-router";
import {watch} from "vue";
const advertisementStore = useAdvertisementStore()
const noData = ref('')
const {getAdvertisements: advertisements} = storeToRefs(advertisementStore)
const {getCurrentFilters:filters} = storeToRefs(advertisementStore)
const router = useRoute()
const currentPage = ref(router.query?.page? router.query.page:1)

const formHandler = (inputs = {}) => {

  if (typeof inputs === 'string') {
   inputs = JSON.parse(inputs)
  }
  inputs.page = currentPage.value
  advertisementStore.setCurrentFilters(inputs)

  const form = advertisementStore.getCollection('api/advertisement', {} , filters.value)

  form.submit()
      .then(response => response.status === 200?
          advertisementStore.setAdvertisements(response.data):
          noData.value = 'ничего нет')
}
formHandler()

watch(() =>router.query?.page, (newVal, old) => {
  if (newVal) {
    currentPage.value = Number(newVal)
    formHandler()
  }
}, {deep: true})
</script>
<template>
  <div>
    <p v-if="noData">
      {{noData}}
    </p>
    <div v-else-if="advertisements && advertisements.pagination">
      <h1>Доступные объявления</h1>
        <div>
          <select name="sort" id="sort" @change="formHandler($event.target.value)">
            <option selected disabled>Сортировка</option>
            <option :value="JSON.stringify({order:'price', orderBy: 'asc'})" >Увеличение цены</option>
            <option :value="JSON.stringify({order:'price', orderBy: 'desc'})" >Уменьшение цены</option>
            <option :value="JSON.stringify({order:'created_at', orderBy: 'asc'})" >Дата создания по возрастанию</option>
            <option :value="JSON.stringify({order:'created_at', orderBy: 'desc'})" >Дата создания по убыванию</option>
          </select>
        </div>
      <div class="advertisement__list">
        <RouterLink :to="`/advertisement/${advertisement.id}`" v-for="(advertisement, index) in advertisements.collection" :id="index+advertisement.title">
          <AdvertisementItem :advertisement="advertisement"/>
        </RouterLink>
      </div>

      <div class="pagination" v-if="advertisements && advertisements.pagination.total_pages > 1">
        <router-link :to="{path: router.path, query: {page: page}}" class="page__nav" :class="{active: advertisements.pagination.current_page === page}" v-for="page in advertisements.pagination.total_pages">
          {{page}}
        </router-link>
      </div>


    </div>
  </div>
</template>

<style scoped>
  .advertisement__list {
    margin: 30px 0;
    display: flex;
    flex-direction: column;
    gap: 10px;
  }

  .pagination {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
  }

</style>
