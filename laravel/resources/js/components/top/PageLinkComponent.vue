<template>
    <div class="page-link-container">
        <div class="container-box">
            <div class="title-box">
                <h3 class="title">各ページへのリンク</h3>
            </div>
            <ul class="page-link-list">
                <li class="page-link">
                    <router-link to="/book" class="link-box">書籍一覧</router-link>
                </li>
                <li class="page-link">
                    <router-link to="/author" class="link-box">登録著者一覧</router-link>
                </li>
                <li class="page-link">
                    <router-link to="/publisher" class="link-box">登録出版社一覧</router-link>
                </li>
            </ul>
        </div>
    </div>
</template>

<style>
.title-box {
    display: flex;
}
.title {
    position: relative;
    top: 0;
    left: 0;
    font-size: 24px;
    border-bottom: 3px solid #0c2e8f;
    margin-bottom: 10px;
}

.title::before {
    position: absolute;
    bottom: 0;

    content: '';
    width: auto;
    border-bottom: 3px solid aqua;
}

.page-link-container {
    display: flex;
    width:100%;
    /* height:150px; */
    padding: 10px;
    background-color: #fafafa;

}

.page-link-list {
    display: flex;
    justify-content: space-between;
    margin: auto auto;
    width: 70%;
}

.page-link {
    padding: 5px;
}

.link-box {
    display: flex;
    justify-content: center;
    align-items: center;
    width:126px;
    height:80px;
    border-radius: 5%;
    background-color: #cdffbe;
    text-decoration:none;
    font-weight: 800;
}

</style>
