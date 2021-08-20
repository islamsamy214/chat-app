<template>
  <div>
    <div class="h-96 w-full">
      <div class="h-full p-2 flex flex-col-reverse overflow-auto">
        <div v-for="(message, index) in messages" :key="index">
          <message-item :message="message"></message-item>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import MessageItem from "./MessageItem.vue";

export default {
  props: ["messages"],

  components: { MessageItem },
};
</script>