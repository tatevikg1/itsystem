<template>
  <div>
    <ul v-if="users">
      <li v-for="user in users" :key="user.id">
        <div>
          {{ user.email }}
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
    users: {
      type: Object,
    },
    components: {
      AppLayout,
      JetSectionBorder,
    },
  }
};
</script>

