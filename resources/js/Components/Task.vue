<script setup>
import { router } from "@inertiajs/vue3";
import taskStatuses from '@/Enums/task-statuses.js';

const { task } = defineProps({
  task: {
    type: Object,
    required: true,
  },
});

const deleteTask = () => router.delete(route('tasks.destroy', task.id));
const completeTask = () => router.patch(route('tasks.complete', task.id));
const reopenTask = () => router.patch(route('tasks.reopen', task.id));
</script>

<template>
  <div class="w-1/3 flex flex-col gap-y-2">
    <div class="flex flex-col gap-y-2">
      <div>{{ task.title }}</div>
      <div class="text-sm">{{ task.description }}</div>
    </div>

    <div class="flex gap-x-2">
      <button @click="deleteTask"
        class="w-[100px] text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Delete</button>
      <button v-if="task.status !== taskStatuses.completed.value" @click="completeTask"
        class="w-[100px] text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Complete</button>
      <button v-else @click="reopenTask"
        class="w-[100px] text-white bg-yellow-700 hover:bg-yellow-800 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Reopen</button>
    </div>
  </div>
</template>