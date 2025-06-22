<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Task from '@/Components/Task.vue';
import { router, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import taskStatuses from '@/Enums/task-statuses.js';

const { tasks } = defineProps({
  tasks: {
    type: Object,
    required: true,
  },
});

const form = useForm({
  title: null,
  description: null,
  status: 'in_progress',
});

const isTaskCreatingFormOpened = ref(false);

const toggleTaskCreatingForm = () => isTaskCreatingFormOpened.value = !isTaskCreatingFormOpened.value;

const handleSubmit = () => form.post(route('tasks.store'), {
  onSuccess: () => form.reset() && toggleTaskCreatingForm(),
});

const showTasksByStatus = (status) => router.reload({
  data: {
    status,
  }
});
</script>

<template>
  <AppLayout title="Todo">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Tasks
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
          <div>
            <button type="button" @click="toggleTaskCreatingForm">Add task</button>
          </div>

          <div class="flex gap-x-3">
            <button v-for="taskStatus in taskStatuses" v-bind:key="taskStatus.value"
              @click="showTasksByStatus(taskStatus.value)">{{ taskStatus.label }}</button>
          </div>

          <form v-if="isTaskCreatingFormOpened" @submit.prevent="handleSubmit" class="flex flex-col gap-y-2 mt-5">
            <div class="flex flex-col">
              <label>Title</label>
              <input v-model="form.title" class="w-1/5">
              <div v-if="form.errors.title" class="text-red-500 font-medium">{{ form.errors.title }}</div>
            </div>
            <div class="flex flex-col">
              <label>Description</label>
              <textarea v-model="form.description" class="w-1/5"></textarea>
              <div v-if="form.errors.description" class="text-red-500 font-medium">{{ form.errors.description }}</div>
            </div>
            <div>
              <button type="submit">Submit</button>
            </div>
          </form>

          <div class="flex flex-col gap-y-3 mt-3">
            <div v-for="task in tasks" v-bind:key="task.id">
              <Task :task="task" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
