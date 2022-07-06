<template>
    <div>
        <p>出版社情報更新フォーム</p>
        <tr>
            <th scope="row">{{ publisher.id }}</th>
            <td>{{ publisher.name }}</td>
            <!-- <td><router-link to="'/publisher/detail/' + publisher.id">詳細</router-link></td> -->
            <!-- <td><a v-bind:href="'/publisher/detail/' + publisher.id">詳細</a></td> -->
            <!-- <a href="/publisher/edit/{{ $publisher->id }}">編集・削除</a></br> -->
        </tr>

        <form method="POST" v-bind:action="'/publisher/edit/' + publisher.id">
            <input type="hidden" name="_token" :value="csrf">
            <label>出版社名</label>
            <input type="text" name="name" v-bind:value="publisher.name ">
            <br />
            <label>出版社名（フリガナ）</label>
            <input type="text" name="name_furigana" v-bind:value="publisher.name_furigana ">
            <br />

            <input type="submit">
        </form>

        <form method="POST" v-bind:action="'/publisher/delete/' + publisher.id">
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
            publisher:[],
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        };
    },
    methods:{
        getPublisherDetail() {
            axios.get('/api/publisher/detail-json/' + this.id)
                .then((res) =>{
                    this.publisher = res.data;
                    this.msg = 'get data!';
                });
        }
    },
    mounted () {
        this.getPublisherDetail();
    },
}
</script>

