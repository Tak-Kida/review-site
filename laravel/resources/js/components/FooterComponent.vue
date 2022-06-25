<template>
    <footer class="footer">
        <p>footer</p>
        <ul>
            <li><router-link to="/">top</router-link></li>
            <li><router-link to="/book">book</router-link></li>
            <li><router-link to="/author">author</router-link></li>
            <li><router-link to="/publisher">publisher</router-link></li>
        </ul>
    </footer>
</template>

<style>
.footer {
    width:100%;
    /* height: 50px; */
    background-color: aquamarine;
}
</style>
