<template>
  <div class="w-full h-screen flex justify-center items-center bg-gray-800 p-4">
    <div class="max-w-4xl w-full bg-gray-800 text-white rounded-xl shadow-lg space-y-4 p-6">
      <!-- Header -->
      <div class="text-center">
        <h1 class="text-3xl font-semibold text-white">Summary ChatBot</h1>
        <p class="text-gray-400">Generate summaries with AI</p>
      </div>

      <!-- Messages Container -->
      <div class="space-y-4 h-72 overflow-y-auto p-4 bg-gray-700 rounded-lg shadow-inner">
        <div v-for="(message, index) in messages" :key="index" class="flex space-x-3">
          <div v-if="message.role === 'user'" class="flex-shrink-0">
            <span class="inline-block w-10 h-10 rounded-full bg-blue-500 text-white text-center leading-10">U</span>
          </div>
          <div v-if="message.role === 'system'" class="flex-shrink-0">
            <span class="inline-block w-10 h-10 rounded-full bg-green-500 text-white text-center leading-10">S</span>
          </div>
          <div class="flex-1">
            <p :class="message.role === 'user' ? 'text-right text-blue-300' : 'text-left text-gray-300'">{{
              message.content }}</p>
          </div>
        </div>
      </div>

      <!-- User Input -->
      <div class="flex space-x-4 mt-4">
        <textarea v-model="userMessage"
          class="w-full p-3 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-700 text-white"
          placeholder="Write your message here..." rows="1"></textarea>
        <button @click="sendMessage"
          class="p-3 bg-gray-100 text-black rounded-lg hover:bg-gray-300 focus:outline-none cursor-pointer">
          Send
        </button>
      </div>

      <!-- Loading & Error -->
      <p v-if="loading" class="text-center text-gray-400">Generating summary...</p>
      <p v-if="error" class="text-center text-red-500">{{ error }}</p>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';

// Variables
const userMessage = ref('');
const loading = ref(false);
const error = ref('');
const messages = ref < { role: 'user' | 'system'; content: string }[] > ([]);

// Send message to the server
const sendMessage = async () => {
  loading.value = true;
  error.value = '';
  messages.value.push({ role: 'user', content: userMessage.value });

  try {
    const response = await fetch('/api/summary', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
      },
      body: JSON.stringify({ text: userMessage.value }),
    });

    const data = await response.json();

    if (response.ok) {
      messages.value.push({ role: 'system', content: data.summary });
    } else {
      error.value = data.message || 'An error occurred while generating the summary.';
    }
  } catch (e) {
    error.value = 'Error communicating with the server.';
  } finally {
    loading.value = false;
  }

  userMessage.value = '';
};
</script>