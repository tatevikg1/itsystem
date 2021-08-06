<template>
  <div>
    <ul v-if="progress">
      <li v-for="task in progress" :key="task.id">
        <div>
          {{ task.description }}
          <span v-if="task.status == 'accepted'">ok</span>
          <span v-else>x</span>
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
    progress: {
      type: Object,
    },
    components: {
      AppLayout,
      JetSectionBorder,
    },
  },
};
</script>

