<template>
  <div class="hidden sm:flex sm:items-center sm:ml-6">
    <!-- Settings Dropdown -->
    <div class="ml-3 relative">
      <BreezeDropdown align="right" width="48">
        <template #trigger>
          <span class="inline-flex rounded-md">
            <button
              type="button"
              class="
                inline-flex
                items-center
                px-3
                py-2
                border border-transparent
                text-sm
                leading-4
                font-medium
                rounded-md
                text-gray-500
                bg-white
                hover:text-gray-700
                focus:outline-none
                transition
                ease-in-out
                duration-150
              "
            >
              {{ selectedRoom.name }}

              <svg
                class="ml-2 -mr-0.5 h-4 w-4"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"
                fill="currentColor"
              >
                <path
                  fill-rule="evenodd"
                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                  clip-rule="evenodd"
                />
              </svg>
            </button>
          </span>
        </template>

        <template #content>
          <div v-for="room in rooms" :key="room.id">
            <button
              class="
                block
                w-full
                px-4
                py-2
                text-left text-sm
                leading-5
                text-gray-700
                hover:bg-gray-100
                focus:outline-none
                focus:bg-gray-100
                transition
                duration-150
                ease-in-out
              "
              @click="setRoom(room)"
            >
              {{ room.name }}
            </button>
          </div>
        </template>
      </BreezeDropdown>
    </div>
  </div>
</template>

<script>
import BreezeDropdown from "@/Components/Dropdown.vue";

export default {
  components: {
    BreezeDropdown,
  }, //end of components

  props: ["rooms", "currentRoom"],
  emits: ["setRoom"],

  data() {
    return {
      selectedRoom: this.currentRoom,
    };
  }, //end of data

  watch: {
    currentRoom(newVal) {
      this.selectedRoom = this.currentRoom;
    },
  }, //end of watch

  methods: {
    setRoom(room) {
      this.$emit("setRoom", room);
    },
  }, //end of methods
};
</script>