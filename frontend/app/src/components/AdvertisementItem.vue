<script setup>
defineProps({
  advertisement:Object
})
</script>

<template>
  <div class="advertisement">
    <div class="advertisement_wrapper">
      <p class="text-4xl">{{advertisement.title}}</p>
      <p>Цена:{{advertisement.price}}</p>
    </div>
    <div>
      <img v-if="advertisement.headPhoto" :src="advertisement.headPhoto.link" alt="">
    </div>
  </div>

</template>


<style scoped>
  .advertisement {
    border: 3px solid white;
    border-radius: 10px;
    padding: 10px;
  }

  .advertisement_wrapper {
    display: flex;
    gap: 20px;
  }

  .advertisement_wrapper>div {
    flex: 1;
  }

</style>
