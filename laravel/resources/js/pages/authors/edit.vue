<template>
    <div>
        <p>著者情報更新フォーム</p>
        <tr>
            <th scope="row">{{ author.id }}</th>
            <td>{{ author.name }}</td>
            <!-- <td><router-link to="'/author/detail/' + author.id">詳細</router-link></td> -->
            <!-- <td><a v-bind:href="'/author/detail/' + author.id">詳細</a></td> -->
            <!-- <a href="/author/edit/{{ $author->id }}">編集・削除</a></br> -->
        </tr>

        <form method="POST" v-bind:action="'/api/author/edit/' + author.id">
            <input type="hidden" name="_token" :value="csrf">
            <label>著者名</label>
            <input type="text" name="name" v-bind:value="author.name ">
            <br />
            <label>著者名（フリガナ）</label>
            <input type="text" name="name_furigana" v-bind:value="author.name_furigana ">
            <br />

            <input type="submit">
        </form>

        <form method="POST" v-bind:action="'/api/author/delete/' + author.id">
            <input type="hidden" name="_token" :value="csrf">
            <label>削除：</label>
            <input type="submit" value="実行">
        </form>
    </div>
</template>

<script>
export default {
    props: {
        id: {type: Number},
    },
    data:function(){
        return {
            msg:'wait...',
            author:[],
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        };
    },
    methods:{
        getAuthorDetail() {
            axios.get('/api/author/detail-json/' + this.id)
                .then((res) =>{
                    this.author = res.data;
                    this.msg = 'get data!';
                });
        }
    },
    mounted () {
        this.getAuthorDetail();
    },
}
</script>

