<template>
<div>
    {{title}}
    <i v-show="direcao === 'asc'  && orderBy === coluna"  class="el-icon-arrow-down"></i>
    <i v-show="direcao === 'desc' && orderBy === coluna" class="el-icon-arrow-up"></i>
</div>
</template>

<script>
export default {
    name: "DirecaoSet",

  props:{
      title : String,
      direcao : String,
      orderBy : String,
      coluna  : String
  },

}
</script>
