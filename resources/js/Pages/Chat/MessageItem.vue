<template>
  <div>
    <div
      class="
        bg-green-500
        shadow-md
        m-3
        p-3
        text-white
        rounded-br-lg
        min-h-full
        w-auto
        flex
        items-start
        justify-start
      "
      v-if="message.user.id == $page.props.auth.user.id"
    >
      {{ message.user.name }}: {{ message.message }}
    </div>
    <div
      class="
        bg-blue-500
        shadow-md
        m-3
        p-3
        text-white
        rounded-bl-lg
        min-h-full
        w-auto
        flex
        items-end
        justify-end
      "
      v-else
    >
      {{ message.message }} :{{ message.user.name }}
    </div>
  </div>
</template>

<script>
export default {
  props: ["message"],
};
</script>