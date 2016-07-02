import UserList from './vue/components/UserList.vue'
import PostList from './vue/components/Post/PostList.vue'

export default {
    data: {
        msg: "hello",
    },
    components: {
        'lt-user-list': UserList,
        'lt-post-list': PostList,
    },
    methods: {
    },
    events: {
    },
    created(){
        console.log('Bootstrap.');
    }
}