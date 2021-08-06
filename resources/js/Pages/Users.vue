<template>
  <div v-if="users">
    <dl v-for="(user, index) in users" :key="user.id">
        <dt>{{index + 1}}. </dt>
        <dd>
          {{ user.name }}
        </dd>
    </dl>
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
  },
};
</script>

<style lang="scss" scoped>
dl {
  width: 100%;
  overflow: hidden;
  padding: 0;
  margin: 0
}
dt {
  float: left;
  width: 10%;
  padding: 0;
  margin: 0
}
dd {
  float: left;
  width: 90%;
  padding: 0;
  margin: 0
}
</style>

