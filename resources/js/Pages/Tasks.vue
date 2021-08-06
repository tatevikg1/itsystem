<template>
  <div>
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
          <span
            @click="task"
            style="cursor: pointer"
            class="p-5"
            >XXXXXXX</span
          >
        </div>
      </li>
    </ul>
  </div>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import JetSectionBorder from "@/Jetstream/SectionBorder";

export default {
  props: {
    tasks: {
      type: Object,
    },
    components: {
      AppLayout,
      JetSectionBorder,
    },
    methods: {
      updateTask(taskId, status) {
        console.log("f");
        Inertia.patch(this.route("task.update"), {
          _token: this.$page.props.csrf_token,
          id: taskId,
          status: status,
        });
      },
      task() {
        console.log("f");
      },
    },
  },
};
</script>

