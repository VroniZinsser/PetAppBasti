<template>
  <div class="drop-drown-container">
    <v-menu offset-y>
      <template v-slot:activator="{ on, attrs }">
        <v-btn
            v-bind="attrs"
            v-on="on"
        >
          <span class="material-icons">more_vert</span>
          <span class="sr-only">Configuración</span>
        </v-btn>
      </template>

      <v-list>
        <v-list-item>
          <v-list-item-title>
            <button @click="$emit('deletePet')">Eliminar</button>
          </v-list-item-title>
        </v-list-item>
      </v-list>
    </v-menu>
  </div>
</template>

<script>
export default {
  name: "Dropdown",
}
</script>

<style scoped>

</style>
