<template>
    <div id="main-app">
        <ChatComponent></ChatComponent>
    </div>
</template>

<script>
    import ChatComponent from "./ChatApp"
    export default {
        name: "MainApp",
        components:{
            ChatComponent
        }
    }
</script>

<style scoped>

</style>