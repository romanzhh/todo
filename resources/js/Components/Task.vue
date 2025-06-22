<script setup>
import { router } from "@inertiajs/vue3";

const { task } = defineProps({
  task: {
    type: Object,
    required: true,
  },
});

const deleteTask = () => router.delete(route('tasks.destroy', task.id));
const completeTask = () => router.patch(route('tasks.complete', task.id));
</script>

<template>
  <div>
    <div>{{ task.title }}</div>
    <div>{{ task.description }}</div>
  </div>

  <div>
    <div>
      <button type="text" @click="deleteTask">Delete</button>
      <button type="text" @click="completeTask">Complete</button>
    </div>
  </div>
</template>