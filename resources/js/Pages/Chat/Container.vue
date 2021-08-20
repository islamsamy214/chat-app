<template>
  <Head title="Chat" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <chat-room-selection
          v-if="rooms.length != 0"
          :rooms="rooms"
          :currentRoom="currentRoom"
          @setRoom="setRoom"
        ></chat-room-selection>
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <message-container :messages="messages"></message-container>
            <input-message
              :room="currentRoom"
              @messageSent="getMessages"
            ></input-message>
          </div>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head } from "@inertiajs/inertia-vue3";

import MessageContainer from "./MessageContainer.vue";
import InputMessage from "./InputMessage.vue";
import ChatRoomSelection from "./ChatRoomSelection.vue";

export default {
  components: {
    BreezeAuthenticatedLayout,
    Head,
    MessageContainer,
    InputMessage,
    ChatRoomSelection,
  },

  data() {
    return {
      rooms: [],
      currentRoom: [],
      messages: [],
    };
  }, //end of data

  watch: {
    currentRoom(val, oldVal) {
      if (oldVal.id) {
        this.disconnect(oldVal.id);
      }
      this.connect();
    },
  }, //end of watch

  methods: {
    connect() {
      if (this.currentRoom.id) {
        let vm = this;

        this.getMessages();

        window.Echo.private(`chat.${this.currentRoom.id}`).listen(
          "NewChatMessages",
          (e) => {
            vm.getMessages();
          }
        );
      }
    }, //end of connent

    disconnect(roomId) {
      window.Echo.leave("chat." + roomId);
    }, //end of disconnect

    getRooms() {
      axios
        .get("/chat/rooms")
        .then((response) => {
          this.rooms = response.data;
          this.setRoom(response.data[0]);
          this.getMessages();
        })
        .catch((error) => {
          alert(error.response.data);
        });
    }, //endf of getRoom

    setRoom(room) {
      this.currentRoom = room;
    }, //end of setRoom

    getMessages() {
      axios
        .get(`/chat/room/${this.currentRoom.id}/messages`)
        .then((response) => {
          this.messages = response.data;
        })
        .catch((error) => {
          alert(error.response.data);
        });
    }, //endf of getMessages
  }, //end of methods

  created() {
    this.getRooms();
  }, //end of created
};
</script>
