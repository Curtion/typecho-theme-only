<template>
  <div>{{data}}</div>
</template>
<script>
export default {
  data() {
    return {
      data: "测试",
    };
  },
  created() {
    setTimeout(() => {
      this.data = "我";
    }, 5000);
  },
};
</script>