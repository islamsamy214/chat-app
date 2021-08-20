<template>
  <div>
    <div class="relative h-10 m-1">
      <form
        @submit.prevent="submitMessage"
        style="border-top: 1px solid #e6e6e6"
        class="grid grid-cols-6"
      >
        <input
          type="text"
          v-model="message"
          class="col-span-5 border-none p-1 mt-1"
          placeholder="Say Something..."
        />
        <button
          type="submit"
          class="
            place-self-end
            bg-gray-500
            hover:bg-blue-700
            p-2
            mt-2
            rounded
            text-white
            disabled:opacity-50
          "
          :disabled="disabled"
        >
          Send
        </button>
      </form>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  props: ["room"],
  emits: ["messageSent"],

  data() {
    return {
      message: "",
      disabled: true,
    };
  }, //end of data

  watch: {
    message(value) {
      if (this.message.trim()) {
        this.disabled = false;
      } else {
        this.disabled = true;
      }
    },
  }, //end of watch

  methods: {
    submitMessage() {
      this.disabled = true;

      let formData = new FormData();
      formData.append("message", this.message);

      axios
        .post(`/chat/room/${this.room.id}/messages`, formData)
        .then((result) => {
          if (result.status == 201) {
            this.message = "";
            this.$emit("messageSent");
          }
        })
        .catch((err) => {
          alert(err);
        });
    },
  }, //end of methods
};
</script>