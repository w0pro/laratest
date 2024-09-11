<script setup>
import {useAdvertisementStore} from "@/stores/advertisement"
import {ref} from "vue";

const advertisementStore = useAdvertisementStore()

const form = advertisementStore.createAdvertisement('api/advertisement', {
  title: '',
  description: '',
  price: 0.01,
  links: []
})

const formSuccess = ref('')

const submit = () => {
  form.submit().then(
      response => {
        if (response.status === 200) {
              form.reset()
          form.errors = {}
          formSuccess.value = 'Объявление добавлено'
          setTimeout(() => formSuccess.value = '', 2000)
        }
      }
  )
};

const linksField = ref(0)

const addLink = () => {
  linksField.value++
}
const delLink = (index) => {
  form.links = form.links.filter((link, ind) => index !== ind)
  linksField.value--

}

</script>
<template>
  <div class="">
    <h1>Создать объявление</h1>
    <form @submit.prevent="submit" class="advertisement__form">
      <label for="title">Заголовок</label>
      <input
          id="title"
          v-model="form.title"
          @change="form.validate('title')"
      />
      <div v-if="form.invalid('title')">
        {{ form.errors.title }}
      </div>

      <label for="price">Цена</label>
      <input
          id="price"
          type="text"
          v-model="form.price"
          @change="form.validate('price')"
      />
      <div v-if="form.invalid('price')">
        {{ form.errors.price }}
      </div>

      <label for="description">Описание</label>
      <textarea
          id="description"
          v-model="form.description"
          @change="form.validate('description')"
          rows="10"
      >
      </textarea>
      <div v-if="form.invalid('description')">
        {{ form.errors.description }}
      </div>
      <div v-if="linksField">
        <label for="links">Ссылки</label>
        <div  v-for="link in linksField">
          <div class="link_wrapper">
            <input

                id="links"
                type="text"
                v-model="form.links[link - 1]"
                @change="form.validate(`links.${link - 1}`)"
            />
            <button type="button" @click="delLink(link - 1)" class="button__2" >
              Удалить
            </button>
          </div>
          <div v-if="form.invalid(`links.${link - 1}`)">
            {{ form.errors[`links.${[link - 1]}`] }}
          </div>
        </div>


      </div>

      <button v-if="linksField < 3" type="button" @click="addLink" class="button__1" >
        Добавить ссылку на изображение
      </button>


      <button class="button__1" :disabled="form.processing">
        Создать объявление
      </button>
    </form>
    <Transition :duration="{ enter: 500, leave: 800 }">
      <div class="form__success" v-if="formSuccess">
        {{formSuccess}}
      </div>
      </Transition>

  </div>
</template>

<style scoped>
  .advertisement__form {
    border: 3px solid white;
    border-radius: 10px;
    padding: 10px;
    display: flex;
    flex-direction: column;
    gap: 10px;
  }

  .form__success{
    margin-top: 20px;
    border: 3px solid white;
    border-radius: 10px;
    padding: 10px;
  }

  .link_wrapper {
    display: flex;
    gap: 10px;
  }

</style>
