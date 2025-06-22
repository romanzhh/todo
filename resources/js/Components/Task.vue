<script setup>
import { router, useForm } from "@inertiajs/vue3";
import taskStatuses from '@/Enums/task-statuses.js';
import { ref } from "vue";

const { task } = defineProps({
  task: {
    type: Object,
    required: true,
  },
});

const isEditing = ref(false);

const form = useForm({
  title: task.title,
  description: task.description,
  status: task.status,
});

const editTask = () => isEditing.value = true;
const saveTask = () => form.put(route('tasks.update', task.id), {
  onSuccess: () => isEditing.value = false,
});
const deleteTask = () => router.delete(route('tasks.destroy', task.id));
const completeTask = () => router.patch(route('tasks.complete', task.id));
const reopenTask = () => router.patch(route('tasks.reopen', task.id));
</script>

<template>
  <div class="w-1/3 flex flex-col gap-y-2">
    <div v-if="!isEditing" class="flex flex-col gap-y-2">
      <div>{{ task.title }}</div>
      <div class="text-sm" style="line-break: anywhere;">{{ task.description }}</div>
    </div>

    <form v-else class="flex flex-col gap-y-3 mb-2">
      <div class="flex flex-col">
        <label class="mb-2 text-sm font-medium text-gray-900">Title</label>
        <input v-model="form.title"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
        <div v-if="form.errors.title" class="mt-2 text-sm text-red-600">{{ form.errors.title }}</div>
      </div>
      <div class="flex flex-col">
        <label class="mb-2 text-sm font-medium text-gray-900">Description</label>
        <textarea v-model="form.description"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"></textarea>
        <div v-if="form.errors.description" class="mt-2 text-sm text-red-600">{{ form.errors.description }}</div>
      </div>
    </form>

    <div class="flex gap-x-2">
      <button v-if="!isEditing" @click="editTask"
        class="w-[100px] text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Edit</button>
      <button v-else @click="saveTask"
        class="w-[100px] text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Save</button>
      <button v-if="task.status !== taskStatuses.completed.value" @click="completeTask"
        class="w-[100px] text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Complete</button>
      <button v-else @click="reopenTask"
        class="w-[100px] text-white bg-yellow-700 hover:bg-yellow-800 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Reopen</button>
      <button @click="deleteTask"
        class="w-[100px] text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Delete</button>
    </div>
  </div>
</template>