<template>
    <div class="page-link-container">
        <div class="container-box">
            <div class="title-box">
                <h3 class="title">各ページへのリンク</h3>
            </div>
            <ul class="page-link-list">
                <li class="page-link">
                    <h5 class="page-link-title">書籍一覧</h5>
                    <div class="page-link-image"></div>
                    <p class="page-link-text">このサービスに登録された書籍の一覧へ移動します。</p>
                    <router-link to="/book" class="link-box">書籍一覧へ</router-link>
                </li>
                <li class="page-link">
                    <h5 class="page-link-title">著者一覧</h5>
                    <div class="page-link-image"></div>
                    <p class="page-link-text">このサービスに登録された著者の一覧へ移動します。</p>
                    <router-link to="/author" class="link-box">著者一覧</router-link>
                </li>
                <li class="page-link">
                    <h5 class="page-link-title">出版社一覧</h5>
                    <div class="page-link-image"></div>
                    <p class="page-link-text">このサービスに登録された出版社の一覧へ移動します。</p>
                    <router-link to="/publisher" class="link-box">出版社一覧</router-link>
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
    width: 80%;
}

.page-link-title {
    font-size: 24px;
    margin-bottom: 10px;
}

.page-link-image {
    width: 80%;
    height: 200px;
    padding: 5px;
    margin: 0 auto 20px;
    background-color: #cdffbe;
}

.page-link-text {
    margin: 0 auto 10px;
    text-align: center
}

.page-link {
    padding: 5px;
    margin-right: 20px;
    border-style: solid;
    border-color: #aaaac0;
    border-width: 3px;
    width: 270px;
}

.link-box {
    display: flex;
    justify-content: center;
    align-items: center;
    width:144px;
    height:40px;
    border-radius: 5%;
    background-color: #0c2e8f;
    color: #fafafa;
    margin: 0 auto;
    text-decoration:none;
    font-weight: 800;
}

.link-box:visited {
    color: #fafafa;
}

</style>
