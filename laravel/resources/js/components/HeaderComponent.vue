<template>
    <header class="header">
        <div class="header-left">
            <div class="header-logo">
                <small>logo</small>
            </div>
        </div>
        <div class="header-right">
            <div class="header-link">
                <small>link</small>
                <!-- <ul>
                    <li><router-link to="/">Top</router-link></li>
                    <li><router-link to="/test-page01">Test Page01</router-link></li>
                    <li><router-link to="/test-page02">Test Page02</router-link></li>
                    <li><router-link to="/book">Book</router-link></li>
                    <li><router-link to="/author">Author</router-link></li>
                </ul> -->
            </div>
        </div>
    </header>
</template>

<style>
.header {
    display: flex;
    justify-content: space-between;
    width: 100%;
    height: 100px;
    background-color: #f6f6f6;
}

.header-left {
    width: 50%;
    height: 50px;
    background-color: red
}

.header-right {
    display: flex;
    justify-content: flex-end;
    width: 50%;
    height: 50px;
    background-color: blue
}

.header-logo {
    width: 50px;
    height: 100%;
    background-color: green
}

.header-link {
    width: 50px;
    height: 100%;
    background-color: yellow
}
</style>
