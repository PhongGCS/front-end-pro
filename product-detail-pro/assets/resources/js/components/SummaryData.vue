<template>
    <div class="_flex _justify-between _px-4 _py-4">
        <span class="_text-lg _font-bold">{{summaryItem.parent}}</span> <br><span>{{summaryItem.name}}</span>
    </div>
</template>
<script>
export default {
  name: 'SummaryData',
  props: {
    summaryItem: Object,
  },
  methods: {
  }
}
</script>