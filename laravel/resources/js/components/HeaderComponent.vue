<template>
    <header class="header">
        <div class="header-left">
            <div class="header-logo">
                <small>logo</small>
            </div>
            <!-- サービス名 -->
            <h2 class="service-title">Book-reviews</h2>
        </div>
        <div class="header-right">
            <ul class="header-link-list">
                <li class="header-link">ログイン</li>
                <!-- <li class="header-link">USER</li>
                <li class="header-link">ログアウト</li> -->
                <!-- <ul>
                    <li><router-link to="/">Top</router-link></li>
                    <li><router-link to="/test-page01">Test Page01</router-link></li>
                    <li><router-link to="/test-page02">Test Page02</router-link></li>
                    <li><router-link to="/book">Book</router-link></li>
                    <li><router-link to="/author">Author</router-link></li>
                </ul> -->
            </ul>
        </div>
    </header>
</template>

<style>
.header {
    display: flex;
    justify-content: space-between;
    width: 100%;
    height: 50px;
    background-color: #0c2e8f;
}

.header-left {
    display: flex;
    /* width: 50px;
    height: 50px; */
    /* background-color: red */
}

.service-title {
    font-size: 40px;
    margin: 5px 10px;
    color:#fafafa;
}

.header-right {
    display: flex;
    justify-content: flex-end;
    width: 50%;
    /* background-color: blue */
}

.header-logo {
    margin-left: 10px;
    width: 50px;
    background-color: darkred
}

.header-link-list {
    display: flex;
    margin: auto 0;
    /* color:#fafafa; */
    /* background-color: yellow */
}

.header-link {
    color:#fafafa;
    list-style: none;
    margin-right: 10px;
    /* background-color: yellow */
}

</style>
