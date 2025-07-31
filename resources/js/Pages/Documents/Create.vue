<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({
  name: '',
  attachment: null
})

const submit = () => {
  form.post('/documents', {
    forceFormData: true
  })
}
</script>

<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Create Document</h1>
    <form @submit.prevent="submit" class="space-y-4">
      <div>
        <label>Name</label>
        <input type="text" v-model="form.name" class="w-full border p-2 rounded" />
        <div v-if="form.errors.name" class="text-red-500">{{ form.errors.name }}</div>
      </div>

      <div>
        <label>Attachment</label>
        <input type="file" @change="e => form.attachment = e.target.files[0]" />
        <div v-if="form.errors.attachment" class="text-red-500">{{ form.errors.attachment }}</div>
      </div>

      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Create</button>
    </form>
  </div>
</template>
