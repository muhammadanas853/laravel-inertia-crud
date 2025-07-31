<!-- <script setup>
import { router } from '@inertiajs/vue3'
import Swal from 'sweetalert2'

defineProps({ documents: Array })

const deleteDocument = (id) => {
  Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      router.delete(`/documents/${id}`)
    }
  })
}
</script> -->
<script setup>
import { router } from '@inertiajs/vue3'
import Swal from 'sweetalert2'

defineProps({ documents: Array })

const deleteDocument = (id) => {
  Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      router.delete(`/documents/${id}`)
    }
  })
}

const restoreDocument = (id) => {
  Swal.fire({
    title: 'Restore this document?',
    icon: 'question',
    showCancelButton: true,
    confirmButtonText: 'Yes, Restore!'
  }).then((result) => {
    if (result.isConfirmed) {
      router.post(`/documents/${id}/restore`)
    }
  })
}
</script>

<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">All Documents</h1>

    <a href="/documents/create" class="bg-green-500 text-white px-4 py-2 rounded">+ Create New</a>

    <ul class="mt-4 space-y-2">
      <li v-for="doc in documents" :key="doc.id" class="p-4 border flex justify-between items-center">
        <div>
          <p class="font-semibold">
            {{ doc.name }}
            <span v-if="doc.deleted_at" class="text-red-500 text-sm ml-2">(Trashed)</span>
          </p>
          <p v-if="doc.attachment">
            <a :href="`/storage/${doc.attachment}`" class="text-blue-500" target="_blank">Download</a>
          </p>
        </div>

        <div class="space-x-2">
          <template v-if="!doc.deleted_at">
            <a :href="`/documents/${doc.id}/edit`" class="text-blue-600">Edit</a>
            <button @click="deleteDocument(doc.id)" class="text-red-500">Delete</button>
          </template>
          <template v-else>
            <button @click="restoreDocument(doc.id)" class="text-yellow-600">Restore</button>
          </template>
        </div>
      </li>
    </ul>
  </div>
</template>

<!-- <template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">All Documents</h1>

    <a href="/documents/create" class="bg-green-500 text-white px-4 py-2 rounded">+ Create New</a>

    <ul class="mt-4 space-y-2">
      <li v-for="doc in documents" :key="doc.id" class="p-4 border flex justify-between">
        <div>
          <p class="font-semibold">{{ doc.name }}</p>
          <p v-if="doc.attachment">
            <a :href="`/storage/${doc.attachment}`" class="text-blue-500" target="_blank">Download</a>
          </p>
        </div>
        <div>
          <a :href="`/documents/${doc.id}/edit`" class="text-blue-600 mr-3">Edit</a>
          <button @click="deleteDocument(doc.id)" class="text-red-500">Delete</button>
        </div>
      </li>
    </ul>
  </div>
</template> -->
