import { ref, computed } from 'vue'
import { defineStore } from 'pinia'
import {useUserApiFetch} from "@/composables/useUserApiFetch"


export const useAdvertisementStore = defineStore('advertisement', () => {
 const currentFilters = ref({})
 const advertisements = ref([])
 const advertisement = ref({})
  function getCollection(path: string, options: {}, inputs: {})
  {
    return useUserApiFetch(path, 'get', inputs)
  }

 function getAdvertisement(path: string, options: {}, inputs: {})
 {
  return useUserApiFetch(path, 'get', inputs)
 }

  function setAdvertisements(data: [])
  {
   advertisements.value = data
  }

 function setAdvertisement(advertisementData: {})
 {
  advertisement.value = advertisementData
 }

  function createAdvertisement(path: string, inputs: {})
  {
   return useUserApiFetch(path, 'post', inputs)
  }

 function setCurrentFilters(newFilters = {})
 {
  currentFilters.value = {...currentFilters.value, ...newFilters }
 }

 const getAdvertisements = computed(() => advertisements.value)
 const getCurrentFilters = computed(() => currentFilters.value)
 const getAdvertisementStore = computed(() => advertisement.value)


 return {
  currentFilters,
  advertisements,
  advertisement,
  getCollection,
  setCurrentFilters,
  createAdvertisement,
  setAdvertisements,
  setAdvertisement,
  getAdvertisement,
  getCurrentFilters,
  getAdvertisements,
  getAdvertisementStore
 }
})
