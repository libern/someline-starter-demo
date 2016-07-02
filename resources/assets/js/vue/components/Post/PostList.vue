<template>

    <div class="list-group list-group-lg list-group-sp">
        <template v-for="item of items">
            <div class="col-md-4 m-b-sm">
                <lt-post-list-item :item="item"></lt-post-list-item>
            </div>
        </template>
    </div>

</template>

<style>
</style>

<script>
    import PostListGroupItem from './PostListGroupItem.vue'
    export default{
        data(){
            return {
//                msg: 'hello vue',
                items: [],
            }
        },
        components: {
            'lt-post-list-item': PostListGroupItem,
        },
        http: {
            root: '/api',
            headers: {
                Accept: 'application/x.someline.v1+json'
            }
        },
        ready() {
            console.log('Ready');

            var resource = this.$resource('posts', {
//                include: ''
            });

            // get item
            resource.get({}).then(function (response) {
                console.log(response);
                console.log(response.data.data);
                this.$set('items', response.data.data)
            });
        }
    }
</script>