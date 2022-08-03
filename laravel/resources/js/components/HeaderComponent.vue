<template>
    <header class="header">
        <div class="header-container">
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
                </ul>
            </div>
        </div>
    </header>
</template>

<style>
.header {
    /* display: flex;
    justify-content: space-between; */
    width: 100%;
    height: 72px;
    background-color: #0c2e8f;
}

.header-container {
    display: flex;
    justify-content: space-between;
    width: 90%;
    /* max-width: none; */
    /* min-width: none; */
    height: 100%;
    margin: 0 auto;
    /* background-color: green */
}

.header-left {
    display: flex;
    /* width: 50px; */
    height: 100%;
    /* background-color: red */
}

.header-logo {
    margin-left: 10px;
    width: 60px;
    background-color: darkred
}

.service-title {
    font-size: 40px;
    margin: 16px 10px;
    color:#fafafa;
}

.header-right {
    display: flex;
    justify-content: flex-end;
    width: 50%;
    /* background-color: blue */
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
}

</style>
