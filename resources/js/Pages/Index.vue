<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Task from '@/Components/Task.vue';
import { router, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import taskStatuses from '@/Enums/task-statuses.js';

const props = defineProps({
  tasks: {
    type: Object,
    required: true,
  },
  status: {
    type: String,
    default: taskStatuses.inProgress.value,
  },
});

const form = useForm({
  title: null,
  description: null,
  status: taskStatuses.inProgress.value,
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
          <div class="flex gap-x-3">
            <button type="button" @click="toggleTaskCreatingForm"
              class="w-sm text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5">Add
              task</button>

            <button v-for="taskStatus in taskStatuses" v-bind:key="taskStatus.value"
              class="w-sm text-gray-900 border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5"
              :class="props.status === taskStatus.value && 'bg-gray-50'" @click="showTasksByStatus(taskStatus.value)">{{
                taskStatus.label }}</button>
          </div>

          <form v-if="isTaskCreatingFormOpened" @submit.prevent="handleSubmit" class="flex flex-col gap-y-3 mt-5">
            <div class="flex flex-col">
              <label class="mb-2 text-sm font-medium text-gray-900">Title</label>
              <input v-model="form.title"
                class="w-1/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
              <div v-if="form.errors.title" class="mt-2 text-sm text-red-600">{{ form.errors.title }}</div>
            </div>
            <div class="flex flex-col">
              <label class="mb-2 text-sm font-medium text-gray-900">Description</label>
              <textarea v-model="form.description"
                class="w-1/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"></textarea>
              <div v-if="form.errors.description" class="mt-2 text-sm text-red-600">{{ form.errors.description }}</div>
            </div>
            <div>
              <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-1/3 px-5 py-2.5 text-center">Submit</button>
            </div>
          </form>

          <div v-if="Object.keys(tasks).length" class="flex flex-col gap-y-4 mt-3">
            <Task :task="task" v-for="task in props.tasks" v-bind:key="task.id" />
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
