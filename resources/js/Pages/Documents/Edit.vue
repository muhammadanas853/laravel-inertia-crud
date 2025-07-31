<script setup>
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
  document: Object
})

const form = useForm({
  name: props.document.name,
  attachment: null
})

const submit = () => {
  form.post(`/documents/${props.document.id}`, {
    _method: 'put',
    forceFormData: true
  })
}
</script>

<!-- <template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Edit Document</h1>
    <form @submit.prevent="submit" class="space-y-4">
      <div>
        <label>Name</label>
        <input type="text" v-model="form.name" class="w-full border p-2 rounded" />
        <div v-if="form.errors.name" class="text-red-500">{{ form.errors.name }}</div>
      </div>

      <div>
        <label>Replace Attachment</label>
        <input type="file" @change="e => form.attachment = e.target.files[0]" />
        <div v-if="form.errors.attachment" class="text-red-500">{{ form.errors.attachment }}</div>
      </div>

      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
    </form>
  </div>
</template> -->
<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Edit Document</h1>

    <form @submit.prevent="submit" class="space-y-4">

      <!-- Name Field -->
      <div>
        <label>Name</label>
        <input type="text" v-model="form.name" class="w-full border p-2 rounded" />
        <div v-if="form.errors.name" class="text-red-500">{{ form.errors.name }}</div>
      </div>

      <!-- Attachment Preview -->
      <div v-if="props.document.attachment">
        <label>Current Attachment</label>
        <div class="mt-1">
          <a :href="`/storage/${props.document.attachment}`" target="_blank">
            <img :src="`/storage/${props.document.attachment}`" class="h-32 rounded border" />
          </a>
        </div>
      </div>

      <!-- File Upload -->
      <div>
        <label>Replace Attachment</label>
        <input type="file" @change="e => form.attachment = e.target.files[0]" />
        <div v-if="form.errors.attachment" class="text-red-500">{{ form.errors.attachment }}</div>
      </div>

      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
    </form>
  </div>
</template>
