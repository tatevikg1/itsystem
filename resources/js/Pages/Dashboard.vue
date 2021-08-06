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
          		<div class="grid grid-flow-col grid-cols-2 grid-rows-2 gap-4">
            		<div class="p-12 bg-gray-100">
						<h2 class="font-semibold text-xl text-gray-800 leading-tight"> Users</h2>
						<Users :users="users" />
					</div>

            		<div class="p-12 bg-gray-100">
						<h2 class="font-semibold text-xl text-gray-800 leading-tight" style="cursor: pointer"
							@click="addNewTask"> Add new board
						</h2>
					</div>

            		<div class="p-12 bg-gray-100">
						<h2 class="font-semibold text-xl text-gray-800 leading-tight">
							My tasks
						</h2>
						<table v-if="tasks" class="table-fixed border-separate" style="width:100%">

							<tr v-for="task in tasks" :key="task.id">
								<td class="w-1/3 ">
									{{ task.description }}
								</td>
								<td class="w-1/3 "> 
									<div @click="updateTask(task.id, 'accepted')" style="cursor: pointer" class="p-5 text-green-700">ok</div>
								</td>
								<td class="w-1/3 ">
									<div @click="updateTask(task.id, 'rejected')" style="cursor: pointer" class="p-5 text-red-700">x</div>
								</td>
							</tr>
						</table>

	            	</div>

					<div class="p-12 bg-gray-100">
						<h2 class="font-semibold text-xl text-gray-800 leading-tight">
							In progress
						</h2>
						<Progress :progress="progress" />
					</div>
        		</div>
        	</div>
      	</div>
    </div>

    <div class="bg-modal">
		<div class="modal-content">
			<div class="close" @click="closeForm">+</div>

			<div class="w-full max-w-xs">
				<form @submit.prevent="saveTask" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
					<div class="mb-4">
						<label class="block text-gray-700 text-sm font-bold mb-2" for="username">
							User
						</label>
						<select name="for_user" id="for_user">
							<option v-for="user in users" :key="user.id" :value="user.id">
							{{ user.name }}
							</option>
						</select>
					</div>

					<textarea name="description" rows="4" cols="20" placeholder="description" id="description"></textarea>
					<button>Add task</button>
				</form>
			</div>
		</div>
	</div>
</app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Users from "./Users.vue";
import Progress from "./Progress.vue";
import JetSectionBorder from "@/Jetstream/SectionBorder";
import { Inertia } from "@inertiajs/inertia";

export default {
  components: {
    AppLayout,
    JetSectionBorder,
    Users,
    Progress,
  },
  props: {
    user: Object,
    users: Object,
    progress: Object,
	tasks: Object
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
    // width: 400px;
    // height: 250px;
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
