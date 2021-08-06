<template>
  <div >
    <table v-if="progress" class="table-fixed border-separate" style="width:100%">
      <tr v-for="task in progress" :key="task.id">
        <td class="w-2/3 ">
          {{ task.description }}
        </td>

        <td class="w-1/3 ">
          <div v-if="task.status == 'accepted'" class="text-green-700">ok</div>
          <div v-else class="text-red-700">x</div>
        </td>
      </tr>
    </table>
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

