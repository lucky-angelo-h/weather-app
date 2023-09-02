<template>
  <main class="py-4">
    <div class="container flex justify-content-center align-items-center">
      <h1>Welcome to weather app</h1>
    </div>
      
  </main>
  
</template>

<script>

  export default {
    props: ['place'],
    mounted() {
        console.log('Component mounted.')
        setTimeout(3000, function() {
          router.push('/app');
        })
    },
    data () {
      
    },
    methods: {
      
    }
  }
</script>