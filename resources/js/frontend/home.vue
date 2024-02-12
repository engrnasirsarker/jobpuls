<template>
    <h1 class="py-5 my-5 bg-rose-900">from home</h1>
    <table class="table-auto">
        <head>
            <tr>
                <th>Name</th>
                <th>Name</th>
                <th>Name</th>
            </tr>
        </head>
        <tbody>
            <tr v-for="row in rows">
                <td>{{ row }}</td>
            </tr>
        </tbody>
    </table>
</template>
<script setup>
import { ref, onMounted } from 'vue'
onMounted(() => {
    fetchData()
})
     
      
const rows = ref([]);
const fetchData = async () => {    
    const res = await axios.get('/api/users');
    rows.value = res.data;
}
</script>