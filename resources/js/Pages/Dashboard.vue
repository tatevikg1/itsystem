<template>
  <app-layout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Dashboard
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <div class="p-12">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              Users
            </h2>

            <Users :users="users" />
          </div>

          <div class="p-12">
            <h2
              class="font-semibold text-xl text-gray-800 leading-tight"
              @click="addNewTask"
              style="cursor: pointer"
            >
              Add new board
            </h2>
            <div style="visi"></div>
          </div>

          <div class="p-12">
            <h2
              class="font-semibold text-xl text-gray-800 leading-tight"
              style="cursor: pointer"
            >
              My tasks
            </h2>
            <ul v-if="tasks">
              <li v-for="task in tasks" :key="task.id">
                <div>
                  {{ task.description }}
                  <span
                    @click="updateTask(task.id, 'accepted')"
                    style="cursor: pointer"
                    class="p-5"
                    >ok</span
                  >
                  <span
                    @click="updateTask(task.id, 'rejected')"
                    style="cursor: pointer"
                    class="p-5"
                    >x</span
                  >
                </div>
              </li>
            </ul>

            <!-- <Tasks :tasks="tasks" /> -->
          </div>

          <div class="p-12">
            <h2
              class="font-semibold text-xl text-gray-800 leading-tight"
              style="cursor: pointer"
            >
              In progress
            </h2>
            <Progress :progress="progress" />
          </div>
        </div>
      </div>
    </div>
    <div class="bg-modal">
      <div class="modal-content">
        <div class="close" @click="closeForm">+</div>

        <form @submit.prevent="saveTask">
          <div class="">
            <select name="for_user" id="for_user">
              <option v-for="user in users" :key="user.id" :value="user.id">
                {{ user.name }}
              </option>
            </select>
          </div>

          <textarea
            name="description"
            rows="4"
            cols="30"
            placeholder="description"
            id="description"
          ></textarea>
          <button>Add task</button>
        </form>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Users from "./Users.vue";
import Tasks from "./Tasks.vue";
import Progress from "./Progress.vue";
import JetSectionBorder from "@/Jetstream/SectionBorder";
import { Inertia } from "@inertiajs/inertia";

export default {
  components: {
    AppLayout,
    JetSectionBorder,
    Users,
    Tasks,
    Progress,
  },
  props: {
    user: Object,
    users: Object,
    tasks: Object,
    progress: Object,
  },

  methods: {
    addNewTask() {
      document.querySelector(".bg-modal").style.display = "flex";
    },

    saveTask() {
      Inertia.post(this.route("task.store"), {
        _token: this.$page.props.csrf_token,
        for_user: document.querySelector("#for_user").value,
        description: document.querySelector("#description").value,
      });
      document.querySelector(".bg-modal").style.display = "none";
    },

    closeForm() {
      document.querySelector(".bg-modal").style.display = "none";
    },

    updateTask(taskId, status) {
      Inertia.patch(this.route("task.update"), {
        _token: this.$page.props.csrf_token,
        id: taskId,
        status: status,
      });
    },
  },
};
</script>

<style lang="scss" scoped>
.bg-modal {
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.7);
  position: absolute;
  top: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 4px;
  display: none;

  .modal-content {
    width: 400px;
    height: 250px;
    background-color: white;
    padding: 20px;

    input {
      width: 100%;
      margin-top: 20%;
    }

    .close {
      position: absolute;
      top: 0;
      right: 12px;
      font-size: 40px;
      transform: rotate(45deg);
      color: rgb(243, 229, 229);
      cursor: pointer;
    }
  }
}
</style>
